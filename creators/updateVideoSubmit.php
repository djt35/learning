<?php
	
	require ('../includes/config.inc.php');

session_start( );

//need to require login functions


$general = new general;
$video = new video;

//print_r($_GET);

foreach ($_GET as $k=>$v){
	
	$sanitised = $general->sanitiseInput($v);
	$_GET[$k] = $sanitised;
	
	
}


if (isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	echo 'id was not passed';
	exit();
	
}


if (isset($_GET['name'])){
	$name = $_GET['name'];
}else{
	echo 'Name was not passed';
	exit();
	
}

if (isset($_GET['url'])){
	$url = $_GET['url'];
}else{
	echo 'URL was not passed';
	exit();
	
}


if (isset($_GET['active'])){
	$active = $_GET['active'];
	
}else{
	echo 'active was not passed';
	exit();
	
}

if (isset($_GET['split'])){
	$split = $_GET['split'];
	
}else{
	echo 'split was not passed';
	exit();
	
}

	
//db query

//check the video does not already exist

//if does not enter a new video

print_r($video->updateVideo($name, $url, $active, $split, $id));

//update video









?>