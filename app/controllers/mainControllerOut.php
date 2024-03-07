<?php
include_once 'config/database.php';
include_once 'objects/bigdata_out.php';
$database = new Database ();
$db = $database->getConnection ();
$bigdata_out = new Bigdata_out ( $db );
?>
