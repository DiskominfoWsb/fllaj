<?php
//namespace Appweb;
Class AppClass{	
	function __construct()
	{
		$this->db 	      = new DatabaseClass;
		$this->login      = new LoginClass;
		$this->smarty     = new Smarty();   
		$this->menu   	  = new MenuClass;	
		$this->sspassvar  = md5('sspsw');

		$qconf = "SELECT * FROM setting where id = 1 ";
		$rconf = $this->db->get_single_result($qconf);
		$this->dbconf     = $rconf;

	}	
	
	function init()
	{
		if($this->login->isLogged() <> 1)
		{
						     
			$this->smarty->assign('basedir', ROOTDIR); 
			$this->smarty->assign('logo', $this->dbconf['gambar']); 
			$this->smarty->assign('appname', $this->dbconf['nama_app']); 
			$this->smarty->assign('nama_app_singkat', $this->dbconf['nama_app_singkat']); 
			$this->smarty->assign('themepath', ROOTDIR.'templates/login/'.LOGIN_THEME.'/'); 

	        $this->smarty->setTemplateDir('templates/login/'.LOGIN_THEME);
	        $this->smarty->setCompileDir('templates_c');
	        $this->smarty->setCacheDir('cache');
	        $this->smarty->setConfigDir('config');
	        $this->smarty->display('theme.tpl');
		}
		else
		{
			if(!isset($_GET['menu'])) $_GET['menu'] = 'home';
			switch($_GET['menu']){
				case'hacked':
					die('Opps...Token Salah');
					break;
				case'pages':
					$app = new Pages();	
					break;
				case'setting':
					$app = new Setting();	
					break;
				case'account':
					$app = new Account();
					break;
				case'gantipassword':
					$app = new GantiPassword();
					break;
				case'mnuser':
					$app = new MasterUser();
					break;

				// START MUDULE
				case'kategori':
					$app = new KategoriBerita();	
					break;	
				case'berita':
					$app = new Berita();	
					break;	
				case'rotator':
					$app = new Rotator();	
					break;	
				case'foto':
					$app = new Foto();	
					break;		
				case'video':
					$app = new Video();	
					break;	
				case'kategori_pengaduan':
					$app = new KategoriPengaduan();	
					break;
				case'pengaduan':
					$app = new Pengaduan();	
					break;
				case'agenda':
					$app = new Agenda();	
					break;
				case'bankdata':
					$app = new Bankdata();	
					break;
				case'weblink':
					$app = new Weblink();	
					break;

				//END MODULE

				case'logout':
					$this->login->logout();
					break;
				default :
					$app = new HomeClass();
					break;				
			}

			$page_title = $app->page_title;

			$this->login->cek_passwd(); // Cek Login dulu

			if ($_SESSION['level_akses'] == md5("1")) {
				$skpd = 'Admin';
			}
			else{	
				//$this->login->cek_akses($_GET['token']);	
				// $qskpd 		= "select urai from skpd where id = '".$_SESSION['user_id']."' ";
				// list($urai) = $this->db->get_row( $qskpd );
				// $skpd = $urai;
			}
				
			$query = "SELECT nama_lengkap,foto FROM users WHERE user_id = '".$_SESSION['user_id']."'";
			$row = $this->db->get_single_result($query);	
			
			$foto = "blank.jpg";
			if ($row['foto'] != "") {
				if (file_exists("files/mnuser/".$row['foto'])) {
					$foto = "files/mnuser/".$row['foto'];
				}else{
					$foto = "images/blank.jpg";
				}
			}
			$this->smarty->assign('ff', $foto); 

			$this->smarty->assign('appname', $this->dbconf['nama_app']); 
			$this->smarty->assign('logo', $this->dbconf['gambar']); 
			$this->smarty->assign('nama_app_singkat', $this->dbconf['nama_app_singkat']);
			$this->smarty->assign('web_title', $page_title); 
			$this->smarty->assign('nama_lengkap', $_SESSION['nama_lengkap']); 
			$this->smarty->assign('username', $_SESSION['username']); 
			$this->smarty->assign('menu_navigasi', $this->menu->init()); 
			$this->smarty->assign('page_title', $page_title); 
			$this->smarty->assign('content', $app->init()); 
			$this->smarty->assign('user_id', $_SESSION['user_id']); 

			$this->smarty->assign('basedir', ROOTDIR); 
			$this->smarty->assign('themepath', ROOTDIR.'templates/logged/'.THEME.'/'); 

	        $this->smarty->setTemplateDir('templates/logged/'.THEME);
	        $this->smarty->setCompileDir('templates_c');
	        $this->smarty->setCacheDir('cache');
	        $this->smarty->setConfigDir('config');
	        $this->smarty->display('index.tpl');
		}
	}
}
?>