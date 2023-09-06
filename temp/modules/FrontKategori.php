<?php
class FrontKategori {
	function __construct(){
		$this->scr 			= new SecurityClass;
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
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
		$jml_per_halaman = 20;
		$jml = $this->db->get_num_rows("SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1' and berita.id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id_kategori']))."' ORDER BY berita.tanggal DESC");
		$jml_halaman = ceil($jml/$jml_per_halaman);

		if(isset($_GET['page'])) {
			$page = $_GET['page'];
			$q = "SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1' and berita.id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id_kategori']))."' ORDER BY berita.tanggal DESC LIMIT ".(($page - 1) * $jml_per_halaman).", $jml_per_halaman";
			
		} else {
			$page = 1;
			$q = "SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1' and berita.id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id_kategori']))."' ORDER BY berita.tanggal DESC LIMIT 0, $jml_per_halaman";
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

		$qk = "SELECT * FROM berita_kategori WHERE id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id_kategori']))."'";
		$rk = $this->db->get_single_result($qk);
		if ($rk['status'] == '0') {
			$page_title = "BERITA - ".str_replace([' ', '_'], ' ', $rk['nama_kategori']);
		}else{
			$page_title =str_replace([' ', '_'], ' ', $rk['nama_kategori']);
		}
			
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
}
?>