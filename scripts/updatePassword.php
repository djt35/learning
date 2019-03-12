<?php

//registerUser.php

//error_reporting(E_ALL);

$openaccess=1;

require ('../includes/config.inc.php'); 
require (BASE_URI.'/scripts/headerScript.php');

//ECHO 'hello';
		
//$formv1 = new formGenerator;
$general = new general;
//$video = new video;
//$tagCategories = new tagCategories;
$user = new users;

/*
function hash_password($password, $salt) {
    $salted_password = substr($password, 0, 4) . $salt . substr($password, 4);
    return hash('sha512', $salted_password);
}
*/

//print_r($_GET);

if (count($_GET) > 0){

	

    
	$data = $general->sanitiseGET($_GET);
    
    //print_r($data);

    foreach ($data as $key=>$value){
		
		$GLOBALS[$key] = $value;
		
    }

    //print_r($GLOBALS);

    //check the username is unique.....
    
    //echo $token . 'is token';

   
    //if ($firstname && $surname && $email && $password && $centreName && $centreCity && $centreCountry && $specialistInterest && $trainee && is_numeric($yearsIndependent) && is_numeric($yearsEndoscopy) && $endoscopyTrainingProgramme && $emailPreferences){

    if ($password && ($password == $confirm) && $userid && $token){

        //echo 'Correct submission';

        $password = hash_password($data['password'], 'westmead');

        $q = "UPDATE `users` SET `password` = '$password', `key` = '{$user->generateRandomString(15)}' WHERE `user_id` = '$userid' AND `key` = '$token'"; 
        
        //echo $q;

        $result = $general->returnUpdateQuery($q);

        //echo 'result was ' . $result;

        if ($result == 1){

            echo '1';

        }else{

            echo 'Your data was not registered.  Please try again';
        }

    }else{

        echo 'Check your data';

    }

    

	
	
	
	
	
	
	
	
	
	
	
	
		
	
	
	//remove the preset global variables
	
	foreach ($data as $key=>$value){
		
		unset($GLOBALS[$key]);
	
		
	}

}else{
	
	echo 'No variables passed';
	
}

$general->endGeneral();
$user->endusers();


?>