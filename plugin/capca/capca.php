<?php
session_start();
header("Content-type: image/png");

 if(isset($_GET['uniq'])){
	 $name = 'SESSION.CAPCA.'.$_GET['uniq'];
 }
 else{
	 $name = 'SESSION.CAPCA';
 }

$captcha_image = imagecreatefrompng("capcabg.png");
$captcha_font = imageloadfont("capcafont.gdf");
$captcha_text = substr(md5(uniqid('')),-6,6);

$_SESSION[$name] = $captcha_text;

$captcha_color = imagecolorallocate($captcha_image,255,255,255);
imagestring($captcha_image,$captcha_font,15,2,$captcha_text,$captcha_color);
imagepng($captcha_image);
imagedestroy($captcha_image);
?>
