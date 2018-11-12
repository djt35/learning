<?php

session_start( );

error_reporting(-1);

$folder = 'https://' . $_SERVER['HTTP_HOST'] . '/studyserver/PROSPER/';


require($_SERVER['DOCUMENT_ROOT'].'/studyserver/PROSPER/login_functions.php');

function class_loader($class) {
		
			require($_SERVER['DOCUMENT_ROOT'].'/studyserver/PROSPER/classes/'.$class.'.class.php');
		 	
		}
	
	
	spl_autoload_register ('class_loader');
	
	
	


//use the referring id as the user id to change the password for
//alternatively use a randomly generated string


$lesion = new Lesion;
$table = new tableGenerator;
$formv1 = new formGenerator;
$user = new users;
$user->Load_from_key($_SESSION['user_id']);

if ($user->Load_from_key($_SESSION['user_id'])){
	
	
	$formv1->generateSelect ('Type:', 'type', 'formInput', 'biopsyType', 'Normal mucosa or polyp biopsy?');
	
	$formv1->generateSelect ('Colon Location:', 'location', 'formInput', 'Location', 'Enter the location in the colon this biopsy was taken from');
	
	$formv1->generateSelect ('Polyp Proximity:', 'polypProximity', 'formInput', 'polypProximity', 'Enter how close to the polyp this biopsy was taken from if normal mucosa');
	
	$formv1->generateSelect ('Polyp Area:', 'polypArea', 'formInput', 'polypArea', 'Where on the polyp was the biopsy taken from?');
	
	//polypArea
	
	//preservative
	
	//histology
	
	//dysplaisa
	
}else{
	
	echo 'Invalid user';
	
	
}