<?php
	session_start();
	require_once 'conexion_spa.php';
	if(isset($_POST['borrar'])){
		if(isset($_POST['check'])){
			$checked = $_POST['check'];
			for($i=0; $i < count($checked); $i++){
				$id = $checked[$i];
				$sql = "DELETE from `detalle_permisos` WHERE `id`='$id'";
				$query = $db->prepare($sql);
				$query->execute();
			}
			header('location:index_grupo_roles.php');
		}else{
			echo "<script>alert('Primero seleccione un registro!')<script>";
			echo "<script>window.location='index_grupo_roles.php'<script>";
		}
	}		
?>