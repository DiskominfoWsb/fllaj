<?php
include('cfg.php');
require 'include/utility/smarty/Smarty.class.php';
include('include/data/DatabaseClass.php');
include('include/utility/SecurityClass.php');	
include('include/utility/NavUtil.php');	
include('include/utility/StringClass.php');
include('include/utility/DateClass.php');
include('include/utility/UrlClass.php');
include('include/utility/PagingClass.php');
include('include/utility/securimage/securimage.php');
include('include/utility/PHPExcel/PHPExcel.php');
include('include/helper/Helper.php');

require("include/utility/upload033/class.upload.php");

// auto load module
if ($handle = opendir('modules')) {
    while (false !== ($files = readdir($handle))) {
        if ($files != "." && $files != "..") {			
			$pattern = '/\b.php\b/i';
			if(preg_match($pattern, $files)){
				include('modules/'.$files);			
			}
        }
    }
    closedir($handle);
}

// auto load report
/*if ($handle = opendir('report')) {
    while (false !== ($files = readdir($handle))) {
        if ($files != "." && $files != "..") {			
			$pattern = '/\b.php\b/i';
			if(preg_match($pattern, $files)){
				include('report/'.$files);			
			}
        }
    }
    closedir($handle);
}*/

?>