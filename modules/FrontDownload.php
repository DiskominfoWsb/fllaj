<?php
class FrontDownload {
	function __construct(){
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
		$data = false;
		$q = "SELECT * FROM bankdata WHERE status = '1' ORDER BY tanggal DESC";
		$results = $this->db->get_results($q);
		$no = 1;
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['keterangan'] = $row['keterangan']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['namafile'] = $row['namafile']; 
		    $row_array['cek'] = file_exists('files/bankdata/'.$row['namafile']);
		    $row_array['seo'] = $this->url->friendlyURL($row['judul']); 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);
		    $row_array['end'] 			= $this->db->get_num_rows($q);

		    array_push($return_arr,$row_array);
		} 
		$page_title = "Bank Data";

		$this->smarty->assign('judul', $page_title);
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

        return array('data'=>$this->smarty->fetch('index.tpl'), 'judul' => $page_title);
	}
}
?>