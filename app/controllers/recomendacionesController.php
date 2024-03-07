<?php 
session_start();
//include "../partials/header_registrate.php";
include "../config/conexion.php";
$error= "";
$pasa=1;

$_SESSION['numero_rif']="";	

//Declaramos una variable para almacenar errores y mostrarlos después
$errores =""; 

if( isset($_POST["company_name"])){
	$_SESSION['estados'] = $_POST["estados"];
	if( isset($_POST["ciudades"]) ){
		$_SESSION['ciudades'] = $_POST["ciudades"];	
	}
	
	$_SESSION['user_name'] = $_POST["user_name"];
	$_SESSION['user_email'] = $_POST["user_email"];
	$_SESSION['user_phone'] = $_POST["user_phone"];
	
	$_SESSION["company_name"] = $_POST["company_name"];
	$_SESSION['company_email'] = $_POST["company_email"];
	$_SESSION['company_phone'] = $_POST["company_phone"];
	$_SESSION['numero_rif'] = $_POST["company_rif"];
	$_SESSION['company_address'] = $_POST["company_address"];
	$_SESSION['pais'] = "VE";
	
	if(!isset($_POST["company_pertenece"])){
		$_SESSION['company_pertenece'] = " ";
	}else{
		$_SESSION['company_pertenece'] = $_POST["company_pertenece"];
	}

	$_SESSION['company_camara'] = $_POST["company_camara"];
		
	$_SESSION['tipo_infraestructura'] = $_POST["tipo_infraestructura"];
	$_SESSION['tipo_infraestructura_otro'] = $_POST["tipo_infraestructura_otro"];
	$_SESSION['area_trabajo'] = $_POST["area_trabajo"];
	$_SESSION['area_trabajo_otro'] = $_POST["area_trabajo_otro"];
	$_SESSION['sector_industrial'] = $_POST["sector_industrial"];
	$_SESSION['sector_industrial_otro'] = $_POST["sector_industrial_otro"];
	$_SESSION['tipo_organizacion'] = $_POST["tipo_organizacion"];
	$_SESSION['tipo_organizacion_otro'] = $_POST["tipo_organizacion_otro"];

	//Comprobamos que los campos no están vacíos
	if(!isset($_POST['estados']) || $_POST['estados'] =="0" ){
		$errores=$errores. 'Falta por seleccionar de la lista de "Estados"<br>';
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if(!isset($_POST['ciudades'])  || $_POST['ciudades'] =="0" ){
		$errores=$errores. 'Falta por seleccionar de la lista de "Ciudades"<br>';;
	}	
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['tipo_infraestructura'] == "0" || $_POST['tipo_infraestructura'] == "" ){
		if($_POST['tipo_infraestructura_otro'] == "" ){
			$errores=$errores. "Si no escoje una opcion debe rellenar otro tipo de infraestructura.<br>";
		}
	}else{
		$_POST['tipo_infraestructura_otro'] =  "";	
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['area_trabajo'] == "0" || $_POST['area_trabajo'] =="" ){
		if(empty($_POST['area_trabajo_otro'])){
			$errores=$errores. "Si no escoje una opcion debe rellenar otra area de trabajo.<br>";
		}
	}else{
		$_POST['area_trabajo_otro'] = "";
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['sector_industrial'] == "0" || $_POST['sector_industrial'] == "" ){
		if(empty($_POST['sector_industrial_otro'])){
			$errores=$errores. "Si no escoje una opcion debe rellenar otro sector industrial.<br>";
		}
	}else{
		$_POST['sector_industrial_otro'] = "";	
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['tipo_organizacion'] == "0" || $_POST['tipo_organizacion'] == "" ){
		if(empty($_POST['tipo_organizacion_otro'])){
			$errores=$errores. "Si no escoje una opcion debe rellenar otro tipo de organizacion.<br>";
		}
	}else{
		$_POST['tipo_organizacion_otro'] = "";	
	}
	
	//Comprobamos que los campos no están vacíos
	if(!isset($_POST['empresa_comment']) || $_POST['empresa_comment'] =="" ){
		$_SESSION["empresa_comment"] = " ";
	}else{
		$_SESSION["empresa_comment"] = $_POST["empresa_comment"];	
	}
	
	// Validamos el formulario...
	if(strlen($errores)>0){
		echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
		echo $errores ;
		echo "</div>";
	}else{
		echo "Formulario validado :)";
		$siHay = 0;
		
		// procedemos a crear el detalle de categorias
		
		if (isset($_POST['accion']) && $_POST['accion'] == "incluir"){
			$lista_cat = $_POST["categorias"]; 
			//recorremos el array de categorias seleccionadas
			for ($i=0;$i<count($lista_cat);$i++)    
			{     
				//echo "<br> Categorias " . $i . ": " . $lista_cat[$i];
				// borro las categorias
				$query = "DELETE FROM solicitud_categorias WhERE categoria = ".  $lista_cat[$i] . 
				" and rif='" . $_SESSION['numero_rif'] ."' and idCompany = " . $_SESSION['companyHive'];
				//echo $query;
				$result = mysqli_query($conexion, $query);
				// creo los registros de categorias
				$query = "SELECT * FROM solicitud_categorias WhERE categoria = ".  $lista_cat[$i] . 
				" and rif='" . $_SESSION['numero_rif'] ."' and idCompany = " . $_SESSION['companyHive'];
				//echo $query;
				$result = mysqli_query($conexion, $query);
				if ( !$result ) {
					die('Query Failed...');
				}else{
					$siCat = 0;
					while( $row = mysqli_fetch_array( $result ) ) {
						$siCat = 1;
					}
					if( $siCat == 0){
						$query = "INSERT into solicitud_categorias(rif, idCompany, categoria) 
						VALUES ('" . $_SESSION['numero_rif'] ."', " . $_SESSION['companyHive'] . ", " . $lista_cat[$i] . ")"; 
						//echo $query;
					
						$result = mysqli_query($conexion, $query);	
						if ( !$result ){
							die('Query Failed!');
						}
						echo "Se agrego categoria sin problemas";
					}
				}	
			} 	
		}
		
		if (isset($_POST['accion']) && $_POST['accion'] == "grabar_comprador"){
			$id = $_SESSION['numero_rif'];
			$query = "SELECT id FROM empresas WhERE numero_rif = '$id'";
			//echo $query;
			$result = mysqli_query($conexion, $query);
			if ( !$result ) {
				die('Query Failed...');
			}else{
				while( $row = mysqli_fetch_array( $result ) ) {
					$siHay =  1;
					?>
					<script>
						alert("La solicitud no pudo ser creada debido a que esta empresa ya se encuentra registrada, si tiene alguna duda por favor no dude en contactarnos. el proceso sera cancelada");
                    </script>
					<?php
				}
				if ( $siHay == 0 ){
					$query = "INSERT into empresas(
					numero_rif, 
					razon_social, 
					email_empresa, 
					telefono_empresa, 
					direccion_empresa, 
					pais, 
					state, 
					ciudad, 
					tipo_infraestructura, 
					area_trabajo, 
					sector_industrial, 
					tipo_organizacion, 
					tipo_infraestructura_otro, 
					area_trabajo_otro, 
					sector_industrial_otro, 
					tipo_organizacion_otro, 
					pertenece_camara, 
					contacto_nombre, 
					contacto_email, 
					contacto_telefono, 
					comentario, 
					estado) 
					VALUES (
					'". $_SESSION['numero_rif'] . "', '" 
					. $_SESSION['company_name'] ."', '"
					. $_SESSION['company_email'] . "', '" 
					. $_SESSION['company_phone'] . "', '" 
					. $_SESSION['company_address'] . "', '" 
					. $_SESSION['pais'] . "', '" 
					. $_SESSION['estados'] . "', '" 
					. $_SESSION['ciudades'] . "', '" 
					. $_SESSION['tipo_infraestructura'] . "', '" 
					. $_SESSION['area_trabajo'] . "', '" 
					. $_SESSION['sector_industrial'] . "', '" 
					. $_SESSION['tipo_organizacion'] . "', '" 
					. $_SESSION['tipo_infraestructura_otro'] . "', '" 
					. $_SESSION['area_trabajo_otro'] . "', '" 
					. $_SESSION['sector_industrial_otro'] . "', '" 
					. $_SESSION['tipo_organizacion_otro'] . "', '" 
					. $_SESSION['company_camara'] . "', '" 
					. $_SESSION['user_name'] . "', '" 
					. $_SESSION['user_email'] . "', '" 
					. $_SESSION['user_phone'] . "', '" 
					. $_SESSION['empresa_comment']  . "', 
					1)"; 
					//echo $query;
				
					$result = mysqli_query($conexion, $query);	
					if ( !$result ){
						die('Query Failed!');
					}else{	
						?>
						<script>
                            alert("La solicitud de recomendacion a la empresa ha sido creada con exito...");
							window.parent.location="http://localhost/strasourcing/app/recomendaciones.php";
                        </script>
                        <?php					
					}	
				}			
			}	
		}	
	}	
}else{
	if( !isset($_POST["company_name"])){
		$_SESSION['user_name'] = "";
		$_SESSION['user_email'] = "";
		$_SESSION['user_phone'] = "";
		
		$_SESSION["company_name"] = "";
		$_SESSION['company_email'] = "";
		$_SESSION['company_phone'] = "";
		$_SESSION['rifHive'] = "";
		$_SESSION['company_address'] = "";
	
		$_SESSION['empresa_comment'] = "";
		$_SESSION['company_pertenece'] = "";
		$_SESSION['company_camara'] = "";
		
		$_SESSION['admin_name'] = "";
		$_SESSION['admin_email'] = "";
		$_SESSION['admin_phone'] = "";
		$_SESSION['admin_cargo'] = "";
			
		$_SESSION['estados'] = 0;
		$_SESSION['ciudades'] = 0;
		$_SESSION['tipo_infraestructura'] = 0;
		$_SESSION['tipo_infraestructura_otro'] = "";
		$_SESSION['area_trabajo'] = 0;
		$_SESSION['area_trabajo_otro'] = "";
		$_SESSION['sector_industrial'] = 0;
		$_SESSION['sector_industrial_otro'] = "";
		$_SESSION['tipo_organizacion'] = 0;
		$_SESSION['tipo_organizacion_otro'] = "";
	}
}
?>