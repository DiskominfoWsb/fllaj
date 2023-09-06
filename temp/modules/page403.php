<?php
class page403{
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty();
		$this->wf 		 = new WF;
		$this->page_title = 'ERROR ';			
	}
	
	function init(){
		$this->smarty->assign('basedir', ROOTDIR);
		$this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/403/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('index.tpl');		
	}
}
?>