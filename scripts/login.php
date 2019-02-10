
 <?php
error_reporting(-1);	 

session_start();

$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}
	 
if ($local){

	require ($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/config.inc.php');

}else{

	require ($_SERVER['DOCUMENT_ROOT'].'/includes/config.inc.php');

}





// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Need two helper files:

	if ($local){
		require ($_SERVER['DOCUMENT_ROOT'].'/dashboard/learning/includes/login_functions.php');
	}else{

		require($_SERVER['DOCUMENT_ROOT'].'/includes/login_functions.php');
	}
	require (DB);

	// Check the login:
	//print_r($_POST);
	list ($check, $data) = check_login($dbc,
		$_POST['username'], $_POST['password']);

	if ($check) { // OK!

		// Set the session data:
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['firstname'] = $data['firstname'];
		$_SESSION['surname'] = $data['surname'];
		


		


		// Redirect:
		echo '1';
		
	} else { // Unsuccessful!
		
		echo '0';
		// Assign $data to $errors for
		$errors = $data;
		foreach ($errors as $msg) {
			//echo " - $msg<br />\n";
		
		}

		
		

	} // End of the main submit conditional.
}

mysqli_close($dbc); // Close the database connection.
// Create the page:
?>
