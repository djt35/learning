<?php 
    error_reporting(0);

    //define the database we are using, here PROSPER.
    define ('MYSQL', '../mysqli_connect_learning.php');
    require (MYSQL); 

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (count($_POST > 0)) {
        
    foreach ($_POST as $key => $value) {
        //$value = mysql_real_escape_string($value);
        $updates[$key] = $value;      
    }
        
        $implodeArray = implode('\', \'', $updates);
        //var_dump($implodeArray);
        $keys = array_keys($updates);
        $keys_string = implode(', ', $keys);
		
        $q = "INSERT INTO `csp` ($keys_string) VALUES ('$implodeArray')";
        $r = @mysqli_query ($dbc, $q);
                if (mysqli_affected_rows ($dbc) == 1) {
               echo '1';
            } else {
                echo '2';
                       //echo '<p>' . mysqli_error($dbc) . '<br /> Query: ' . $q . ' </p>';
                        
            }
        
    }
    
}

   
   
mysqli_close($dbc);
?>