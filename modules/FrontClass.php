<?php
class FrontClass{
	function __construct()
    {
        $this->scr      = new SecurityClass;
        $this->db       = new DatabaseClass;
		$this->date 	= new DateClass;
        $this->dbconf   = new DataConfigClass;  
		$this->smarty   = new Smarty();  
        $this->str      = new StringClass; 
        $this->url      = new UrlCLass;

        //Smarty Config
        $this->smarty->assign('baseurl', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/'); 
        $this->smarty->setTemplateDir('templates/front/'.FRONT_THEME);
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        //End Smarty Config

	}

	function init()
    {
        $app = false;
        if(!isset($_GET['menu'])) $_GET['menu'] = 'home';
        switch($_GET['menu']){
            case'page':
                $app = new FrontPages();
                break;

            case 'berita':
                $app = new FrontBerita();
                break;
            case 'kategori':
                $app = new FrontKategori();
                break;
            case 'foto':
                $app = new FrontFoto();
                break;
            case 'video':
                $app = new FrontVideo();
                break;
            case 'pengaduan':
                $app = new FrontPengaduan();
                break;
            case 'agenda':
                $app = new FrontAgenda();
                break;
            case 'download':
                $app = new FrontDownload();
                break;
            case 'visimisi':
                $app = new FrontVisimisi();
                break;

            case 'siswaguru':
                $app = new FrontSiswaGuru();
                break;

            default :
                $app = new FrontHome();
                break;              
        }

        $page_title = $app->page_title;

        
        $hariini = $this->date->SQLIndonesianDay(date('w')).', '.date('d').' '.$this->date->IndonesianMonth(date('m')).' '.date('Y');

        $this->smarty->assign('tanggalhariini', $hariini);

        $qconf = "SELECT * FROM setting where id = 1";
        $rconf = $this->db->get_single_result($qconf);
        
        $this->smarty->assign('facebook', $rconf['facebook']);
        $this->smarty->assign('youtube', $rconf['youtube']);
        $this->smarty->assign('wa', explode(",", $rconf['wa']));
        $this->smarty->assign('twitter', str_replace("@", "", $rconf['twitter']));
        $this->smarty->assign('instagram', str_replace("@", "", $rconf['instagram']));

        $met = $titkat = '';
        if (is_array($app->init())) {
            $hasil = $app->init();
            $this->smarty->assign('web_title', $hasil['judul']);
            $this->smarty->assign('content', $hasil['data']); 
            $web_title = $hasil['judul'];
        }else{
            $this->smarty->assign('web_title', $page_title);
            $this->smarty->assign('content', $app->init()); 
            $web_title = $page_title;
        }
        $met = ' 
            <link rel="icon" href="'.ROOTDIR.'files/setting/'.$rconf['gambar'].'" type="image/gif" sizes="16x16">
            <meta property="og:type" content="website" />
            <meta property="og:url" content="'.ROOTDIR.'" />
            <meta property="og:title" content="'.$web_title.' - '.$rconf['nama_app'].'" />
            <meta property="og:description" content="'.$rconf['nama_app'].'" />
            <meta name="keywords" content="'.str_replace(" ", ", ", $rconf['nama_app']).'">
            <meta property="og:image" itemprop="image" content="'.ROOTDIR.'files/setting/'.$rconf['gambar'].'" />
            <meta property="og:image:width" content="200" />
            <meta property="og:image:height" content="200" />
            <link itemprop="thumbnailUrl" href="'.ROOTDIR.'files/setting/'.$rconf['gambar'].'"> 
            <span itemprop="thumbnail" itemscope itemtype="https://schema.org/ImageObject"> 
                <link itemprop="url" href="'.ROOTDIR.'files/setting/'.$rconf['gambar'].'"> 
            </span>
            <meta name="googlebot-news" content="index,follow" />
            <meta name="googlebot" content="index,follow" />';

        if (@$_GET['f'] == 'read' and @$_GET['menu'] == 'berita') {
            $q = "SELECT berita.*, berita_kategori.nama_kategori as kategori FROM berita left join berita_kategori on berita.id_kategori = berita_kategori.id_kategori WHERE id= '".$this->scr->esc(htmlspecialchars($_GET['id']))."'";
            $results = $this->db->get_results($q);
            $gm = explode("|", $results[0]['gambar']);

            $met = '
                <link rel="icon" href="'.ROOTDIR.'files/setting/'.$rconf['gambar'].'" type="image/gif" sizes="16x16">
                <meta property="fb:app_id" content="173062883398595" />
                <meta property="og:type" content="articel" />
                <meta property="og:site_name" content="polairud" />
                <meta name="keywords" content="'.str_replace(" ", ", ", $results[0]['judul']).'">

                <meta name="googlebot-news" content="index,follow" />
                <meta name="googlebot" content="index,follow" />

                <meta name="robots" content="index, follow" />
                <meta name="language" content="id" />
                <meta name="geo.country" content="id" />
                <meta http-equiv="content-language" content="In-Id" />
                <meta name="geo.placename" content="Indonesia" />

                <meta property="og:url" content="'.ROOTDIR.'berita/read/'.$results[0]['id'].'/'.$this->url->friendlyURL($results[0]['judul']).'" />
                <meta property="og:title" content="'.$results[0]['judul'].'" />
                <meta property="og:description" content="'.htmlspecialchars(strip_tags($results[0]['isi'])).'" />
                <meta property="og:image" content="'.ROOTDIR.'files/berita/thumb_'.$gm[0].'" />
                <meta property="og:image:width" content="200" />
                <meta property="og:image:height" content="200" />

                <link itemprop="thumbnailUrl" href="'.ROOTDIR.'files/berita/thumb_'.$gm[0].'"> 
                <span itemprop="thumbnail" itemscope itemtype="https://schema.org/ImageObject"> 
                    <link itemprop="url" href="'.ROOTDIR.'files/berita/thumb_'.$gm[0].'"> 
                </span>';
        }
            // $titkat = str_replace("_", " ", $results[0]['kategori']);
            // $titkat = strtoupper($titkat);

        $this->smarty->assign('met', $met); 
        $this->smarty->assign('titkat', $titkat); 
        $this->smarty->assign('rconf', $rconf); 
        $this->smarty->assign('pengunjung', $this->pengunjung());
        $this->smarty->assign('weblink', $this->weblink());
        $this->smarty->assign('trending', $this->trending());
        $this->smarty->assign('berita', $this->berita());

        $navbar = new FrontNavbar();
        $this->smarty->assign('navbar', $navbar->init());

        
        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');

        // if ($_GET['menu'] == 'landing') {
            // $this->smarty->display('landing.tpl');
        // }else if ($_GET['menu'] == 'home') {
            $this->smarty->display('index.tpl');
        // }else{
            // $this->smarty->display('detail.tpl');
            // $this->smarty->display('index.tpl');
        // }
	}

    function pengunjung(){
        $ip         = $_SERVER['REMOTE_ADDR'];
        $tanggal    = date("Y-m-d");
        $waktu      = time();
        $bataswaktu = time() - 600;
        $week = date('Y-m-d', strtotime('-1 week'));
        $month = date('Y-m-d', strtotime('-1 month'));

        $p = "SELECT sum(hits) as today, (SELECT sum(hits) as tot FROM statistik) as tot, (SELECT sum(hits) as week FROM statistik WHERE tanggal>'".$week."') as week, (SELECT sum(hits) as month FROM statistik WHERE tanggal>'".$month."') as month FROM statistik WHERE tanggal='$tanggal'";
        $rp = $this->db->get_single_result($p);

        $pengunjung = array(
            'pengunjung'    => number_format($rp['today']/2,0,",","."), 
            'mingguan'      => number_format($rp['week']/2,0,",","."), 
            'bulanan'       => number_format($rp['month']/2,0,",","."), 
            'total'         => number_format($rp['tot']/2,0,",",".")
        );

        return $pengunjung;
    }

    function weblink() {
        $q = "SELECT * FROM weblink where status = 1";
        return $this->db->get_results($q);
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
            $row_array['judul']         = $row['judul']; 
            $row_array['baca']          = number_format($row['baca']/2,0,'.',','); 
            $row_array['link']          = ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']); 
            $row_array['gambar']        = $gambar; 
            $row_array['tanggal']       = $this->date->IndonesianDatetime($row['tanggal']);

            array_push($return_arr,$row_array);
        }
        return $return_arr;
    }

    function berita(){
        $q = "SELECT berita.*, users.nama_lengkap as kontributor, berita_kategori.nama_kategori as kategori,berita_kategori.id_kategori FROM berita join users on berita.uid = users.user_id join berita_kategori on berita_kategori.id_kategori = berita.id_kategori WHERE berita.status = '1'
            ORDER BY berita.tanggal DESC limit 10";
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
            $row_array['id']            = $row['id']; 
            $row_array['kontributor']   = $row['kontributor']; 
            $row_array['judul']         = $row['judul']; 
            $row_array['isi']           = substr(strip_tags($row['isi']), 0, 100);
            $row_array['baca']          = number_format($row['baca']/2,0,'.',','); 
            $row_array['link']          = ROOTDIR.'berita/read/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']); 
            $row_array['gambar']        = $gambar; 
            $row_array['tanggal']       = $this->date->IndonesianDatetime($row['tanggal']);
            $row_array['end']           = $this->db->get_num_rows($q);

            array_push($return_arr,$row_array);
        } 
        return $return_arr;
    }

}
?>