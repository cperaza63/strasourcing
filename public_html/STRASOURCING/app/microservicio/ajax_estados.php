<?php
include_once '../config/database.php';
include_once '../objects/estadoCiudades.php';
$database = new Database ();
$db = $database->getConnection ();
$estadosCiudades = new EstadosCiudades ( $db );
if(isset($_POST["id_estado"]) && !empty($_POST["id_estado"])){
	$stmt = $estadosCiudades->readCiudades($_POST["id_estado"]); 
	$i = 0;
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) )
	{	
		if( $i==0 ){
			echo '<option value="">Seleccione Ciudad</option>';	
		}
		$i++;
		echo '<option value="'.$row['id'].'">'.$row['city'].'</option>';
	}
	if( $i == 0 ){
		echo '<option value=">Estado no disponible</option>';	
	}
}else{
		echo '<option value=">No se recibio el Estado</option>';		
}
?>