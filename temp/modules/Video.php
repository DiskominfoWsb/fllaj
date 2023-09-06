<?php
class Video {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->dbconf     = new DataConfigClass;
		$this->paging    = new PagingClass;
		$this->page_title = 'Video';	


		$this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.htmlspecialchars($_GET['menu']).'/');
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
		$q = "SELECT * FROM video ORDER BY id DESC";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['link'] = $row['link']; 
		    $row_array['keterangan'] = $row['keterangan']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);

		    array_push($return_arr,$row_array);
		} 

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', htmlspecialchars($_GET['menu'])); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('basedir', ROOTDIR); 

        return $this->smarty->fetch('index.tpl');
	}

	function add(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['link'] == '') $error[] = '- Silahkan isi Link';
	        if($_POST['keterangan'] == '') $error[] = '- Silahkan isi Keterangan';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'judul'    	=> $_POST['judul'],
						'link'    	=> $_POST['link'],
						'keterangan'    	=> $_POST['keterangan'],
						'tanggal'    	=> date('Y-m-d h:i:s'),
						'status' => $_POST['status']
					);
					$this->db->do_insert( 'video', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
					
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
		if (!empty($_POST)){
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['link'] == '') $error[] = '- Silahkan isi Link';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					
					$data = array(
						'judul'    	=> $_POST['judul'],
						'link'    	=> $_POST['link'],
						'keterangan'    	=> $_POST['keterangan'],
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'status' => $_POST['status']
					);
					

					$where = array(
							'id' => htmlspecialchars($_GET['id'])
						);
					$this->db->do_update( 'video', $data, $where, 1 ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
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

		$query = "SELECT * FROM video where id='".htmlspecialchars($_GET['id'])."'";
		
		$results = $this->db->get_single_result($query);
		// die(print_r($results));
		$this->smarty->assign('data', $results); 
		return $this->smarty->fetch('edit.tpl');
	}

	function delete(){
		try 
		{
			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'video', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
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
			$this->db->do_update('video', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'/'.htmlspecialchars($_GET['id']).'/detail"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}