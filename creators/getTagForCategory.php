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
$tagCategory = new tagCategories;

//print_r($_GET);

foreach ($_GET as $k=>$v){
	
	$sanitised = $general->sanitiseInput($v);
	$_GET[$k] = $sanitised;
	
	
}


if (isset($_GET['category'])){
	$category = $_GET['category'];
}else{
	echo 'category was not passed';
	exit();
	
}

echo json_encode($tagCategory->returnTagsDefinedCategory($category));

