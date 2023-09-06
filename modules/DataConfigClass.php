<?php
class DataConfigClass{
  function __construct(){
    $this->db          = new DatabaseClass;
  }

	 function getConf($conf){				
		$q = "select * from setting where id=2"; 
		$results = $this->db->get_results($q);
		foreach( $results as $row ){
			return $row[$conf];
		}
	}

	
}
?>