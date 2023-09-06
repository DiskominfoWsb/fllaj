<?php
	error_reporting(E_ALL ^ E_NOTICE);
	include('cfg.php');
	$con = mysql_connect(HOST, USER, PASS) ;
	$db = mysql_select_db(DB);

	function CreateKey($clientkey) {
		   $Kasih = Array (22,12,13,23,16,21,11,27,31,14,24,18,29,22,27,15,17,09,7,6);
		   $GenKey = strtoupper(md5(strtoupper(str_ireplace("-","",$clientkey))));
		   $sTemp = "";
		   foreach($Kasih as $i => $val) {
		     $sTemp .= $GenKey{$val-1};
		   }
		   $sTemp = substr($sTemp,0,strlen($sTemp)-9);
		   Return $sTemp;
	}
        if (md5("preet".$_GET['d'])==$_GET['seed']) {
	   $q="select nama,pass from pengguna where nama='".$_GET['username']."' and pass='".$_GET['password']."' and kdurusan='".$_GET['ur']."' and kdbidang='".$_GET['bid']."' and kdunit='".$_GET['org']."'";
	   $q=mysql_query($q);
   	   $data_login=mysql_fetch_array($q);
           $iRand=rand(1,9);
           $iRand2=rand(1,9);
           $iRand=1;
           $iRand2=1;
	   if($data_login!=''){
		        $out=md5($iRand.$data_login['pass'].$iRand.$_GET['d'].",muk0moko,".$iRand2.$data_login['nama']);
                $itSession = $iRand.CreateKey($out).$iRand2;
                $q="update pengguna set session='".$itSession."' where nama='".$_GET['username']."' and pass='".$_GET['password']."'";
	            $q=mysql_query($q);
                die($itSession);
	   } else {
		   die('false');
	   }
        } else {
          die('false');
        }
?>