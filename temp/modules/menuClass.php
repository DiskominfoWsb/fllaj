<?php
class menuClass{
	function __construct(){
		$this->db        = new DatabaseClass;
		//$this->str       = new StringClass();
	}



	function init(){
		$data = false;
		$sub = $aktif = $aktif_sub = $aktif_color = '';
		
		$q = "SELECT * from menu where parent = '0' order by urut asc ";
		$results = $this->db->get_results($q);
		foreach( $results as $row ){
			$akses = explode(',', $row['akses']);
			$a = false;
			foreach ($akses as $key) {
				if (md5($key) == $_SESSION['level_akses']) {
					$a = true;
				}
			}
			if ($a) {
			
				$qsub 	= "SELECT * from menu where parent = '".$row['id_menu']."' order by urut asc ";
				$ressub = $this->db->get_results($qsub);
				$jum 	= $this->db->get_num_rows($qsub);

				if ($jum==0) {
					$link = ROOTDIR.'giadmin/'.$row['menu_key'];
					$kelas = '';
					$icondown = '';
					if($_GET['menu'] == $row['menu_key']){					
						$kelas = 'class="active"';
					}
				}else{
					$icondown = '<i class="fa fa-angle-left pull-right"></i>';
					$sub .= '<ul class="treeview-menu">';
					foreach( $ressub as $rowsub ){
						if($_GET['menu'] == $rowsub['menu_key']){					
							$aktif = 'active';
							$aktif_sub = ' class="active" ';
						}
						$kelas = 'class=" treeview '.$aktif.'"';
						$linksub = ROOTDIR.'giadmin/'.$rowsub['menu_key'];
						$akses = explode(',', $rowsub['akses']);
						$a = false;
						foreach ($akses as $key) {
							if (md5($key) == $_SESSION['level_akses']) {
								$a = true;
							}
						}
						if ($a) {
							$sub .= '<li '.$aktif_sub.'><a title="'.$rowsub['menu_desc'].'" '.$aktif_color.' href="'.$linksub.'">'.$rowsub['icon'].' <span> '.$rowsub['menu_urai'].'</span></a></li>';
						}
						$aktif_sub = '';
					}
					$sub.=	'</ul>';	
					$link = "javascript:__getSubMenu('".$row['menu_key']."');";
				}	

				$data .= '<li '.$kelas.'><a title="'.$row['menu_desc'].'" href="'.$link.'">'.$row['icon'].' <span> '.$row['menu_urai'].'</span> '.$icondown.'</a>';
				$data .= $sub;	
				$sub   = '';
				$data .='</li>';		
				$aktif = '';
				$linku = '';
			}
		}
		
		return($data);
	}
	
}
?>