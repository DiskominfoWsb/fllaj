<?php
class FrontPengaduan {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->anu 	 = new DateClass;	
		$this->url 		 = new UrlCLass; 
		$this->wf 		 = new WF; 
		$this->page_title = 'Aspirasi dan Pelaporan';

		$this->smarty->setTemplateDir('templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
        $this->smarty->assign('filepath', ROOTDIR.'files/berita/');
	}
	
	function init(){
		if (!empty($_POST)) {
	        if($_POST['g-recaptcha-response'] == '') $error[] = 'The response parameter is missing.';
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try 
				{
					$data = array(
						'nama'    	=> $_POST['nama'],
						'tanggal'    	=> date('Y-m-d H:i:s'),
						'email'    	=> $_POST['email'],
						'hp'    	=> $_POST['hp'],
						'kategori'    	=> $_POST['kategori'],
						'pesan'    	=> $_POST['pesan'],
						'status'    	=> '1',
						'jk'    	=> $_POST['jk']
					);
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'gambar', 'pengaduan');
						if ($gambar) {
							$data['gambar'] = $gambar;
						}
					}
					$this->db->do_insert( 'pengaduan', $data,true ); 
		        	$response = '{"response":"true","message":"Data Berhasil Disimpan","menu":"'.ROOTDIR.htmlspecialchars($_GET['menu']).'"}';
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
		}

		$q = "SELECT * FROM pengaduan_kategori";
		$r = $this->db->get_results($q);
		
		$this->smarty->assign('kategori', $r);
		$this->smarty->assign('judul', $this->page_title);
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('basedir', ROOTDIR); 

		$jml_per_halaman = 5;		
		$jml = $this->db->get_num_rows("SELECT pengaduan.*, pengaduan_kategori.urai, pengaduan_respon.pesan as respon, users.nama_lengkap FROM `pengaduan` join pengaduan_kategori on pengaduan_kategori.id = pengaduan.kategori left join pengaduan_respon on pengaduan_respon.id_pengaduan = pengaduan.id left join users on users.user_id = pengaduan_respon.user_id where pengaduan.status = '1'");
		$jml_halaman = ceil($jml/$jml_per_halaman);
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
		}else{
			$page = 1;
		}
		$start = (($page - 1) * $jml_per_halaman);
		$q = "SELECT pengaduan.*, pengaduan_kategori.urai, pengaduan_respon.pesan as respon, pengaduan_respon.tanggal as tanggal_respon, users.nama_lengkap, users.foto FROM `pengaduan` join pengaduan_kategori on pengaduan_kategori.id = pengaduan.kategori left join pengaduan_respon on pengaduan_respon.id_pengaduan = pengaduan.id left join users on users.user_id = pengaduan_respon.user_id where pengaduan.status = '1' order by pengaduan.tanggal desc LIMIT $start, $jml_per_halaman";
		$r = $this->db->get_results($q);
		$data = false;
		$return_arr = array();
		foreach ($r as $row) {
		    $row_array['nama']		= preg_replace('/(?!^)\S/', '*', $row['nama']); 
		    $row_array['tgl_aduan']	= $this->date->IndonesianDatetime($row['tanggal']); 
		    $row_array['pesan']		= $row['pesan']; 
		    $row_array['kategori']	= $row['urai']; 
		    $row_array['gambar']	= $row['gambar']; 
		    
		    $row_array['foto']				= $row['foto']; 
		    $row_array['respon']			= $row['respon']; 
		    $row_array['nama_lengkap']		= $row['nama_lengkap']; 
		    $row_array['tanggal_respon']	= $this->date->IndonesianDatetime($row['tanggal_respon']); 


			// $data .= '<div class="row blog-comments-v2">
			// 	<div class="commenter">
			// 		<img class="rounded-x" src="'.ROOTDIR.'images/user.png" alt="">
			// 	</div>
			// 	<div class="comments-itself">
			// 		<h4>
			// 			'.preg_replace('/(?!^)\S/', '*', $row['nama']).'
			// 			<span>'.$this->date->IndonesianDatetime($row['tanggal']).'</span>
			// 		</h4>
			// 		<p>Kategori : <strong>'.$row['urai'].'</strong></p>
			// 		<p>'.$row['pesan'].'</p>
			// 	</div>
			// </div>';
			// if ($row['respon']) {
			// 	$data .= '<div class="row blog-comments-v2 blog-comments-v2-reply">
			// 		<div class="commenter">
			// 			<img class="rounded-x" src="'.ROOTDIR.'images/admin.png" alt="">
			// 		</div>
			// 		<div class="comments-itself">
			// 			<h4>
			// 				'.$row['nama_lengkap'].'
			// 				<span>'.$this->date->IndonesianDatetime($row['tanggal_respon']).'</span>
			// 			</h4>
			// 			'.$row['respon'].'
			// 		</div>
			// 	</div>';
			// }

		    array_push($return_arr,$row_array);
		}		
		$this->smarty->assign('komentar', $return_arr);

		$awal = $akhir = $pagination = '';
		if ($page == $jml_halaman) {
			$akhir = 'hidden';
		}
		if ($page == 1) {
			$awal = 'hidden';
			if ($jml_halaman == 1) {
				$akhir = 'hidden';
			}
		}
		$seb = $page - 1;
		$ses = $page + 1;
		$pagination .= '<div class="row">
			<div class=" col-md-5 text-center previous"><a '.$awal.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'berita/'.$seb.'">Sebelumnya</a></div>
			<div class=" col-md-2 text-center page-amount">'.$page.' of '.$jml_halaman.'</div>
			<div class=" col-md-5 text-center next"><a '.$akhir.' style="border: 1px solid #ccc; border-radius: 50px; padding: 5px;" href="'.ROOTDIR.'berita/'.$ses.'">Selanjutnya</a></div>
		</div>';

		$this->smarty->assign('pagination', $pagination);
		$this->smarty->assign('judul', $this->page_title);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init());

        return array('data'=>$this->smarty->fetch('index.tpl'), 'judul' => $this->page_title);
	}
}
?>