<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Generaltech';
$dbname = 'fisioterapia';

$mydb = new mysqli($dbhost,$dbuser,$dbpass,$dbname) or die("Error " . mysqli_error($conn));
$mydb->set_charset("utf8");
//mysqli_close($conn);

?>