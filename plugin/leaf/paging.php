<?php
class LEAF_paging
{
	public $v = array('overload-paging' => false);
	
	function __construct()
	{
		// default variable set.
			$this->conf['range-link'] = 2;
	}
	
	public function totalData()
	{
		$query = SQL::execute($this->conf['query-total']);
		$assoc = SQL::assoc($query);
		$this->conf['total-data'] = $assoc['TOTALDATA'];
	}
	
	public function totalPage()
	{ 
		$this->conf['total-page'] = ceil( $this->conf['total-data'] / $this->conf['limit-data'] );
	}
		
	public function startDataPerPage()
	{
		$this->conf['start-data-per-page'] = $this->conf['start-data']+1;
	}
	
	public function endDataPerPage($total)
	{
		$this->conf['end-data-per-page'] = ( ($this->conf['start-data']+($total-1)) );
	}	
	
	public function rangePaging()
	{
		$this->conf['start-paging'] = 1;
		
		// end arrow.
		$this->conf['end-arrow'] = true;
		
		// start arrow & end arrow.
		if($this->conf['total-page'] > ($this->conf['range-link']*2)+1){
			$this->conf['start-arrow'] = true;
		}
		else{
			$this->conf['end-arrow'] = false;
		}
		
		// kondisi saat 'active page' 
		// berada pada page-page terakhir.
		if($_GET['pg'] >= $this->conf['total-page'] - $this->conf['range-link']){
		 	$this->conf['end-paging'] = $this->conf['total-page'];
			 
			if($this->conf['total-page'] - ($this->conf['range-link']*2) >= 0 ){
				$this->conf['start-paging'] = $this->conf['total-page'] - ($this->conf['range-link']*2);
			}
			else{
				$this->conf['start-paging'] = 1;
			}
				
			$this->conf['end-arrow'] = false;
		} 
		
		// kondisi saat 'active page'
		// berada pada page-page awal
		// sampai dengan dibawah nol.
		elseif($_GET['pg'] <= $this->conf['range-link']+1){
			$this->conf['end-paging'] 	= ($this->conf['range-link']*2)+1;
			$this->conf['start-paging'] = 1;
			$this->conf['start-arrow'] 	= false;
		}	 
		
		// kondisi normal / berada di tengah-tengah.
		else{
			$this->conf['end-paging'] = $_GET['pg']+$this->conf['range-link'];
			 
			if($_GET['pg'] - $this->conf['range-link'] > 0){
			 	$this->conf['start-paging'] = $_GET['pg']-$this->conf['range-link'];
			}
			else{
				$this->conf['start-paging'] = 1;
			}
		}
	}

	// USE	
	function checkBugsPaging()
	{
		if($_GET['pg'] > $this->conf['total-page']){
			header('location:'.html_entity_decode($this->conf['paging-url']).'&pg='.$this->conf['total-page']);
			die();
		}
	}
	
	function init()
	{	
		if($this->conf['total-data']>0){
			// Check bugs paging.
				$this->checkBugsPaging();

			$v=array();
			$v['paging']='
				<div class="paging">
					<div class="trigger">
			';
			
			if($this->conf['start-arrow'] === true){
				$v['paging'].='
					<a href="'.$this->conf['paging-url'].'&amp;pg=1" class="metro-hitam fmtip default trans-background" title="First Page"><<</a>
				';
			}
			
			for($i=$this->conf['start-paging']; $i<=$this->conf['end-paging']; $i++){
				if($i>0 && $i<=$this->conf['total-page']){
					if($i==$_GET['pg']){
						$this->conf['link-style'] = 'merah active';
					}
					else{
						$this->conf['link-style']='metro-hitam default trans-background';
					}
					
					$v['paging'].= '
						<a href="'.$this->conf['paging-url'].'&amp;pg='.$i.'" class="'.$this->conf['link-style'].'">'.$i.'</a>
					';
				}			
			}
			
			if($this->conf['end-arrow'] === true){
				$v['paging'].='
					<a href="'.$this->conf['paging-url'].'&amp;pg='.$this->conf['total-page'].'" class="metro-hitam fmtip default trans-background" title="Last Page">>></a>
				';
			}	
			
			$v['paging'].='
					</div><!--[trigger]-->
					
					<div class="info">
						<div class="text">
							Total: 
							<b>'.$this->conf['total-data'].'</b>
							data,					
							<b>'.$this->conf['total-page'].' </b>
							pages
						</div>
						
						<div class="goto">
							<div class="cgoto metro-hitam">
								<div class="ke">
									Go to page
								</div>
								<div class="input">
									<form action="{rootdir}plugin/auth_paging.php" method="POST">
										<input type="text" class="paging-text" name="to" />								
										<input type="image" src="{themepath}img/go.png" alt="icon" />
										<input type="hidden" name="current-page" value="'.$_GET['pg'].'" />
										<input type="hidden" name="url" value="'.$this->conf['paging-url'].'" />
									</form>
								</div>
							</div>
						</div>
					</div><!--[info]-->
				</div><!--[paging]-->
			';
			
		
			return($v['paging']);
		}
		else{
			return(false);
		}
	}	
}

