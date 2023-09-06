<?php
class Header {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->dbconf     = new DataConfigClass;
		$this->paging    = new PagingClass;
		$this->page_title = 'Manage Header';	


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
		$q = "SELECT * FROM header order by id desc";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['gambar'] = ROOTDIR.'files/header/'.$row['gambar']; 

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
	        	try 
				{
					$namafile = false;
					if($_FILES['gambar']['name']){
					$this->image = new Upload($_FILES['gambar']); 
						if ($this->image->uploaded) {
							$timestamp = date("dmYhis");
							$ext = substr($_FILES['gambar']['name'],-4);
								
							// save uploaded image with a new name
							$this->image->file_max_size = '204800000'; // 2mb 
							$this->image->mime_check = true;
							$this->image->allowed = array('image/*');
							$this->image->file_new_name_body = $timestamp;
							$this->image->Process('files/header/');

							if (!$this->image->processed) {
								$response = '{"response":"false","message":"'.$this->image->error.'"}';
								die($response);
							}else{
								$namafile = $timestamp.'.'.$this->image->file_dst_name_ext;
							}
						}
					}
					$data = array(
						'gambar'    => $namafile,
						'status'    => $_POST['status']
					);
					$this->db->do_insert( 'header', $data,true ); 
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

	function delete(){
		try 
		{
			$query = "SELECT gambar FROM header WHERE id = '".$_POST['id']."'";
			$gbr_lama = $this->db->get_single_result($query);
			if (file_exists("files/header/".$gbr_lama['gambar']) && !empty($gbr_lama['gambar'])) {
				unlink("files/header/".$gbr_lama['gambar']);
			}
			$delete = array(
			    'id' => htmlspecialchars($_POST['id'])
			);
			$this->db->do_delete( 'header', $delete, 1 );
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
			$this->db->do_update('header', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}