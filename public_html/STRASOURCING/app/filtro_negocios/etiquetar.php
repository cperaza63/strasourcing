<?php
session_start();
include "Conexion.php";
$dbSPA=connectSPA();
$etiquetas = array();
$_GET['idusuario'] = 11;
$query=$dbSPA->query("select * from formulas where etiqueta='".$_GET['texto_etiqueta']."'");

if( isset ( $_GET['preferencia'] ) && $_GET['preferencia'] !="" ){
	while($r=$query->fetch_object()){ $etiquetas[]=$r; }
	if(count($etiquetas)>0){
		print "<span style='color:red;'>La etiqueta ya existe</span";
	}else{
		
		$categoria = 0;
		$subcategoria = 0;
		$grupo = 0;
		$pais_origen ="0";
		$marca="0";
		$preferencia="";
		$tipo="0";
		$sector="0";
		$estado = "0";
		$ciudad = "0";
		
		
		if(isset($_GET['marca']) && $_GET['marca'] != "" ){
			$marca = $_GET['marca'];
		}
		if(isset($_GET['origen']) && $_GET['origen'] != "" ){
			$pais_origen = $_GET['origen'];
		}
		
		if(isset($_GET['categoria']) && $_GET['categoria'] != "" ){
			$categoria = $_GET['categoria'];
		}
		
		if(isset($_GET['subcategoria']) && $_GET['subcategoria'] != "" ){
			$subcategoria = $_GET['subcategoria'];
		}
		
		if(isset($_GET['grupo']) && $_GET['grupo'] != "" ){
			$grupo = $_GET['grupo'];
		}
		
		if(isset($_GET['preferencia']) && $_GET['preferencia'] != "" ){
			$preferencia = $_GET['preferencia'];
		}
		if(isset($_GET['tipo']) && $_GET['tipo'] != "" ){
			$tipo = $_GET['tipo'];
		}
		if(isset($_GET['sector']) && $_GET['sector'] != "" ){
			$sector = $_GET['sector'];
		}
		
		if(isset($_GET['estado']) && $_GET['estado'] != "" ){
			$estado = $_GET['estado'];
		}
		
		if(isset($_GET['ciudad']) && $_GET['ciudad'] != "" ){
			$ciudad = $_GET['ciudad'];
		}
		
		$sq="insert into formulas(rif, idCompany, etiqueta, idusuario, categoria, subcategoria, grupo, preferencia, marca, pais_origen, 
		tipo_empresa, sector, estado, ciudad) 
		values( '".$_SESSION['rifHive']."', ".$_SESSION['companyHive'].", '" . $_GET['texto_etiqueta'] . "', " . $_GET['idusuario'] . ", " . $categoria . ", " . $subcategoria . ", " . 
		$grupo . ", '" . $preferencia . "', " . $marca . ", " . $pais_origen . ", " . $tipo . ", " . $sector . ", " . $estado. ", " . $ciudad. ")" ;
		
		$query = $dbSPA->query($sq);
		
		print "<span style='color:green;'>Filtro se registro con exito "."</span>";
	}
}else{
	print "<span style='color:red;'>Debe seleccionar primero la preferencia</span";
}
?>