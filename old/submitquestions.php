<?php 
    error_reporting(0);

    //define the database we are using, here PROSPER.
    define ('MYSQL', '../mysqli_connect_learning.php');
     require (MYSQL); 
    
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (count($_POST > 0)) {
    
    $userid = $_POST['userid'];
    
        unset($_POST['userid']);
        unset($_POST['centre']);
        
    foreach ($_POST as $key => $value) {
        //$value = mysql_real_escape_string($value);
        $value = "'$value'";
        $updates[] = "$key = $value";      
    }
        
        //var_dump($updates);
        $implodeArray = implode(', ', $updates);
        $q = "UPDATE `csp` SET $implodeArray WHERE `userid` = $userid";
        $r = @mysqli_query ($dbc, $q);
                if (mysqli_affected_rows ($dbc) == 1) {
               echo '1';
            } else {
                echo '2';
                        echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
                        
            }
        
    }
    
}
   
   
mysqli_close($dbc);
?>