<?php
	
	$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}

if ($local){

    $root = $_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/dashboard/learning/';
    require($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');
}else{
    $root = $_SERVER['DOCUMENT_ROOT'].'/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/learning/';

    require($_SERVER['DOCUMENT_ROOT'].'/learning/includes/config.inc.php');

}

$location = $roothttp . 'elearn.php';


session_start( );


if (!isset($_SESSION['user_id'])) {
			 		
				    // Need the functions:
				     require ($root . 'includes/login_functions.php');
				     redirect_login($location);
			 }



$general = new general;



function ne($v) {
    return $v != '';
}



//$connection = new DataBaseMysql();

//required GET variables  table, query, fieldsToGetObject, outputFormat

//e.g. with table

/*
	
	http://localhost:90/dashboard/learning/scripts/masterAjaxDataReturnQuery.php?table=tags&outputFormat=2&Identifier%5C=id&1=tagName
	
	as shown the table header can be specified as the first part of the data string
	
*/


//check count of get variables

if (count($_GET) > 0){

	

	
	$data = $general->sanitiseGET($_GET);
	
	foreach ($data as $key=>$value){
		
		$GLOBALS[$key] = $value;
		
	}
	
	//print_r($GLOBALS);
	
	
	if (!isset($table)){
		
		echo 'Table key not set';
		exit();	
		
	}
	
	/*if (!isset($query)){
		
		echo 'Query key not set';
		exit();	
		
	}*/
	
	if (!isset($outputFormat)){
		
		echo 'Output format key not set';
		exit();	
		
	}
	
		
		
	unset($data['table']);
	unset($data['query']);
	unset($data['outputFormat']);

		//print_r($data);

	
	foreach($data as $key=>$value)
		{
		    if(is_null($value) || $value == '' || $value == 'undefined')
		        unset($data[$key]);
		}
	
	//print_r($data);
	
	
	$dataString2 = implode('` , `', $data);
	

	//echo $dataString2;
	
	//SELECT the required fields from the database
		
	if ($query){
	
		$q = "SELECT `$dataString2` FROM `$table` WHERE $query";
		
		//echo $q;
	
	}else {
		
		$q = "SELECT `$dataString2` FROM `$table`";
		
		//echo $q;
		
		
	}
	
	
	
	//echo $q;
	
	$result = $general->connection->RunQuery($q);
		
		//if ($result->num_rows > 1){
			
				//$returnArray = array();
				
				//print_r($result->fetch_array(MYSQLI_ASSOC));
				
			if ($outputFormat == 1){
			
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
				    $rows[] = array_map('utf8_encode', $row);
				}
			
								
			echo json_encode($rows);	
			
			}else if ($outputFormat == 2){
				
				echo '<table>';
				
				echo '<tr>';
				
				foreach ($data as $key=>$value){
					
					
					echo '<th>' . $key . '</th>';
					


													
				}
				
				echo '</tr>';
				
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					
					echo '<tr>';
					
					foreach($data as $key=>$value){
						
						
					echo '<td>';
					echo $row[$value];
					echo '</td>';
						
					}
					
					echo '</tr>';

													
				}
				
				
				
				echo '</table>';
				
				
				
				
			}
				
			//}else{
				
				//return NULL;
				
			//}	
		
		
	
	
	
	
	//remove the preset global variables
	
	foreach ($data as $key=>$value){
		
		unset($GLOBALS[$key]);
	
		
	}

}else{
	
	echo 'No variables passed';
	
}

$general->endGeneral();

