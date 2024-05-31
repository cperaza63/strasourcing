<?php
	session_start();
	require_once 'conexion.php';
	
	if(isset($_POST['borrar'])){
		if(isset($_POST['check'])){
			$checked = $_POST['check'];
			for($i=0; $i < count($checked); $i++){
				$id = $checked[$i];
				$sql = "DELETE from `marca_catsubcatgrupo` WHERE `id`='$id'";
				$query = $db->prepare($sql);
				$query->execute();
			}
			
			header('location:index.php');
		}else{
			echo "<script>alert('Primero seleccione un registro!')</script>";
			echo "<script>window.location='index.php'</script>";
		}
	}		
?>