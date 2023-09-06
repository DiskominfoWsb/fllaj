<?php 
Class LoginClass {
    function __construct() {
        $this->db = new DatabaseClass;
        $this->ssusrvar = md5(APP_ID.'ssusr');
        $this->sspassvar = md5(APP_ID.'sspsw');
        $this->timeout = 60 * 60;
    }
    function isLogged(){
        //echo $_SESSION['last_access'];
        //die
        !isset($_SESSION[$this->ssusrvar]) ? $_SESSION[$this->ssusrvar] = true : false;
        !isset($_SESSION[$this->sspassvar]) ? $_SESSION[$this->sspassvar] = true : false;
        !isset($_SESSION['last_access']) ? $_SESSION['last_access'] = true : false;

        $this->timeout = 60*60;
        if ($_SESSION['last_access'] + ($this->timeout) < time()) {
            unset($_SESSION[$this->ssusrvar]);
            unset($_SESSION[$this->sspassvar]); 
            unset($_SESSION);        
            $cek  = 0;
        }
        else{
            $_SESSION['last_access'] = time() + ($this->timeout);
            $username = base64_decode($_SESSION[$this->ssusrvar]);
            $password = base64_decode($_SESSION[$this->sspassvar]);
            
            $q = "SELECT * FROM users WHERE username='".$username."' AND password='".sha1('wf'.$password)."'";
            $jumlah = $this->db->get_num_rows($q);
            $cek = $jumlah;
        }
        return($cek);
    }

    function init() {
        $q = "SELECT user_id,username,password,nama_lengkap,no_hp,level_akses,status
                    FROM users WHERE 
                    username= '" .$_POST['username']. "' 
                    AND password= '".sha1('wf'.$_POST['password'])."'"; 
        $result = $this->db->get_single_result($q,PDO::FETCH_NUM);
        $jumlah = $this->db->get_num_rows($q);
        list($user_id,$username,$password,$nama_lengkap,$no_hp,$level_akses,$status) = $result;

        
        if (str_replace(' ', '', $_POST['username']) == ''){
            die('{"respon":"gagal","msg":"Username masih kosong"}');
        }
        if ($_POST['password'] == ''){
            die('{"respon":"gagal","msg":"Password Masih Kosong"}');
        }
        if ($status == 0){
            die('{"respon":"gagal","msg":"Akun Belum Aktif. Hubungi Admin."}');
        }

        $_SESSION['last_access']    = time();
        $_SESSION[$this->ssusrvar]  = base64_encode($_POST['username']);
        $_SESSION[$this->sspassvar] = base64_encode($_POST['password']);
        $_SESSION['level_akses']    = md5($level_akses);
        $_SESSION['user_id']        = $user_id;
        $_SESSION['username']       = $username;
        $_SESSION['nama_lengkap']   = $nama_lengkap;
        $_SESSION['key']   = md5($user_id.'wf'.sha1('wf'.md5('wf')));

        if ($jumlah==1) {
            $response = '{"respon":"sukses"}';
        }
        else{
            $response = '{"respon":"gagal","msg":"Username atau Password Salah"}';
        }
        die($response);
    }

    function logout(){
        unset($_SESSION[$this->ssusrvar]);
        unset($_SESSION[$this->sspassvar]);  
        unset($_SESSION['user_id']);
        unset($_SESSION['level_akses']);
        unset($_SESSION['username']);
        unset($_SESSION['last_access']);      
        unset($_SESSION['nama_lengkap']);      
        header("location:".ROOTDIR."giadmin");
        die();
    }


    function cek_akses($id_menu){
        $q = "SELECT count(*)as jumlah FROM menu m, menu_akses ma 
            WHERE 
            m.id_menu=ma.id_menu
            AND m.menu_key='".$_GET['menu']."'
            AND ma.id_menu = '".$this->crypt->decode($id_menu)."' ";
        die($q);
        $q = $this->db->query($q);
        $row = $this->db->get_results($q);

        if ($_SESSION['level_akses']<>md5('admin') and $_GET['menu']<> 'ganti_passwd') {
            if ($_GET['menu']<>'home' and $_GET['menu']<>'account') {
                if($row['jumlah']==0){
                    echo "<meta http-equiv='refresh' content='0;URL=".$this->cnf->ROOTDIR."giadmin/hacked'>";
                    die();
                }
            }
        }
    }

    function cek_passwd(){
        if ($_GET['menu']<> 'ganti_passwd' and base64_decode($_SESSION[$this->sspassvar]) == '0cc175b9c0f1b6a831c399e269772661') {
            header("location:".$this->cnf->ROOTDIR."giadmin/ganti_passwd");
            die();
        }        
    }
    
    function google() {
        $q = "SELECT user_id,username,password,nama_lengkap,no_hp,level_akses,email
                    FROM users WHERE 
                    email= '" .$_POST['email']. "' "; 
        $result = $this->db->get_single_result($q,PDO::FETCH_NUM);
        $jumlah = $this->db->get_num_rows($q);
        list($user_id,$username,$password,$nama_lengkap,$no_hp,$level_akses,$email) = $result;

        if ($jumlah==1) {
            $response = '{"respon":"sukses"}';
            
            $_SESSION['last_access']    = time();
            $_SESSION[$this->ssusrvar]  = base64_encode($username);
            $_SESSION[$this->sspassvar] = base64_encode($password);
            $_SESSION['level_akses']    = md5($level_akses);
            $_SESSION['user_id']        = $user_id;
            $_SESSION['username']       = $username;
            $_SESSION['nama_lengkap']   = $nama_lengkap;
        }
        else{
            $response = '{"respon":"gagal","msg":"Email Belum Terdaftar."}';
        }
        die($response);
    }

    function daftar(){
        if($_POST['ktp'] == '') $error[] = '- Silahkan isi Nomor KTP Anda ';
        if($_POST['hp'] == '') $error[] = '- Silahkan isi Nomor HP Anda ';

        $q = "SELECT * from users where username = '".$_POST['username']."'";
        if ($this->db->get_num_rows($q) == 1) {
            $error[] = '- Username Sudah di Pakai.';
        }
        $q = "SELECT * from users where email = '".$_POST['email']."'";
        if ($this->db->get_num_rows($q) == 1) {
            $error[] = '- Email Sudah di Pakai.';
        }
        $q = "SELECT * from users where no_hp = '".$_POST['hp']."'";
        if ($this->db->get_num_rows($q) == 1) {
            $error[] = '- No. Hp Sudah di Pakai.';
        }

        if (isset($error)) {
            $response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
            die($response);
        }else{
            try {    
                $data = array(
                    'username'      => $_POST['username'],
                    'password'      => md5($_POST['pw2']),
                    'level_akses'       => 'umum',
                    'nama_lengkap'      => $_POST['nama_lengkap'],
                    'no_hp'     => $_POST['hp'],
                    'alamat'     => $_POST['alamat'],
                    'email'     => $_POST['email'],
                    'nik'     => $_POST['ktp'],
                    'last_login' => date('Y-m-d H:i:s')
                );
                $this->db->do_insert( 'users', $data,true ); 
                $response = 'sukses';
                
            }
            catch(PDOException $e)
            {
                $response = $e->getMessage();
            }
            die($response);
        }
    }

    // function lupa(){        
    //     $error[] = '- Username / No. Hp yang anda masukan tidak terdaftar.';
    //     $q = "SELECT * from users where username = '".$_POST['user']."'";
    //     if ($this->db->get_num_rows($q) == 1) {
    //         $r = $this->db->get_single_result($q);
    //         $error = [];
    //     }
    //     $q = "SELECT * from users where no_hp = '".$_POST['user']."'";
    //     if ($this->db->get_num_rows($q) == 1) {
    //         $r = $this->db->get_single_result($q);
    //         $error = [];
    //     }
    //     if (isset($r)) {
    //         if ($r['level_akses'] == "admin") {
    //             $error[] = '- Hubungi Admin Pusat.';
    //         }
    //         if ($r['no_hp'] == "") {
    //             $error[] = '- Tidak Ada No. Hp terdaftar. Silahkan hubungi Admin Pusat.';
    //         }
    //     }

    //     if (!empty($error)) {
    //         $response = '{"status":"gagal","response":"'.implode('<br />', $error).'"}';
    //         die($response);
    //     }else{
    //         $pass = $this->gen();
    //         $url = 'http://kantor.gi.co.id:8018/sms_center_pacitan/kirim_sms/';
    //         $apikey = sha1('PACITANKAB');

    //         $nomor = $r['no_hp'];
    //         $pesan = 'SP3TPK. Password Baru anda : '.$pass;
    //         $fields = array(
    //             'api_key'   => $apikey,
    //             'nomer'     => $nomor,
    //             'pesan'     => $pesan
    //         );

    //         $fields_string = '';
    //         foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    //         rtrim($fields_string, '&');
    //         $ch = curl_init();
    //         curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
    //         curl_setopt($ch,CURLOPT_URL, $url);
    //         curl_setopt($ch,CURLOPT_POST, count($fields));
    //         curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    //         curl_exec($ch);
    //         curl_close($ch);

    //         $update = array(
    //             'password' => md5($pass)
    //         );
    //         $where_clause = array(
    //             'user_id' => $r['user_id']
    //         );
            
    //         $this->db->do_update( 'users', $update, $where_clause, 1 );
    //         $num = '';
    //         $nomore = str_split($nomor);
    //         foreach ($nomore as $key => $value) {
    //             if ($key > 8) {
    //                 $num .= 'X';
    //             }else{
    //                 $num .= $value; 
    //             }
    //         }
    //         $response = '{"status":"sukses","response":"Password baru sedang dikirim ke '.$num.'."}';
    //         die($response);
    //     }
    // }
    
    function gen() {
        $alphabet = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); 
    }
}

?>