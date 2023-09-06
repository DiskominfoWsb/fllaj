<?php
class Static_page {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->page_title = 'Halaman Statis';	


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

			case 'insert':
				return $this->insert();
				break;

			case 'edit':
				return $this->edit();
				break;

			case 'update':
				return $this->update();
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
		$results = false;

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $results); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

        return $this->smarty->fetch('index.tpl');
	}

	function add(){
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('menu', $_GET['menu']); 
		return $this->smarty->fetch('add.tpl');
	}

	function insert(){
		if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
        if($_POST['isi'] == '') $error[] = '- Silahkan isi Konten Pengumuman';

        if (isset($error)) {
        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
            die($response);
        }else{
        	try 
			{
				$namafile = time().$_FILES["namafile"]["name"];
				move_uploaded_file($_FILES["namafile"]["tmp_name"], "files/pengumuman/".$namafile);
				$data = array(
					'judul'    	=> $_POST['judul'],
					'isi'    	=> $_POST['isi'],
					'tanggal'    	=> $_POST['tanggal'],
					'namafile'    	=> $namafile,
					'status' => $_POST['status']
				);
				$this->db->do_insert( 'pengumuman', $data,true ); 
	        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
				
			}
			catch(PDOException $e)
			{
				$response = '{"response":"false","message":"'.$e->getMessage().'"}';
			}
			die($response);
        }
	}

	function edit(){
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('menu', $_GET['menu']); 

		$query = "SELECT * FROM pengumuman where id='".$_GET['id']."'";
		
		$results = $this->db->get_single_result($query);
		// die(print_r($results));
		$this->smarty->assign('data', $results); 
		return $this->smarty->fetch('edit.tpl');
	}

	function update(){
        if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
        if($_POST['isi'] == '') $error[] = '- Silahkan isi Konten Pengumuman';

        if (isset($error)) {
        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
            die($response);
        }else{
        	try 
			{
				if ($_FILES['namafile']["name"]) {
					$namafile = time().$_FILES["namafile"]["name"];
					move_uploaded_file($_FILES["namafile"]["tmp_name"], "files/pengumuman/".$namafile);

					$query = "SELECT namafile FROM pengumuman WHERE id = '".$_POST['id']."'";
					$file_lama = $this->db->get_single_result($query);
					unlink("files/pengumuman/".$file_lama['namafile']);
					
					$data = array(
						'judul'    	=> $_POST['judul'],
						'isi'    	=> $_POST['isi'],
						'tanggal'   => $_POST['tanggal'],
						'namafile'    => $namafile,
						'status' 	=> $_POST['status']
					);
					
				}else{
					$data = array(
						'judul'    	=> $_POST['judul'],
						'isi'    	=> $_POST['isi'],
						'tanggal'   => $_POST['tanggal'],
						'status' 	=> $_POST['status']
					);
				}

				$where = array(
						'id' => $_POST['id']
					);
				$this->db->do_update( 'pengumuman', $data, $where, 1 ); 
	        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
	        	// print_r($data);
				
			}
			catch(PDOException $e)
			{
				$response = '{"response":"false","message":"'.$e->getMessage().'"}';
			}
			die($response);
        }
	}

	function delete(){
		try 
		{
			$query = "SELECT namafile FROM pengumuman WHERE id = '".$_GET['id']."'";
					$file_lama = $this->db->get_single_result($query);
					unlink("files/pengumuman/".$file_lama['namafile']);
			$delete = array(
			    'id' => $_GET['id']
			);
			$this->db->do_delete( 'pengumuman', $delete, 1 );
        	echo "<meta http-equiv='refresh' content='0;URL=".ROOTDIR."?mode=admin&menu=".$_GET['menu']."&f=index'>";
			die();
		}
		catch(PDOException $e)
		{
			//$response = '{"response":"false","message":"'.$e->getMessage().'"}';
			die($e->getMessage());
		}
	}
}