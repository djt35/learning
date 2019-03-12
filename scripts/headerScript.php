<?php
	
   //error_reporting(0);

    require (BASE_URI . '/includes/login_functions.php');
    
    //place to redirect the user if not allowed access
    $location = BASE_URL . '/index.php';

    if (!($dbc)){
    require(DB);
    }
   
    
    require(BASE_URI . '/scripts/interpretUserAccess.php');
?>