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
    //require($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');
}else{
    $root = $_SERVER['DOCUMENT_ROOT'].'/learning/';
    $roothttp = 'http://' . $_SERVER['HTTP_HOST'].'/learning/';

   // require($_SERVER['DOCUMENT_ROOT'].'/learning/includes/config.inc.php');

}
    
    
    function redirect_user ($page='elearn.php') {
        header ("Location: $page");
        exit ();
    }
    
     
	
	 function redirect_login ($location) {
        header ("Location: $location");
        exit ();
    }
	

	function hash_password($password, $salt) {
    $salted_password = substr($password, 0, 4) . $salt . substr($password, 4);
    return hash('sha512', $salted_password);
}
        
    function check_login($dbc, $email, $pass) {
        
    
            $errors = array();
        
            //email address is present;
            if (empty($_POST['email'])) {
                $errors[]='Please enter a valid email address';
            } else {
                $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
            }
        
            //password;
            if (empty($_POST['pass'])) {
                $errors[]='Please enter a password';
            } else {
				$salt = 'westmead';
                $password = mysqli_real_escape_string($dbc, trim($_POST['pass']));
				$p = hash_password($password, $salt);
            }
        
        if (empty ($errors)) {
            
            $q = "SELECT user_id, firstname, surname, centre FROM users WHERE email='$e' AND password='$p'";
            
            $r = @mysqli_query ($dbc, $q);
            
                if ((mysqli_num_rows($r))==1) {
                    //match detected;
                    //echo '<h1> User detected, you could login if I knew how </h1>';
                    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                    return array(true, $row);
                    
                } else {
                    //no user found;    
                    $errors[ ] = 'The email address and/or password supplied are not registered in the system';
                    //echo "$e is assigned to the e variable";
                    //echo "$p is assigned to the p variable";

                    // echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
                } 
            }
        
                return array(false, $errors);
       
        }
    
            ?>


