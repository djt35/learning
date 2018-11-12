<?php 
    error_reporting(0);

    //define the database we are using, here PROSPER.
    define ('MYSQL', '../mysqli_connect_learning.php');
     require (MYSQL); 
    
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (count($_POST > 0)) {
    
    $userid = $_POST['userid'];
    
	$q = "SELECT `changeScore` FROM `csp` WHERE userid = '$userid'";
			$r = mysqli_query($dbc, $q);
			$num = mysqli_num_rows($r);
			if ($num > 0){ 
				echo "1";
			}else {
			echo "0";	
				
			}
        
   
mysqli_close($dbc);
?>