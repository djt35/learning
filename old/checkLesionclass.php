<?php

echo 'Using Classes <br><br>';

require 'lesion_class_inc.php';
//require 'list.class.inc.php';


error_reporting(-1);

$lesion = new Lesion;

$lesion->Lesion();



$lesion->Load_from_key(27);

print_r($lesion);

echo "Details as follows ";

echo $lesion->get_k_lesion();

echo "Previous attempt was ";
echo $lesion->getPreviousAttempt();

$lesion->setPreviousAttempt(1);

echo "Previous attempt now ";
echo $lesion->getPreviousAttempt();

echo $lesion->JS_var();



?>
