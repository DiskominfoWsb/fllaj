<?php
class TableDataClass{			
	function grid($options){
		/* Options:
			- initial : program / kegiatan ,dll.
			- data : query result data
			- nav : array, link-link yang akan digunakan
			- navtheme : string
			- tabletitle : html
			- forminput html : html			
			- editbutton : class edit button			
			- index : boolean
			- sesresult : boolean
			- checkbox : boolean
			- forminput : boolean
			- templateedit : boolean
		*/
		
		/* Default options value */
		$this->options = array(	'initial'		=> '',
								'nav'			=> '',
								'data'			=> '',
								'tabletitle'	=> '',
								'editbutton'	=> 'edititem',
								'totaldata'		=> 0,
								'kodeinput'		=> false,
								'forminputhtml'	=> false,
								'formreporthtml'=> false,
								'index'			=> false,
								'sesresult'		=> false,
								'checkbox'		=> false,
								'forminput'		=> false,
								'formreport'	=> false,
								'templateedit'	=> false,
								'navtheme'		=> false,
								'button'		=> true);
		
		/* Ubah value dari default option sesuai dengan user defined. */
		foreach($options as $key => $value){
			$this->options[$key] = $value;
		}
		
		$this->v = array('sesresult'	=> false,
						 'checkbox'		=> false,
						 'forminput'	=> $this->footer($this->options['totaldata']),
						 'templatedit'	=> false,
						 'button'		=> false,
						 'kodeinput'	=> '<input type="text" name="kd" id="kd" class="text register" value="'.$this->options['kodeinput'].'." readonly="readonly" style="width: 80px; text-align: right;" />
											<input type="text" name="kode" id="kode" class="text register" />',
						 'inputindex'	=> 'false');

		if($this->options['sesresult'] === true){
			$this->v['sesresult']	= $this->sessionResult($this->options['initial'].'-result');
		}
		if($this->options['checkbox'] === true){
			$this->v['checkbox'] = '
				<th class="abuabu" style="width: 30px;">
					<a href="javascript:void(0);" class="cekuncekall tipster" title="Check / Uncheck All">
						<img src="{themepath}img/check-all.png" alt="icon" />
					</a>
				</th>			
			';
		}
		if($this->options['index'] === true){
			$this->v['kodeinput'] = '
				<input type="text" name="kode" id="kode" class="text register" />			
			';
			$this->v['inputindex'] = 'true';
		}
		if($this->options['forminput'] === true){
			$this->v['forminput'] = $this->footer($this->options['totaldata'], true);
		}
		if($this->options['templateedit'] === true){
			$this->v['templateedit'] = $this->templateEditItem();
		}
		
		if($this->options['tabletitle'] <> ''){
			$this->v['tabletitle'] = str_replace('{thcheckbox}', $this->v['checkbox'], $this->options['tabletitle']);
		}else{
			$this->v['tabletitle'] = '
				<tr>
					'.$this->v['checkbox'].'
					<th class="abuabu">Kode '.ucwords($this->options['initial']).'</th>
					<th class="abuabu">Uraian</th>
				</tr>			
			';
		}

		$html = '
		<table class="apps">
				<tr>
					<td class="r1 grey vmiddle head" style="height: 30px;">
						'.$this->navigasi($this->options['nav']).'
					</td>
				</tr>

				<tr>
					<td class="r2 data">
						<div class="data">
						<form action="?menu='.$_GET['menu'].'&amp;f=auth&amp;t=delete&amp;i='.$this->options['initial'].'" method="POST" id="formTableData">
							<input type="hidden" name="selfurl" value="'.$_SERVER['REQUEST_URI'].'" />																		
							<input type="hidden" value="'.$this->v['inputindex'].'" class="index" />
							
							'.$this->clue($this->options['nav']).'
								
							'.$this->v['sesresult'].'
							'.$_SESSION['url'].'
							
							<table class="dt">
								'.$this->v['tabletitle'].'
			';
			
			$html.= $this->options['data'];
			$html.= '
							</table>							
						</form>
						</div>
					</td>
				</tr>
				<tr>
					<td class="r3 grey vmiddle foot" style="height: 40px;">
						'.$this->v['forminput'].'
					</td>
				</tr>
			</table>
		';
		return($html . $this->v['templateedit']);	
	}
	
	function navigasi($arrayMenu){
		switch( $this->options['navtheme'] ){
			case '1':
				$html = $this->navtheme1();
				break;
			default:
				if( is_array($arrayMenu) ){
					$html = false;
					
					$i = $now = 0;
					foreach($arrayMenu as $key => $value){
						if($_GET['f'] == strtolower($key)){
							$now = $i;
						}
						$i++;
					}
					
					$i = 0;
					foreach($arrayMenu as $key => $value){
						$class = 'def putihtua';
						if($_GET['f'] == strtolower($key)){
							$class 	= 'active gbiru';	
							$href 	= $_SERVER['REQUEST_URI'];
						}
						else{							
							$href = $value['link'];
						}
						
						if($now < $i)
							$link = 'javascript:void(0);';
						else
							$link = $href;
						
						$html .= '
							<a href="'.$link.'" class="'.$class.'">
								'.$key.'
							</a>
						';
						$i++;
					}
				}
				break;
		}
		return($html);			
	}
	
	function navtheme1(){
		foreach($this->options['nav'] as $key => $value){
			$class= 'def ';
			if($key == $_GET['f']){
				$class = "gbiru active";
				$value['c'] = '';
				$link = $_SERVER['REQUEST_URI'];
			}
			else{
				$link = '?menu='.$_GET['menu'].'&amp;f='.$key;
			}
			
			$html.= '
				<a href="'.$link.'" class="'.$class.$value['c'].'">
					<div class="n">
						'.$value['t'].'
					</div>
				</a>
			';
		}
		return($html);
	}
	
	function clue($arrayMenu){
		if( is_array($arrayMenu) ){
			$kd = explode('.', $_GET['kd']);
					
			$i = 0;
			foreach($arrayMenu as $key => $value){
				$i++;
				if($_GET['f'] == strtolower($key)){
					$pos = $i;
				}
			}			
			
			$clue = false;
			$i = 0;
			foreach($arrayMenu as $key => $value){
				$i++;
				if( $i < $pos && $pos > 1 ){
					$lowerkey = strtolower($key);
										
					$db = new MysqlClass();
					$q = $db->query($value['query']);
					$a = $db->fetchArray($q);
					
					$urai = $a[$value['field']['kode']].'&ensp;-&ensp;'.$a[$value['field']['urai']];
					
					$clue .= '
						<tr>
							<td class="l">'.ucwords($lowerkey).'</td>
							<td class="r">:&ensp;<b>'.$urai.'</b></td>
						</tr>
					';
					
					$db->close();
				}
			}
			//die($k);
			
			$html = '
				<table class="clue">
					<tr><td>
						<table class="cl">
							'.$clue.'
						</table>
					</td></tr>
				</table>		
			';
			
			if($clue !== false)
				return($html);
			else
				return(false);
		}
	}
	
	function footer($totalData = 0, $form = false){		
		if($form){
		
			$forminputhtml = str_replace('{kodeinput}', $this->v['kodeinput'], $this->options['forminputhtml']);
			if($this->options['forminputhtml'] === false){
				$forminputhtml = '
					<tr>
						<td class="l">
							Kode '.ucwords($_GET['f']).'
						</td>
						<td class="r">
							'.$this->v['kodeinput'].'
						</td>
					</tr>
					<tr>
						<td class="l">
							Uraian
						</td>
						<td class="r">
							<input type="text" name="urai" id="urai" class="text long register" />
						</td>
					</tr>					
				';
			}
			
			$button = array('tambah'	=> '<a href="javascript:void(0);" class="gbutton button tambahitem">Tambah</a>',
							'edit'		=> '<a href="javascript:void(0);" class="gbutton button '.$this->options['editbutton'].'">Edit</a>',
							'delete'	=> '<a href="javascript:void(0);" class="gbutton button deleteconfirm">Delete</a>',
							'report'	=> '<a href="javascript:void(0);" class="gkuning button buttonreport" style="border-color:rgb(254, 191, 4);">Buat Laporan</a>');
							
			foreach($button as $key => $value){
				if( is_array($this->options['button']) ){
					if( in_array($key, $this->options['button']) ){
						$this->v['button'].= $value;
					}
				}else{								
					$this->v['button'].= $value;
				}
			}			

			$form = '
				<div class="l">
					'.$this->v['button'].'
				</div>
							
				<div class="forminput">					
					<form action="?menu='.$_GET['menu'].'&amp;f=auth&amp;t=input&amp;kd='.$_GET['kd'].'" method="POST" class="register" id="formInputData">
					<input type="hidden" name="selfurl" value="'.$_SERVER['REQUEST_URI'].'" />
							
					<div class="result"></div>
								
					<table class="tinput">
						'.$forminputhtml.'
						<tr>
							<td colspan="2" class="sbmt">
							<input type="hidden" value="'.$_GET['f'].'" name="type" id="type" class="register" />
							<input type="submit" value="Simpan" class="submit gkuning" />
							<input type="button" value="Tutup" class="submit but batalinput gitem" />
							</td>
						</tr>
					</table>
					</form>
				</div>
			';
			
			if( $this->options['formreport'] === true){
				
				if( $this->options['formreporthtml'] !== false ){
					$formreporthtml = $this->options['formreporthtml'];
				}else{
					$formreporthtml = '
						<tr>
							<td class="l">
								Rekening
							</td>
							<td class="r">
								<span title="Kode Akun">
									<input type="text" name="kdakun" id="kdakun" class="text register kdr" />
								</span>
								<span title="Kode Kelompok">
									<input type="text" name="kdkel" id="kdkel" class="text register kdr" />
								</span>
								<span title="Kode Jenis">
									<input type="text" name="kdjenis" id="kdjenis" class="text register kdr" />
								</span>
								<span title="Kode Obyek">
									<input type="text" name="kdobj" id="kdobj" class="text register kdr" />
								</span>
								<span title="Kode Rekening">
									<input type="text" name="kdrek" id="kdrek" class="text register kdr" />
								</span>
								<div title="Cari Rekening" class="tipster gbiru3 cari carirekening">
									<img src="{themepath}img/lup-white.png" alt="icon" />
									Pencarian
								</div>								
							</td>
						</tr>
						<tr>
							<td class="l">
								Uraian
							</td>
							<td class="r">
								<div class="urai readonly text reset" style="width: 300px; padding: 10px; overflow: hidden; border: solid 1px #ABABAB;" />
								</div>
							</td>
						</tr>
						<tr>
							<td class="l">
								Tanggal
							</td>
							<td class="r">
								<input type="text" name="tgl_start" id="tgl_start" class="text long register tglstart" style="width: 150px;" readonly="readonly" />
								&ensp;s.d.&ensp;
								<input type="text" name="tgl_end" id="tgl_end" class="text long register tglend" style="width: 150px;" readonly="readonly" />
							</td>
						</tr>						
						<tr>
							<td class="hide templateSearchRekening" colspan="2">
								<input type="hidden" class="url" value="{rootdir}?menu=pengeluaran&amp;f=ajaxreport" />								
								<input type="hidden" class="kd" value="'.$_GET['kd'].'" />
								<input type="hidden" class="type" value="report"  />
								
								<div class="srek">
									<div class="abuabu isrek top">
										<div class="l">
											Pencarian
										</div>
										<div class="r">
											<div class="close">X</div>							
										</div>
									</div>
									<div class="isrek middle">
										<div class="ajaxcontent">
											
										</div>
									</div>
									<div class="abuabu isrek bottom">							
										<input type="hidden" class="url" value="{rootdir}?menu=sp2d&amp;f=ajaxcontent" />
									</div>
								</div>
							</td>
						</tr>					
					';
				}
				
				$form .= '
				<div class="formreport">
					<form action="?menu='.$_GET['menu'].'&amp;f=report&amp;kd='.$_GET['kd'].'" method="POST" class="register" id="formReportData">
					<input type="hidden" name="selfurl" value="'.$_SERVER['REQUEST_URI'].'" />
							
					<div class="result"></div>
								
					<table class="tinput">
						
						'.$formreporthtml.'
						
						<tr>
							<td colspan="2" class="sbmt">
							<input type="hidden" value="'.$_GET['f'].'" name="type" id="type" class="register" />
							<input type="submit" value="Cetak" class="submit gkuning" />
							<input type="button" value="Tutup" class="submit but batalreport gitem" />
							</td>
						</tr>
					</table>
					</form>
				</div>				
				';
			}
		}
		
		$html = '
			<div class="lf">			
				'.$form.'			
				<div class="info r">
					Total <b>'.$totalData.'</b> data
				</div>
			</div>		
		';
		return($html);	
	}
	
	function templateEditItem(){
		$html = '
		<div class="templatePopupEditItem">
			<div class="popupEditItem">
			<form action="?menu='.$_GET['menu'].'&amp;f=auth&amp;t=edit" method="POST" class="register" id="formEditData">
				<div class="result"></div>
				<div class="top abuabu">
					<div class="title">
						FORM EDIT DATA
					</div>
					<div class="r">
						<div class="close">
							X
						</div>
					</div>
				</div>
				<div class="middle">
					{jscontent}
				</div>
				<div class="bottom abuabu">
					<div class="l">
						<input type="hidden" value="'.$_SERVER['REQUEST_URI'].'" name="selfurl" />
						<input type="hidden" value="'.$_GET['f'].'" id="type" name="type" class="register" />
						<input type="hidden" id="totaldata" name="totaldata" class="register totaldata" />					
						<input type="submit" value="Simpan" class="button gkuning" />
						<input type="button" value="Batal" class="button batal close" />
					</div>
				</div>
			</form>
			</div>
		</div>
		';
		return($html);	
	}
	
	function sessionResult($name){
		$html = false;
		if(isset($_SESSION[$name]) && $_SESSION[$name] <> ''){
			$html = '
				<div class="sessionResult">
					<table class="sess">
						<tr>
							<td class="lf">
								<img src="{themepath}img/info.png" alt="icon" class="icon" />
							</td>
							<td class="rg">
								'.$_SESSION[$name].'
							</td>
						</tr>
					</table>
				</div>			
			';
			unset($_SESSION[$name]);
		}
		return($html);	
	}
	
	function cekbugs($id, $pkfield, $table){
		$q = '	SELECT COUNT(*) AS TOTAL 
				FROM '.$table.'
				WHERE '.$pkfield.'=\''.$id.'\'';
		$q = $this->db->query($q);
		return($a['TOTAL']);
	}
}
?>