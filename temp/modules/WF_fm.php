<?php
class WF_fm {
	function __construct(){
		$this->dilarang_masuk = array('php', 'txt', 'html', 'phtml', 'htm', 'phtm', 'php5', 'shtml', 'sphp', 'pjpeg', 'xjpg', 'htaccess', 'asa', 'cer', 'pht', 'asax', 'xap');
	}

	public function cek($value) {
		$a = str_replace(" ", "", $value['name']);
        $b = explode('.', $a);
        
        $tidak_boleh_masuk = array_intersect($b, $this->dilarang_masuk);
        if (count($tidak_boleh_masuk) == 0) {
        	return false;
        }else{
            return true;
        }
	}
}