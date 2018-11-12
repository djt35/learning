<?php

/*
 * Author: Rafael Rocha - www.rafaelrocha.net - info@rafaelrocha.net
 * 
 * Create Date: 8-02-2018
 * 
 * Version of MYSQL_to_PHP: 1.1
 * 
 * License: LGPL 
 * 
 */
		
Class DataBaseMysql {

	public $conn;

	public function __construct(){
		$this->conn = new mysqli("localhost", "root", "nevira1pine", "learningTool");
		if($this->conn->connect_error){
			echo "Error connect to mysql";die;
		}
	}
	
	public function RunQuery($q){
			
			$result = $this->conn->query($q);
			return $result;
			
	}
	
	public function RunQueryDebug($query_tag){
		$result = $this->conn->query($query_tag) or die("Error SQL query-> $query_tag  ". mysql_error());
		return $result;
	}
	

	public function TotalOfRows($table_name){
		$result = $this->RunQuery("Select * from $table_name");
		return $result->num_rows;
	}

	public function CloseMysql(){
		$this->conn->close();
	}

}

?>