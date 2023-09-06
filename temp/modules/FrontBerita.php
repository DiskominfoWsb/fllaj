<?php
class FrontBerita {
	function __construct(){
		$this->scr 			= new SecurityClass;
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
        $this->dbconf   = new DataConfigClass;  
		$this->anu 	 = new DateClass;	
		$this->url 		 = new UrlCLass; 
		$this->page_title = '';

		$this->smarty->setTemplateDir('templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
        $this->smarty->assign('filepath', ROOTDIR.'files/berita/');
	}
	
	function init(){
		if(!isset($_GET['f'])) $_GET['f'] = 'index';
		switch( $_GET['f'] ){
			case 'read':
				return $this->read();
				break;
			default:
				return($this->index());
				break;
		}
	}

	function index(){
		$pagination = '';
		$data = false;
		$jml_per_halaman = 12;
		$jml = $this->db->get_num_rows("SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1'
			ORDER BY berita.tanggal DESC");
		$jml_halaman = ceil($jml/$jml_per_halaman);

		if(isset($_GET['page'])) {
			$page = $_GET['page'];
			$q = "SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1'
			ORDER BY berita.tanggal DESC LIMIT ".(($page - 1) * $jml_per_halaman).", $jml_per_halaman";
			
		} else {
			$page = 1;
			$q = "SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1'
			ORDER BY berita.tanggal DESC LIMIT 0, $jml_per_halaman";
		}

		$results = $this->db->get_results($q);

		$no = 1;
		$return_arr = array();
		foreach ($results as $row) {
			$video = '';
			if ($row['video'] != "") {
				$video = '<label style="position: absolute; top: 7.5px; right: 7.5px;" class="btn btn-xs btn-danger" class="berita_video"> Berita Video </label>';
			}
			$gm = explode("|", $row['gambar']);
	    	if (file_exists('files/berita/'.$gm[0])) {
	    		$gambar = ROOTDIR.'files/berita/'.$gm[0];
	    	}else{
	    		$gambar = ROOTDIR.'images/image-not-available.jpg';
	    	}
		    $row_array['id'] 			= $row['id']; 
		    $row_array['kontributor'] 	= $row['kontributor']; 
		    $row_array['judul'] 		= $row['judul']; 
		    $row_array['isi'] 			= substr(strip_tags($row['isi']), 0, 100);
		    $row_array['baca'] 			= number_format($row['baca']/2,0,'.',','); 
		    $row_array['link'] 			= ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']); 
		    $row_array['gambar'] 		= $gambar; 
		    $row_array['tanggal'] 		= $this->date->IndonesianDatetime($row['tanggal']);
		    $row_array['end'] 			= $this->db->get_num_rows($q);

		    array_push($return_arr,$row_array);
		}

		$page_title = "Berita";
			
			$awal = $akhir = '';
			if ($page == $jml_halaman) {
				$akhir = 'hidden';
			}
			if ($page == 1) {
				$awal = 'hidden';
			}
			$seb = $page - 1;
			$ses = $page + 1;
			$pagination .= '<div class="row">
				<div class=" col-md-5 text-center previous"><a '.$awal.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'berita/'.$seb.'">Sebelumnya</a></div>
				<div class=" col-md-2 text-center page-amount">'.$page.' of '.$jml_halaman.'</div>
				<div class=" col-md-5 text-center next"><a '.$akhir.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'berita/'.$ses.'">Selanjutnya</a></div>
			</div>';

		$this->smarty->assign('pagination', $pagination);

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr);
		$this->smarty->assign('judul', $page_title);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init());

        return array('data'=>$this->smarty->fetch('index.tpl'), 'judul' => $page_title);
	}

	function read(){
		$data = false;
		$q = "SELECT berita.*, users.nama_lengkap as kontributor, users.fb, users.tw, users.ig, users.foto, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori where berita.id = '".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
		$r = $this->db->get_single_result($q);
		$baca = $r['baca'];
		$baca++;
		$r['baca'] = number_format($baca/2,0);
		$telo = array(
			'baca'    	=> $baca
		);
		$where = array(
			'id' => $r['id']
		);
		$this->db->do_update( 'berita', $telo, $where, 1 );
		// Slider Berita
		$gm_slide = $cap_slide = $gm_in = $cap_in = [];
		$gm = explode("|", $r['gambar']);
		$par = explode("|", $r['paragraf']);
		$cap = explode("|", $r['caption']);
		$no = 0;
		foreach ($gm as $key => $value) {
			if ($par[$key] == 0) {
				$gm_slide[$no] = $gm[$key];
				if (array_key_exists($key, $cap)) {
					$cap_slide[$no] = $cap[$key];
				}
				$no++;
			}else{
				$gm_in[$par[$key]] = $gm[$key];
				if (array_key_exists($key, $cap)) {
					$cap_in[$par[$key]] = $cap[$key];
				}
			}
		}
		$interval = true;
		// if (count($gm_slide) == 1) {
		// 	$gm_slide[1] = $gm_slide[0];
		// 	$interval = false;
		// }
		if (count($cap_slide) == 1) {
			$cap_slide[1] = $cap_slide[0];
		}
		// End Slider Berita
		// Link Sisipan
		$lain = "SELECT * FROM berita WHERE id <> '".$this->scr->esc(htmlspecialchars($_GET['id']))."' AND status = '1' AND id_kategori = '".$r['id_kategori']."' ORDER BY RAND() DESC LIMIT 1";
		$berita_lain = $this->db->get_results($lain);
		$dump_isi = explode("\n", $r['isi']);
		$new_isi = [];
		foreach ($dump_isi as $key => $value) {
			if (array_key_exists($key,$gm_in)) {
				$new_isi[] = '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    				<div class="carousel-inner" role="listbox">
    					<div class="carousel-item active">
            				<img src="'.ROOTDIR.'files/berita/'.$gm_in[$key].'" style="width: 100%;">';
		    				if (array_key_exists($key,$cap_in)) {
								$new_isi[] = '<div class="carousel-caption">
		                            <p>'.$cap_in[$key].'</p>
		                        </div>';
							}
						$new_isi[] = '</div>
					</div>
				</div>
				<br>';
			}
			if ($r['video'] != "") {
				if ($key == $r['paragraf_video']) {
			    	$link = explode("&", $r['video']);
					$vlink =  $link[0];
					$new_isi[] = '<iframe style="width: 100%; height: auto;" src="'.str_replace("watch?v=", "embed/", $vlink).'?ecver=1'.'" frameborder="0" allowfullscreen></iframe>';
				}
			}
			if ($key == 1) {
				$new_isi[] = $value;
				if ($this->db->get_num_rows($lain) > 0) {
					$new_isi[] = '<p> (<b>Baca Juga :</b> <a style="font-size: 0.92em;" href="'.ROOTDIR.'berita/read/'.$berita_lain[0]['id'].'/'.$this->url->friendlyURL($berita_lain[0]['judul']).'">'.$berita_lain[0]['judul'].'</a>) </p>';
				}
			}else{
				$new_isi[] = $value;
			}
		}
		$new_isi = implode("\n", $new_isi);
		// End Link Sisipan

		$foto = "images/icon.jpg";
		if (file_exists("files/users/".$r['foto'])) {
			$foto = "files/users/".$r['foto'];
		}
		$divkontributor = '<div class="row" style="margin: 20px 0 20px 0; background-color: #eff4f9; padding: 20px 0 20px 0; border-radius: 5px;">
			<div class="col-md-2">
                <img src="'.ROOTDIR.$foto.'" style="max-width: 100%; max-height: 125px; border-radius: 5px;">
            </div>
            <div class="col-md-10">
                <h3><b>'.$r['kontributor'].'</b></h3>
                <p>
                    Merupakan salah satu kontributor di <a href="https://mmc.kalteng.go.id">Multimedia Center Provinsi Kalimantan Tengah</a>.
                </p>
                <div class="row">
            		<div class="col-xs-12">
	                    <a href="'.$r['fb'].'" style="margin-left: 5px;" target="_blank">
	                        <img src="'.ROOTDIR.'images/fb-logo.png" style="height: 30px;">
	                        <img class="hidden-xs hidden-sm" src="'.ROOTDIR.'images/facebook-logo-png-1722.png" style="height: 30px;">
	                    </a> 
	                    <a href="https://twitter.com/'.str_replace("@", "", $r['tw']).'" style="margin-left: 5px;" target="_blank">
	                        <img src="'.ROOTDIR.'images/twitter_PNG5.png" style="height: 30px;">
	                        <img class="hidden-xs hidden-sm" src="'.ROOTDIR.'images/2000px-Twitter_logo.png" style="height: 30px;">
	                    </a>
	                    <a href="https://instagram.com/'.str_replace("@", "", $r['ig']).'" style="margin-left: 5px;" target="_blank">
	                        <img src="'.ROOTDIR.'images/insta3.png" style="height: 30px;">
	                        <img  class="hidden-xs hidden-sm" src="'.ROOTDIR.'images/instagram-logo.png" style="height: 30px;">
	                    </a>
	                </div>
                </div>
            </div>
		</div>';
		// End Kontributor

		$url = htmlspecialchars("https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

		$page_title = $r['judul'];

		$this->smarty->assign('divkontributor', $divkontributor);
		$this->smarty->assign('url', $url);
		$this->smarty->assign('gambarutama', $gm[0]);
		$this->smarty->assign('gambarslider', $gm_slide);
		$this->smarty->assign('captionslider', $cap_slide);
		$this->smarty->assign('interval', $interval);
		$this->smarty->assign('isi', $new_isi);
		$this->smarty->assign('tanggal', $this->date->IndonesianDateTime($r['tanggal']));

		$this->smarty->assign('basedir', ROOTDIR);
		$this->smarty->assign('data', $r);
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']);

        $this->smarty->assign('berita_lain', $this->berita_lain($r));

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init());

        return array('data'=>$this->smarty->fetch('read.tpl'), 'judul' => $page_title);
	}

	function berita_lain($r){
		$ss = false;
		$qs = "SELECT * FROM berita where tanggal <= '".$r['tanggal']."' and id != ".$this->scr->esc(htmlspecialchars($_GET['id']))." order by tanggal DESC limit 1";
		$rs = $this->db->get_single_result($qs);
	    	$gm = explode("|", $rs['gambar']);
	    	if (!file_exists('files/berita/thumb_'.$gm[0])) {
	    		$file = ROOTDIR.'files/berita/TP_NoC_S.png';
	    	}else{
	    		$file = ROOTDIR.'files/berita/thumb_'.$gm[0];
	    	}
		$ss .= '<div class="col-lg-6">';
	    if ($this->db->get_num_rows($qs) > 0) {
			$ss .= '<div class="row">
				<div class="col-sm-4">
					<img src="'.$file.'" alt="" style="width: 100%; height: 100px;">
				</div>
				<div class="col-sm-8">
					<a href="'.ROOTDIR.'berita/read/'.$rs['id'].'/'.$this->url->friendlyURL($rs['judul']).'">
						<span>Previous Post</span>
						<h5>'.$rs['judul'].'</h5>
					</a>
				</div>
			</div>';
	    }
		$ss .= '</div>';
		$qs = "SELECT * FROM berita where tanggal >= '".$r['tanggal']."' and id != ".$this->scr->esc(htmlspecialchars($_GET['id']))." order by tanggal ASC limit 1";
		$rs = $this->db->get_single_result($qs);
	    	$gm = explode("|", $rs['gambar']);
	    	if (!file_exists('files/berita/thumb_'.$gm[0])) {
	    		$file = ROOTDIR.'files/berita/TP_NoC_S.png';
	    	}else{
	    		$file = ROOTDIR.'files/berita/thumb_'.$gm[0];
	    	}
		$ss .= '<div class="col-md-6">';
	    if ($this->db->get_num_rows($qs) > 0) {
			$ss .= '<div class="row">
				<div class="col-sm-8 text-right">
					<a href="'.ROOTDIR.'berita/read/'.$rs['id'].'/'.$this->url->friendlyURL($rs['judul']).'">
						<span>Next Post</span>
						<h5>'.$rs['judul'].'</h5>
					</a>
				</div>
				<div class="col-sm-4">
					<img src="'.$file.'" alt="" style="width: 100%; height: 100px;">
				</div>
			</div>';
	    }
		$ss .= '</div>';
		return $ss;
	}
}
?>