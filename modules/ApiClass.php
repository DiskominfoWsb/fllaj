<?php
class ApiClass{
	function __construct(){
		$this->db 		 = new DatabaseClass;		
		$this->url 		 = new UrlCLass; 
		$this->date 	 = new DateClass;
		$this->scr 			= new SecurityClass;
	}
	
	function init(){
		!isset($_GET['f']) ? $_GET['f'] = 'manage' : false;
		if (!method_exists($this, $_GET['f'])) {
			return($this->index());
			die();
		}
		switch( $_GET['f'] ){
			case $_GET['f']:
				return($this->{$_GET['f']}());
				break;
				
			default:
				return($this->index());
				break;
		}
	}

	function index(){

		$class_methods = get_class_methods('ApiClass');
		// or
		$class_methods = get_class_methods(new ApiClass());

		$data = '
			<h1>Daftar API</h1>
			<ol>';
		foreach ($class_methods as $method_name) {
		    if ($method_name != "__construct" and $method_name != "init" and $method_name != "index" and $method_name != "numberToRomanRepresentation") {
		    	$data .= '<li style="padding: 2.5px;"><a href="'.ROOTDIR.'api/'.$method_name.'"> '.strtoupper(str_replace("_", " ", $method_name)).' -  (api/'.$method_name.')</a></li>';
		    }
		}
		$data .= '</ol>';
		die($data);
	}
	
	// function tabel_cek(){
	// 	$this->scr->cleanAllRequest();
	// 	$q = "SELECT * FROM `permohonan_email` where token = '".$this->scr->esc($_POST['token'])."'";
	// 	$r = $this->db->get_single_result($q);
	// 	if ($this->db->get_num_rows($q) == 1) {
	// 		if ($r['status'] == '0'){
	// 			$stt = '<label class="label label-default"> Permohonan Masuk </label>';
	// 		}
	// 		elseif ($r['status'] == '1'){
	// 			$stt = '<label class="label label-warning"> Permohonan Diproses </label>';
	// 		}
	// 		elseif ($r['status'] == 'Y'){
	// 			$stt = '<label class="label label-danger"> Permohonan Diterima </label>';
	// 		}
	// 		elseif ($r['status'] == 'N'){
	// 			$stt = '<label class="label label-success"> Permohonan Ditolak </label>';
	// 		}
	// 	    die('<table class="table table-bordered table-striped table-hover">
	// 	    	<tr>
	// 	    		<th>Tanggal Permohonan</th>
	// 	    		<td style="text-align: left;">'.$this->date->Indonesiandatetime($r['tanggal']).'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Nama</th>
	// 	    		<td style="text-align: left;">'.$r['nama'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>NIP</th>
	// 	    		<td style="text-align: left;">'.$r['nip'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>No. Telp</th>
	// 	    		<td style="text-align: left;">'.$r['hp'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Dinas Asal</th>
	// 	    		<td style="text-align: left;">'.$r['dinas'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Pangkat</th>
	// 	    		<td style="text-align: left;">'.$r['pangkat'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Jabatan</th>
	// 	    		<td style="text-align: left;">'.$r['jabatan'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Email</th>
	// 	    		<td style="text-align: left;">'.$r['email'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Status</th>
	// 	    		<td style="text-align: left;">'.$stt.'</td>
	// 	    	</tr>
	// 	    </table>');
	// 	}

	// 	$q = "SELECT * FROM `permintaan` where token = '".$this->scr->esc($_POST['token'])."'";
	// 	$r = $this->db->get_single_result($q);
	// 	if ($this->db->get_num_rows($q) == 1) {
	// 		if ($r['status'] == '0'){
	// 			$stt = '<label class="label label-default"> Permohonan Masuk </label>';
	// 		}
	// 		elseif ($r['status'] == '1'){
	// 			$stt = '<label class="label label-warning"> Permohonan Diproses </label>';
	// 		}
	// 		elseif ($r['status'] == 'Y'){
	// 			$stt = '<label class="label label-danger"> Permohonan Diterima </label>';
	// 		}
	// 		elseif ($r['status'] == 'N'){
	// 			$stt = '<label class="label label-success"> Permohonan Ditolak </label>';
	// 		}
	// 	    die('<table class="table table-bordered table-striped table-hover">
	// 	    	<tr>
	// 	    		<th>Tanggal Permohonan</th>
	// 	    		<td style="text-align: left;">'.$this->date->Indonesiandatetime($r['tanggal']).'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Nama</th>
	// 	    		<td style="text-align: left;">'.$r['nama'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>NIP</th>
	// 	    		<td style="text-align: left;">'.$r['nip'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>No. Telp</th>
	// 	    		<td style="text-align: left;">'.$r['hp'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Dinas Asal</th>
	// 	    		<td style="text-align: left;">'.$r['dinas'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Domain</th>
	// 	    		<td style="text-align: left;">'.$r['domain'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Ringkasan</th>
	// 	    		<td style="text-align: left;">'.$r['ringkasan'].'</td>
	// 	    	</tr>
	// 	    	<tr>
	// 	    		<th>Status</th>
	// 	    		<td style="text-align: left;">'.$stt.'</td>
	// 	    	</tr>
	// 	    </table>');
	// 	}
	// 	die("Tidak Ada Data.");
	// }

	public function grafik1() {
		header('Access-Control-Allow-Origin: *');
		// die('wf');
		// if (!empty($_POST) and @$_POST['auth'] == 'wf'.$_GET['mod'].$_GET['f']) {
		$q = "SELECT pengaduan_kategori.urai, (SELECT COUNT(*) FROM pengaduan WHERE pengaduan.kategori = pengaduan_kategori.id AND pengaduan.`status` = '1') AS jumlah, (SELECT COUNT(*) FROM pengaduan JOIN pengaduan_respon ON pengaduan_respon.`id_pengaduan` = pengaduan.id WHERE pengaduan.kategori = pengaduan_kategori.id AND pengaduan.`status` = '1') AS sudah FROM pengaduan_kategori"; 
		$r = $this->db->get_results($q);
		$x = $y = $sudah = $jumlah = [];
		foreach ($r as $row) {
			$x[] 		= $row['urai'];
			$jumlah[] 	= (int)$row['jumlah']; 
			$sudah[] 	= (int)$row['sudah'];
		}
		$y[] = array(
			'name' 	=> 'Jumlah', 
			'color'	=> 'rgba('.$this->random_color().',1)',
			'data'	=> $jumlah
		);
		$y[] = array(
			'name' 			=> 'Sudah Ditanggapi', 
			'color'			=> 'rgba('.$this->random_color().',0.75)',
			'data'			=> $sudah,
			'pointPadding'	=> (float) 0.25
		);
		$data = array(
			'judul' 	=> 'Statistik Jumlah Aspirasi dan Pelaporan', 
			'sumber' 	=> 'LLAJ Kab. Wonosobo', 
			'x' 		=> $x, 
			'y' 		=> $y
		);
		die(json_encode($data, JSON_PRETTY_PRINT));

		// }
	}

	public function grafik2()
	{
		header('Access-Control-Allow-Origin: *');
		$q = "SELECT * FROM pengaduan_kategori";
		$rkat = $this->db->get_results($q);
		$n = $this->db->get_num_rows($q);
		$q = "SELECT DATE_FORMAT(tanggal, '%m') AS bulan, DATE_FORMAT(tanggal, '%Y') AS tahun, COUNT(kategori) AS jumlah, pengaduan_kategori.urai AS kategori FROM pengaduan LEFT JOIN pengaduan_kategori ON pengaduan_kategori.`id` = pengaduan.`kategori` where pengaduan.status = '1' GROUP BY DATE_FORMAT(tanggal, '%Y-%m'), kategori ORDER BY DATE_FORMAT(tanggal, '%Y-%m') DESC LIMIT ".(12*$n)."";
		$r = $this->db->get_results($q);
		// var_dump($r);
		$r = array_reverse($r);
		// echo "<hr>";
		// var_dump($r);
		// die();
		$array = [];
		foreach ($r as $row) {
			$array[$row['bulan'].'-'.$row['tahun']][$row['kategori']] = $row['jumlah'];
		}
		// var_dump($array);die();
		$x = $y = $val = [];
		foreach ($array as $key => $value) {
			$tanggal = explode('-', $key);
			$x[] = $this->date->IndonesianMonth($tanggal[0]).' '.$tanggal[1];
			foreach ($rkat as $row) {
				if (array_key_exists($row['urai'], $value)) {
					$val[$row['urai']][] = (int) $value[$row['urai']];
				}else{
					$val[$row['urai']][] = (int) 0;
				}
			}
		}
		foreach ($val as $key => $value) {
			$y[] = array(
				'name' => $key, 
				'color'	=> 'rgba('.$this->random_color().',1)',
				'data' => $value 
			);
		}
		$data = array(
			'judul' 	=> 'Statistik Bulanan Aspirasi dan Pelaporan', 
			'sumber' 	=> 'LLAJ Kab. Wonosobo', 
			'x' 		=> $x, 
			'y' 		=> $y
		);
		die(json_encode($data, JSON_PRETTY_PRINT));
	}

	private function random_color_part() {
	    return str_pad(mt_rand( 0, 255 ), 2, '0', STR_PAD_LEFT);
	}

	private function random_color() {
	    return $this->random_color_part() .', '. $this->random_color_part() .', '. $this->random_color_part();
	}
}
?>