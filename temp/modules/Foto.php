<?php
class Foto {
	function __construct(){
		$this->scr 			= new SecurityClass;
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->page_title = 'Album Foto';	

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

			case 'lihat':
				return $this->lihat();
				break;

			case 'add_upload':
				return $this->add_upload();
				break;

			case 'edit_foto':
				return $this->edit_foto();
				break;

			case 'delete_foto':
				return $this->delete_foto();
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
		$nav = array('index'	=> array('t'=>'ALBUM FOTO', 'c'=>''),
					     'add'		=> array('t'=>'TAMBAH ALBUM FOTO ', 'c'=>''),
					     'add_upload'		=> array('t'=>'UPLOAD FOTO', 'c'=>''),
					    );
		return($this->nav->render($nav));
	}

	function index(){
		$data = false;
		$q = "SELECT *, galeri_kategori.id_kategori as id , (SELECT COUNT(id_foto)FROM galeri_foto WHERE galeri_foto.id_kategori = galeri_kategori.id_kategori) AS jumlah FROM galeri_kategori";
		$results = $this->db->get_results($q);

		// echo "<pre>";print_r($results);echo "</pre>";die();

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $results); 
		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

        return $this->smarty->fetch('index.tpl');
	}

	function add(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['keterangan'] == '') $error[] = '- Silahkan isi Konten keterangan';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'nama_kategori'    	=> $_POST['judul'],
						'keterangan'    	=> $_POST['keterangan']
					);
					$this->db->do_insert( 'galeri_kategori', $data,true ); 
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

	function add_upload(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['keterangan'] == '') $error[] = '- Silahkan isi Konten keterangan';
	        if($_FILES['file']["name"] == '') $error[] = '- Silahkan Pilih Foto';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					for ($i=0; $i < count($_FILES['file']['name']); $i++) {
						$namafile = $data = false;
						$gambar = [];
						foreach ($_FILES['file'] as $key => $value) {
							$gambar[$key] = $value[$i];
						}
						$this->image = new Upload($gambar); 
						if ($this->image->uploaded) {
							$timestamp = date("dmYhis");
							$ext = substr($_FILES['file']['name'][$i],-4);
								
							$this->image->mime_check = true;
							$this->image->allowed = array('image/*');
							$this->image->file_new_name_body = $timestamp.$i;
							$this->image->Process('files/albumfoto/');

							if (!$this->image->processed) {
								$response = '{"response":"false","message":"'.$this->image->error.'"}';
								die($response);
							}else{
								$namafile = $timestamp.$i.'.'.$this->image->file_dst_name_ext;
							}
						}	
						$data = array(
							'id_kategori'    	=> $_POST['id_kategori'],
							'judul'    	=> $_POST['judul'],
							'keterangan'    	=> $_POST['keterangan'],
							'namafile'    	=> $namafile,
							'tanggal'    	=> date('Y-m-d H:i:s'),
							'status' => $_POST['status']
						);
						$this->db->do_insert( 'galeri_foto', $data,true ); 
					}
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
					
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		}
		$query = "SELECT * FROM galeri_kategori";
		
		$results = $this->db->get_results($query);
		$this->smarty->assign('data', $results); 
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		return $this->smarty->fetch('upload.tpl');
	}

	function edit(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['keterangan'] == '') $error[] = '- Silahkan isi Konten keterangan';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'nama_kategori'    	=> $_POST['judul'],
						'keterangan'    	=> $_POST['keterangan']
					);

					$where = array(
							'id_kategori' => $_GET['id']
						);
					$this->db->do_update( 'galeri_kategori', $data, $where, 1 ); 
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

		$query = "SELECT * FROM galeri_kategori where id_kategori='".$_GET['id']."'";
		
		$results = $this->db->get_single_result($query);
		// die(print_r($results));
		$this->smarty->assign('data', $results); 
		return $this->smarty->fetch('edit.tpl');
	}

	function delete(){
		try 
		{
			$delete = array(
			    'id_kategori' => htmlspecialchars($_POST['id'])
			);
			$this->db->do_delete( 'galeri_kategori', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
		}
		catch(PDOException $e)
		{
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die($response);
	}

	function lihat(){
		$data = false;
		$q = "SELECT *, id_foto as id FROM galeri_foto WHERE id_kategori = '".$_GET['id']."'";
		$results = $this->db->get_results($q);

		// echo "<pre>";print_r($results);echo "</pre>";die();

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $results); 
		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

        return $this->smarty->fetch('lihat.tpl');
	}

	function edit_foto(){
		$data = false;
		$q = "SELECT galeri_kategori.nama_kategori, galeri_foto.* FROM `galeri_foto` join galeri_kategori on galeri_foto.id_kategori = galeri_kategori.id_kategori where galeri_foto.id_foto = '".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
		$results = $this->db->get_single_result($q);

		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['keterangan'] == '') $error[] = '- Silahkan isi Konten keterangan';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'judul'    	=> $_POST['judul'],
						'keterangan'    	=> $_POST['keterangan']
					);
					
					$where = array(
						'id_foto' => $this->scr->esc(htmlspecialchars($_GET['id']))
					);
					$this->db->do_update( 'galeri_foto', $data, $where, 1 ); 
		        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'/'.$results['id_kategori'].'/lihat"}';
					
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		
		}

		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('data', $results); 
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $results); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

        return $this->smarty->fetch('edit_foto.tpl');
	}

	function delete_foto(){
		try 
		{
			$query = "SELECT * FROM galeri_foto WHERE id_foto = '".$_POST['id']."'";
			$gbr_lama = $this->db->get_single_result($query);
			if (file_exists("files/albumfoto/".$gbr_lama['namafile']) && !empty($gbr_lama['namafile'])) {
				unlink("files/albumfoto/".$gbr_lama['namafile']);
			}
			if (file_exists("files/albumfoto/thumb_".$gbr_lama['namafile']) && !empty($gbr_lama['namafile'])) {
				unlink('files/albumfoto/thumb_'.$gbr_lama['namafile']);
			}
			$kat = $gbr_lama['id_kategori'];
			$delete = array(
			    'id_foto' => htmlspecialchars($_POST['id'])
			);
			$this->db->do_delete( 'galeri_foto', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'/'.$kat.'/lihat"}';
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
				'id_foto' => $_POST['id']
			);
			$this->db->do_update('galeri_foto', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}
}