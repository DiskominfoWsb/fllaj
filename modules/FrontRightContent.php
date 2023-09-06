<?php
class FrontRightContent {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->date 	 = new DateClass;
		$this->url 		 = new UrlCLass; 
		
		$this->smarty->assign('baseurl', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/'); 
        $this->smarty->setTemplateDir('templates/front/'.FRONT_THEME);
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
	}

	function init(){
		$qconf = "SELECT * FROM setting where id = 1";
        $rconf = $this->db->get_single_result($qconf);

		$this->smarty->assign('twitter', str_replace('@', '', $rconf['twitter']));
		$this->smarty->assign('basedir',ROOTDIR);
		$this->smarty->assign('rconf',$rconf);
		$this->smarty->assign('facebook',$rconf['facebook']);
		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']);
		
		$this->smarty->assign('trending',$this->trending());
		$this->smarty->assign('tag',$this->tag());
		$this->smarty->assign('agenda',$this->agenda());
		$this->smarty->assign('video',$this->video());
		$this->smarty->assign('bankdata',$this->bankdata());

        return $this->smarty->fetch('right.tpl');
	}

	function trending(){
		$data = false;
		$q = "SELECT *, DATEDIFF(now(),berita.tanggal) as slsh, berita.baca/DATEDIFF(now(),berita.tanggal) as nilai FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori where berita.status = 1 group by berita.id order by berita.baca/DATEDIFF(now(),berita.tanggal) desc LIMIT 3";
		$results = $this->db->get_results($q);
		$no = 1;
		$return_arr = array();
	    foreach ($results as $row) {$gm = explode("|", $row['gambar']);
	    	if (file_exists('files/berita/'.$gm[0])) {
	    		$gambar = ROOTDIR.'files/berita/thumb_'.$gm[0];
	    	}else{
	    		$gambar = ROOTDIR.'images/image-not-available.jpg';
	    	}
		    $row_array['judul'] 		= $row['judul']; 
		    $row_array['baca'] 			= number_format($row['baca']/2,0,'.',','); 
		    $row_array['link'] 			= ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']); 
		    $row_array['gambar'] 		= $gambar; 
		    $row_array['tanggal'] 		= $this->date->IndonesianDatetime($row['tanggal']);

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

	function video() {
		$q = "SELECT * FROM video where status = '1' order by rand() limit 1";
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
}
?>