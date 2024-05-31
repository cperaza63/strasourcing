<?php 
session_start();
include "config.php";
$error="";
$marca=0;
$tipo_empresa = 0;
$categoria=0;
$subcategoria=0;
$etiqueta = "";

$color_administrador = "outline-secondary";
$color_empresa = "outline-secondary";
$color_contacto = "outline-secondary";
$color_pys = "outline-secondary";
$color_redes = "outline-secondary";
$color_soporte = "secondary";

if ( !isset($_SESSION['proveedor_web'])) {
	$_SESSION["proveedor_web"] = "";
	$_SESSION['instagram'] = "";
	$_SESSION['facebook'] = "";
	$_SESSION['twitter'] = "";
	$_SESSION['youtube'] = "";
	$_SESSION["linkedin"] = "";
	$_SESSION['tiktok'] = "";
	$_SESSION['rango1_trabajadores'] = "";
	$_SESSION['rango2_trabajadores'] = "";
	$_SESSION['cantidad_clientes'] = "";
	$_SESSION['condiciones_pago'] = "";
	$_SESSION['garantia'] = "";
	$_SESSION['servicio_postventa'] = "";
	$_SESSION['etiqueta'] = "";
}
if( !isset($_POST['etiqueta'] )){
	$_SESSION['etiqueta'] = "";	
}

if ( isset($_POST['accion'] ) && $_POST['accion'] = "escoger_soporte") {
	if( $_POST['etiqueta'] !=""){
		$etiqueta = $_POST['etiqueta'];
		$_SESSION['etiqueta'] = $etiqueta;	
	}else{
		$etiqueta = "TODOS LOS SOPORTES";
		$_SESSION['etiqueta'] = $etiqueta;	
	}
	
}else{
	$escoger_soporte = $_SESSION['etiqueta'];	
}

if ( isset($_POST['boton'] )) {
	$boton_opcion = $_POST['boton'];
}else{
	$_POST['boton'] = "soporte";	
}

if ( isset($_POST['boton'] ) && $_POST['boton']!=""){
	if ( $_POST['boton'] == "administrador" ){
		$color_administrador = "secondary";
		$color_empresa = "outline-secondary";
		$color_contacto = "outline-secondary";
		$color_pys = "outline-secondary";
		$color_redes = "outline-secondary";
	}else {
		if( $_POST['boton'] == "empresa" ){
			$color_administrador = "outline-secondary";
			$color_empresa = "secondary";
			$color_contacto = "outline-secondary";
			$color_pys = "outline-secondary";
			$color_redes = "outline-secondary";
		}else{
			if( $_POST['boton'] == "contacto"){
				$color_administrador = "outline-secondary";
				$color_empresa = "outline-secondary";
				$color_contacto = "secondary";
				$color_pys = "outline-secondary";		
				$color_redes = "outline-secondary";
			}else{
				if( $_POST['boton'] == "pys"){
					$color_administrador = "outline-secondary";
					$color_empresa = "outline-secondary";
					$color_contacto = "outline-secondary";		
					$color_pys = "secondary";		
					$color_redes = "outline-secondary";		
				}else{
					if( $_POST['boton'] == "redes"){
						$color_administrador = "outline-secondary";
						$color_empresa = "outline-secondary";
						$color_contacto = "outline-secondary";		
						$color_pys = "outline-secondary";		
						$color_redes = "secondary";
					}	
				}
			}
		}	
	}
}
// Traigo todos los datos
$query = "SELECT * FROM proveedores WhERE id = " . $_SESSION['companyHive'] . " limit 1";
$result = mysqli_query($con, $query);
if ( !$result ) {
	die('Fallo en la busqueda...');
}else{
	while( $row = mysqli_fetch_array( $result ) ) {
		//echo $query;
		$_SESSION["proveedor_web"] = $row["proveedor_web"];
		$_SESSION['instagram'] = $row["instagram"];
		$_SESSION['facebook'] = $row["facebook"];
		$_SESSION['twitter'] = $row["twitter"];
		$_SESSION['youtube'] = $row["youtube"];
		$_SESSION["linkedin"] = $row["linkedin"];
		$_SESSION['rango1_trabajadores'] = $row["rango1_trabajadores"];
		$_SESSION['rango2_trabajadores'] = $row["rango2_trabajadores"];
		$_SESSION['cantidad_clientes'] = $row["cantidad_clientes"];
		$_SESSION['condiciones_pago'] = $row["condiciones_pago"];
		$_SESSION['garantia'] = $row["garantia"];
		$_SESSION['servicio_postventa'] = $row["servicio_postventa"];
	}
	//echo $query;
}

$sql = "SELECT numero_rif FROM proveedores WHERE id = ".$_SESSION['companyHive'];
//echo "<br>" . $sql;
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_array($query);
if ($result > 0) {
	$rif_proveedor = $result[0];
	$_SESSION['rifHive'] = $rif_proveedor;
}else{
	$rif_proveedor = $_SESSION['rifHive'];	
}

if ( !isset($_SESSION['rifHive'])) {
	$_SESSION['rifHive'] = "0";
}else{
	$rif_proveedor = $_SESSION['rifHive'];	
}

if( isset($_POST["proveedor_web"]) && isset($_POST['cantidad_clientes'] ) ) {
	
	$_SESSION["proveedor_web"] = $_POST["proveedor_web"] != "" ? $_POST["proveedor_web"]: "http://";
	$_SESSION['instagram'] = $_POST["instagram"] != "" ? $_POST["instagram"]: "http://";
	$_SESSION['facebook'] = $_POST["facebook"] != "" ? $_POST["facebook"]: "http://";
	$_SESSION['twitter'] = $_POST["twitter"] != "" ? $_POST["twitter"]: "http://";
	$_SESSION['youtube'] = $_POST["youtube"] != "" ? $_POST["youtube"]: "http://";
	$_SESSION["linkedin"] = $_POST["linkedin"] != "" ? $_POST["linkedin"]: "http://";
	$_SESSION['tiktok'] = $_POST["tiktok"] != "" ? $_POST["tiktok"]: "http://";
	
	$_SESSION['rango1_trabajadores'] = $_POST["rango1_trabajadores"];
	$_SESSION['rango2_trabajadores'] = $_POST["rango2_trabajadores"];
	$_SESSION['cantidad_clientes'] = $_POST["cantidad_clientes"];
	$_SESSION['condiciones_pago'] = $_POST["condiciones_pago"];
	$_SESSION['garantia'] = $_POST["garantia"];
	$_SESSION['servicio_postventa'] = $_POST["servicio_postventa"];

	// grabo y me salgo
	$query = "UPDATE proveedores 
	SET proveedor_web = '" .$_SESSION["proveedor_web"]. "', 
	instagram = '" .$_SESSION["instagram"]. "', 
	facebook = '" .$_SESSION["facebook"]. "', 
	twitter = '" .$_SESSION["twitter"]. "', 
	youtube = '" .$_SESSION["youtube"]. "', 
	linkedin = '" .$_SESSION["linkedin"]. "', 
	tiktok = '" .$_SESSION["tiktok"]. "',
	
	rango1_trabajadores = " .$_SESSION["rango1_trabajadores"]. ", 
	rango2_trabajadores = " .$_SESSION["rango2_trabajadores"]. ", 
	cantidad_clientes = " .$_SESSION["cantidad_clientes"]. ", 
	condiciones_pago = '" .$_SESSION["condiciones_pago"]. "', 
	garantia = " . $_SESSION["garantia"]. ", 
	servicio_postventa = " .$_SESSION["servicio_postventa"]. " 
	WHERE id = ".$_SESSION['companyHive'];
	
	//echo $query;
	$result = mysqli_query($con, $query);	
	if ( !$result ){
		die('Query Failed!');
	}
	echo "Registro ha sido grabado con éxito!";
}
?>
