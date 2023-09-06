<?php
class Setting{
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->wf 		 = new WF;
		$this->smarty     = new Smarty(); 
		$this->page_title = 'KONFIGURASI';		
	}
	function init(){
		if (!empty($_POST)) {
			if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        }else{
	        	try {
					$update = array(
						'client' 			=> $_POST['nama_pemda'],
						'nama_app' 			=> $_POST['nama_app'],
						'nama_app_singkat' 	=> $_POST['nama_app_singkat'],
						'alamat' 			=> $_POST['alamat'],
						'telp' 				=> $_POST['telp'],
						'facebook'			=> $_POST['facebook'],
						'email'				=> $_POST['email'],
						'twitter'			=> $_POST['twitter'],
						'instagram'			=> $_POST['instagram'],
						'youtube'			=> $_POST['youtube'],
						'nama_kdh'			=> $_POST['nama_kdh'],
						'wa'			=> implode(", ", $_POST['wa']),
						'nama_wa_kdh'			=> $_POST['nama_wa_kdh']
					);
					if (!empty($_FILES)) {
						$gambar = $this->wf->upload_files($_FILES, 'gambar', 'setting');
						if ($gambar) {
							$update['gambar'] = $gambar;
							$query = "SELECT gambar FROM setting WHERE id = '1'";
							$gbr_lama = $this->db->get_single_result($query);
							if (file_exists("files/setting/".$gbr_lama['gambar']) && !empty($gbr_lama['gambar'])) {
								unlink("files/setting/".$gbr_lama['gambar']);
							}
						}
					}
					if (!empty($_FILES)) {
						$foto_kdh = $this->wf->upload_files($_FILES, 'foto_kdh', 'setting');
						if ($foto_kdh) {
							$update['foto_kdh'] = $foto_kdh;
							$query = "SELECT foto_kdh FROM setting WHERE id = '1'";
							$gbr_lama = $this->db->get_single_result($query);
							if (file_exists("files/setting/".$gbr_lama['foto_kdh']) && !empty($gbr_lama['foto_kdh'])) {
								unlink("files/setting/".$gbr_lama['foto_kdh']);
							}
						}
					}
					if (!empty($_FILES)) {
						$foto_wa_kdh = $this->wf->upload_files($_FILES, 'foto_wa_kdh', 'setting');
						if ($foto_wa_kdh) {
							$update['foto_wa_kdh'] = $foto_wa_kdh;
							$query = "SELECT foto_wa_kdh FROM setting WHERE id = '1'";
							$gbr_lama = $this->db->get_single_result($query);
							if (file_exists("files/setting/".$gbr_lama['foto_wa_kdh']) && !empty($gbr_lama['foto_wa_kdh'])) {
								unlink("files/setting/".$gbr_lama['foto_wa_kdh']);
							}
						}
					}
					$where_clause = array(
					    'id' => 1
					);
					$exec = $this->db->do_update( 'setting', $update, $where_clause, 1 );
					if ($exec) {
						$response = '{"response":"true","message":"Berhasil Diupdate","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
					}
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}
	        }
	        die($response);
		}
		$q = "SELECT client, nama_app, nama_app_singkat, alamat, telp, email, facebook, twitter, instagram, youtube, nama_kdh, nama_wa_kdh, foto_kdh, foto_wa_kdh, gambar, wa FROM setting where id ='1'";
		$result = $this->db->get_single_result($q,PDO::FETCH_NUM);	   
		list($nama_pemda,$nama_app,$nama_app_singkat,$alamat,$telp,$email,$facebook,$twitter,$instagram,$youtube,$nama_kdh,$nama_wa_kdh,$foto_kdh,$foto_wa_kdh,$gambar,$wa) = $result;
		$this->smarty->assign('nama_app', $nama_app);
		$this->smarty->assign('nama_app_singkat', $nama_app_singkat);
		$this->smarty->assign('nama_pemda', $nama_pemda);
		$this->smarty->assign('alamat', $alamat);
		$this->smarty->assign('telp', $telp);
		$this->smarty->assign('email', $email);
		$this->smarty->assign('facebook', $facebook); 
		$this->smarty->assign('twitter', $twitter);
		$this->smarty->assign('instagram', $instagram);
		$this->smarty->assign('youtube', $youtube);
		$this->smarty->assign('nama_kdh', $nama_kdh);
		$this->smarty->assign('nama_wa_kdh', $nama_wa_kdh);
		$this->smarty->assign('foto_kdh', $foto_kdh);
		$this->smarty->assign('foto_wa_kdh', $foto_wa_kdh);
		$this->smarty->assign('gambar', $gambar);
		$this->smarty->assign('wa', $wa);

		$this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('index.tpl');
	}
}
?>