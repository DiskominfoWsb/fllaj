<?php
class Berita {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->dbconf     = new DataConfigClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->paging    = new PagingClass;
		$this->page_title = 'Berita';	


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
		if ($_SESSION['level_akses'] == md5('public')) {
			unset($nav['add']);
		}
		return($this->nav->render($nav));
	}

	function index(){
		$data = false;
		if (!empty($_GET['id'])) {
			$start = ($_GET['id']-1) * 40;
			$page = $_GET['id'];
		}else{
			$start = 0;
			$page = 1;
		}
		if ($_SESSION['level_akses']==md5("operator")) {
			$q = "SELECT users.nama_lengkap, berita_kategori.nama_kategori, berita.* FROM berita join berita_kategori on berita.id_kategori = berita_kategori.id_kategori JOIN users on berita.uid = users.user_id and berita.uid = '".$_SESSION['user_id']."' ORDER BY berita.tanggal DESC limit ".$start.",40";
		}else{
			$q = "SELECT users.nama_lengkap, berita_kategori.nama_kategori, berita.* FROM berita join berita_kategori on berita.id_kategori = berita_kategori.id_kategori JOIN users on berita.uid = users.user_id ORDER BY berita.tanggal DESC limit ".$start.",40";
		}
		//$results = $this->db->get_results($q);
		$results = $this->db->get_results($q);

		$return_arr = array();
		//foreach ($results as $row) {
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['baca'] = number_format($row['baca'] / 2); 
		    $row_array['status'] = $row['status']; 
		    $row_array['id_kategori'] = $row['id_kategori']; 
		    $row_array['kontributor'] = $row['nama_lengkap']; 
		    $row_array['kategori'] = str_replace("_", " ", $row['nama_kategori']); 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);
		    if ($row['status'] == 0) {
		    	if ($row['refisi'] == "1") {
		    		$row_array['catatan'] = '<button class="btn btn-sm btn-info">Telah Direvisi</button>'; 
		    	}else{
		    		if ($row['catatan']) {
		    			$row_array['catatan'] = '<button class="btn btn-sm btn-warning">Periksa Catatan Admin</button>'; 
		    		}else{
		    			$row_array['catatan'] = ''; 
		    		}
		    	}
		    }else{
		    	$row_array['catatan'] = ''; 
		    }
		    array_push($return_arr,$row_array);
		} 
		if ($_SESSION['level_akses'] == md5('operator')) {
			$this->smarty->assign('akses', false);
		}else{
			$this->smarty->assign('akses', true);
		}

		$this->smarty->assign('basedir', ROOTDIR);
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('pagination', $this->pagination($page)); 

        return $this->smarty->fetch('index.tpl');
	}

	function add(){
		
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['isi'] == '') $error[] = '- Silahkan isi Konten Berita';
	        if($_POST['kategori'] == '') $error[] = '- Silahkan Pilih Kategori';
	        // if (count($_FILES['gambar_pertama']['name'] != $_POST['caption'])) {
	        // 	$error[] = '- Isi Caption Masing-masing gambar';
	        // }
	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$namafile = [];
					$count = count($_FILES['gambar_pertama']['name']);
					if ($count > 3) {
						$count = 3;
					}
					for ($i=0; $i < $count; $i++) { 
						if($_FILES['gambar_pertama']['name'][$i]){
							$gambar = [];
							foreach ($_FILES['gambar_pertama'] as $key => $value) {
								$gambar[$key] = $value[$i];
							}
							$this->image = new Upload($gambar); 
							if ($this->image->uploaded) {
								$timestamp = date("dmYhis").'_'.$i;
								$ext = substr($_FILES['gambar_pertama']['name'][$i],-4);
									
								// save uploaded image with a new name
								$this->image->file_max_size 		= '204800000'; // 2mb 
								$this->image->mime_check 			= true;
								$this->image->allowed 				= array('image/*');
								$this->image->file_new_name_body 	= $timestamp;
								// $this->image->image_watermark       = 'images/wm.png';
								// $this->image->image_watermark_position       = 'TR';
								$this->image->Process('files/berita/');

								$this->image->file_mf_max_size 		= '204800000'; 
								$this->image->mime_check	 		= true;
								$this->image->allowed 				= array('image/*');
								$this->image->file_new_name_body 	= 'thumb_'.$timestamp;
								// $this->image->image_watermark       = 'images/wm_small.png';
								// $this->image->image_watermark_position       = 'TR';
								$this->image->image_resize 			= true;
								$this->image->image_x 				= 200;
								$this->image->image_ratio_y 		= true;
								$this->image->Process('files/berita/');

								if (!$this->image->processed) {
									$response = '{"response":"false","message":"'.$this->image->error.'"}';
									die($response);
								}else{
									$namafile[] = $timestamp.'.'.$this->image->file_dst_name_ext;
								}
							}
						}
					}

					if (isset($_POST['id_bidang'])) {
						$id_bidang = $_POST['id_bidang'];
					}else{
						$id_bidang = " ";
					}
					$data = array(
						'judul'    		=> $_POST['judul'],
						'isi'    		=> preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $_POST['isi']),
						'tanggal'    	=> $_POST['tanggal'],
						'id_kategori'   => $_POST['kategori'],
						'id_bidang'    	=> $id_bidang,
						'gambar'    	=> implode("|", $namafile),
						'caption'    	=> implode("|", $_POST['caption']),
						'paragraf'    	=> implode("|", $_POST['paragraf']),
						'uid'    		=> $_SESSION['user_id'],
						'status' 		=> 0,
						'video'   => $_POST['video'],
						'paragraf_video'   => $_POST['paragraf_video']
					);
					$this->db->do_insert( 'berita', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
					
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		}

		$this->smarty->assign('kategori', $this->option_kat());
		$this->smarty->assign('page_title', $this->page_title); 
		$this->smarty->assign('navigasi', $this->navigasi()); 

		return $this->smarty->fetch('add.tpl');
	}

	function edit(){
		if (!empty($_POST)) {
			if($_POST['judul'] == '') $error[] = '- Silahkan isi judul ';
	        if($_POST['isi'] == '') $error[] = '- Silahkan isi Konten Berita';
	        if($_POST['kategori'] == '') $error[] = '- Silahkan Pilih Kategori';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$namafile = [];
					$count = count($_FILES['gambar_pertama']['name']);
					if ($count > 3) {
						$count = 3;
					}
					for ($i=0; $i < $count; $i++) { 
						if($_FILES['gambar_pertama']['name'][$i]){
							$gambar = [];
							foreach ($_FILES['gambar_pertama'] as $key => $value) {
								$gambar[$key] = $value[$i];
							}
							$this->image = new Upload($gambar); 
							if ($this->image->uploaded) {
								$timestamp = date("dmYhis").'_'.$i;
								$ext = substr($_FILES['gambar_pertama']['name'][$i],-4);
									
								// save uploaded image with a new name
								$this->image->file_max_size 		= '204800000'; // 2mb 
								$this->image->mime_check 			= true;
								$this->image->allowed 				= array('image/*');
								$this->image->file_new_name_body 	= $timestamp;
								$this->image->image_watermark       = 'images/wm.png';
								$this->image->Process('files/berita/');

								$this->image->file_mf_max_size 		= '204800000'; 
								$this->image->mime_check	 		= true;
								$this->image->allowed 				= array('image/*');
								$this->image->file_new_name_body 	= 'thumb_'.$timestamp;
								$this->image->image_watermark       = 'images/wm.png';
								$this->image->image_resize 			= true;
								$this->image->image_x 				= 200;
								$this->image->image_ratio_y 		= true;
								$this->image->Process('files/berita/');

								if (!$this->image->processed) {
									$response = '{"response":"false","message":"'.$this->image->error.'"}';
									die($response);
								}else{
									$namafile[$i] = $timestamp.'.'.$this->image->file_dst_name_ext;
								}
							}
						}
					}
					$query = "SELECT catatan,gambar,caption FROM berita WHERE id = '".$_GET['id']."'";
					$gbr_lama = $this->db->get_single_result($query);
					$lama = explode("|", $gbr_lama['gambar']);
					$cap_lama = explode("|", $gbr_lama['caption']);
					$baru = $cap = [];
					for ($i=0; $i < 3; $i++) {
						if (!empty($namafile[$i])) {
						 	$baru[$i] = $namafile[$i];
						}else if (!empty($lama[$i])) {
						 	$baru[$i] = $lama[$i];
						}
						if (!empty($_POST['caption'][$i])) {
						 	$cap[$i] = $_POST['caption'][$i];
						}else if (!empty($cap_lama[$i])) {
						 	$cap[$i] = $cap_lama[$i];
						}
					}
					if (isset($_POST['id_bidang'])) {
						$id_bidang = $_POST['id_bidang'];
					}else{
						$id_bidang = " ";
					}
					$data = array(
						'judul'    		=> $_POST['judul'],
						'isi'    		=> preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $_POST['isi']),
						'tanggal'    	=> $_POST['tanggal'],
						'id_kategori'   => $_POST['kategori'],
						'id_bidang'    	=> $id_bidang,
						'gambar'    	=> implode("|", $baru),
						'caption'    	=> implode("|", $cap),
						'paragraf'    	=> implode("|", $_POST['paragraf']),
						'video'   => $_POST['video'],
						'paragraf_video'   => $_POST['paragraf_video']
					);
					if (empty($_POST['catatan'])) {
						$data['refisi'] = "0";
					}else{
						if ($_POST['catatan'] == $gbr_lama['catatan']) {
							if ($_SESSION['level_akses'] == md5("operator")) {
								$data['refisi'] = "1";
							}else{
								$data['refisi'] = "0";
							}
						}else{
							if ($_SESSION['level_akses'] != md5("operator")) {
								$data['catatan'] = $_POST['catatan'];
								$data['refisi'] = "0";
							}
						}
					}
					$where = array(
						'id' => $_GET['id']
					);
					$this->db->do_update( 'berita', $data, $where, 1 ); 
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

		$query = "SELECT * FROM berita where id='".$_GET['id']."'";
		
		$results = $this->db->get_single_result($query);
		$kat = $this->option_kat();
		if ($_SESSION['level_akses']!=md5("operator")) {
			$isicatatanadmin = '<textarea class="form-control" name="catatan">'.$results['catatan'].'</textarea>';
			$hid = '';
		}else{
			$isicatatanadmin = '<textarea readonly class="form-control" name="catatan">'.$results['catatan'].'</textarea>';
			$hid = 'hidden';
		}

		$catatanadmin = '';
		if ($results['status'] == 0) {
			if ($_SESSION['level_akses']==md5("operator")) {
				if ($results['catatan']) {
					$catatanadmin = '<div class="row form-group">
			            <div class="col-md-2">
			                <strong>Catatan Admin</strong>
			            </div>
			            <div class="col-md-10">
			                '.$isicatatanadmin.'
			            </div>
			        </div>
			        <hr>';
				}
			}else{
				$catatanadmin = '<div class="row form-group">
		            <div class="col-md-2">
		                <strong>Catatan Admin</strong>
		            </div>
		            <div class="col-md-10">
		                '.$isicatatanadmin.'
		            </div>
		        </div>
		        <hr>';
			}
		}
		// die(print_r($results));
		$this->smarty->assign('catatanadmin', $catatanadmin); 
		$this->smarty->assign('hidden', $hid); 
		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('data', $results); 
		$this->smarty->assign('kategori', $kat);
		return $this->smarty->fetch('edit.tpl');
	}

	function option_kat(){
		$q = "SELECT * FROM berita_kategori where id_kategori != 32";
		$results = $this->db->get_results($q);
		$html = '';
		if (isset($_GET['id'])) {
			foreach ($results as $key) {
				$q2 = "SELECT * FROM berita where id = '".$_GET['id']."'";
				$r = $this->db->get_results($q2);
				
				$s = '';
				if ($key['id_kategori'] == $r[0]['id_kategori']) {
					$s = 'selected="selected"';
				}
				$html .= '<option '.$s.' value="'.$key['id_kategori'].'">'.$key['nama_kategori'].'</option>';
			}
		}else{
			foreach ($results as $key) {
				$html .= '<option value="'.$key['id_kategori'].'">'.$key['nama_kategori'].'</option>';
			}
		}
		return $html;
	}

	function delete(){
		try 
		{
			$query = "SELECT gambar FROM berita WHERE id = '".$_POST['id']."'";
			$gbr_lama = $this->db->get_single_result($query);
			$lama = explode("|", $gbr_lama['gambar']);
			foreach ($lama as $key) {
			 	if (file_exists("files/berita/".$key) && !empty($key)) {
					unlink("files/berita/".$key);
				}
				if (file_exists("files/berita/thumb_".$key) && !empty($key)) {
					unlink("files/berita/thumb_".$key);
				}
			} 
			$delete = array(
			    'id' => $_POST['id']
			);
			$this->db->do_delete( 'berita', $delete, 1 );
        	$response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
			die($response);
		}
		catch(PDOException $e)
		{
			//$response = '{"response":"false","message":"'.$e->getMessage().'"}';
			die($e->getMessage());
		}
	}

	function publish(){
		try {
			$data = array(
				'status'    	=> $_POST['status']
			);
			$where = array(
				'id' => $_POST['id']
			);
			$this->db->do_update('berita', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}

	function pagination($page){
		$data = false;
		if ($_SESSION['level_akses']==md5("operator")) {
			$q = "SELECT users.nama_lengkap, berita_kategori.nama_kategori, berita.* FROM berita join berita_kategori on berita.id_kategori = berita_kategori.id_kategori JOIN users on berita.uid = users.user_id WHERE berita.id_kategori != 32 and berita.uid = '".$_SESSION['user_id']."' ORDER BY berita.tanggal DESC";
		}else{
			$q = "SELECT users.nama_lengkap, berita_kategori.nama_kategori, berita.* FROM berita join berita_kategori on berita.id_kategori = berita_kategori.id_kategori JOIN users on berita.uid = users.user_id WHERE berita.id_kategori != 32 ORDER BY berita.tanggal DESC";
		}
		$total = number_format($this->db->get_num_rows($q) / 40,0);
		if ($total < number_format($this->db->get_num_rows($q) / 40,2)) {
			$total++;
		}
		$data .= '<div class="row">';
			$data .= '<div class="col-md-4 text-right">';
				if ($page != 1) {
					$data .= '<a href="'.ROOTDIR.'giadmin/berita/'.($page-1).'/page"><i class="fa fa-arrow-left"></i> Previous</a>';
				}
			$data .= '</div>';
			$data .= '<div class="col-md-4 text-center">';
			if ((40*$page) >= $this->db->get_num_rows($q)) {
				$data .= 40*($page-1)+1 .' - '. $this->db->get_num_rows($q);
			}else{
				$data .= 40*($page-1)+1 .' - '. 40*($page);
			}
			$data .= '<br>';
			$data .= 'Halaman : '.$page.'/'.$total;
			$data .= '</div>';
				$data .= '';
			$data .= '<div class="col-md-4">';
				if ((40*$page) <= $this->db->get_num_rows($q)) {
					$data .= '<a href="'.ROOTDIR.'giadmin/berita/'.($page+1).'/page">Next <i class="fa fa-arrow-right"></i></a>';
				}
			$data .= '</div>';
		$data .= '</div>';
		return $data;
	}
}