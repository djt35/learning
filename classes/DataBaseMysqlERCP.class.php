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
		
Class DataBaseMysqlERCP {

	public $conn;

	public function __construct(){
		$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
		    $local = TRUE;
		} else {
		    $local = FALSE;
		}
		
		if ($local){
				$this->conn = new mysqli("localhost", "root", "nevira1pine", "ESD");
				if($this->conn->connect_error){
					echo "Error connect to mysql";die;
				}
		}else{
			
			$this->conn = new mysqli("localhost", "djt", "nevira1pine", "ESD");
				if($this->conn->connect_error){
					echo "Error connect to mysql";die;
				}
			
			
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