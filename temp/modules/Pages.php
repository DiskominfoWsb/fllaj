<?php
class Pages {
	function __construct(){
		$this->db 		 = new DatabaseClass;
		$this->smarty     = new Smarty();  
		$this->date 	 = new DateClass;
		$this->paging    = new PagingClass;
		$this->nav 		 = new NavUtil;
 		$this->page_title = 'Pengaturan Halaman Statis';
		$this->table 	  = 'pages';
		$this->wf 		 = new WF;

		$this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
	}
	
	function init(){
		$html = '';
		!isset($_GET['f']) ? $_GET['f'] = 'manage' : false;
		switch($_GET['f']){
			case'add':
				$html.= $this->add();
				break;
			case'img':
				$html.= $this->img();
				break;
			case'edit':
				$html.= $this->edit();
				break;
			case'delete':
				$this->delete();
				break;
			case'publish':
				$this->publish();
				break;
			default:
				$html.= $this->manage();
				break;
		}
		return($html);
	}

	function navigasi(){
		$html = '';
		$nav = array(
			'manage'	=> array('t'=>'MANAGE', 'c'=>''),
			'img'		=> array('t'=>'GAMBAR / FILE', 'c'=>''),
			'add'		=> array('t'=>'TAMBAH', 'c'=>'')
		);
		return($this->nav->render($nav));
	}
	
	function manage(){
		$data = false;
		$q = "SELECT * FROM pages where parent = 0 ORDER BY urut ASC";
		$results = $this->db->get_results($q);
		$return_arr = array();
		foreach ($results as $row) {
		    $row_array['id'] = $row['id']; 
		    $row_array['parent'] = $row['parent']; 
		    $row_array['judul'] = $row['judul']; 
		    $row_array['status'] = $row['status']; 
		    $row_array['tanggal'] = $this->date->IndonesianDatetime($row['tanggal']);
		    
    			$row_array['edit'] = true; 
    			$row_array['delete'] = true; 
		    // }
		    array_push($return_arr,$row_array);

		    $q1 = "SELECT * FROM pages where parent = ".$row['id']." ORDER BY urut ASC";
			$r1 = $this->db->get_results($q1);
			foreach ($r1 as $r) {
				$row_array['id'] = $r['id']; 
				$row_array['parent'] = $r['parent']; 
			    $row_array['judul'] = $r['judul']; 
			    $row_array['status'] = $r['status']; 
			    $row_array['tanggal'] = $this->date->IndonesianDatetime($r['tanggal']);
			    // if (strpos($r['module'], 'http') !== false){
	    		// 	$row_array['edit'] = false; 
	    		// 	$row_array['delete'] = true; 
			    // }else if ($r['module']) {
	    		// 	$row_array['edit'] = false; 
	    		// 	$row_array['delete'] = false; 
			    // }else{
	    			$row_array['edit'] = true; 
	    			$row_array['delete'] = true; 
			    // }
			    array_push($return_arr,$row_array);
				$q2 = "SELECT * FROM pages where parent = ".$r['id']." ORDER BY urut ASC";
				$r2 = $this->db->get_results($q2);
				foreach ($r2 as $rr) {
					$row_array['id'] = $rr['id']; 
					$row_array['parent'] = $rr['parent']; 
				    $row_array['judul'] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - ".$rr['judul']; 
				    $row_array['status'] = $rr['status']; 
				    $row_array['tanggal'] = $this->date->IndonesianDatetime($rr['tanggal']);
				    // if (strpos($rr['module'], 'http') !== false){
		    		// 	$row_array['edit'] = false; 
		    		// 	$row_array['delete'] = true; 
				    // }else if ($rr['module']) {
		    		// 	$row_array['edit'] = false; 
		    		// 	$row_array['delete'] = false; 
				    // }else{
		    			$row_array['edit'] = true; 
		    			$row_array['delete'] = true; 
				    // }
				    array_push($return_arr,$row_array);
				}
			}
		} 

		$this->smarty->assign('mode', $_GET['mode']);
		$this->smarty->assign('menu', $_GET['menu']); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('arr_data', $return_arr);  
		$this->smarty->assign('basedir', ROOTDIR);  


        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('index.tpl');
	}

	function add(){
		if (!empty($_POST)) {
			$tanggal = date("Y-m-d h:i:s");
	        if($_POST['parent'] == '') $error[] = '- Silahkan isi perent ';
	        if($_POST['judul'] == '') $error[] = '- Silahkan isi nama ';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        } 
	        else{	
				try 
				{
					$qcek = "SELECT id,judul
								FROM pages where judul='".$_POST['judul']."'";
			        $count	= $this->db->get_num_rows($qcek);
			        if ($count==0) {
						$data = array(
							'parent'    => $_POST['parent'],
							'judul'    	=> $_POST['judul'],
							'isi'		=> $_POST['isi'],
							'urut'		=> $_POST['urut'],
							'status'	=> $_POST['status'],
							'module'	=> $_POST['module'],
							'tanggal'	=> $tanggal,
						);
						$this->db->do_insert( 'pages', $data,true ); 
						$lastid = $this->db->lastid();
			        	$response = '{"response":"true","message":"Data Berhasil Disimpan, Last ID ='.$lastid.'","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
			        }
			        else{
			        	$response = '{"response":"false","message":"Nama kategori sudah ada"}';
			        }
				}
				catch(PDOException $e)
				{
					$response = '{"response":"false","message":"'.$e->getMessage().'"}';
				}
				die($response);
	        }
			die($response);
		}

		$q = "SELECT a.id, a.parent,a.urut, a.judul, Deriv1.Count
				FROM pages a
				LEFT OUTER JOIN (
				SELECT parent, COUNT( * ) AS COUNT
				FROM `pages`
				GROUP BY parent
				)Deriv1 ON a.id = Deriv1.parent ORDER BY a.urut,a.id ASC";

		$results = $this->db->get_results($q,PDO::FETCH_OBJ);
		foreach ($results as $r) {
			$arr[$r->parent][] = $r;
		}
		if (isset($arr)) {
			$parent = $this->get_list_produk($arr);
		}else{
			$parent = 0;
		}

		$status = '<option value="1">Publish</option>
	               <option value="0">Un Publish</option>';


		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('act', '?mode=admin&amp;menu='.$_GET['menu'].'&amp;f=save'); 
		$this->smarty->assign('parent', $parent); 
		$this->smarty->assign('status', $status);

        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('add.tpl');
	}


	function edit(){
		if (!empty($_POST)) {
			$tanggal = date("Y-m-d h:i:s");
	        if($_POST['judul'] == '') $error[] = '- Silahkan isi nama ';

	        if (isset($error)) {
	        	$response = '{"response":"false","message":"'.implode('<br />', $error).'"}';
	            die($response);
	        } 
	        else{	
	        	try {
					$update = array(
						'parent'  		=> $_POST['parent'], 
						'judul'  		=> $_POST['judul'], 
						'isi'			=> $_POST['isi'],
						'urut'			=> $_POST['urut'],
						'status'		=> $_POST['status'],
						'module'		=> $_POST['module'],
						'tanggal'		=> $tanggal
					);
					$where_clause = array(
						'id' => htmlspecialchars($_GET['id'])
					);
					$this->db->do_update( 'pages', $update, $where_clause, 1 );
					$response = '{"response":"true","message":"Berhasil Diupdate","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'"}';
	        	} catch (PDOException $e) {
	        		$response = '{"response":"false","message":"'.$e->getMessage().'"}';
	        	}

				die($response);
	        }
			
			die($response);
		}
		$q = "SELECT a.id, a.parent,a.urut, a.judul, Deriv1.Count
				FROM pages a
				LEFT OUTER JOIN (
				SELECT parent, COUNT( * ) AS COUNT
				FROM `pages`
				GROUP BY parent
				)Deriv1 ON a.id = Deriv1.parent ORDER BY a.urut,a.id ASC";

		$results = $this->db->get_results($q,PDO::FETCH_OBJ);
		foreach ($results as $r) {
			$arr[$r->parent][] = $r;
		}
		
		$query = "SELECT id,judul,isi,urut,status,module,parent
					FROM pages where id='".$_GET['id']."'";
        list($id,$judul,$isi,$urut,$status,$module,$id_parent) = $this->db->get_single_result( $query,PDO::FETCH_NUM );

		$parent = $this->get_list_produk($arr, 0, $id_parent);

        $this->smarty->assign('parent', $parent); 
        $s=$ss='';
		if($status == 1) $s = 'selected';
		if($status == 0) $ss = 'selected';

		$status = '<option value="1" '.$s.'>Publish</option>
	               <option value="0" '.$ss.'>Un Publish</option>';


        $this->smarty->assign('id', $id);
        $this->smarty->assign('judul', $judul);
        $this->smarty->assign('isi', $isi); 
        $this->smarty->assign('urut', $urut); 
        $this->smarty->assign('status', $status);
        $this->smarty->assign('module', $module); 

		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('act', '?mode=admin&amp;menu='.$_GET['menu'].'&amp;f=update'); 

        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('edit.tpl');
	}

	function img(){
		if (!empty($_FILES)) {
			$gambar = $this->wf->upload_files($_FILES, 'gambar', 'source');
			if ($gambar) {
				$response = '{"response":"true","message":"Berhasil Diupdate","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'/img"}';
				die($response);
			}
		}
		$dir = 'files/source';
		$data = false;
		$no = 1;
		$return_arr = array();
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($img = readdir($dh)) !== false) {
		            if ($img != '.' and $img != '..') {
						$row_array['nama'] 		= $img; 
						$row_array['file'] 		= ROOTDIR.$dir.'/'.$img; 
						$row_array['end'] 		= $no; 
						$row_array['no'] 		= $no++; 
						
						$ext = explode('.', $img);
						$count = count($ext)-1;
						$whatthefuck = $ext[$count];
						if ($whatthefuck == "png" or $whatthefuck == "jpg" or $whatthefuck == "jpeg" or $whatthefuck == "gif") {
							$whatthefuck = "image";
						}
						$row_array['is_img'] 	= $whatthefuck; 

						array_push($return_arr,$row_array);
					}
		        }
		        closedir($dh);
		    }
		}
		// die();

        $this->smarty->assign('arr_data', $return_arr); 
		$this->smarty->assign('navigasi', $this->navigasi()); 
		$this->smarty->assign('basedir', ROOTDIR); 
		$this->smarty->assign('menu', $_GET['menu']); 

        $this->smarty->setTemplateDir('templates/logged/'.THEME.'/module/'.$_GET['menu'].'/');
        $this->smarty->setCompileDir('templates_c');
        $this->smarty->setCacheDir('cache');
        $this->smarty->setConfigDir('config');
        return $this->smarty->fetch('img.tpl');
	}

	function delete(){
		unlink('files/source/'.$_POST['id']);
        $response = '{"response":"true","message":"Berhasil Dihapus","menu":"'.ROOTDIR.'giadmin/'.htmlspecialchars($_GET['menu']).'/img"}';
		die($response);
	}

	function publish(){
		try {
			$data = array(
				'status'    	=> $_POST['status']
			);
			$where = array(
				'id' => $_POST['id']
			);
			$this->db->do_update('pages', $data, $where, 1 ); 
        	$response = '{"response":"true","message":"Data Berhasil Disimpan"}';
			
		} catch(PDOException $e) {
			$response = '{"response":"false","message":"'.$e->getMessage().'"}';
		}
		die();
	}

	

	function get_data($data, $parent = 0 ){
		static $i = 1;
		$tab = str_repeat(" ",$i);
		static $a = 0;
		$pusher = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$showPusher = str_repeat($pusher,$a);
		if(isset($data[$parent])){
			$html = "$tab";
			$i++;
			foreach($data[$parent] as $v){
				$a++;
				$child = $this->get_data($data, $v->id);
		
				if($v->parent == 0){
					$listChild = "";
				}
		$html .= "$tab";
		$html .= '<tr>'; 
		if ($v->urut <> '') {
			$urut = $v->urut.'. ';
		}
		else{
			$urut = '';
		}

		if($v->status == 1){
			$status = '<span class="label label-success">Publish</span>';
		}
		else{
			$status = '<span class="label label-danger">Un Publish</span>';
		}

		if($v->parent == 0){
			$html .= '<td class="text-center">'.$v->urut.'.</td>';
			$html .= '<td>'.$showPusher.$v->judul.'</td>';
		}
		else{
			$html .= '<td></td>';
			$html .= '<td>'.$showPusher.' - '.$v->judul.'</td>';
		}

		$html .= '<td class="text-center">'.$this->date->IndonesianDatetime($v->tanggal).'</td>';
		$html .= '<td class="text-center" class="text-center">'.$status.'</td>';
		$html .= '
			<td>
				<a class="btn btn-primary btn-xs" href="?mode=admin&amp;menu='.$_GET['menu'].'&amp;f=edit&amp;id='.$v->id.'&parent='.$v->parent.'">
					<i class="fa fa-edit"></i>
				</a>
			</td>
			<td>';
		if($v->module == ''){
		$html .='<a class="btn btn-danger btn-xs delete" data-href="?mode=admin&amp;menu='.$_GET['menu'].'&amp;f=delete&amp;id='.$v->id.'"  data-toggle="modal" data-target="#confirm-delete" title="Hapus">
					<i class="fa fa-times"></i>
				</a>';
		}else{
			$html .= '<a title="'.$v->module.'" class="btn btn-warning btn-xs"><i class="fa fa-lock"></i></a>';
		}

		$html .='</td>';

		$html .= '</tr>';
		$a--;
		if($child){
			$i--;
			$html .= $child;
			$html .= "$tab";
		}
		}
		$html .= "$tab";
		return $html;
		}
		else{	
			return false;
		}
		
	} 

	function get_list_produk($data, $parent = 0, $id_parent = 0 ){
		$selected = "";
		if(!isset($_GET['parent'])) $_GET['parent'] = 'null';

		static $i = 1;
		$tab = str_repeat(" ",$i);
		
		static $a = 0;
		
		$pusher = "___";
		
		$showPusher = str_repeat($pusher,$a);
		
		if(isset($data[$parent])){
			$html = "$tab";
			$i++;
			foreach($data[$parent] as $v){
				$a++;
				$child = $this->get_list_produk($data, $v->id, $id_parent);
		
				if($v->parent == 0){
					$listChild = "";
				}
				
				if($v->id == $id_parent){
					$selected = 'selected';
				}


		$html .= "$tab";

		if ($v->urut <> '') {
			$urut = $v->urut.'. ';
		}
		else{
			$urut = '';
		}

		if($v->parent == 0){
			$html .= '<option '.$selected.' value="'.$v->id.'">'.$showPusher.$v->judul.'</option>';
		}
		else{
			$html .= '<option '.$selected.' value="'.$v->id.'">'.$showPusher.$v->judul.'</option>';
		}

		$selected = '';

		$a--;
		
		if($child){
			$i--;
			$html .= $child;
			$html .= "$tab";
		}
		//$html .= '</li>';
		}
		$html .= "$tab";
		return $html;

		}
		else{	
			return false;
		}
	}
}
?>