<?php
class Agenda {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->dbconf     = new DataConfigClass;
		$this->paging    = new PagingClass;
		$this->wf    = new WF;
		$this->page_title = 'Agenda';	


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
			default:
				return($this->index());
				break;
		}
	}

	function navigasi(){
		$html = '';
		if($_GET['f']=='edit')
		{	
			$nav = array('index'	=> array('t'=>'MANAGE', 'c'=>''),
						);
		}
		else
		{
			$nav = array('index'	=> array('t'=>'MANAGE', 'c'=>''),
					     'add'		=> array('t'=>'TAMBAH', 'c'=>''),
					    );
		}
		return($this->nav->render($nav));
	}

	function index(){
		$data = false;
		$per_page = $this->dbconf->getConf('record_per_page');
		!isset($_GET['page']) ? $_GET['page'] = 1 : false;
		$q = "SELECT * FROM agenda JOIN users ON agenda.uid=users.user_id ORDER BY tgl_mulai DESC";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['nama_lengkap'] = $row['nama_lengkap']; 
		    $row_array['lokasi'] = $row['lokasi']; 
		    $row_array['tgl_mulai'] = $this->date->IndonesianDatetime($row['tgl_mulai']);
		    $row_array['tgl_selesai'] = $this->date->IndonesianDatetime($row['tgl_selesai']);

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
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['deskripsi'] == '') $error[] = '- Silahkan isi Konten Isi';
	        if($_POST['lokasi'] == '') $error[] = '- Silahkan isi Tempat';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'judul'    	=> $_POST['judul'],
						'deskripsi'    	=> $_POST['deskripsi'],
						'tgl_mulai'    	=> $_POST['tgl_mulai'],
						'tgl_selesai'    	=> $_POST['tgl_selesai'],
						'lokasi'    	=> $_POST['lokasi'],
						'uid' => $_SESSION['user_id']
					);
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'gambar', 'agenda');
						if ($gambar) {
							$data['gambar'] = $gambar;
						}
					}
					$this->db->do_insert( 'agenda', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
					
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		}
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		return $this->smarty->fetch('add.tpl');
	}

	function edit(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['deskripsi'] == '') $error[] = '- Silahkan isi Konten Isi';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'judul'    	=> $_POST['judul'],
						'deskripsi'    	=> $_POST['deskripsi'],
						'tgl_mulai'    	=> $_POST['tgl_mulai'],
						'tgl_selesai'    	=> $_POST['tgl_selesai'],
						'lokasi'    	=> $_POST['lokasi']
					);
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'gambar', 'agenda');
						if ($gambar) {
							$data['gambar'] = $gambar;
						}
					}
					$where = array(
						'id' => $_GET['id']
					);
					$this->db->do_update( 'agenda', $data, $where, 1 ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
		        	// print_r($data);
					
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		}
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

		$query = "SELECT * FROM agenda where id='".$_GET['id']."'";
		
		$results = $this->db->get_single_result($query);
		// die(print_r($results));
		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('data', $results); 
		return $this->smarty->fetch('edit.tpl');
	}

	function delete(){
		try 
		{
			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'agenda', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
		}
		catch(PDOException $e)
		{
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die($response);
	}
}