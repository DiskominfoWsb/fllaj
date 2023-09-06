<?php
class Account{
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty();
		$this->wf 		 = new WF;
		$this->page_title = 'SETTING ACCOUNT';			
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
		    if($_POST['nama_lengkap'] == '') $error[] = '- Silahkan isi nama ';
		    if($_POST['email'] == '') $error[] = '- Silahkan isi email ';
		    if($_POST['no_hp'] == '') $error[] = '- Silahkan isi nomor hp ';
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try {
					$data = array(
						'nama_lengkap'    	=> $_POST['nama_lengkap'],
						'no_hp'    	=> $_POST['no_hp'],
						'email'    	=> $_POST['email']
					);
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'foto', 'mnuser');
						if ($gambar) {
							$data['foto'] = $gambar;
							$query = "SELECT foto FROM users WHERE user_id = '".$_SESSION['user_id']."'";
							$gbr_lama = $this->db->get_single_result($query);
							if (file_exists("images/".$gbr_lama['foto']) && !empty($gbr_lama['foto'])) {
								unlink("files/mnuser/".$gbr_lama['foto']);
							}
						}
					}
					$where = array(
						'user_id' => $_SESSION['user_id']
					);
					$this->db->do_update( 'users', $data, $where, 1 );
					$response = '{"response":"true","message":"Berhasil Diupdate","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}
	        }
	        die($response);
		}
		$q="SELECT user_id,username,password,nama_lengkap,no_hp,level_akses,foto,email
			FROM users WHERE user_id ='".$_SESSION['user_id']."'";
		$result = $this->db->get_single_result($q,PDO::FETCH_NUM);	   
        list($user_id,$username,$password,$nama_lengkap,$no_hp,$level_akses,$foto,$email) = $result;
		
		$this->smarty->assign('page_title', $this->page_title);				
		$this->smarty->assign('namaValue', $username);
		$this->smarty->assign('nama_lengkap', $nama_lengkap);
		if (!file_exists('files/mnuser/'.$foto)) {
			$this->smarty->assign('foto', 'images/blank.jpg'); 
		}else{
			$this->smarty->assign('foto', ROOTDIR.'files/mnuser/'.$foto); 
		}
		$this->smarty->assign('email', $email);
		$this->smarty->assign('basedir', ROOTDIR);
		$this->smarty->assign('no_hp', $no_hp);
		$this->smarty->assign('act', '?mode=admin&amp;menu='.$_GET['menu'].'&amp;f=auth');

        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('index.tpl');		
	}
}
?>