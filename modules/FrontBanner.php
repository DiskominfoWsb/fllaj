<?php
class FrontBanner {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->url 		 = new UrlCLass; 

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
	}

	function init(){
		$data = '';
		$query_slider = "SELECT * FROM berita WHERE status = '1' ORDER BY tanggal DESC limit 4";
        $result_slider = $this->db->get_results($query_slider);
        $no = 1;
		foreach ($result_slider as $row) {
			$gm = explode("|", $row['gambar']);
			$a = '';
			if ($no == 1) {
				$a = 'active';
			}
			$data .= '<div class="ms-slide" style="z-index: 10">
				<img src="'.ROOTDIR.'files/berita/'.$gm[0].'" data-src="'.ROOTDIR.'files/berita/'.$gm[0].'" alt="'.$row['judul'].'" alt="">
				<div class="ms-layer ms-promo-info color-light" style="left:15px; top:300px"
				data-effect="bottom(40)"
				data-duration="2000"
				data-delay="700"
				data-ease="easeOutExpo"
				>'.$row['judul'].'</div>

				<div class="ms-layer ms-promo-sub color-light" style="left:15px; top:450px"
				data-effect="bottom(40)"
				data-duration="2000"
				data-delay="1300"
				data-ease="easeOutExpo"
				>'.substr(strip_tags($row['isi']), 0, 200).' ...</div>

				<a class="ms-layer btn-u" style="left:15px; top:530px" href="'.ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']).'"
				data-effect="bottom(40)"
				data-duration="2000"
				data-delay="1300"
				data-ease="easeOutExpo"
				>Selengkapnya</a>
			</div>';
            $no++;
		}
		return $data;
	}

	function banner(){
		$data = '';
		$query_slider = "SELECT * FROM banner WHERE status = '1'";
        $result_slider = $this->db->get_results($query_slider);
        $no = 1;
        foreach ($result_slider as $row) {
			$a = '';
			if ($no == 1) {
				$a = 'active';
			}
			$data .= '
				<div class="single-hero-item set-bg" data-setbg="'.ROOTDIR.'files/rotator/'.$row['gambar'].'">
					<div style="z-index: 10; background-color: rgba(0,0,0,.4); color: white; text-align: center; padding: 25px 0; position: absolute; bottom: 0; right: 0; left: 0;">
						<h4 style="color: white; font-weight: bold;">Selamat Datang di Portal Resmi Kabupaten Katingan Provinsi Kalimantan Tengah</h4>
					</div>
				</div>

			';
            $no++;
		}
        return $data;
	}

	function head(){
		$query_slider = "SELECT * FROM header WHERE status = '1' order by RAND() DESC limit 1";
        $result_slider = $this->db->get_single_result($query_slider);
        $n = $this->db->get_num_rows($query_slider);
        if ($n == 1) {
        	$head = '<img style="max-height: 100%; max-width: 100%;" src="'.ROOTDIR.'files/header/'.$result_slider['gambar'].'">';	
        }else{
        	$head = '';
        }
        return $head;
	}

	function landing(){
		$data = '';
		$query_slider = "SELECT * FROM berita WHERE status = '1' ORDER BY tanggal DESC limit 10";
        $result_slider = $this->db->get_results($query_slider);
        $no = 1;
		foreach ($result_slider as $row) {
			$gm = explode("|", $row['gambar']);
			$a = '';
			if ($no == 1) {
				$a = 'active';
			}
			$data .= '<div class="item '.$a.'" style="height: 200px;">
                <img src="'.ROOTDIR.'files/berita/'.$gm[0].'" alt="'.$row['judul'].'" style="width:100%;">
                <div class="carousel-caption">
                	<a href="'.ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']).'" style="color: white;">
						<h5><b>'.$row['judul'].'</b></h5>
					</a>
                </div>
			</div>';
            $no++;
		}
		return $data;
	}
}
?>