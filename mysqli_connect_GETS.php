<?php # Script to connect to database - mysqli_connect.php

DEFINE ('DB_USER', 'djt');
DEFINE ('DB_PASSWORD','nevira1pine');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','anderVal');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$dbc) {
    trigger_error ('Could not connect to MySQL: '. mysqli_connect_error ());
} else {
  mysqli_set_charset($dbc, 'utf8');  
}

try{

$pdo = new PDO('mysql:host=localhost; dbname=anderVal', 'djt', 'nevira1pine');
//echo 'successful database connection';

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

