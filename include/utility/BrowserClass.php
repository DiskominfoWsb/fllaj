<?php
class BrowserClass{
	function detect(){
		$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

		if (preg_match('/opera/', $userAgent)) {
		$name = 'Opera';
		}
		elseif (preg_match('/webkit/', $userAgent)) {
		$name = 'Safari/Chrome';
		}
		elseif (preg_match('/msie/', $userAgent)) {
		$name = 'Internet Explorer';
		}
		elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) {
		$name = 'Mozilla Firefox';
		}
		else {
		$name = 'unrecognized';
		}

		if (preg_match('/.+(?:fox|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) {
		$version = $matches[1];
		}
		else {
		$version = 'unknown';
		}

		if (preg_match('/linux/', $userAgent)) {
		$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/', $userAgent)) {
		$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/', $userAgent)) {
		$platform = 'Windows';
		}
		else {
		$platform = 'unrecognized';
		}

		return $name.' '.$version.' '.$platform;
	}
}
?>