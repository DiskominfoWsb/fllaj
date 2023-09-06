<?php

class PostgresClass{	
	public function __construct()
	{
        $this->db_host = DB_HOST;
        $this->db_name = DB_NAME;
        $this->db_user = DB_USER;
        $this->db_pass = DB_PASS;
        $this->db_port = DB_PORT;

        $this->link  = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS);
        
        // $dsn = "pgsql:host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS;
        // try{
        //     // create a PostgreSQL database connection
        //     $this->link = new PDO("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);

        //     // display a message if connected to the PostgreSQL successfully
        //     if($this->link){
        //         echo "Connected to the database successfully!";
        //     }
        // }catch (PDOException $e){
        //     // report error message
        //     echo $e->getMessage();
        // }

    }

    public function __destruct()
    {
         $this->link = null;
    }


	public function get_results($query)
	{
        $data = [];
		$result = pg_query($this->link, $query);
        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }
		return $data;
	}

    public function get_results_paging($query,$per_page=10,$page=1,$fetch_stmt=PDO::FETCH_ASSOC)
    {
        $result = pg_query($this->link, $query);

        $jml_per_halaman = $per_page;
        $jml_data = $result->rowCount(); 
        $jml_page = ceil($jml_data / $jml_per_halaman);

        if(isset($page)) {
            $i = ($page - 1) * $jml_per_halaman  + 1;
            $q = $query." LIMIT ".(($page - 1) * $jml_per_halaman).", $jml_per_halaman";
            
        } else {
            $q = $query." LIMIT 0, $jml_per_halaman";
        }

        $result = pg_query($this->link, $q);
        $row = $result->fetchAll($fetch_stmt);
        return array('row' => $row,'count' => $jml_data,'jml_page'=>$jml_page);    
    }


	public function get_single_result($query)
	{
		$result = pg_query($this->link, $query);
		$row = pg_fetch_assoc($result);
		return $row;	
	}


	public function get_num_rows($query)
	{
		$result = pg_query($this->link, $query);
		return pg_num_rows($result);	
	}


    public function lastid()
    {
        return $this->link->lastInsertId();
    }

    public function do_insert( $table, $variables = array() )
    {
        if( empty( $variables ) )
        {
            return false;
            exit;
        }
        
        $sql = "INSERT INTO ". $table;
        $fields = array();
        $values = array();
        foreach( $variables as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        
        $sql .= $fields .' VALUES '. $values;
        //die($sql);
        $query = pg_query($this->link, $sql);
        
        try {
        	if($query) return true;
        } catch (PDOException $e) {
        	return false;
        }
    }


    public function do_insert_ignore( $table, $variables = array() )
    {
        if( empty( $variables ) )
        {
            return false;
            exit;
        }
        
        $sql = "INSERT IGNORE ". $table;
        $fields = array();
        $values = array();
        foreach( $variables as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        
        $sql .= $fields .' VALUES '. $values;
        //die($sql); 
        $query = pg_query($this->link, $sql);
        
        try {
            if($query) return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function do_replace( $table, $variables = array() )
    {
        if( empty( $variables ) )
        {
            return false;
            exit;
        }
        
        $sql = "REPLACE INTO ". $table;
        $fields = array();
        $values = array();
        foreach( $variables as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        
        $sql .= $fields .' VALUES '. $values;
        //die($sql);
        $query = pg_query($this->link, $sql);
        
        try {
            if($query) return true;
        } catch (PDOException $e) {
            return false;
        }
    }



	public function do_update( $table, $variables = array(), $where = array(), $limit = '' )
    {
        //Make sure the required data is passed before continuing
        //This does not include the $where variable as (though infrequently)
        //queries are designated to update entire tables
        if( empty( $variables ) )
        {
            return false;
            exit;
        }
        $sql = "UPDATE ". $table ." SET ";
        foreach( $variables as $field => $value )
        {
            
            $updates[] = "$field = '".$value."'";
        }
        $sql .= implode(', ', $updates);
        
        //Add the $where clauses as needed
        if( !empty( $where ) )
        {
            foreach( $where as $field => $value )
            {
                $value = $value;

                $clause[] = "$field = '$value'";
            }
            $sql .= ' WHERE '. implode(' AND ', $clause);   
        }
        
        // if( !empty( $limit ) )
        // {
        //     $sql .= ' LIMIT '. $limit;
        // }
        // die($sql);
        $query = pg_query($this->link, $sql);

        try {
        	if($query) return true;
        } catch (PDOException $e) {
        	return false;
        }
    }


    public function do_delete( $table, $where = array(), $limit = '' )
    {
        //Delete clauses require a where param, otherwise use "truncate"
        if( empty( $where ) )
        {
            return false;
            exit;
        }
        
        $sql = "DELETE FROM ". $table;
        foreach( $where as $field => $value )
        {
            $value = $value;
            $clause[] = "$field = '$value'";
        }
        $sql .= " WHERE ". implode(' AND ', $clause);
        
        // if( !empty( $limit ) )
        // {
        //     $sql .= " LIMIT ". $limit;
        // }
            
        $query = pg_query($this->link, $sql);

        try {
        	if($query) return true;
        } catch (PDOException $e) {
        	return false;
        }
    }


}

?>