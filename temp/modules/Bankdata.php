<?php
class Bankdata {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->dbconf     = new DataConfigClass;
		$this->paging    = new PagingClass;
		$this->wf    = new WF;
		$this->page_title = 'Bank Data';	


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
		$per_page = $this->dbconf->getConf('record_per_page');
		!isset($_GET['page']) ? $_GET['page'] = 1 : false;
		$q = "SELECT * FROM bankdata ORDER BY id DESC";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['namafile'] = $row['namafile']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);

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

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'judul'    	=> $_POST['judul'],
						'keterangan'    	=> $_POST['isi'],
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'status' => $_POST['status']
					);
					if (!empty($_FILES)) {
						$file = $this->wf->upload_single_files($_FILES, 'file', 'bankdata');
						if ($file) {
							$data['namafile'] = $file;
						}
					}
					$this->db->do_insert( 'bankdata', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
					
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		}
		$q = "SELECT * FROM pages where parent = '87'";
		$r = $this->db->get_results($q);

		$this->smarty->assign('kategori', $r); 
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		return $this->smarty->fetch('add.tpl');
	}

	function delete(){
		try 
		{
			$query = "SELECT namafile FROM bankdata WHERE id = '".$_POST['id']."'";
			$gbr_lama = $this->db->get_single_result($query);
			if (file_exists("files/bankdata/".$gbr_lama['namafile']) && !empty($gbr_lama['namafile'])) {
				unlink("files/bankdata/".$gbr_lama['namafile']);
			}
			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'bankdata', $delete, 1 );
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
			$this->db->do_update('bankdata', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}