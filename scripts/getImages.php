<?php
	
	require ('../includes/config.inc.php');

$location = BASE_URL . '/elearn.php';


session_start( );


if (!isset($_SESSION['user_id'])) {
			 		
				    // Need the functions:
				     require (BASE_URI . '/includes/login_functions.php');
				     redirect_login($location);
			 }



$general = new general;



function ne($v) {
    return $v != '';
}





if (count($_GET) > 0){

	

	
	$data = $general->sanitiseGET($_GET);
	
	foreach ($data as $key=>$value){
		
		$GLOBALS[$key] = $value;
		
	}
	
	//print_r($GLOBALS);
	
	
	
	
	if (!isset($tagid)){
		
		echo 'Tag id not set';
		exit();	
		
	}
	
	
	$general->getTaggedImageSets($tagid, BASE_URL);	
		
	
	
	//remove the preset global variables
	
	foreach ($data as $key=>$value){
		
		unset($GLOBALS[$key]);
	
		
	}

}else{
	
	echo 'No variables passed';
	
}

$general->endGeneral();

