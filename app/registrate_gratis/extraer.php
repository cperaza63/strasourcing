<?php
require 'config.php';

// Número de registros recuperados
$numberofrecords = 5;

if(!isset($_GET['depart'])){

   // Obtener registros a tarves de la consulta SQL
   $stmt = $con->prepare("SELECT * FROM php_combo.ciudad ORDER BY name LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $lista_productos = $stmt->fetchAll();

}else{

   $search = $_GET['depart'];// Search text

   $sql = "SELECT * FROM php_combo.ciudad WHERE name like :nombre ORDER BY name LIMIT :limit";
   
   echo "==" . $sql;

   // Mostrar resultados
   $stmt = $con->prepare($sql);
   $stmt->bindValue(':name', '%'.$search.'%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   //Variable en array para ser procesado en el ciclo foreach
   $lista_productos = $stmt->fetchAll();

}

$response = array();

// Leer los datos de MySQL
foreach($lista_productos as $pro){
   $response[] = array(
      "id" => $pro['id'],
      "text" => $pro['name']
   );
}

echo json_encode($response);
exit();
?>