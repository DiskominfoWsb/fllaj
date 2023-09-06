<?php
class Weblink {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->dbconf     = new DataConfigClass;
		$this->paging    = new PagingClass;
		$this->page_title = 'Link Tautan';	


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
		$q = "SELECT * FROM weblink ORDER BY id DESC";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['link'] = $row['link']; 
		    $row_array['gambar'] = $row['gambar']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);

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
	        if($_POST['link'] == '') $error[] = '- Silahkan isi Link';

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
							$this->image->Process('files/weblink/');

							if (!$this->image->processed) {
								$response = '{"response":"false","message":"'.$this->image->error.'"}';
								die($response);
							}else{
								$namafile = $timestamp.'.'.$this->image->file_dst_name_ext;
							}
						}
					}
					$data = array(
						'judul'    	=> $_POST['judul'],
						'link'    	=> $_POST['link'],
						'kategori'    	=> $_POST['kategori'],
						'gambar'    	=> $namafile,
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'status' => '1'
					);
					$this->db->do_insert( 'weblink', $data,true ); 
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
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['link'] == '') $error[] = '- Silahkan isi Link';

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

							$this->image->Process('files/weblink/');

							if (!$this->image->processed) {
								$response = '{"response":"false","message":"'.$this->image->error.'"}';
								die($response);
							}else{
								$namafile = $timestamp.'.'.$this->image->file_dst_name_ext;
							}

							$query = "SELECT gambar FROM weblink WHERE id = '".$_GET['id']."'";
							$gbr_lama = $this->db->get_single_result($query);
							if (file_exists("files/weblink/".$gbr_lama['gambar']) && !empty($gbr_lama['gambar'])) {
								unlink("files/weblink/".$gbr_lama['gambar']);
							}
							
							$data = array(
								'judul'    	=> $_POST['judul'],
								'kategori'    	=> $_POST['kategori'],
								'link'    	=> $_POST['link'],
								'gambar'    	=> $namafile,
								'tanggal'    	=> date('Y-m-d H:i:s')
							);
						}
					}else{
						$data = array(
							'judul'    	=> $_POST['judul'],
							'kategori'    	=> $_POST['kategori'],
							'link'    	=> $_POST['link'],
							'tanggal'    	=> date('Y-m-d H:i:s')
						);
					}

					$where = array(
							'id' => $_GET['id']
						);
					$this->db->do_update( 'weblink', $data, $where, 1 ); 
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
		$this->smarty->assign('basedir', ROOTDIR); 

		$query = "SELECT * FROM weblink where id='".$_GET['id']."'";
		
		$results = $this->db->get_single_result($query);
		// die(print_r($results));
		$this->smarty->assign('data', $results); 
		return $this->smarty->fetch('edit.tpl');
	}

	function delete(){
		try 
		{
			$query = "SELECT gambar FROM weblink WHERE id = '".$_GET['id']."'";
			$gbr_lama = $this->db->get_single_result($query);
			if (file_exists("files/weblink/".$gbr_lama['gambar']) && !empty($gbr_lama['gambar'])) {
				unlink("files/weblink/".$gbr_lama['gambar']);
			}
			if (file_exists("files/weblink/thumb_".$gbr_lama['gambar']) && !empty($gbr_lama['gambar'])) {
				unlink("files/weblink/thumb_".$gbr_lama['gambar']);
			}

			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'weblink', $delete, 1 );
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
			$this->db->do_update('weblink', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'/'.htmlspecialchars($_GET['id']).'/detail"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}