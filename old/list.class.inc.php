<?php

require_once 'DataBaseMysql.class.php';

Class List {

	private $Listid; //int(11)
	private $listDate; //date
	private $Duration; //int(20)
	private $StartTime; //timestamp(6)
	private $centreID; //int(10)
	private $endoscopistID; //int(10)
	private $traineeID; //int(10)
	private $connection;

	public function List(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don¥t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_List($listDate,$Duration,$StartTime,$centreID,$endoscopistID,$traineeID){
		$this->listDate = $listDate;
		$this->Duration = $Duration;
		$this->StartTime = $StartTime;
		$this->centreID = $centreID;
		$this->endoscopistID = $endoscopistID;
		$this->traineeID = $traineeID;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from List where Listid = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->Listid = $row["Listid"];
			$this->listDate = $row["listDate"];
			$this->Duration = $row["Duration"];
			$this->StartTime = $row["StartTime"];
			$this->centreID = $row["centreID"];
			$this->endoscopistID = $row["endoscopistID"];
			$this->traineeID = $row["traineeID"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM List WHERE Listid = $key_row");
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE List set listDate = \"$this->listDate\", Duration = \"$this->Duration\", StartTime = \"$this->StartTime\", centreID = \"$this->centreID\", endoscopistID = \"$this->endoscopistID\", traineeID = \"$this->traineeID\" where Listid = \"$this->Listid\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into List (listDate, Duration, StartTime, centreID, endoscopistID, traineeID) values (\"$this->listDate\", \"$this->Duration\", \"$this->StartTime\", \"$this->centreID\", \"$this->endoscopistID\", \"$this->traineeID\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT Listid from List order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["Listid"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return Listid - int(11)
	 */
	public function getListid(){
		return $this->Listid;
	}

	/**
	 * @return listDate - date
	 */
	public function getlistDate(){
		return $this->listDate;
	}

	/**
	 * @return Duration - int(20)
	 */
	public function getDuration(){
		return $this->Duration;
	}

	/**
	 * @return StartTime - timestamp(6)
	 */
	public function getStartTime(){
		return $this->StartTime;
	}

	/**
	 * @return centreID - int(10)
	 */
	public function getcentreID(){
		return $this->centreID;
	}

	/**
	 * @return endoscopistID - int(10)
	 */
	public function getendoscopistID(){
		return $this->endoscopistID;
	}

	/**
	 * @return traineeID - int(10)
	 */
	public function gettraineeID(){
		return $this->traineeID;
	}

	/**
	 * @param Type: int(11)
	 */
	public function setListid($Listid){
		$this->Listid = $Listid;
	}

	/**
	 * @param Type: date
	 */
	public function setlistDate($listDate){
		$this->listDate = $listDate;
	}

	/**
	 * @param Type: int(20)
	 */
	public function setDuration($Duration){
		$this->Duration = $Duration;
	}

	/**
	 * @param Type: timestamp(6)
	 */
	public function setStartTime($StartTime){
		$this->StartTime = $StartTime;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setcentreID($centreID){
		$this->centreID = $centreID;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setendoscopistID($endoscopistID){
		$this->endoscopistID = $endoscopistID;
	}

	/**
	 * @param Type: int(10)
	 */
	public function settraineeID($traineeID){
		$this->traineeID = $traineeID;
	}

    /**
     * Close mysql connection
     */
	public function endList(){
		$this->connection->CloseMysql();
	}

}