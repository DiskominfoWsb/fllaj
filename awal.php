<?php

//phpinfo();

date_default_timezone_set('Asia/jakarta');

	// Just Add on :P 
	$cookie_name = "Set-Cookie";
	$cookie_value = "wahyufebriyana_session";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 12), "/"); // 86400 = 1 day
	$cookie_name = "wahyufebriyana_session";
	$cookie_value = "wahyufebriyana_session";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 12), "/"); // 86400 = 1 day

error_reporting(E_ALL);
session_start();
require_once('inc.php');

$dirname = dirname(__FILE__);
$docroot = str_replace(DIRECTORY_SEPARATOR, '/', $dirname) . '/';
$rootdir = str_replace('awal.php', '', $_SERVER['PHP_SELF']);
define('DOCROOT',$docroot);
define('ROOTDIR',$rootdir);
define('SERVER',$_SERVER['SERVER_ADDR'].ROOTDIR);	

$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
define('PROTOCOL',$protocol);	
define('FULL_URL', PROTOCOL."://".$_SERVER['HTTP_HOST'].'/'.$_SERVER['REQUEST_URI']);
class cms{
	function __construct(){		
		$this->security	= new SecurityClass;
		$this->security->cleanAllRequest();	

		$this->db		= new DatabaseClass;	
		$this->smarty   = new Smarty();			
	} 
	function init(){
		!isset($_GET['mode']) ? $_GET['mode'] = '' : false;
		switch($_GET['mode']){
            case 'login':
				$this->login 	= new LoginClass; 
                $this->login->init();
                break;	
			case 'admin':
				$this->app		= new AppClass; 
				$this->app->init();
			break;	
			case 'api':
				$this->api   	= new ApiClass;
				$this->api->init();
			break;
	
			default :
				$this->front   	= new FrontClass;
				$this->front->init();
			break;
		}	
	}	
}
$gicms 	= new cms;
$gicms->init();
?>
