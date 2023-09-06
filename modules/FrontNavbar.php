<?php
class FrontNavbar {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty(); 
		$this->url 		 = new UrlCLass;

        $this->smarty->assign('basedir', ROOTDIR); 
        $this->smarty->assign('themepath', ROOTDIR.'templates/front/'.FRONT_THEME.'/');
	}

	function init($parent = 0){
		$data = false;
		$q = "SELECT *, (SELECT COUNT(*) FROM pages p WHERE p.status = 1 AND p.parent = pages.id) as jml FROM pages WHERE status = 1 AND parent = '".$parent."' ORDER BY urut ASC";
		foreach ($this->db->get_results($q) as $row){
			$target = $icon = $active = $dropdown = '';
			if($row['module'] == ""){
				$link = ROOTDIR.'page/'.$row['id'].'/'.$this->url->friendlyURL($row['judul']);
			}else{
				if(strpos($row['module'], 'http') !== false){
				    $link = $row['module']; 
				    $target = 'target="_blank"';
				}else{
					$link = ROOTDIR.$row['module']; 	
				}
			}
			if ($parent > 0) {
				// $icon = '<i class="fa fa-circle"></i>';
				$icon = '';
			}
			if ($row['module'] == $_GET['menu']) {
				$active = 'active';
			}
			$c1 = $c2 = $dt = $ic = '';
			if ($row['jml'] > 0) {
				$link = "#"; 
				$ic = '<i class="fa fa-angle-down"></i>';
				$c1 = 'dropdown';
				$c2 .= 'dropdown-toggle ';
				$dt = 'data-toggle="dropdown" data-menu="dropdown"';
			}
			if ($parent != 0) {
				$c2 .= 'dropdown-item ';
			}
			// $data .= '<li class="nav-item '.$active.' "><a class="dropdown-item '.$dropdown.'" '.$target.' href="'.$link.'">'.$icon.' '.$row['judul'].'</a>';
			// 	if ($row['jml'] > 0) {
			// 		$data .= '<div class="dropdown-menu">
			// 			<ul>';
			// 		$data .= $this->init($row['id']);
			// 			$data .= '</ul>
			// 		</div>';
			// 	}
			// $data .= '</li>';
			$data .= '<li class="'.$c1.' nav-item">
        		<a class="'.$c2.' nav-link nav_item" href="'.$link.'" '.$dt.'>'.$icon.' '.$row['judul'].' '.$ic.'</a>';
				if ($row['jml'] > 0) {
					$data .= '
		                <ul class="dropdown-menu">
		                	'.$this->init($row['id']).'
		                </ul>
		            ';
				}
			$data .= '</li>';
		}
		return $data;
	}
}
?>