<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "php_combo";

try {
	$db = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	die('No se puede conectar a MySQL');
}
?>