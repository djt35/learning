<?php

//user access variables

//$openaccess = 1 allows the page to be viewed without login and skips the rest of the script
//$requiredUserLevel corresponds to database users access level; if not set the page simply requires login
//$paid allows setting of pages which require subscription and login

//define token from url

if (count($_GET) > 0){

    if (isset($_GET['token'])){

        $token = $_GET['token'];

    }

}

//script for detection of page related variables in header
if ($openaccess == 1){

        goto b;

}else{

    //if a token is present allowing access to the page then allow
    //else reject
    if ($tokenaccess == 1){
        if (isset($token)){

            //echo 'token set is' . $token;

            //why does this require login

            $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
           // print_r($dbc);
            $sql = "SELECT `user_id` FROM `users` WHERE `key` = '$token'";
            //echo $sql;
            $result = mysqli_query ($dbc, $sql);
            //print_r($result);
            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)) {
                    $userid = $row['user_id'];
                
                    
                }

                //echo $userid;
                goto c;
    
            }else{
                    echo 'token did not match any userid';
                    unset($token);
                    goto a;
                    
    
            }

             

            

            mysqli_free_result($result);
            mysqli_close($dbc);

            //allow access if token valid from database

            //if so goto c:

            
            //get user id from token
            //reset token once used

        }
    }
}

    a:{
//echo 'made it to a';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['access_level'])) {

    redirect_login($location);
}

$userid = $_SESSION['user_id'];

if (isset($requiredUserLevel)){

    //if the requiredUserLevel variable is present on the referring page
    
    $currentUserLevel = $_SESSION['access_level'];
    //echo $currentUserLevel;

    //check the access level in the session matches the userid in the database

    //require(DB);
    $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $sql = "SELECT `user_id`, `access_level` 
            FROM `users` WHERE `user_id` = $userid";
            $result = mysqli_query ($dbc, $sql);
            
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)) {
                    $databaseUserAccessLevel = $row['access_level'];
                }

                if ($databaseUserAccessLevel != $currentUserLevel){

                    redirect_login($location);

                }
             }

            mysqli_free_result($result);
            mysqli_close($dbc);

    //reject any user that does not have access higher or equal to that specified

    if ($currentUserLevel > $requiredUserLevel){

       
        redirect_login($location);

    }

}


//identify with the variables in the top of the original file
//$userLevel
//$paid, not yet implemented

}



b:{

    unset($userid);

//do things where open access allowed
}
c:{
//echo 'made it to c';
//do things for token access

}