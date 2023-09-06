<?php
class Pengaduan {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->dbconf     = new DataConfigClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->paging    = new PagingClass;
		$this->page_title = 'Pengaduan';	


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
		$data = false;
		$q = "SELECT pengaduan.*, pengaduan_kategori.urai, (SELECT count(*) from pengaduan_respon where id_pengaduan = pengaduan.id) as jumlah FROM pengaduan join pengaduan_kategori on pengaduan_kategori.id = pengaduan.kategori ORDER BY tanggal DESC";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);
		    $row_array['nama'] = $row['nama'];
		    $row_array['status'] = $row['status'];
		    $row_array['pesan'] = $row['pesan'];
		    $row_array['urai'] = $row['urai'];
		    $row_array['email'] = $row['email'];
		    $row_array['hp'] = $row['hp'];
		    $row_array['jumlah'] = $row['jumlah'];

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
	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'pesan'			=> $_POST['pesan'],
						'user_id'		=> $_SESSION['user_id'],
						'id_pengaduan'		=> $_GET['id'],
					);
					$this->db->do_insert( 'pengaduan_respon', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
	    }
		$this->smarty->assign('basedir', ROOTDIR); 

		$query = "SELECT pengaduan.*, pengaduan_kategori.urai, (SELECT count(*) from pengaduan_respon where id_pengaduan = pengaduan.id) as jumlah FROM pengaduan join pengaduan_kategori on pengaduan_kategori.id = pengaduan.kategori where pengaduan.id = '".$_GET['id']."'";
		$results = $this->db->get_single_result($query);
		$q = "SELECT * FROM pengaduan_respon where id_pengaduan = '".$_GET['id']."'";
		$r = $this->db->get_single_result($q);

		$this->smarty->assign('respon', $r); 
		$this->smarty->assign('data', $results); 
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		return $this->smarty->fetch('add.tpl');
	}

	function edit(){
		if (!empty($_POST)) {
	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					
					$data = array(
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'pesan'			=> $_POST['pesan'],
						'user_id'		=> $_SESSION['user_id'],
					);

					$where = array(
						'id' => htmlspecialchars($_GET['id'])
					);
					$this->db->do_update( 'pengaduan_respon', $data, $where, 1 ); 
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

		$query = "SELECT pengaduan.*, pengaduan_kategori.urai, (SELECT count(*) from pengaduan_respon where id_pengaduan = pengaduan.id) as jumlah FROM pengaduan join pengaduan_kategori on pengaduan_kategori.id = pengaduan.kategori where pengaduan.id = '".$_GET['id']."'";
		$results = $this->db->get_single_result($query);
		$q = "SELECT * FROM pengaduan_respon where id_pengaduan = '".$_GET['id']."'";
		$r = $this->db->get_single_result($q);

		$this->smarty->assign('respon', $r); 
		$this->smarty->assign('data', $results); 
		return $this->smarty->fetch('edit.tpl');
	}

	function delete(){
		try 
		{
			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'pengaduan', $delete, 1 );
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
			$this->db->do_update('pengaduan', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}