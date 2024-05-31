<?php
	session_start();
	require_once 'conexion_spa.php';	
	echo "llegue";
	//	$_SESSION['companyHive'] = "19362";
	//  $_SESSION['rifHive']


	if(isset($_POST['guardar'])){
		$marca = $_SESSION['marca_id'];
		$categoria = $_SESSION['continente_id'];
		$subcategoria = $_SESSION['pais_id'];
		$grupo = $_SESSION['ciudad_id'];
		
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sq = "DELETE FROM proveedor_marcas where rif='" . 
		$_SESSION['rifHive'] . "' and marca = " . 	$_SESSION['marca_id'] . " and categoria = " . $_SESSION['continente_id'] . 
		" and subcategoria = " . $_SESSION['pais_id'] . " and grupo = ". $_SESSION['ciudad_id'];
		$query = $db->query($sq);
		
		$sq = "SELECT * FROM proveedor_marcas where rif='" . $_SESSION['rifHive'] . "' and marca = " . 	$_SESSION['marca_id'] . 
		" and categoria = " . $_SESSION['continente_id'] . 	" and subcategoria = " . $_SESSION['pais_id'] . " and grupo = ". $_SESSION['ciudad_id'];
		$query = $db->query($sq);
		
		$marcas = $_POST["tabla_marcas"];
		$cuantos = count($marcas);
		if ( $cuantos > 0 ) {
			for ($x = 0; $x < $cuantos; $x++) {
				try{
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "INSERT INTO `proveedor_marcas` 
					(`idCompany`, `rif`, `tipo_empresa`, `marca`, `categoria`, `subcategoria`, `grupo`) 
					VALUES (" . 
					$_SESSION['companyHive'] . ", '" .
					$_SESSION['rifHive']."', 3, " . 
					$_SESSION['marca_id'].", " .
					$_SESSION['continente_id'] . ", " .
					$_SESSION['pais_id']. ", " . $marcas[$x] . ")";
					echo $sql;
					$db->exec($sql);
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}	
		}
		
		$db = null; 
		header('location: index_proveedor_grupos.php');
	}
	
?>