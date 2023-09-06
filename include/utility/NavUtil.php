<?php
class NavUtil{
	function render($nav){
		$html = false;
		$html .= '<div class="row" style="margin-bottom:14px">
                        <div class="col-md-12">';
		foreach($nav as $key => $value){
			$class="";
			if($key == $_GET['f']){
				$class = "active";
				$value['c'] = '';
				$link = $_SERVER['REQUEST_URI'];
			} 
			else{
				$link = ROOTDIR.'giadmin/'.$_GET['menu'].'/'.$key;
			}
			
			$html.= '<a style="font-weight:600" href="'.$link.'" class="btn btn-primary '.$class.$value['c'].'">'.ucwords(strtolower($value['t'])).'</a>
			';
		}
		$html .= '</div></div>';
		return($html);
	}	
}
