<?php
class GantiPassword{
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty();
		$this->page_title = 'Ganti Password';			
	}
	
	function init(){
		!isset($_GET['f']) ? $_GET['f'] = 'manage' : false;
		switch( $_GET['f'] ){
			case 'auth':
				return($this->auth());
				break;
			default:
				return($this->index());
				break;
		}
	}
	
	function index(){	
		if (!empty($_POST)) {
			if($_POST['oldps'] == '') $error[] = '- Silahkan masukkan password Lama Anda';
			if(md5($_POST['oldps']) != base64_decode($_SESSION[md5(APP_ID.'sspsw')])) $error[] = '- Password Lama Anda SALAH!!';
	        if($_POST['newps'] == '') $error[] = '- Silahkan masukkan password Baru Anda';
	        if($_POST['re_newps'] == '') $error[] = '- Silahkan masukkan Konfirmasi password Baru Anda';
	        if($_POST['newps'] <> $_POST['re_newps']) $error[] = '- Konfirmasi Password Tidak Sama';
	        if(strlen($_POST['newps']) < 5 || strlen($_POST['newps']) > 30) $error[] = "- Password antara 5 sampai 30 karakter";

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode(' ', $error).'"}';
	            die($response);
	        } 
	        else{
				$update = array(
					'password' => sha1('wf'.md5($_POST['newps']))
				);
				$where_clause = array(
					'user_id' => $_SESSION['user_id']
				);

				try {
					$this->db->do_update( 'users', $update, $where_clause, 1 );
					$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
				} catch (PDOException $e) {
					$response = '{"response":"false","message":"Query Roolback"}';
				}
				die($response);
			}
		}
		$this->smarty->assign('page_title', $this->page_title);				

        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('index.tpl');		
	}
}
?>