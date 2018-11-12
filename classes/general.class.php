<?php

require_once 'DataBaseMysql.class.php';

Class general {

	
	public $connection;

	public function __construct (){
		$this->connection = new DataBaseMysql();
	}
	
	//!Sanitise form input and other important functions
	
	public function sanitiseInput ($data) {
		
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		
	}
	
	public function sanitiseGET ($data) {
		
		$dataSanitised = array();
		
		foreach ($data as $key=>$value){
		
			$sanitisedValue = trim($value);
			$sanitisedValue = stripslashes($sanitisedValue);
			$sanitisedValue = htmlspecialchars($sanitisedValue);
			
			$dataSanitised[$key] = $sanitisedValue;
			
		}
		
		
		return $dataSanitised;
	
		
	}
	
	public function returnYesNoDBQuery ($q){


		//print_r($q);


		$result = $this->connection->RunQuery($q);

		//print_r($result);

		//IF THERE is a database error return 2

		//IF THERE are no rows affected but no errors return 0

		//IF THERE is one row affected return 1

		if ($result){


			//print_r($this->connection->conn->affected_rows);

			//print_r($this->connection->conn, there is plenty else in this object including error_list as an array and connect_error);

			if ($this->connection->conn->affected_rows == 1){

				return 1;

			} else {

				return 0;

			}

		} else {

			return 2;

		}

	}
	
	public function returnWithInsertID($q) {
		
		
		//$result = $this->connection->RunQuery($q);
		
		if ($this->returnYesNoDBQuery($q) == 1){
			
			return $this->connection->conn->insert_id;
			
		}else{
			
			
			return false;
			
		}
		
		//$result = $this->connection->RunQuery($q);
		
		
	}

	
	
	public function endGeneral (){
		
		$this->connection->CloseMysql();
		
		
	}
	
	
	public function makeTable ($q){
		
		//echo $q;
		
		$result = $this->connection->RunQuery($q);
		
		//print_r($result);
		
		if ($result->num_rows > 0){
					
		
				$data = array();
			
				while($data[] = $result->fetch_array(MYSQLI_ASSOC));
				
		
		
		echo '<table id="dataTable">';
				
				echo '<tr>';
				
				foreach ($data as $key=>$value){
					
					foreach ($value as $k=>$v){
						echo '<th>' . $k . '</th>';
					}
					
					break;								
				}
				
				echo '</tr>';
				
				foreach ($data as $k=>$v){

					
					echo '<tr class="datarow">';
					
					foreach($v as $key=>$value){
						
						
					echo '<td>';
					echo $value;
					echo '</td>';
						
					}
					
					echo '</tr>';

													
				}
				
				
				
		echo '</table>';
		
		}
		
	}
	
	
	public function generateFormField ($table){
		
		$q = "SELECT `COLUMN_NAME` AS `name`, `ORDINAL_POSITION` AS `position`, `CHARACTER_MAXIMUM_LENGTH` AS `length`
	    FROM INFORMATION_SCHEMA.COLUMNS
	            WHERE TABLE_SCHEMA='LearningTool'
	            AND TABLE_NAME = '$table'";
            
            //echo $q;
            
			$result = $this->connection->RunQuery($q);
			
			if ($result->num_rows > 0){
			
				$columns = array();
			
				while($columns[] = $result->fetch_array(MYSQLI_ASSOC));


	
		        
		        foreach ($columns as $key=>$value){
			        
			        echo 'echo $formv1->generateText(\'';
			        
			        foreach ($value as $k=>$v){
				        
				        if ($k == 'name'){
					        
					        echo $v . '\', \'' . $v . '\', ';
					        
				        }
				        
				        
			        }
			        
			        echo '\'\', \'tooltip here\');' . PHP_EOL;
			        
			        //echo '\n';
			        
			        
		        }
				
				
				
			}
		
		

		
		
		
	}
	
	public function generateLogicValidate ($table){
		
		$q = "SELECT `COLUMN_NAME` AS `name`, `ORDINAL_POSITION` AS `position`, `CHARACTER_MAXIMUM_LENGTH` AS `length`
	    FROM INFORMATION_SCHEMA.COLUMNS
	            WHERE TABLE_SCHEMA='LearningTool'
	            AND TABLE_NAME = '$table'";
            
            //echo $q;
            
			$result = $this->connection->RunQuery($q);
			
			if ($result->num_rows > 0){
			
				$columns = array();
			
				while($columns[] = $result->fetch_array(MYSQLI_ASSOC));

				/*
				rules: {
	
	            timezone: {
	                required: true,
	            },
	            password: {
		            required: true,
		        },
		        password_again: {
				      equalTo: "#password",
				},
		            
	            
		
		        },
		        messages: {
		
		            
		            timezone: {
		                required: \'a timezone is required for the user\',
		
		
		            },
		
		        },
		        */
		        echo 'rules: {'. PHP_EOL;
		        
		        foreach ($columns as $key=>$value){
			        
			        //echo 'echo $formv1->generateText(\'text here\', \'';
			        
			        foreach ($value as $k=>$v){
				        
				        if ($k == 'name'){
					        
					        echo $v . ': { required: true },   '. PHP_EOL;
					        //echo '<br><br>';
					        
				        }
				        
				        
			        }
			    
		        }
				
				echo '},';
				
				echo 'messages: {'. PHP_EOL;
		        
		        foreach ($columns as $key=>$value){
			        
			        //echo 'echo $formv1->generateText(\'text here\', \'';
			        
			        foreach ($value as $k=>$v){
				        
				        if ($k == 'name'){
					        
					        echo $v . ': { required: \'message\' },   '. PHP_EOL;
					        //echo '<br><br>';
					        
				        }
				        
				        
			        }
			    
		        }
				
				echo '},';
				
			}
		
		

		
		
		
	}
	
	
}

?>