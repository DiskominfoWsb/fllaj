<?php
class MasterUser {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->dbconf     = new DataConfigClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->paging    = new PagingClass;
		$this->scr 			= new SecurityClass;
		$this->wf 		 = new WF;
		$this->page_title = 'MASTER USER';	
		$this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
	}
	function init(){
		if(!isset($_GET['f'])) $_GET['f'] = 'index';
		switch( $_GET['f'] ){
			case 'add':
				return $this->add();
				break;
			case 'edit':
				return $this->edit();
				break;
			case 'delete':
				return $this->delete();
				break;
			case 'publish':
				return $this->publish();
				break;
			default:
				return($this->index());
				break;
		}
	}
	function navigasi(){
		if($_GET['f']=='edit')
		{	
			$nav = array('index'	=> array('t'=>'MANAGE', 'c'=>''),
						);
		}else{
			$nav = array('index'	=> array('t'=>'MANAGE', 'c'=>''),
					     'add'		=> array('t'=>'TAMBAH', 'c'=>''),
					    );
		}
		
		return($this->nav->render($nav));
	}
	function index(){
		$q = "SELECT * FROM users WHERE user_id != '2' ORDER BY level_akses,user_id asc";
		
		$results = $this->db->get_results($q);
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['user_id']; 
		    $row_array['nama_lengkap'] = $row['nama_lengkap']; 
		    $row_array['no_hp'] = $row['no_hp']; 
		    $row_array['email'] = $row['email'];
		    if ($row['level_akses'] == 1) {
		    	$row_array['level_akses'] = "Admin";
		    }else{
		    	$row_array['level_akses'] = "Operator";
		    }
		    $row_array['status'] = $row['status'];
		    array_push($return_arr,$row_array);
		} 
		$this->smarty->assign('basedir', ROOTDIR);
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
        return $this->smarty->fetch('index.tpl');
	}
	function add(){
		if (!empty($_POST)) {
			if($_POST['username'] == '') $error[] = '- Silahkan isi Username ';
	        if($_POST['password'] == '') $error[] = '- Silahkan isi Password';
	        if($_POST['level_akses'] == '') $error[] = '- Silahkan Pilih Level Akses';
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try {
					$data = array(
						'username'    	=> $_POST['username'],
						'password'    	=> sha1('wf'.md5($_POST['password'])),
						'level_akses'    	=> $_POST['level_akses'],
						'nama_lengkap'    	=> $_POST['nama_lengkap'],
						'no_hp'    	=> $_POST['no_hp'],
						'email'    	=> $_POST['email'],
						'last_login' => date('Y-m-d H:i:s')
					);
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'foto', 'mnuser');
						if ($gambar) {
							$data['foto'] = $gambar;
						}
					}
					$this->db->do_insert( 'users', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}
	        }
	        die($response);
		}
		$this->smarty->assign('page_title', $this->page_title);  
		$this->smarty->assign('navigasi', $this->navigasi()); 
		return $this->smarty->fetch('add.tpl');
	}
	function edit(){
		if (!empty($_POST)) {
			if($_POST['username'] == '') $error[] = '- Silahkan isi Username ';
        	if($_POST['level_akses'] == '') $error[] = '- Silahkan Pilih Level Akses';
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try {
					$data = array(
						'username'    	=> $_POST['username'],
						'level_akses'    	=> $_POST['level_akses'],
						'nama_lengkap'    	=> $_POST['nama_lengkap'],
						'no_hp'    	=> $_POST['no_hp'],
						'email'    	=> $_POST['email'],
						'last_login' => date('Y-m-d H:i:s')
					);
					if (!empty($_POST['password'])) {
						$data['password'] = sha1('wf'.md5($_POST['password']));
					}
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'foto', 'mnuser');
						if ($gambar) {
							$data['foto'] = $gambar;
							$query = "SELECT foto FROM users WHERE user_id = '".$_GET['id']."'";
							$gbr_lama = $this->db->get_single_result($query);
							if (file_exists("images/".$gbr_lama['foto']) && !empty($gbr_lama['foto'])) {
								unlink("files/mnuser/".$gbr_lama['foto']);
							}
						}
					}
					$where = array(
						'user_id' => htmlspecialchars($_GET['id'])
					);
					$this->db->do_update( 'users', $data, $where, 1 );
					$response = '{"response":"true","message":"Berhasil Diupdate","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}
	        }
	        die($response);
		}
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$query = "SELECT * FROM users where user_id='".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
		$results = $this->db->get_single_result($query);
		if (!file_exists('files/mnuser/'.$results['foto']) or $results['foto'] == "") {
			$this->smarty->assign('foto', ROOTDIR.'files/mnuser/icon.jpg'); 
		}else{
			$this->smarty->assign('foto', ROOTDIR.'files/mnuser/'.$results['foto']); 
		}
		
		$this->smarty->assign('data', $results); 
		$this->smarty->assign('basedir', ROOTDIR); 
		return $this->smarty->fetch('edit.tpl');
	}
	function delete(){
		try 
		{
			$query = "SELECT foto FROM users WHERE user_id = '".$_POST['id']."'";
			$gbr_lama = $this->db->get_single_result($query);
			if (file_exists(ROOTDIR."files/mnuser/".$gbr_lama['foto']) && !empty($gbr_lama['foto'])) {
				unlink(ROOTDIR."files/mnuser/".$gbr_lama['foto']);
			}
			$delete = array(
			    'user_id' => $_POST['id']
			);
			$this->db->do_delete( 'users', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
		}
		catch(PDOException $e)
		{
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die($response);
	}

	function publish(){
		try {
			$data = array(
				'status'    	=> $_POST['status']
			);
			$where = array(
				'user_id' => $_POST['id']
			);
			$this->db->do_update('users', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}