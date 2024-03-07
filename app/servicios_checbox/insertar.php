<?php
session_start();

require_once 'config.php';
if(isset($_POST['guardar'])){
  $tipo_servicio = htmlentities($_POST['tipo_servicio']);
  $comentario = htmlentities($_POST['comentario']);
  $rif = $_SESSION['rifHive']; //htmlentities($_POST['rif'])
  $programas = addslashes(implode(", ", $_POST['programas']));

  $query = $db->prepare("INSERT INTO `servicios_proveedor`(`tipo_servicio`, `comentario`, `rif`, `programas`)
  VALUES (:tipo_servicio,:comentario,:rif,:programas)");
  $query->bindParam(":tipo_servicio", $tipo_servicio);
  $query->bindParam(":comentario", $comentario);
  $query->bindParam(":rif", $rif);
  $query->bindParam(":programas", $programas);
  $query->execute();
  header("location: index.php");		
	}
?>