<?php
class FrontAgenda {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->nav 		 = new NavUtil;
		$this->date 	 = new DateClass;
		$this->anu 	 = new DateClass;	
        $this->dbconf   = new DataConfigClass;  
		$this->url 		 = new UrlCLass; 
		$this->page_title = '';

		$this->smarty->setTemplateDir('templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
        $this->smarty->assign('filepath', ROOTDIR.'files/berita/');
	}
	
	function init(){
		if(!isset($_GET['f'])) $_GET['f'] = 'index';
		switch( $_GET['f'] ){
			case 'read':
				return $this->read();
				break;
			default:
				return($this->index());
				break;
		}
	}

	function index(){
		$data = false;

		$q = "SELECT * FROM agenda JOIN users ON agenda.uid = users.user_id WHERE NOW() < agenda.tgl_selesai ORDER BY agenda.tgl_mulai ASC";
		$results = $this->db->get_results($q);
		$no = 1;
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['deskripsi'] = $row['deskripsi'];
		    $row_array['lokasi'] = $row['lokasi'];
		    $row_array['seo'] = $this->url->friendlyURL($row['judul']); 
		    $row_array['tgl_mulai'] = $this->date->IndonesianDatetime($row['tgl_mulai']);
		    $row_array['tgl_selesai'] = $this->date->IndonesianDatetime($row['tgl_selesai']);

		    if (date('Ymd', strtotime($row['tgl_mulai'])) == date('Ymd', strtotime($row['tgl_selesai']))) {
		    	$row_array['tanggal'] = $this->date->IndonesianDatetime($row['tgl_mulai']).' - '.date('H:i', strtotime($row['tgl_selesai']));
		    }else{
		    	$row_array['tanggal'] = $this->date->IndonesianDatetime($row['tgl_mulai']).' - '.$this->date->IndonesianDatetime($row['tgl_selesai']);
		    }

		    if (strtotime(date('Y-m-d H:i:s')) < strtotime($row['tgl_mulai'])) {
				$stt = "Belum Dimulai";
				$bg = 'bg-success';
			}else if (strtotime(date('Y-m-d H:i:s')) > strtotime($row['tgl_selesai'])) {
				$stt = "Sudah Selesai";
				$bg = 'bg-danger';
			}else{
				$stt = "Sedang Berlangsung";
				$bg = 'bg-warning';
			}
		    $row_array['stt'] = $stt; 
		    $row_array['bg'] = $bg; 

		    array_push($return_arr,$row_array);
		} 

		$page_title = "AGENDA";

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr);

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

        return array('data'=>$this->smarty->fetch('index.tpl'), 'judul' => $page_title);
	}

	function read(){
		$data = false;
		$q = "SELECT * FROM agenda JOIN users ON agenda.uid = users.user_id WHERE id = '".$_GET['id']."'";
		$results = $this->db->get_results($q);

		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['deskripsi'] = $row['deskripsi']; 
		    $row_array['nama_lengkap'] = $row['nama_lengkap']; 
		    $row_array['seo'] = $this->url->friendlyURL($row['judul']);
		    $row_array['tgl_mulai'] = $this->date->IndonesianDatetime($row['tgl_mulai']);
		    $row_array['tgl_selesai'] = $this->date->IndonesianDatetime($row['tgl_selesai']);
		    $row_array['gambar'] = $row['gambar'];
		    $row_array['lokasi'] = $row['lokasi'];
		    if (date('Y-m-d', strtotime($row['tgl_mulai'])) == date('Y-m-d', strtotime($row['tgl_selesai']))) {
				$tanggal =  $this->date->IndonesianDate($row['tgl_mulai']).' '.date('H:i', strtotime($row['tgl_mulai'])).' sd '.date('H:i', strtotime($row['tgl_selesai']));
			}else{
				$tanggal = $this->date->IndonesianDatetime($row['tgl_mulai']).' sd '.$this->date->IndonesianDatetime($row['tgl_selesai']);
			}
		    $row_array['tanggal'] = $tanggal;

			if (strtotime(date('Y-m-d H:i:s')) < strtotime($row['tgl_mulai'])) {
				$stt = "Belum Dimulai";
				$bg = 'bg-success';
			}else if (strtotime(date('Y-m-d H:i:s')) > strtotime($row['tgl_selesai'])) {
				$stt = "Sudah Selesai";
				$bg = 'bg-danger';
			}else{
				$stt = "Sedang Berlangsung";
				$bg = 'bg-warning';
			}
		    $row_array['stt'] = $stt;
		    $row_array['bg'] = $bg;
		    array_push($return_arr,$row_array);
		} 
		$page_title = $return_arr[0]['judul'];

		$lain = "SELECT * FROM agenda WHERE id <> '".$_GET['id']."' ORDER BY id DESC";
		$berita_lain = $this->db->get_results($lain);

		$lainnya = array();
		foreach ($berita_lain as $row) {
		    $array_row['konten'] = '<h4><i class="fa fa-circle"></i> <a style="color:#333;font-weight:bold" href="'.ROOTDIR.'agenda/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']).'">'.$row['judul'].'</a></h4>'; 
		    array_push($lainnya,$array_row);
		} 
		$url = htmlspecialchars("https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$surl = str_replace(":", "%3A", $url);
		$surl = str_replace("/", "%2F", $surl);

		$q = "SELECT * FROM berita WHERE id = '".$_GET['id']."'";
		$results = $this->db->get_results($q);
		$baca = number_format($results[0]['baca'] / 2);
        $this->smarty->assign('twitter', str_replace("@", "", $this->dbconf->getConf('twitter')));
        $this->smarty->assign('url', $url);

		$this->smarty->assign('surl', $surl); 
		$this->smarty->assign('wasurl', $url); 

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('berita_lain', $lainnya); 

        return array('data'=>$this->smarty->fetch('read.tpl'), 'judul' => $page_title);
	}
}
?>