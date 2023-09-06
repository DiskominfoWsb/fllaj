<?php
class FrontSiswaGuru {
	function __construct(){
		$this->scr 			= new SecurityClass;
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
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
        $gmb = $arr_data = $pagination = false;
        if (!empty($_GET['page'])) {
            $gmb = '../';
        }
        if ($_GET['filter'] == 'siswa') {
            $judul = 'Daftar Siswa';
            $this->siswa();
            $this->smarty->assign('jurusan', $this->jurusan()); 
        }else if ($_GET['filter'] == 'alumni') {
            $judul = 'Daftar Alumni';
            $this->alumni();
            $this->smarty->assign('jurusan', $this->jurusan()); 
            $this->smarty->assign('tahun_alumni', $this->tahun_alumni());
        }else if ($_GET['filter'] == 'guru') {
            $judul = 'Daftar Guru/Karyawan';
            $arr_data = $this->guru();
            $pagination = $this->pagination($arr_data['pagination']);
        }else if ($_GET['filter'] == 'walikelas') {
            $judul = 'Daftar Wali Kelas';
            $arr_data = $this->walikelas();
            $pagination = $this->pagination($arr_data['pagination']);
        }

        $this->smarty->assign('judul', $judul); 
        $this->smarty->assign('gmb', $gmb); 
        $this->smarty->assign('arr_data', $arr_data['data']); 
        $this->smarty->assign('pagination', $pagination); 

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

        return array('data'=>$this->smarty->fetch($_GET['filter'].'.tpl'), 'judul'=>$judul);
	}

    function siswa() {
        if (!empty($_POST)) {
            $postdata = http_build_query(
                array(
                    'tahun' => $_POST['tahun'],
                    'kelas' => $_POST['jurusan']
                )
            );

            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context  = stream_context_create($opts);

            $result = file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/daftar_siswa', false, $context);

            include 'templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/search_siswa.php';

            $data['data'] = $wf;
            die(json_encode($data));
        }
    }

    function alumni() {
        if (!empty($_POST)) {
            $postdata = http_build_query(
                array(
                    'tahun' => $_POST['tahun'],
                    'kelas' => $_POST['jurusan']
                )
            );

            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context  = stream_context_create($opts);

            $result = file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/daftar_alumni', false, $context);

            include 'templates/front/'.FRONT_THEME.'/module/'.$_GET['menu'].'/search_siswa.php';

            $data['data'] = $wf;
            die(json_encode($data));
        }
    }

    function guru() {
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $data = json_decode(file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/daftar_guru/'.$page.'/15'), JSON_FORCE_OBJECT);
        return $data;
    }

    function walikelas() {
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $data = json_decode(file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/daftar_wali/'.$page.'/15'), JSON_FORCE_OBJECT);
        return $data;
    }

    function read() {
        $postdata = http_build_query(
            array(
                'username' => $_GET['id']
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/detail_siswa', false, $context);

        if ($_GET['filter'] == 'siswa') {
            $judul = 'Detail Siswa';
        }else if ($_GET['filter'] == 'alumni') {
            $judul = 'Detail Alumni';
        }

        $r = json_decode($result);

        $this->smarty->assign('r', $r); 
        $this->smarty->assign('judul', $judul); 

        $right = new FrontRightContent;
        $this->smarty->assign('right', $right->init()); 

        $this->smarty->assign('prestasi', $this->detail_prestasi($r->user_id)); 

        return array('data'=>$this->smarty->fetch('read_'.$_GET['filter'].'.tpl'), 'judul'=>$judul);
    }

    function jurusan() {
        $data = json_decode(file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/jurusan'), JSON_FORCE_OBJECT);
        return $data;
    }

    function tahun_alumni() {
        $data = json_decode(file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/tahun_alumni'), JSON_FORCE_OBJECT);
        return $data;
    }

    function detail_prestasi($id) {
        $postdata = http_build_query(
            array(
                'user_id' => $id
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents('https://simpen-smkn2wonosari.wfdev.us/api/prestasi', false, $context);
        return json_decode($result);
    }

    function pagination($array) {
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        $data = false;
        $data .= '<ul class="pagination pagination_style5">';
            $disabled = '';
            if ($page == 1) {
                $disabled = 'disabled';
            }
            $data .= '<li class="page-item '.$disabled.'"><a class="page-link" href="'.ROOTDIR.$_GET['filter'].'/'.($page-1).'" tabindex="-1"><i class="ion-ios-arrow-thin-left"></i></a></li>';
            foreach ($array as $key => $value) {
                $a = '';
                if ($page == $key) {
                    $a = 'active';
                }
                $data .= '<li class="page-item '.$a.'"><a class="page-link" href="'.ROOTDIR.$_GET['filter'].'/'.$key.'">'.$value.'</a></li>';                    
            }
            $disabled = '';
            if ($page == count($array)) {
                $disabled = 'disabled';
            }
            $data .='<li class="page-item '.$disabled.'"><a class="page-link" href="'.ROOTDIR.$_GET['filter'].'/'.($page+1).'"><i class="ion-ios-arrow-thin-right"></i></a></li>';
        $data .='</ul>';

        return $data;
    }
}
?>