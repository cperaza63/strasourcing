<?php 
session_start();
include "config.php";
$error="";
$marca=0;
$tipo_empresa = 0;
$categoria=0;
$subcategoria=0;
$boton_opcion = "";

$color_administrador = "outline-secondary";
$color_empresa = "outline-secondary";
$color_contacto = "secondary";
$color_pys = "outline-secondary";
$color_redes = "outline-secondary";
$color_soporte = "outline-secondary";

if ( isset($_GET['del'] ) && $_GET['del'] !="" ) {
	$sql = "DELETE FROM proveedor_sectores WHERE id = " . $_GET['del'];
	$query = mysqli_query($con, $sql);
}
if ( isset($_GET['delrevision'] ) && $_GET['delrevision'] !="" ) {
	$sql = "DELETE FROM proveedor_revisiones WHERE id = " . $_GET['delrevision'];
	$query = mysqli_query($con, $sql);
}

if ( isset($_POST['grabar_sector'] ) && $_POST['grabar_sector'] =="grabar_sector" && $_POST['sector'] != "" ) {
	// reviso que no exceda el 100%
	$sql = "SELECT SUM(porcentaje) as total_porcentaje FROM proveedor_sectores WHERE idProveedor = '". $_SESSION['companyHive'] ."'";	
	$pasa = 1;
	$query = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($query);
	if ($result > 0 ) {
		$total_pocentaje = $result[0];
		if ( $result[0] > 100 ){
			$pasa = 0;
		}
	}
	// vemos si excede porcentaje
	if ($pasa == 1 ) {
		// como no excede el 100%, procedo a validar que no exista la relacion proveedor - sector
		$sql = "SELECT * FROM proveedor_sectores WHERE idProveedor = '". $_SESSION['companyHive'] ."' and sector = ". $_POST['sector'];	
		$query = mysqli_query($con, $sql);
		$result = mysqli_fetch_array($query);
		if ($result > 0) {		
			// como hay relacion, entonces no lo agrego
			echo "Atención: No puede agregar un sector que ya ha sido agregado<br>";	
		}else{
			// si no procedo a agregar la relacion
			if( ($total_pocentaje * 1) + ($_POST['porcentaje_sector'] * 1) > 100 ){
				echo "Atención: No puede agregar este sector porque excederia el 100%<br>";					
			}else{
				$sql = "INSERT INTO proveedor_sectores (idProveedor, sector, porcentaje) values ('". $_SESSION['companyHive'] ."', " . $_POST['sector'] . ", " . $_POST['porcentaje_sector'] . ")";	
				//echo $sql; 
				if ($con->query($sql) === TRUE) {
					echo "Atención: Un nuevo sector ha sido agregada con exito!<br>";
				} else {
					echo "Error: " . $sql . "<br>" . $con->error;
				}	
			}				
		}	
	}
	else{
		// como hay relacion, entonces no lo agrego
		echo "Atención: No puede agregar mas sectores porque excede el 100%<br>";		
	}
}



if ( isset($_POST['grabar_revision'] ) && $_POST['grabar_revision'] =="grabar_revision" && $_POST['nombre_revisor'] != "" ) {
	// como no excede el 100%, procedo a validar que no exista la relacion proveedor - sector
	$sql = "SELECT * FROM proveedor_revisiones WHERE idProveedor = ". $_SESSION['companyHive'] ." and revisor = '". $_POST['nombre_revisor']."'";	
	//echo $sql;
	$query = mysqli_query($con, $sql);
	$result = mysqli_fetch_array($query);
	if ($result > 0) {		
		// como hay relacion, entonces no lo agrego
		echo "Atención: No puede agregar una revisión que ya ha sido agregada<br>";	
	}else{
		$sql = "INSERT INTO proveedor_revisiones (idProveedor, revisor, tipo) values ('" . 
		$_SESSION['companyHive'] ."', '" . $_POST['nombre_revisor'] . "', '" . $_POST['tipoRevision'] . "')";	
		//echo $sql; 
		if ($con->query($sql) === TRUE) {
			echo "Atención: Una nueva revisión ha sido agregada con éxito!<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}					
	}	
}

if ( isset($_POST['boton'] )) {
	$boton_opcion = $_POST['boton'];
}else{
	$_POST['boton'] = "contacto";	
}

if ( isset($_POST['boton'] ) && $_POST['boton']!=""){
	$url = "http://localhost/strasourcing/app/registrate_gratis/proveedor_spa.php?boton=".$_POST['boton'];
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
					$color_redes = "outline-secondary";		;
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
// selecciona la marca de trabajo
if( isset( $_POST['agregar_categoria'] ) && $_POST['agregar_categoria'] ="agregar_categoria"){
	
	if( $_POST['marca'] != "" ){
		$_SESSION['marca'] = $_POST['marca'];
		$marca = $_POST['marca'];	
	}else{
		$error = "Marca<br>";
	}
	
	if( $_POST['tipo_empresa'] != "" ){
		$_SESSION['tipo_empresa'] = $_POST['tipo_empresa'];
		$tipo_empresa = $_POST['tipo_empresa'];	
	}else{
		$error = "Tipo de empresa<br>";
	}
	
	if( $_POST['categoria'] != "" ){
		$_SESSION['categoria'] = $_POST['categoria'];
		$categoria = $_POST['categoria'];	
	}else{
		$error = $error . "Categoria<br>";
	}
	$cerveza = $_POST['subcategoria'];
	$cuantos = count($cerveza);
		//echo $cuantos;	
	if ($error ==""){
		
		///echo "procedo a grabar";	
		
		for ($i=0;$i<$cuantos;$i++)
		{
			//echo "<br> Cerveza " . $i . ": " . $cerveza[$i];
			$sql = "SELECT * FROM proveedor_marcas WHERE rif = '$rif_proveedor' and marca = $marca and categoria= $categoria 
			and subcategoria=" . $cerveza[$i];
			//echo "<br>" . $sql;
			$query = mysqli_query($con, $sql);
			$result = mysqli_fetch_array($query);
			if ($result > 0) {
				//echo "si hay y no agrega ";
			}else{
				if ( $cerveza[$i] != "" ){
					$sql = "INSERT INTO proveedor_marcas 
					(rif, marca, tipo_empresa, categoria, subcategoria) values 
					('$rif_proveedor', $marca, $tipo_empresa, $categoria, ".$cerveza[$i].")";	
					//echo $sql; 
					if ($con->query($sql) === TRUE) {
					  //echo "Una nueva marca propuesta por Usted ha sido agregada con exito!";
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
		}		
	}else{
		echo $error;
	}
}
?>
