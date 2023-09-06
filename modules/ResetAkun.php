<?php
class ResetAkun {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->dbconf     = new DataConfigClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->paging    = new PagingClass;
		$this->scr 			= new SecurityClass;
		$this->wf 		 = new WF;
		$this->page_title = 'Permintaan Reset Akun';	
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
			case 'kabupaten_add':
				return $this->kabupaten_add();
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
		$q = "SELECT * FROM permintaan ORDER BY tanggal desc";
		$results = $this->db->get_results($q);
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['nama'] = $row['nama']; 
		    $row_array['telp'] = $row['telp']; 
		    $row_array['daerah_asal'] = $row['daerah_asal']; 
		    $row_array['jabatan'] = $row['jabatan'];
		    $row_array['lampiran'] = $row['lampiran'];
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
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try {
					$data = array(
						'nama'    	=> $_POST['nama'],
						'daerah_asal'    	=> $_POST['daerah_asal'],
						'jabatan'    	=> $_POST['jabatan'],
						'telp'    	=> $_POST['telp'],
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'token'    	=> $this->token()
					);
					if (!empty($_FILES)) {
						$lampiran = $this->wf->upload_single_files($_FILES, 'lampiran', 'reset_akun');
						if ($lampiran) {
							$data['lampiran'] = $lampiran;
						}
					}
					$this->db->do_insert( 'permintaan', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}
	        }
	        die($response);
		}
		$this->smarty->assign('page_title', $this->page_title);  
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('provinsi', $this->provinsi()); 
		return $this->smarty->fetch('add.tpl');
	}
	function edit(){
		if (!empty($_POST)) {
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try {
					$data = array(
						'nama'    	=> $_POST['nama'],
						'daerah_asal'    	=> $_POST['daerah_asal'],
						'jabatan'    	=> $_POST['jabatan'],
						'telp'    	=> $_POST['telp'],
						'status'    	=> $_POST['status'],
					);
					if (!empty($_FILES)) {
						$lampiran = $this->wf->upload_single_files($_FILES, 'lampiran', 'reset_akun');
						if ($lampiran) {
							$data['lampiran'] = $lampiran;
						}
					}
					$where = array(
						'id' => htmlspecialchars($_GET['id'])
					);
					$this->db->do_update( 'permintaan', $data, $where, 1 );
					$response = '{"response":"true","message":"Berhasil Diupdate","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}
	        }
	        die($response);
		}
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$query = "SELECT * FROM permintaan where id='".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
		$results = $this->db->get_single_result($query);
		
		$this->smarty->assign('data', $results); 
		$this->smarty->assign('provinsi', $this->provinsi($results['daerah_asal'])); 
		$this->smarty->assign('basedir', ROOTDIR); 
		return $this->smarty->fetch('edit.tpl');
	}
	function delete(){
		try 
		{
			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'permintaan', $delete, 1 );
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
				'id' => $_POST['id']
			);
			$this->db->do_update('permintaan', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}

	function provinsi($id = ''){
		$data = '';
		$q = "SELECT * FROM lokasi order by kodelokasi asc";
		$r = $this->db->get_results($q);
		foreach ($r as $row) {
			$s = '';
			if ($row['lokasi'] == $id) {
				$s = 'selected';
			}
			$data .= '<option '.$s.'>'.$row['lokasi'].'</option>';
		}
		return $data;
	}

	function token(){
		$token = $this->wf->gen();
		$q = "SELECT * FROM permintaan where token = '".$token."'";
		if ($this->db->get_num_rows($q) > 0) {
			return $this->token();
		}else{
			return $token;
		}
	}
}