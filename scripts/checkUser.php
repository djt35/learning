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
$user = new users;



function ne($v) {
    return $v != '';
}





if (count($_GET) > 0){

	

	
	$data = $general->sanitiseGET($_GET);
	
	foreach ($data as $key=>$value){
		
		$GLOBALS[$key] = $value;
		
	}
	
	//print_r($GLOBALS);
	
	
	
	
	if (!isset($userid)){
		
		echo 'User id not set';
		exit();	
		
	}
	
	
	//check session user id = that passed in GET
	
	
	if ($_SESSION['user_id'] <> $userid){
		
		//perform logout
		
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
		    );
		}
		
		// Finally, destroy the session.
		session_destroy();
		
		echo 0;
		
		
	}else{
		
		echo 1;
		
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

