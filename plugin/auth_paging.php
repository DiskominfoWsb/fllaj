<?php
$v=array('to'	=> $_POST['to'],
		 'cpage'=> $_POST['current-page'],
		 'url'	=> $_POST['url']
		);
				 
if($v['to'] == '' || !is_numeric($v['to'])){
	header('location:'.html_entity_decode($v['url']).'&pg='.$v['cpage']);
}
else{
	header('location:'.html_entity_decode($v['url']).'&pg='.$v['to']);
}
die();
?>