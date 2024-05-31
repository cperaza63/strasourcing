<?php 
session_start();
include "config.php";
include "../config/conexion.php";

include_once '../objects/empresas.php';
$empresas = new Empresas ( $bd );

/*$_SESSION['active'] = true;
$_SESSION['nombreHive'] = "AIDA TATIANA NUNEZ";
$_SESSION['loginHive'] = "anunez";
$_SESSION['companyHive'] = "19334";
$_SESSION['tipoHive'] = 3;
$_SESSION['iduserHive'] = 5;*/
$rif_imagen = "";
$logo_imagen = "";
$error= "";
$pasa=1;
$boton= "";
$url="http://localhost/spa_users/layout/admin/index.php";
$boton_opcion ="";
$boton_opcion == "empresa";	
$color_administrador = "outline-secondary";
$color_empresa = "secondary";
$color_contacto = "outline-secondary";
$user_name = "";
$user_email = "";
$user_phone = "";

$company_name  = "";
$company_email = "";
$company_phone = "";
$company_rif = "";
$company_address = "";

$empresa_comment = "";
$company_pertenece = 0;
$company_camara = "";

$admin_name = "";
$admin_email = "";
$admin_phone = "";
$admin_cargo = "";

$estados = 0;
$ciudades = 0;
$tipo_infraestructura = 0;
$tipo_infraestructura_otro = "";
$area_trabajo = 0;
$area_trabajo_otro = "";
$sector_industrial = 0;
$sector_industrial_otro = "";
$tipo_organizacion = 0;
$tipo_organizacion_otro = "";

// esta variable se incrementa cada vez que ocurre un error
$r = 0;
$listaErrores = array();
$array = array(
    "0"  => "El Rif debe comenzar con una letra J, V, E, G, P",
    "1"  => "El rif no acepta caracteres distintos a letras y numeros",
    "2"  => "Falta por seleccionar de la lista de Estados",
	"3"  => "Falta por seleccionar de la lista de Ciudades",
	"4"  => "Si no escoje una opcion debe rellenar otro tipo de infraestructura",
	"5"  => "Si no escoje una opcion debe rellenar otra area de trabajo",
	"6"  => "Si no escoje una opcion debe rellenar otro sector industrial",
	"7"  => "Si no escoje una opcion debe rellenar otro tipo de organizacion"
);
// fin de declaracion de errores

//Declaramos una variable para almacenar errores y mostrarlos después
$errores ="";
if ( isset($_POST['boton'] ) && $_POST['boton']!=""){
	$boton_opcion == $_POST['boton'];	
	if ( $_POST['boton'] == "administrador" ){
		$color_administrador = "secondary";
		$color_empresa = "outline-secondary";
		$color_contacto = "outline-secondary";
		//echo "=1=". $color_administrador;
	}else {
		if( $_POST['boton'] == "empresa" ){
			$color_administrador = "outline-secondary";
			$color_empresa = "secondary";
			$color_contacto = "outline-secondary";
			//echo "=2==". $color_empresa;		
		}else{
			if( $_POST['boton'] == "contacto"){
				$color_administrador = "outline-secondary";
				$color_empresa = "outline-secondary";
				$color_contacto = "secondary";		
				//echo "=3=". $color_contacto;
			}
		}	
	}
}

$txtDireccion = "";
$txtCiudad = "";
$txtEstado = "";
$latitude = "";
$longitude = "";

if ( isset($_POST['grabar_direccion'] ) && $_POST['grabar_direccion'] == "Grabar Dirección"){
    $company_rif = $_POST['company_rif']; 
	$company_phone  = $_POST["telefono_empresa"]; 
    $direccion_final="";
	$txtDireccion = $_POST['txtDireccion'];
	$txtCiudad = $_POST['txtCiudad'];
	$txtEstado = $_POST['txtEstado'];
	$latitude  = $_POST['latitude'] != "" ? $_POST['latitude'] : "0";
	$longitude = $_POST['longitude']!= "" ? $_POST['longitude'] : "0";
	if ($txtDireccion != ""){
		$direccion_final = $txtDireccion . ", "  .  $txtCiudad .", " . $txtEstado;
	}
	$query = "SELECT id FROM empresas WhERE id = " . $_SESSION['companyHive'];
	//echo $query;
	$result = mysqli_query($con, $query);
	if ( !$result ) {
		die('Query Failed...');
	}else{				
		$query = "UPDATE empresas SET  
		direccion_empresa= '" . $direccion_final . "', 
		latitude= " . $latitude . ",  
		longitude= " . $longitude . " 
		WHERE id = " . $_SESSION['companyHive']; 
		$result = mysqli_query($con, $query);
		//echo $query;
		if ( !$result ){
			die('Query Failed!');
		}else{
			// AREA de mensajes del sistema
			$alert="*** ATENCION *** Se actualizo la direccion y coordenadas!," . $latitude." ". $longitude ;
			?>
			<div class="alert alert-success" role="alert"><?php echo $alert;?></div>;
            <?php	
			$alert="";
		}
	}
}


// Traigo todos los datos
$query = "SELECT * FROM empresas WhERE id = " . $_SESSION['companyHive'] . " limit 1";
//secho $query;
$result = mysqli_query($con, $query);
if ( !$result ) {
	die('Fallo en la busqueda...');
}else{
	while( $row = mysqli_fetch_array( $result ) ) {
		$company_rif  = $row["numero_rif"];
		$company_name  = $row["razon_social"];
		$company_email  = $row["email_empresa"];
		$company_phone  = $row["telefono_empresa"]; 
		$company_address  = $row["direccion_empresa"];
		$pais  = $row["pais"]; 
		$estados  = $row["state"]; 
		$ciudades  = $row["ciudad"];  
		$tipo_infraestructura  = $row["tipo_infraestructura"]; 
		$area_trabajo  = $row["area_trabajo"]; 
		$sector_industrial  = $row["sector_industrial"]; 
		$tipo_organizacion  = $row["tipo_organizacion"]; 
		$tipo_infraestructura_otro  = $row["tipo_infraestructura_otro"]; 
		$area_trabajo_otro  = $row["area_trabajo_otro"]; 
		$sector_industrial_otro  = $row["sector_industrial_otro"]; 
		$tipo_organizacion_otro  = $row["tipo_organizacion_otro"]; 
		$company_camara  = $row["pertenece_camara"];
		$_SESSION['fedecamaras'] = $row["pertenece_camara"];
		$latitude = $row["latitude"];
		$longitude = $row["longitude"];
		$user_name  = $row["contacto_nombre"];
		$user_email  = $row["contacto_email"]; 
		$user_phone  = $row["contacto_telefono"]; 
		$admin_name  = $row["admin_nombre"]; 
		$admin_email  = $row["admin_email"]; 
		$admin_phone  = $row["admin_telefono"];
		$admin_cargo   = $row["admin_cargo"];
		$empresa_comment = $row["comentario"];
		$logo_imagen = $row["logo_imagen"];
		$rif_imagen = $row["rif_imagen"];
	}
	//echo $query;
}

if( isset( $_POST["user_name"]) && $_POST["user_name"] != ""){
	$user_name = $_POST["user_name"];
	$user_email = $_POST["user_email"];
	$user_phone = $_POST["user_phone"];	
	$query = "SELECT id FROM empresas WhERE id = " . $_SESSION['companyHive'];
	//echo $query;
	$result = mysqli_query($con, $query);
	if ( !$result ) {
		die('Query Failed...');
	}else{				
		if( $_POST['boton'] == "grabar_contacto" ){
			$query = "UPDATE empresas SET  
			contacto_nombre= '" .$user_name . "', 
			contacto_email= '" .$user_email . "',  
			contacto_telefono= '" .$user_phone . "' 
			WHERE id = " . $_SESSION['companyHive']; 
			$result = mysqli_query($con, $query);
			//echo $query;
			if ( !$result ){
				die('Query Failed!');
			}else{
				echo "Se actualizó el contacto!";
			}
		}
	}
}

if( isset( $_POST["admin_name"]) && $_POST["admin_name"] != ""){		
	$admin_name = $_POST["admin_name"];
	$admin_email = $_POST["admin_email"];
	$admin_phone = $_POST["admin_phone"];
	$admin_cargo = $_POST["admin_cargo"];
	$company_camara = $_POST["company_camara"];
	$_SESSION['fedecamaras'] = $_POST["company_pertenece"];
	$query = "SELECT id FROM empresas WhERE id = ".$_SESSION['companyHive'];
	//echo $query;
	$result = mysqli_query($con, $query);
	if ( !$result ) {
		die('Query Failed...');
	}else{		
		if( $_POST['boton'] == "grabar_administracion" ){
			$query = "UPDATE empresas SET  
			admin_nombre= '" .$admin_name . "',  
			admin_email = '". $admin_email . "',  
			admin_telefono = '". $admin_phone . "', 
			admin_cargo = '". $admin_cargo . "'
			WHERE id = " . $_SESSION['companyHive']; 
			//echo $query;
			$result = mysqli_query($con, $query);
			
			if ( !$result ){
				die('Query Failed!');
			}else{
				echo "Se actualizo el administrador de la empresa";
			}
			//session_destroy();
		}
	}
}

if( isset($_POST["company_name"]) && $_POST["company_name"] !="" ){
	$estados = $_POST["estados"];
	if( isset($_POST["ciudades"]) ){
		$ciudades = $_POST["ciudades"];	
	}	
	$company_name = $_POST["company_name"];
	$company_phone = $_POST["company_phone"];   
    $company_rif = $_POST["company_rif"];
    $company_email = $_POST["company_email"];
	if( isset ($company_rif ) && $company_rif!="" ) {
		// validamos que el primer caracter = J
		$letra = strtoupper ( substr ( $company_rif, 0, 1 ) );
		if ($letra != 'J' && $letra != 'V' && $letra != 'E' && $letra != 'G' && $letra != 'P' ){
			//$errores = $errores. "El rif debe comenzar con una letra J.<br>";
            $r++;
			$listaErrores[$r] = "0";
		}
	}
		
	$tipo_infraestructura = $_POST["tipo_infraestructura"];
	$tipo_infraestructura_otro = $_POST["tipo_infraestructura_otro"];
	$area_trabajo = $_POST["area_trabajo"];
	$area_trabajo_otro = $_POST["area_trabajo_otro"];
	$sector_industrial = $_POST["sector_industrial"];
	$sector_industrial_otro = $_POST["sector_industrial_otro"];
	$tipo_organizacion = $_POST["tipo_organizacion"];
	$tipo_organizacion_otro = $_POST["tipo_organizacion_otro"];	
		
	//Comprobamos que los campos no están vacíos
	if(!isset($_POST['estados']) || $_POST['estados'] =="0" ){
		//$errores=$errores. 'Falta por seleccionar de la lista de "Estados"<br>';
		$r++;
		$listaErrores[$r] = "2";
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if(!isset($_POST['ciudades'])  || $_POST['ciudades'] =="0" ){
		//$errores=$errores. 'Falta por seleccionar de la lista de "Ciudades"<br>';
		$r++;
		$listaErrores[$r] = "3";
	}	
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['tipo_infraestructura'] == "0" || $_POST['tipo_infraestructura'] == "" ){
		if($_POST['tipo_infraestructura_otro'] == "" ){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otro tipo de infraestructura.<br>";
			$r++;
			$listaErrores[$r] = "4";
		}
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['area_trabajo'] == "0" || $_POST['area_trabajo'] =="" ){
		if(empty($_POST['area_trabajo_otro'])){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otra area de trabajo.<br>";
			$r++;
			$listaErrores[$r] = "5";
		}
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['sector_industrial'] == "0" || $_POST['sector_industrial'] == "" ){
		if(empty($_POST['sector_industrial_otro'])){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otro sector industrial.<br>";
			$r++;
			$listaErrores[$r] = "6";
		}
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['tipo_organizacion'] == "0" || $_POST['tipo_organizacion'] == "" ){
		if(empty($_POST['tipo_organizacion_otro'])){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otro tipo de organizacion.<br>";
			$r++;
			$listaErrores[$r] = "7";
		}
	}
	
	
	//Comprobamos que los campos no están vacíos
	if(!isset($_POST['empresa_comment']) || $_POST['empresa_comment'] =="" ){
		$empresa_comment = " ";
	}else{
		$empresa_comment = $_POST["empresa_comment"];	
	}
	// Validamos el formulario...
	if(strlen($errores)>0){
		echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
		echo $errores ;
		echo "</div>";
	}else{
		//echo "Formulario validado :)";		
		$id = $company_rif;
		if( isset($_POST['boton']) && $_POST['boton'] == "grabar_empresa" ){
			$query = "SELECT id FROM empresas WhERE id = " . $_SESSION['companyHive'];
			//echo $query;
			$result = mysqli_query($con, $query);
			if ( !$result ) {
				die('Query Failed...');
			}else{					
                $company_rif = str_replace("-","",$company_rif);
                $company_rif = str_replace(".","",$company_rif);
                $company_rif = str_replace("_","",$company_rif);
                $company_rif = str_replace(" ","",$company_rif);
				$query = "UPDATE empresas SET  
				numero_rif = '". $company_rif . "', 
				razon_social = '". $company_name  . "', 
				email_empresa = '". $company_email  . "', 
				telefono_empresa = '". $company_phone  . "',  
				direccion_empresa = '". $company_address . "', 
				pais = 'VE',  
				state = '". $estados . "',  
				ciudad = '". $ciudades . "',   
				tipo_infraestructura = '". $tipo_infraestructura . "',  
				area_trabajo = '". $area_trabajo . "',  
				sector_industrial = '". $sector_industrial . "',  
				tipo_organizacion = '". $tipo_organizacion . "',  
				tipo_infraestructura_otro = '". $tipo_infraestructura_otro  . "',  
				area_trabajo_otro = '". $area_trabajo_otro . "',  
				sector_industrial_otro = '". $sector_industrial_otro . "',  
				tipo_organizacion_otro = '" . $tipo_organizacion_otro . "',  
				pertenece_camara = " . $company_camara  . ", 
				contacto_nombre= '" .$user_name . "', 
				contacto_email= '" .$user_email . "',  
				contacto_telefono= '" .$user_phone . "',  
				comentario = '". $empresa_comment . "'
				WHERE id = " . $_SESSION['companyHive'];	
				//echo $query;
				$result = mysqli_query($con, $query);	
				if ( !$result ){
					die('Query Failed!');
				}
				echo "Se actualizá la empresa";
				//session_destroy();				
			}		
		}
	}	
}
?>