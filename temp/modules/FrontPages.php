<?php
class FrontPages {
	function __construct(){
		$this->scr 			= new SecurityClass;
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
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
        $qconf = "SELECT * FROM setting where id = 1";
        $rconf = $this->db->get_single_result($qconf);
        $this->smarty->assign('rconf', $rconf);

		$q = "SELECT * FROM pages WHERE id = '".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
        $result = $this->db->get_single_result($q);

        $this->smarty->assign('arr_data', $result); 

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

        return array('data'=>$this->smarty->fetch('read.tpl'), 'judul'=>$result['judul']);
	}
}
?>