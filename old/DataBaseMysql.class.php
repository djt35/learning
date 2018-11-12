<?php
		
Class DataBaseMysql {

	public $conn;

	public function DataBaseMysql(){
		$this->conn = new mysqli("localhost", "root", "nevira1pine", "VosCAR");
		if($this->conn->connect_error){
			echo "Error connect to mysql";die;
		}
	}
	
	public function RunQuery($query_tag){
		$result = $this->conn->query($query_tag) or die("Erro SQL query-> $query_tag  ". mysql_error());
		return $result;
	}


	public function CloseMysql(){
		$this->conn->close();
	}

}

?>