<?php
class KategoriPengaduan {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->dbconf     = new DataConfigClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->paging    = new PagingClass;
		$this->page_title = 'Kategori Pengaduan';	


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
		$q = "SELECT * FROM pengaduan_kategori ORDER BY id ASC";
		//$results = $this->db->get_results($q);
		$results = $this->db->get_results($q);

		$return_arr = array();
		//foreach ($results as $row) {
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['urai'];

		    array_push($return_arr,$row_array);
		} 

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

        return $this->smarty->fetch('index.tpl');
	}

	function add(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'urai'    	=> $_POST['judul']
					);
					$this->db->do_insert( 'pengaduan_kategori', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
	    }
		$q = "SELECT * FROM pengaduan_kategori ORDER BY id ASC";
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		return $this->smarty->fetch('add.tpl');
	}

	function edit(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					
					$data = array(
						'urai'    	=> $_POST['judul']
					);

					$where = array(
						'id' => htmlspecialchars($_GET['id'])
					);
					$this->db->do_update( 'pengaduan_kategori', $data, $where, 1 ); 
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
		$this->smarty->assign('basedir', ROOTDIR); 

		$query = "SELECT id as id,urai as judul FROM pengaduan_kategori where id='".$_GET['id']."'";
		
		$results = $this->db->get_single_result($query);
		// die(print_r($results));
		$this->smarty->assign('data', $results); 
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
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'pengaduan_kategori', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.$_GET['menu'].'"}';
		}
		catch(PDOException $e)
		{
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die($response);
	}
}