<?php
class DbGridClass{
	function init($dataSource='',$primaryKey,$arField='',$editing='1',$adding='1',$deleting='1')
	{
			
			$this->cnf = new ConfigClass;
			
			$themepath = $this->cnf->THMDIR ;
			$rootdir = $this->cnf->ROOTDIR;
		
			/* page display */
			$numperpage = 15;	
			$numsetpg = 5;
			/* page counting */
			$pg 		=(empty($_GET[pg]))?"1":$_GET[pg];
			$pgstart	= ($pg-1) * $numperpage;
			$pgend		= ($pg) * $numperpage;
			/* data */
			$nrw = mysql_num_rows($dataSource);
			$numpg = ceil($nrw/$numperpage);				
			$lssetpg = ceil($numpg/$numsetpg); 	
					
			$pg = (empty($_GET[pg]))?1:$_GET[pg];
			$pgs = (empty($_GET[pgs]))?1:$_GET[pgs];
			$prev = $_GET[pgs]-1;
			
			// pattern wf/content/pg/pgs/list.htm$ awal.gi?mode=admin&content=$1&pg=$2&pgs=$3&cntmode=list
			$pages = "<ul id=\"pagination-flickr\">"; 
			if($pgs>'1'){
				$pages = $pages."<li><a href=\"".$rootdir."wf/".$_GET['content']."/".$x."/".$prev."/list.htm \"> &laquo; Previous</a></li>"; 
				//$pages = $pages."<li><a href=\"?content=".$_GET['content']."&mode=list&page=$_GET[page]&pg=$x&pgs=$prev\">« Previous</a></li>";
				} 
			$awal  = ($pgs-1)*$numsetpg+1;
			$akhir = $pgs*$numsetpg;
			for($x=$awal;$x<=$akhir;$x++){
				if($x<=$numpg){
					$pages = $pages."<li><a href=\"".$rootdir."wf/".$_GET['content']."/".$x."/".$pgs."/list.htm \">".$x."</a></li>"; 
					//$pages = $pages." <li><a href=?content=".$_GET['content']."&mode=list&page=$_GET[page]&pg=$x&pgs=$pgs>$x</a></li> ";
				}
			}
			$next = $pgs+1;
			if($pgs<$lssetpg){
				$pages = $pages."<li><a href=\"".$rootdir."wf/".$_GET['content']."/".$x."/".$next."/list.htm \">Next &raquo;</a></li>"; 
				//$pages = $pages."<li class=\"next\"><a href=\"?content=".$_GET['content']."&mode=list&page=$_GET[page]&pg=$x&pgs=$next\">Next &raquo;</a></li>";
			}
			$pages = $pages."</ul>";
			
			
			if($numpg > 1 ){
				$pagedisplay = $pages;
			}else{
				$pagedisplay = '';
			}
			
			if($adding == '1'){
				$add = "<a href='".$this->cnf->ROOTDIR."wf/".$_GET[content]."/form.htm'><img src='".$themepath."images/admin/add.gif' alt='Add' align='absmiddle' border='0' > Add </a>";
			}else{
				$add = "";
			}
			
								
			if($dataSource <> ''){
					// openheader
					$table =	"				
					<script type='text/javascript'>
							function codel(urldel) {
							if(confirm('Anda yakin akan menghapus data ini?')){									
								location.href = urldel;
								return true;
							}else{
								return false;
								}
							}
					</script>					
					
						
					<div style='font-size: 12px; padding-top:15px; padding-bottom:5px; padding-right: 15px;'>
								 $add     		
								</div>
								$pagedisplay<br />
	<br />
	
	
								<div style='font-size: 12px; padding-bottom: 5px; text-align: right; padding-right: 15px;'>
									
								</div>
								<div>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
							  <thead>
							  <tr style='padding: 3px;' bgcolor='#cccccc'>
								<th width='30px' height='25' align='center'><b>No</b></th>";
								
					// loop column			
					for($col=0;$col<count($arField);$col++){
						// field			
						$table .=	"<th height='25' align=left  style='padding-left:5px;padding-right:5px'><b> ". ucwords(strtolower($arField[$col])) ."</b></th>";
					}
					// end loop column			
					
					//closeheader			
					$table .=	"<th width='50px' height='25'><b>Action</b></th>
							  </tr>
							  </thead>
							  <tbody> ";
							  
					// loop row
					$i = 0;
					while($tmpdata = mysql_fetch_array($dataSource)){
						$data[$i] = $tmpdata;
						$i++;
					}
					
					
					for($i = $pgstart; $i< $pgend; $i++){
						$no = $i +1;
						$color = ($no % 2 == 0 )?'#F7F7F7':'';
							if($data[$i][$primaryKey] <> ''){
									//opencontent
									$table .="<tr style='padding: 3px;' bgcolor='".$color."'>
												<td height='30' align='center' style='border-bottom: 1px solid rgb(204, 204, 204); padding-right: 5px;'> $no </td>";
									
									// loop column			
									for($col=0;$col<count($arField);$col++){
										//field			
										$flcol 		= $arField[$col];
										$fielddata  = $data[$i][$flcol];
										// detect image
										// $fielddata 	= ( substr($data[$i][$flcol],-4)=='.jpg')?"<img vspace=5px; width='501px' height='157px' src=banner/img/".$data[$i][$flcol]." /> <img vspace=5px; width='110px' height='110px' hspace='10px' src=banner/thumb/t_".$data[$i][$flcol]." /> ":$data[$i][$flcol]; 
										
										$fielddata = ($fielddata <> '')?$fielddata:'&nbsp;';
										// print td
										$table .="<td height='30' style='border-bottom: 1px solid rgb(204, 204, 204); padding-left:5px; padding-right: 5px;'>". $fielddata ."</td>";
									}
									// end loop column									
									$editLink =($editing == '1')?"<a href='".$this->cnf->ROOTDIR."wf/".$_GET[content]."/".$data[$i][$primaryKey]."/form.htm'><img src='".$themepath."images/admin/edit.gif' alt='Edit Event' border='0'></a>":"";
									$deleteLink =($deleting == '1')?"<a  onClick=\"codel('".$this->cnf->ROOTDIR."wf/".$_GET[content]."/".$data[$i][$primaryKey]."/del.htm');\"><img src='".$themepath."images/admin/del.gif' alt='Hapus Event' border='0'></a>	":"";
									
									$table .="<td height='30' valign='middle' style='border-bottom: 1px solid rgb(204, 204, 204); padding-right: 5px; text-align: center;'>													 											 
													 $deleteLink
													 $editLink
												</td>";
									// closecontent			
									$table .="</tr>";
							}
					}
					// end loop row
					
					
					
					
							 
					// closetable		
					$table .="</tbody></table>
						  </div>
						  <div style='font-size: 12px; padding-bottom: 5px; text-align: right; padding-right: 15px;'>
						  $pagedisplay
						  </div> ";
			}
			return $table;				
	}
}
?>