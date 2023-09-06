<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$file = $_POST['f'];

if( !empty($file) && isset($_SESSION[md5('ssusr')]) ){		
	if( file_exists($file) ){
		unlink($file);		
	}
}
?>