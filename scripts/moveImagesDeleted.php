<?php
ini_set('display_errors',1);

require ('../includes/config.inc.php');

$openaccess = 0;
$requiredUserLevel = 2;

require (BASE_URI . '/scripts/headerScript.php');

//require (BASE_URI . '/scripts/imageFunctions.php');

$general = new general;
$user = new users;


function ne($v) {
	return $v != '';
}

$errors = array();

$data = json_decode(file_get_contents('php://input'), true);

//print_r($data);

if (count($data) > 0){

    foreach ($data as $key=>$value){

        foreach ($value as $k=>$v){

            //$v is filename
            $filename = pathinfo(BASE_URI . '/' . $v,PATHINFO_FILENAME);
            $extension = pathinfo(BASE_URI . '/' . $v, PATHINFO_EXTENSION);

            copy(BASE_URI . '/' . $v, BASE_URI . '/' . 'includes/images/deleted/' . $filename . '.' . $extension);
            unlink(BASE_URI . '/' . $v);

        }

    }


}

?>


