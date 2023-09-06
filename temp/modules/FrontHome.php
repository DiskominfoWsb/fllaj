<?php
class FrontHome {
	function __construct(){
		$this->db 		 	= new DatabaseClass;
		$this->smarty     	= new Smarty(); 
		$this->nav 		 	= new NavUtil;
		$this->date 	 	= new DateClass;
		$this->url 		 	= new UrlCLass; 
		$this->wf 		 	= new WF;
		$this->scr 			= new SecurityClass;
		$this->page_title	= 'BERANDA';	


		$this->smarty->setTemplateDir('templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
	}
	
	function init(){
		if(!isset($_GET['f'])) $_GET['f'] = 'index';
		switch( $_GET['f'] ){
			default:
				return($this->index());
				break;
		}
	}

	function index(){
		$qconf = "SELECT * FROM setting where id = 1";
        $rconf = $this->db->get_single_result($qconf);

        $this->smarty->assign('rconf', $rconf);
        $this->smarty->assign('berita', $this->berita());
        $this->smarty->assign('banner', $this->banner());
        $this->smarty->assign('weblink', $this->weblink());
        $this->smarty->assign('video', $this->video());

        $this->smarty->assign('agenda', $this->agenda());
        $this->smarty->assign('bankdata', $this->bankdata());
        $this->smarty->assign('tag', $this->tag());
        $this->smarty->assign('statistik', $this->statistik());
        
        return $this->smarty->fetch('index.tpl');
	}

	function berita(){
		$q = "SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1'
			ORDER BY berita.tanggal DESC limit 6";
		$r = $this->db->get_results($q);
		$return_arr = array();
		$no = 1;
		foreach ($r as $row) {
			$gm = explode("|", $row['gambar']);
	    	if (file_exists('files/berita/'.$gm[0])) {
	    		$gambar = ROOTDIR.'files/berita/'.$gm[0];
	    	}else{
	    		$gambar = ROOTDIR.'images/image-not-available.jpg';
	    	}
		    $row_array['id'] 			= $row['id']; 
		    $row_array['kontributor'] 	= $row['kontributor']; 
		    $row_array['judul'] 		= $row['judul']; 
		    $row_array['isi'] 			= substr(strip_tags($row['isi']), 0, 100);
		    $row_array['baca'] 			= number_format($row['baca']/2,0,'.',','); 
		    $row_array['link'] 			= ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']); 
		    $row_array['gambar'] 		= $gambar; 
		    $row_array['tanggal'] 		= $this->date->IndonesianDatetime($row['tanggal']);
		    $row_array['end'] 			= $this->db->get_num_rows($q);

		    array_push($return_arr,$row_array);
		} 
		return $return_arr;
	}

	function banner(){
		$data = '';
		$query_slider = "SELECT * FROM banner WHERE status = '1'";
        $result_slider = $this->db->get_results($query_slider);
        return $result_slider;
	}

	function weblink() {
		$q = "SELECT * FROM weblink where status = 1";
		return $this->db->get_results($q);
	}

	function video() {
		$q = "SELECT * FROM video where status = '1' order by rand() limit 3";
		$r = $this->db->get_results($q);
		$return_arr = array();
		foreach ($r as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 

	    	$link = explode("&", $row['link']);
			$vlink =  $link[0];

		    $row_array['link'] = str_replace("watch?v=", "embed/", $vlink); 
		    $row_array['keterangan'] = $row['keterangan']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);

		    array_push($return_arr,$row_array);
		} 
		return $return_arr;
	}

	public function bankdata() {
		$data = false;
		$q = "SELECT * FROM bankdata WHERE status = '1' ORDER BY tanggal DESC limit 5";
		$results = $this->db->get_results($q);
		$no = 1;
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['keterangan'] = $row['keterangan']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['namafile'] = $row['namafile']; 
		    $row_array['cek'] = file_exists('files/bankdata/'.$row['namafile']);
		    $row_array['seo'] = $this->url->friendlyURL($row['judul']); 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);
		    $row_array['end'] 			= $this->db->get_num_rows($q);

		    array_push($return_arr,$row_array);
		} 
		return $return_arr;
	}

	public function agenda() {
		$data = false;
		$q = "SELECT * FROM agenda JOIN users ON agenda.uid = users.user_id WHERE NOW() < agenda.tgl_selesai ORDER BY agenda.tgl_mulai ASC limit 5";
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
		return $return_arr;
	}

	public function tag() {
		$q = "SELECT *, (SELECT count(*) FROM berita where id_kategori = berita_kategori.id_kategori) as jml FROM berita_kategori";
		$results = $this->db->get_results($q);
		$no = 1;
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id_kategori'] = $row['id_kategori']; 
		    $row_array['jml'] = $row['jml']; 
		    $row_array['nama_kategori'] = $row['nama_kategori']; 
		    $row_array['seo'] = $this->url->friendlyURL($row['nama_kategori']); 
			
			array_push($return_arr,$row_array);
		} 
		return $return_arr;
	}

	public function statistik() {
        $ip         = $_SERVER['REMOTE_ADDR'];
        $tanggal    = date("Y-m-d");
        $waktu      = time();
        $bataswaktu = time() - 600;
        $week = date('Y-m-d', strtotime('-1 week'));
        $month = date('Y-m-d', strtotime('-1 month'));
        $q = "SELECT * FROM statistik where tanggal = '".$tanggal."' and ip = '".$ip."'";
        if ($this->db->get_num_rows($q) > 0) {
        	$r = $this->db->get_single_result($q);
        	$data = array(
				'hits'		=> $r['hits']+1,
				'online'	=> $waktu,
			);
        	$where = array(
				'ip' 	=> $ip, 'tanggal' => $tanggal
			);
			$this->db->do_update( 'statistik', $data, $where, 1 ); 
        }else{
        	$data = array(
				'hits'		=> 1,
				'online'	=> $waktu,
				'ip'		=> $ip,
				'tanggal'	=> $tanggal
			);
			$this->db->do_insert( 'statistik', $data,true ); 
        }
	}
}
?>