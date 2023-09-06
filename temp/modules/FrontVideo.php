<?php
class FrontVideo {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->url 		 = new UrlCLass; 
		$this->fronthome 		 = new FrontHome; 
		$this->wf 		 = new WF; 
		$this->page_title = 'GALERI VIDEO';	


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
			default:
				return($this->index());
				break;
		}
	}

	function index(){
		$pagination = '';
		$data = $return_arr = false;
		$jml_per_halaman = 6;
		$jml = $this->db->get_num_rows("SELECT * FROM video WHERE status = '1' ORDER BY id DESC");
		$jml_halaman = ceil($jml/$jml_per_halaman);

		$return_arr = array();

		if(isset($_GET['page'])) {
			$page = $_GET['page'];
			$q = "SELECT * FROM video WHERE status = '1' ORDER BY id DESC LIMIT ".(($page - 1) * $jml_per_halaman).", $jml_per_halaman";
			
		} else {
			$page = 1;
			$q = "SELECT * FROM video WHERE status = '1' ORDER BY id DESC LIMIT 0, $jml_per_halaman";
		}
		$results = $this->db->get_results($q);
		
		$cn = 1;
	    foreach ($results as $row) {
	    	$link = explode("&", $row['link']);
			$vlink =  $link[0];

	    	$row_array['link']		= str_replace("watch?v=", "embed/", $vlink).'?ecver=1';
	    	$row_array['judul']		= $row['judul'];
			$row_array['keterangan']	= $row['keterangan'];
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
				<div class=" col-md-5 text-center previous"><a '.$awal.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'video/'.$seb.'">Sebelumnya</a></div>
				<div class=" col-md-2 text-center page-amount">'.$page.' of '.$jml_halaman.'</div>
				<div class=" col-md-5 text-center next"><a '.$akhir.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'video/'.$ses.'">Selanjutnya</a></div>
			</div>';

		$this->smarty->assign('pagination', $pagination);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init());
        
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('judul', 'Galeri Video'); 

        return $this->smarty->fetch('index.tpl');
	}
}
?>