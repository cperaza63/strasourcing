<?php 
$error= "";
$pasa=1;

//Declaramos una variable para almacenar errores y mostrarlos después
$errores =""; 
$siva="0";


if (isset($_GET['asunto']) && $_GET['asunto'] == 12 ){
	if (isset($_GET['leido']) && $_GET['leido'] != 0 ){
		$query = "UPDATE tabla_contactos SET estatus=1 WHERE asunto= " . $_GET['asunto'] . " and solicitud_categoria=" . $_GET['leido'];
		$result = mysqli_query($conexion, $query);
	}
}

if(!isset($_SESSION['empresa_externa'])){
	$_SESSION['empresa_externa']="";	
}

if(isset ($_GET['rif'])){
	$_SESSION['consulta_rif'] = $_GET['rif'];
	$query = "SELECT * FROM empresas WHERE numero_rif = '". $_GET['rif']. "'";
	//echo $query;
	$result = mysqli_query($conexion, $query);
	if ( !$result ) {
		die('Query Failed...');
	}else{
		$cuantas_solicitudes = $result->num_rows;
		while( $row = mysqli_fetch_array( $result ) ) {
			$_SESSION['empresa_externa'] = $row['razon_social'];
		}
	}
}

if(!isset ($_GET['accionR'])){
	$_SESSION['accionR'] = "";
}
if(isset ($_GET['accionR']) && $_GET['accionR'] != "" ){
	$_SESSION['accionR'] = $_GET['accionR'];
}
$rif_seleccion = "";

if(isset($_POST['accion']) && $_POST['accion'] == "recomendar"){
	//echo "=solicitar_categoria=" . $_POST['solicitar_categoria'];
	//echo "=Rs=" . $_POST['razon_social'];
	//echo "=Nr=" . $_POST['numero_rif'];	
	$full = 26;
	$condiciones_pago 	= ($_POST['condiciones_pago'] - 1 ) * 10;
	$negociaciones 		= ($_POST['negociaciones'] - 2 ) * 10;
	$tiempo_entrega 	= ($_POST['tiempo_entrega'] - 3 ) * 10;
	$calidad 			= ($_POST['calidad'] - 4 ) * 10;
	$garantia 			= ($_POST['garantia'] - 5 ) * 10;
	$soporte 			= ($_POST['soporte'] - 6 ) * 10;
	$puntuacion = $condiciones_pago + $negociaciones + $tiempo_entrega + $calidad + $garantia + $soporte;
	
	$porcentaje = ($puntuacion / $full)*100;
	//echo "<br>Puntuacion = " . $puntuacion;
	
	//
	$query = "DELETE FROM evaluacion WhERE solicitud_categoria = " . $_POST['solicitar_categoria'];
	$result = mysqli_query($conexion, $query);
	//
	$sql = "INSERT INTO evaluacion ( idCompany, idProveedor, rif, condiciones_pago, negociaciones, tiempo_entrega, calidad,
	garantia, soporte, solicitud_categoria, puntuacion) Values (" . 
	$_SESSION['companyHive'] .", " . 
	$_POST['idProveedor'] . ", '" . $_POST['numero_rif'] . 
	"', $condiciones_pago, $negociaciones, $tiempo_entrega, $calidad, $garantia, $soporte, " . $_POST['solicitar_categoria'] . ", $puntuacion )";
	//echo "<br>" . $sql;
	$result = mysqli_query($conexion, $sql);
	//
	$query = "UPDATE solicitud_categorias SET estatus = " . $_POST['recomiendo'] . " WhERE ID = " . $_POST['solicitar_categoria'];
	//echo "<br>" . $query;
	$result = mysqli_query($conexion, $query);
	//
	?>
	<script>
        alert("La solicitud de recomendacion a la empresa ha sido creada con exito...");
        window.parent.location="http://localhost/strasourcing/app/recomendacionesEmpRif.php";
    </script>
    <?php
}
?>