
 <?php
error_reporting(-1);

require ('../includes/config.inc.php');

session_start();


// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:


	require (BASE_URI . '/includes/login_functions.php');
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
		$_SESSION['access_level'] = $data['access_level'];

		// Redirect:
		echo '1';

	} else { // Unsuccessful!

		echo '0';
		// Assign $data to $errors for
		$errors = $data;
		foreach ($errors as $msg) {
			echo " - $msg<br />\n";

		}




	} // End of the main submit conditional.
}

mysqli_close($dbc); // Close the database connection.
// Create the page:
?>
