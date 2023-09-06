<?php
class HomeClass{
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty();   
		$this->page_title = 'DASHBOARD';

		$this->date 	 = new DateClass;
        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/home/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');	
	}
	
	function init(){


        return $this->smarty->fetch('index.tpl');
	}

}
?>