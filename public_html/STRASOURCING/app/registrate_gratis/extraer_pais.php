<?php
require 'config.php';

// Número de registros recuperados
$numberofrecords = 5;

if( isset($_GET['depart'])){
	$search = $_GET['depart'];
}else{
	$search = $_POST['depart'];	
}

$sql = "SELECT id, name FROM php_combo.pais WHERE continente_id like ". $search ." ORDER BY name LIMIT 5";
//echo "==" . $sql;
// Mostrar resultados

$stmt = $con->prepare($sql);
$stmt->execute();
//grab a result set
$resultSet = $stmt->get_result();
//pull all results as an associative array
$lista_productos = $resultSet->fetch_all();

$response = array();

// Leer los datos de MySQL
foreach($lista_productos as $pro){
   $response[] = array(
      "id" => $pro[0],
      "name" => $pro[1]
   );
}

echo json_encode($response);
exit();
?>