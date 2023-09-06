<?php
class WF {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->date 	 = new DateClass;
		$this->dbconf     = new DataConfigClass;
		$this->dilarang_masuk = array('php', 'txt', 'html', 'phtml', 'htm', 'phtm', 'php5', 'shtml', 'sphp', 'pjpeg', 'xjpg', 'htaccess', 'asa', 'cer', 'pht', 'asax', 'xap');
	}

	function kick(){
		$delete = array(
		    'user_id' => $_SESSION['user_id']
		);
		$this->db->do_delete( 'users', $delete, 1 );
		session_destroy();
	}

	function upload_files($files, $type, $tbl){
	    $ff = [];
	    $no = 0;
		foreach($files as $key => $value) {
	        $n = count($value['name']);
	        if ($n > 0) {
	            for ($i = 0; $i < $n; $i++) {
	            	if ($value['name'][$i] != '') {
		                $a = str_replace(" ", "", $value['name'][$i]);
		                $b = explode('.', $a);
		                $cj = count($b)-1;
		                $tidak_boleh_masuk = array_intersect($b, $this->dilarang_masuk);
		                if (count($tidak_boleh_masuk) == 0) {
		                    $no++;
		                    $name = date('dmYhis').'_'.$no.'_'.$a;
		                    $target_dir = "files/".$tbl."/";
		                    $target_file = $target_dir.basename($name);
		                    $uploadOk = 1;
		                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		                    move_uploaded_file($value["tmp_name"][$i], $target_file);
		                    if ($type == $key) {
		                    	$ff[] = $name;
		                    }
		                }else{
		                	$this->kick();
		                }
	            	}
	            }
	        }
	    }

	    if (count($ff) > 0) {
	        return implode(", ", $ff);
	    }else{
	    	return false;
	    }
	}

	function upload_single_files($files, $type, $tbl){
	    $ff = [];
	    $no = 0;
		foreach($files as $key => $value) {
	        // $n = count($value['name']);
	        if ($value['name'] != '') {
                $a = str_replace(" ", "", $value['name']);
                $b = explode('.', $a);
                $cj = count($b)-1;
                $tidak_boleh_masuk = array_intersect($b, $this->dilarang_masuk);
                if (count($tidak_boleh_masuk) == 0) {
                    $no++;
                    $name = date('dmYhis').'_'.$no.'_'.$a;
                    $target_dir = "files/".$tbl."/";
                    $target_file = $target_dir.basename($name);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    move_uploaded_file($value["tmp_name"], $target_file);
                    if ($type == $key) {
                    	$ff[] = $name;
                    }
                }else{
                	$this->kick();
                }
	        }
	    }
	    if (count($ff) > 0) {
	        return implode(", ", $ff);
	    }else{
	    	return false;
	    }
	}
}