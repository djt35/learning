<?php
	
	require ('../includes/config.inc.php');

session_start( );

//need to require login functions


$general = new general;
$tagCategories = new tagCategories;

//print_r($_GET);

foreach ($_GET as $k=>$v){
	
	$sanitised = $general->sanitiseInput($v);
	$_GET[$k] = $sanitised;
	
	
}



if (isset($_GET['tagCategoryName'])){
	$name = $_GET['tagCategoryName'];
}else{
	echo 'Name was not passed';
	exit();
	
}


if (isset($_GET['active'])){
	$active = $_GET['active'];
	
}else{
	echo 'active was not passed';
	exit();
	
}

	
//db query

//check the video does not already exist

//if does not enter a new video

print_r($tagCategories->newTagCategory($name, $active));

//update video









?>