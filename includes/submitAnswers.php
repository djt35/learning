<?php

//print_r($_POST);
session_start( );
    
    // If no session value is present, redirect the user:
    if (!isset($_SESSION['user_id'])) {

    // Need the functions:
     require ('login_functions.php');
     redirect_user( );

  }

//error_reporting(-1);

$myinputs = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
//var_dump($myinputs);
//find a way to not do this to date

//filter out if the  user that is sent over in the data 1) is the current user and 2)has data in the database.  if not new row, if does update in the data sent over or not




require '../classes/QuestionsCSP.class.php';



$questions = new Questions;

//$questions->defineUser();

$userid = $myinputs['userid'];

//echo "Value of load from key for userid $userid is  ";
//if ($questions->Load_from_key($userid) === TRUE){echo 'true';} if ($questions->Load_from_key($userid) === FALSE){echo 'false';}

if ($questions->Load_from_key($userid) === FALSE){
	//user has not answered any questions yet
	// therefore create a new record
	$questions->New_Questions($userid, $myinputs['question1apre'], $myinputs['question1bpre'], $myinputs['question2pre'], $myinputs['question3apre'], $myinputs['question3bpre'], $myinputs['question1apost'], $myinputs['question1bpost'], $myinputs['question2post'], $myinputs['question3apost'], $myinputs['question3bpost'], $myinputs['overallPre'], $myinputs['overallPost']);

		if ($questions->Save_New_Row()){
			
			echo 'New Data Saved';
			
		}
	
} else if ($questions->Load_from_key($userid) === TRUE){
	//user has previously answered any questions, so update their data and submit
	$questions->New_Questions($userid, $myinputs['question1apre'], $myinputs['question1bpre'], $myinputs['question2pre'], $myinputs['question3apre'], $myinputs['question3bpre'], $myinputs['question1apost'], $myinputs['question1bpost'], $myinputs['question2post'], $myinputs['question3apost'], $myinputs['question3bpost'], $myinputs['overallPre'], $myinputs['overallPost']);

		//$questions->Save_Active_Row();
	
		if ($questions->Save_Active_Row()){
			
			echo 'Data updated';
		}else {
			
			echo 'Data not updated';
			
		}
}
/*


if ($userid == $questions->defineUser()){
		$questions->New_Questions($myinputs['question1apre'], $myinputs['question1bpre'], $myinputs['question2pre'], $myinputs['question3apre'], $myinputs['question3bpre'], $myinputs['question1apost'], $myinputs['question1bpost'], $myinputs['question2post'], $myinputs['question3apost'], $myinputs['question3bpost'], $myinputs['overallPre'], $myinputs['overallPost'], $myinputs['datecreated']);

		echo $questions->Save_Active_Row();
		//echo $questions->getConnectionError();
}else if ($userid == ""){
	
		$questions->New_Questions($myinputs['question1apre'], $myinputs['question1bpre'], $myinputs['question2pre'], $myinputs['question3apre'], $myinputs['question3bpre'], $myinputs['question1apost'], $myinputs['question1bpost'], $myinputs['question2post'], $myinputs['question3apost'], $myinputs['question3bpost'], $myinputs['overallPre'], $myinputs['overallPost'], $myinputs['datecreated']);

		echo $questions->Save_New_Row();
		//needs to be save as a new row
	
	
}
*/
?>