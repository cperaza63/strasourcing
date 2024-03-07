<?php
	session_start();
	require_once 'conexion_spa.php';
	
	if(isset($_POST['borrar'])){
		if(isset($_POST['check'])){
			$checked = $_POST['check'];
			for($i=0; $i < count($checked); $i++){
				$id = $checked[$i];
				$sql = "DELETE from `proveedor_marcas` WHERE `id`='$id'";
				$query = $db->prepare($sql);
				$query->execute();
			}
			
			header('location:index_proveedor_grupos.php');
		}else{
			echo "<script>alert('Primero seleccione un registro!')</script>";
			echo "<script>window.location='index_proveedor_grupos.php'</script>";
		}
	}		
?>