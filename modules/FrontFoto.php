<?php
class FrontFoto {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->anu 	 = new DateClass;	
		$this->fronthome 		 = new FrontHome; 
		$this->url 		 = new UrlCLass; 
		$this->scr 			= new SecurityClass;
		$this->page_title = '';

		$this->smarty->setTemplateDir('templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
	}
	
	function init(){
		if(!isset($_GET['f'])) $_GET['f'] = 'index';
		switch( $_GET['f'] ){
			case 'home':
				return $this->home();
				break;
			case 'albumfoto':
				return $this->albumfoto();
				break;
			case 'getfoto':
				return $this->getfoto();
				break;
			default:
				return($this->index());
				break;
		}
	}

	function home(){
		$data = false;
		$q = "SELECT * FROM galeri_foto WHERE status = '1' ORDER BY id_foto DESC LIMIT 6";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id_foto'] = $row['id_foto']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['keterangan'] = $row['keterangan']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['namafile'] = $row['namafile']; 
		    $row_array['cek'] = file_exists('files/albumfoto/'.$row['namafile']);

		    array_push($return_arr,$row_array);
		} 

        return $return_arr;
	}

	function getfoto(){
		$data = false;
		$q = "SELECT * FROM galeri_foto WHERE id_foto = '".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
		$results = $this->db->get_single_result($q);

		$html = false;
		$html .= "<div class='col-md-12'>";
		$html .= "<img src='".ROOTDIR."files/albumfoto/".$results['namafile']."' class='img-responsive'>";
		$html .= "</div>";

        die($html);
	}

	function index(){
		$pagination = '';
		$data = $return_arr = false;
		$jml_per_halaman = 21;
		$jml = $this->db->get_num_rows("SELECT f.*, 
				k.keterangan AS album_ket, 
				k.id_kategori AS id_album 
				FROM galeri_foto AS f 
				JOIN galeri_kategori AS k 
				ON f.id_kategori=k.id_kategori 
				Where f.status = 1
				GROUP BY k.id_kategori 
				ORDER BY k.id_kategori DESC");

		$jml_halaman = ceil($jml/$jml_per_halaman);

		$q = "SELECT * FROM pages WHERE module = '".$this->scr->esc(htmlspecialchars($_GET['menu']))."'";
        $result = $this->db->get_single_result($q);
        $this->smarty->assign('arr_data', $result); 

		// $return_arr = false;

		if(isset($_GET['page'])) {
			$page = $_GET['page'];
			$q = "SELECT f.*, 
				count(f.id_foto) as jml,
				k.keterangan AS album_ket, 
				k.id_kategori AS id_album 
				FROM galeri_foto AS f 
				JOIN galeri_kategori AS k 
				ON f.id_kategori=k.id_kategori 
				Where f.status = 1
				GROUP BY k.id_kategori 
				ORDER BY k.id_kategori DESC LIMIT ".(($page - 1) * $jml_per_halaman).", $jml_per_halaman";
			
		} else {
			$page = 1;
			$q = "SELECT f.*, 
				count(f.id_foto) as jml,
				k.keterangan AS album_ket, 
				k.id_kategori AS id_album 
				FROM galeri_foto AS f 
				JOIN galeri_kategori AS k 
				ON f.id_kategori=k.id_kategori 
				Where f.status = 1
				GROUP BY k.id_kategori 
				ORDER BY k.id_kategori DESC LIMIT 0, $jml_per_halaman";
		}
		$results = $this->db->get_results($q);
		$return_arr = array();
		$cn = 1;
	    foreach ($results as $row) {
			$row_array['link'] 		= ROOTDIR.'foto/'.$row['id_album'].'/'.$this->url->friendlyURL($row['judul']);
			$row_array['judul']		= $row['judul'];
			$row_array['gambar']		= ROOTDIR.'files/albumfoto/'.$row['namafile'];
			$row_array['album_ket']	= $row['album_ket'];
			$row_array['jml']		= $row['jml'];
			$row_array['end']		= $this->db->get_num_rows($q);
			$row_array['no']		= $cn;

	    	array_push($return_arr,$row_array);
	    	$cn++;
	    }

		$page_title = "Galeri Album";

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
			<div class=" col-md-5 text-center previous"><a '.$awal.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'foto/'.$seb.'">Sebelumnya</a></div>
			<div class=" col-md-2 text-center page-amount">'.$page.' of '.$jml_halaman.'</div>
			<div class=" col-md-5 text-center next"><a '.$akhir.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'foto/'.$ses.'">Selanjutnya</a></div>
		</div>';

		$this->smarty->assign('pagination', $pagination);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr);
		$this->smarty->assign('judul', $page_title);

        return array('data'=>$this->smarty->fetch('index.tpl'), 'judul' => $page_title);
	}

	function albumfoto(){
		$pagination = '';
		$data = $return_arr = false;
		$jml_per_halaman = 12;
		$jml = $this->db->get_num_rows("SELECT f.*, 
				f.keterangan AS foto_ket, 
				f.id_foto AS id_foto 
				FROM galeri_foto AS f 
				JOIN galeri_kategori AS k 
				ON f.id_kategori=k.id_kategori 
				WHERE f.status = 1 and f.id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id']))."' 
				ORDER BY k.id_kategori DESC");
		$jml_halaman = ceil($jml/$jml_per_halaman);
		
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
			$q = "SELECT f.*, k.nama_kategori, 
				f.keterangan AS foto_ket, 
				f.id_foto AS id_foto 
				FROM galeri_foto AS f 
				JOIN galeri_kategori AS k 
				ON f.id_kategori=k.id_kategori 
				WHERE f.status = 1 and f.id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id']))."' 
				ORDER BY k.id_kategori DESC LIMIT ".(($page - 1) * $jml_per_halaman).", $jml_per_halaman";
			
		} else {
			$page = 1;
			$q = "SELECT f.*, k.nama_kategori, 
				f.keterangan AS foto_ket, 
				f.id_foto AS id_foto 
				FROM galeri_foto AS f 
				JOIN galeri_kategori AS k 
				ON f.id_kategori=k.id_kategori 
				WHERE f.status = 1 and f.id_kategori = '".$this->scr->esc(htmlspecialchars($_GET['id']))."' 
				ORDER BY k.id_kategori DESC LIMIT 0, $jml_per_halaman";
		}
		$results = $this->db->get_results($q);
		$page_title = 'Album "'.$results[0]['nama_kategori'].'"';
		$return_arr = array();
		$cn = 1;
	    foreach ($results as $row) {
			$row_array['judul']		= $row['judul'];
			$row_array['gambar']		= ROOTDIR.'files/albumfoto/'.$row['namafile'];
			$row_array['foto_ket']	= $row['foto_ket'];
			$row_array['end']		= $this->db->get_num_rows($q);
			$row_array['no']		= $cn;

	    	array_push($return_arr,$row_array);
	    	$cn++;
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
			<div class=" col-md-5 text-center previous"><a '.$awal.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'foto/'.$results[0]['id_kategori'].'/'.$this->url->friendlyURL($results[0]['nama_kategori']).'/'.$seb.'">Sebelumnya</a></div>
			<div class=" col-md-2 text-center page-amount">'.$page.' of '.$jml_halaman.'</div>
			<div class=" col-md-5 text-center next"><a '.$akhir.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'foto/'.$results[0]['id_kategori'].'/'.$this->url->friendlyURL($results[0]['nama_kategori']).'/'.$ses.'">Selanjutnya</a></div>
		</div>';

		$this->smarty->assign('pagination', $pagination);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('judul', $page_title); 

        return array('data'=>$this->smarty->fetch('foto.tpl'), 'judul' => $page_title);
	}
}
?>