<?php
class PagingClass{
	function __construct(){

	}

	function create($jml_page){
		$paging = false;

		$uri = $_SERVER['REQUEST_URI'];
		$urix = explode("&page=", $uri);
		$uriok = $urix[0];

		$paging .= "Halaman : <select name=\"page\" id=\"page\" style=\"padding:2px;border:1px solid #999\" onchange=\"MM_jumpMenu('parent',this,0)\">";
		for($i = 1 ; $i <= $jml_page; $i++) {
			if($_GET['page'] == $i){	
				$paging .= '<option value="'.$uriok.'&amp;page='.$i.'" selected>'.$i.'</option>';
			}
			else{
				$paging .= '<option value="'.$uriok.'&amp;page='.$i.'">'.$i.'</option>';
			}
		}
		$paging .= '</select>';
		$paging .= "<script type=\"text/javascript\">
					function MM_jumpMenu(targ,selObj,restore){
					eval(targ+\".location='\"+selObj.options[selObj.selectedIndex].value+\"'\");
					if (restore) selObj.selectedIndex=0;
					}
					</script>";
		return $paging;
	}
}