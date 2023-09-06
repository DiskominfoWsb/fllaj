<?php
	class SecurityClass{
		function cleanAllRequest(){
			foreach($_POST as $key => $value){
				if(!is_array($_POST[$key])){
					$str = str_replace(	
						array('\\', '"', '\''),
						array('\\\\', '\"', '\\\''), 
						$value
					);
					$_POST[$key] = $str;
				}
			}
			foreach($_GET as $key => $value){
				if(!is_array($_GET[$key])){
					$str = str_replace(
						array('\\', '"', '\'', ' '),
						array('\\\\', '\"', '\\\'', ''), 
						$value
					);
					$_GET[$key] = $str;
				}
			}
		}

		function esc($str){
			$str = str_replace(
				array('\\','"','\'', ' '),
				array('\\\\','\"','\\\'', ''), 
				$str
			);
			return($str);	
		}	
	}
?>