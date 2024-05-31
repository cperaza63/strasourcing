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

if(isset ($_POST['rif'])){
	$_SESSION['consulta_rif'] = $_POST['rif'];
}else{
	if(!isset ($_POST['rif'])){
		$_SESSION['consulta_rif'] = "";
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
}

if( isset( $_POST['numero_rif'] ) && $_POST['numero_rif'] != ""){	
	if(isset($_POST['accion']) && $_POST['accion'] !="recomendar"){
		echo $_POST['accion'];	
	}else
	{
		if( isset($_POST['solicitar_categoria'] ) && $_POST['solicitar_categoria'] !="" ){
			$stmt = $empresas->readRif($_POST['numero_rif']); 
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
			{		
				$rif_seleccion = $row['numero_rif'];
				if( isset( $rif_seleccion ) && $rif_seleccion  !="" ){
					$siHay = 0;	
					// procedemos a crear el detalle de categorias
								
					$fecha_respuesta = date("Y-m-d");
					if (isset($_POST['accion']) && $_POST['accion'] == "recomendar"){
						$query = "UPDATE solicitud_categorias set 
						rif = '" . $rif_seleccion ."',  
						idCompany=" . $_POST['idProveedor'] . ", 
						categoria= ". $_POST['categoria'] . ", 
						puntuacion= " . $puntuacion . ", 
						fecha_respuesta = '$fecha_respuesta', 
						estatus= 1 WHERE id = " . $_POST['solicitar_categoria']; 
						$result = mysqli_query($conexion, $query);	
						if ( !$result ){
							die('Query Failed!');
						}
						// ahora colocamos el mensaje en el archivo tabla_contactos
						$tablaContactos->usuario	  = $_SESSION['loginHive'];
						$tablaContactos->rifEnvia = $rif_seleccion;
						$tablaContactos->rifDestino = " ";
						$tablaContactos->companyEnvia = $_SESSION['companyHive'];
						$tablaContactos->companyDestino = $_POST['idProveedor'];
						$tablaContactos->empresa 	= $_SESSION['nombreHive'];
						$tablaContactos->asunto 	= 11; 
						$tablaContactos->comentario = "Respuesta por evaluación de solicitud de recomendacion #". $_POST['solicitar_categoria'] ." del proveedor #".$_POST['idProveedor'];	
						$tablaContactos->crearContactoAproveedor($_SESSION['companyHive'], $_POST['solicitar_categoria'], $_POST['idProveedor'], $rif_seleccion );
						?>
						<script>
							alert("La solicitud de recomendacion a la empresa ha sido creada con exito...");
							//window.parent.location="http://localhost/strasourcing/app/recomendacionesEmp.php";
						</script>
						<?php
					}
				}
			}	
		}
	}
}
?>