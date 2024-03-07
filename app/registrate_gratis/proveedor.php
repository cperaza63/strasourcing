<?php 
session_start();
include "../partials/header_registrate.php";
include "../config/conexion.php";

$error= "";
$pasa=1;
$pais = "VE";
$alert = "";
$usuario = "";
$telefono = "";
$email = "";
$contacto="";
$empresa = "";
$estado = "";
$ciudad = "";
$asunto = "";
$comentario = "";
$direccion = "";
$website = "";
$mensajeEmail = "";
$ref_rif = "";
$ref2_rif = "";
$ref_razon_social = "";
$ref2_razon_social = "";
$ref_email = "";
$ref2_email = "";
$ref_telefono = "";
$ref2_telefono = "";

if(!isset($_SESSION['pais'])){
	$_SESSION['pais']="";
}
if(!isset($_SESSION['fedecamaras'])){
	$_SESSION['fedecamaras']="";
}

if(!isset($_SESSION['ref_rif'])){
	$_SESSION['ref_rif']="";
}
if(!isset($_SESSION['ref2_rif'])){
	$_SESSION['ref2_rif']="";
}
if(!isset($_SESSION['ref_razon_social'])){
	$_SESSION['ref_razon_social']="";
}
if(!isset($_SESSION['ref2_razon_social'])){
	$_SESSION['ref2_razon_social']="";
}
if(!isset($_SESSION['ref_email'])){
	$_SESSION['ref_email']="";
}
if(!isset($_SESSION['ref2_email'])){
	$_SESSION['ref2_email']="";
}
if(!isset($_SESSION['ref_telefono'])){
	$_SESSION['ref_telefono']="";
}
if(!isset($_SESSION['ref2_telefono'])){
	$_SESSION['ref2_telefono']="";
}
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
	$_SESSION['rifHive'] = $_POST["company_rif"];
	$_SESSION['company_address'] = $_POST["company_address"];
	
	$_SESSION['ref_rif'] = $_POST["ref_rif"];
	$_SESSION['ref2_rif'] = $_POST["ref2_rif"];
	$_SESSION['ref_razon_social'] = $_POST["ref_razon_social"];
	$_SESSION['ref2_razon_social'] = $_POST["ref2_razon_social"];
	$_SESSION['ref_email'] = $_POST["ref_email"];
	$_SESSION['ref2_email'] = $_POST["ref2_email"];
	$_SESSION['ref_telefono'] = $_POST["ref_telefono"];
	$_SESSION['ref2_telefono'] = $_POST["ref2_telefono"];
	
	
	if(!isset($_POST["company_pertenece"])){
		$_SESSION['company_pertenece'] = " ";
	}else{
		$_SESSION['company_pertenece'] = $_POST["company_pertenece"];
	}
		
	if( isset( $_POST["box_int"] ) ) {
		if( $_POST["box_int"] == "X" ){
			$_SESSION['pais'] = $_POST["select_box"];
		}else{
			$_SESSION['pais'] = $_POST["select_pais"];	
			$_SESSION['estados'] = 0;
			$_SESSION['ciudades'] = 0;
		}	
	}else{
		$_SESSION['pais'] = $_POST["select_pais"];	
	}
	
	//echo "=pais=". $_SESSION['pais'];

	$_SESSION['company_camara'] = $_POST["company_camara"];
	
	$_SESSION['admin_name'] = $_POST["admin_name"];
	$_SESSION['admin_email'] = $_POST["admin_email"];
	$_SESSION['admin_phone'] = $_POST["admin_phone"];
	$_SESSION['admin_cargo'] = $_POST["admin_cargo"];
		
	$_SESSION['tipo_infraestructura'] = $_POST["tipo_infraestructura"];
	$_SESSION['tipo_infraestructura_otro'] = $_POST["tipo_infraestructura_otro"];
	$_SESSION['area_trabajo'] = $_POST["area_trabajo"];
	$_SESSION['area_trabajo_otro'] = $_POST["area_trabajo_otro"];
	$_SESSION['sector_industrial'] = $_POST["sector_industrial"];
	$_SESSION['sector_industrial_otro'] = $_POST["sector_industrial_otro"];
	$_SESSION['tipo_organizacion'] = $_POST["tipo_organizacion"];
	$_SESSION['tipo_organizacion_otro'] = $_POST["tipo_organizacion_otro"];
	
	if( isset ( $_POST["company_rif"] ) && $_POST["company_rif"] !="" ) {
		// validamos que el primer caracter = J
		$letra = strtoupper ( substr ( $_POST["company_rif"], 0, 1 ) );
		if ($letra != 'J' && $letra != 'V' && $letra != 'E' && $letra != 'G' && $letra != 'P' ){
			//$errores = $errores. "El rif debe comenzar con una letra J.<br>";
			$r++;
			$listaErrores[$r] = "0";
		}else{
			// Recorremos cada carácter de la cadena
			$cadena = $_POST["company_rif"];
			for($i=1;$i<strlen($cadena);$i++){
				if( $cadena[$i] >=0 && $cadena[$i] <=9 ){
					// pasa
				}else{
					//$errores = $errores. "El resto de la cadena del RIF debe ser numerico.<br>";
					$r++;
					$listaErrores[$r] = "1";
				break;
				}
			}	
		}
	}else{
		//$errores = $errores. "El rif debe tener un valor.<br>";
	}
	
	
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
		$listaErrores[$r] = "4";
	}	
	
		// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['tipo_infraestructura'] == "0" || $_POST['tipo_infraestructura'] == "" ){
		if($_POST['tipo_infraestructura_otro'] == "" ){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otro tipo de infraestructura.<br>";
			$r++;
			$listaErrores[$r] = "4";
		}
	}else{
		$_POST['tipo_infraestructura_otro'] =  "";	
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['area_trabajo'] == "0" || $_POST['area_trabajo'] =="" ){
		if(empty($_POST['area_trabajo_otro'])){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otra area de trabajo.<br>";
			$r++;
			$listaErrores[$r] = "5";
		}
	}else{
		$_POST['area_trabajo_otro'] = "";
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['sector_industrial'] == "0" || $_POST['sector_industrial'] == "" ){
		if(empty($_POST['sector_industrial_otro'])){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otro sector industrial.<br>";
			$r++;
			$listaErrores[$r] = "6";
		}
	}else{
		$_POST['sector_industrial_otro'] = "";	
	}
	
	// Validación del Sistema Operativo: Comprueba si el dato ha sido introducido
	if($_POST['tipo_organizacion'] == "0" || $_POST['tipo_organizacion'] == "" ){
		if(empty($_POST['tipo_organizacion_otro'])){
			//$errores=$errores. "Si no escoje una opcion debe rellenar otro tipo de organizacion.<br>";
			$r++;
			$listaErrores[$r] = "7";
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
		//echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
		//echo $errores ;
		//echo "</div>";
	}else{
		echo "Formulario validado :)";
		$id = $_SESSION['rifHive'];
		$query = "SELECT id, fase FROM proveedores WhERE numero_rif = '$id'";
		echo $query;
		$result = mysqli_query($conexion, $query);
		if ( !$result ) {
			die('Query Failed...');
		}
		else
		{
			$procesado = 0;
			while( $row = mysqli_fetch_array( $result ) ) {
				echo "entre" . $row['id'];
				if ($row['id']  > 0 && $row['fase']  >= 1 ){
					echo "No se agrego, ya en fase 1 " . $row['id'] . " " . $row['fase'];
					$procesado = 1;
					?>
                    <script>
                    window.location="proveedor_paso2.php";
                    </script>
					<?php
					//header("Location: proveedor_paso2.php");
				}else{
					$query = "INSERT into proveedores(
					fase,
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
					admin_nombre, 
					admin_email, 
					admin_telefono, 
					admin_cargo, 
					comentario, 
					estado,
					ref_rif,
					ref2_rif,
					ref_razon_social,
					ref2_razon_social,
					ref_email,
					ref2_email,
					ref_telefono,
					ref2_telefono
					) 
					VALUES (1, 
					'". strtoupper($_SESSION['rifHive']) . "', '" 
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
					. $_SESSION['admin_name'] . "', '" 
					. $_SESSION['admin_email'] . "', '" 
					. $_SESSION['admin_phone'] . "', '" 
					. $_SESSION['admin_cargo']  . "', '"
					. $_SESSION['empresa_comment']  . "', 1, '"
					. $_SESSION['ref_rif']  . "', '"
					. $_SESSION['ref2_rif']  . "', '"
					. $_SESSION['ref_razon_social']  . "', '"
					. $_SESSION['ref2_razon_social']  . "', '"
					. $_SESSION['ref_email']  . "', '"
					. $_SESSION['ref2_email']  . "', '"
					. $_SESSION['ref_telefono']  . "', '"
					. $_SESSION['ref2_telefono']  . "')"; 
					
					//echo $query;
					$result = mysqli_query($conexion, $query);	
					if ( !$result ){
						die('Query Failed!');
					}
					//echo "Se agrego sin problemas 1";
					$procesado = 1;
					?>
                    <script>
                    window.location="proveedor_paso2.php";
                    </script>
					<?php
					//header("Location: proveedor_paso2.php");
				}
			}	
			if($procesado == 0){			
				$query = "INSERT into proveedores(
						fase,
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
						admin_nombre, 
						admin_email, 
						admin_telefono, 
						admin_cargo, 
						comentario, 
						estado,
						ref_rif,
						ref2_rif,
						ref_razon_social,
						ref2_razon_social,
						ref_email,
						ref2_email,
						ref_telefono,
						ref2_telefono
						) 
						VALUES (1, 
						'". $_SESSION['rifHive'] . "', '" 
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
						. $_SESSION['admin_name'] . "', '" 
						. $_SESSION['admin_email'] . "', '" 
						. $_SESSION['admin_phone'] . "', '" 
						. $_SESSION['admin_cargo']  . "', '"
						. $_SESSION['empresa_comment']  . "', 1, '"
						. $_SESSION['ref_rif']  . "', '"
						. $_SESSION['ref2_rif']  . "', '"
						. $_SESSION['ref_razon_social']  . "', '"
						. $_SESSION['ref2_razon_social']  . "', '"
						. $_SESSION['ref_email']  . "', '"
						. $_SESSION['ref2_email']  . "', '"
						. $_SESSION['ref_telefono']  . "', '"
						. $_SESSION['ref2_telefono']  . "')"; 
						echo $query;
				$result = mysqli_query($conexion, $query);	
				if ( !$result ){
					die('Query Failed!');
				}
				//echo "Se agrego sin problemas 2";
				?>
				<script>
                window.location="proveedor_paso2.php";
                </script>
                <?php
                //header("Location: proveedor_paso2.php");
			}
		}		
	}	
}
else
{
	if ( !isset( $_SESSION['user_name'] ) ){
		$_SESSION['user_name'] = "";
		$_SESSION['user_email'] = "";
		$_SESSION['user_phone'] = "";
		
		$_SESSION["company_name"] = "";
		$_SESSION['company_email'] = "";
		$_SESSION['company_phone'] = "";
		$_SESSION['rifHive'] = "";
		$_SESSION['company_address'] = "";
	
		
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
		$_SESSION["empresa_comment"] = "";	
		$_SESSION['ref_rif'] = "";
		$_SESSION['ref2_rif'] = "";
		$_SESSION['ref_razon_social'] = "";
		$_SESSION['ref2_razon_social'] = "";
		$_SESSION['ref_email'] = "";
		$_SESSION['ref2_email'] = "";
		$_SESSION['ref_telefono'] = "";
		$_SESSION['ref2_telefono'] = "";		
	}
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>SISTEMA SPA | registrate gratis</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
	<link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico">

	<meta name="theme-color" content="#712cf9">


    <style>
		.center-h {
		  justify-content: center;
		}
		.center-v {
		  align-items: center;
		}
		
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
    <style type="text/css">
    .bi1 {        vertical-align: -.125em;
        fill: currentColor;
}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){

            $("#sel_depart").change(function(){
                var deptid = $(this).val();

                $.ajax({
                    url: '../llenar_contacto/getUsers.php',
                    type: 'post',
                    data: {depart:deptid},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#sel_user").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];

                            $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

                        }
                    }
                });
            });

        });
    </script>

  	</head>
  	<body class="center-h center-v" style="background-color:#E6E6E6;">
        <br><br><br><br>
        <div class="container" style="background-color:white;">
          <header class="blog-header lh-1 py-3">
            <div class="row flex-nowrap justify-content-end align-items-end">
              <div class="col-4 d-flex justify-content-end align-items-end">
                <a class="btn btn-sm btn-outline-secondary" href="../outside.php">Regresar al Menu principal</a>
              </div>
            </div>
          </header>
        </div>
        <div class="container" style="background-color:white;">
          <header class="blog-header lh-1 py-3">
          <h5 class="display-4 fst-italic">Registración del PROVEEDOR </h5>
        </div>
    <main class="container"  style="background-color:white;">   
      <form action="" method="post">
        <div class="row g-5 center-h center-v" >
          <div class="col-md-8" style="background-color:white;">
            <div class="position-sticky" style="top: 2rem;">
              <div class="p-4 mb-3 bg-secondary-subtle rounded">
                <h4 class="fst-italic">Paso 1 de 4 - Información de quien registra la empresa      </h4>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi-person-circle"></i></span>
                  <input name="user_name" type="text" required class="form-control" placeholder="escriba su nombre" title="escriba su nombre" value="<?php echo $_SESSION['user_name']; ?>" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-envelope-at"></i></span>
                  <input name="user_email" type="email" required class="form-control" placeholder="escriba su e-mail" title="escriba su e-mail" value="<?php echo $_SESSION['user_email']; ?>" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-telephone-x"></i></span>
                  <input name="user_phone" type="text" required class="form-control" placeholder="escriba su número celular" value="<?php echo $_SESSION['user_phone']; ?>" aria-describedby="basic-addon1">
                </div>
                </p>
              </div>
            </div>
          </div>
        <div class="col-md-8" style="background-color:white;">
            
          <div class="p-4 mb-3 bg-secondary-subtle rounded">
                <h4 class="fst-italic">Paso 2 de 4 - Información de la Empresa          </h4>
              <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-building"></i></span>
                    <input name="company_name" value="<?php echo $_SESSION["company_name"]; ?>" type="text" required class="form-control" placeholder="escriba la razón social del negocio"  aria-describedby="basic-addon1">
            </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="company_email" type="email" required class="form-control" placeholder="escriba e-mail oficial del negocio" value="<?php echo $_SESSION['company_email'];?>" aria-describedby="basic-addon1">
                  </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="company_phone" type="text" required class="form-control" placeholder="escriba su número de telefono o celular de contacto con el negocio" value="<?php echo $_SESSION['company_phone'];?>" aria-describedby="basic-addon1">
                  </div>
    				
                  <span>
				  <?php 
                    foreach ($listaErrores as $i => $value) {
                        if ($listaErrores[$i] == "0" || $listaErrores[$i] == "1"){
                            echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
                            echo $array[$listaErrores[$i]] ;
                            echo "</div>";
                        }
                    }
                    ?>
                  </span>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rif</span>
                    <input name="company_rif" value="<?php echo $_SESSION['rifHive']; ?>" type="text" required class="form-control" placeholder="escriba su número de RIF del negocio"  aria-describedby="basic-addon1">
                  </div>
                  
                  <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-checklist"></i></span>
                      <textarea size="5" name="empresa_comment" id="empresa_comment" class="form-control" title="Campo breve explicación de su empresa" placeholder="Campo breve explicación de su empresa"></textarea>
                  </div>
                  
                  <div class="input-group mb-3">
                      <input name="box_int" type="checkbox" class="form-check-input" id="box_int" title="Si su empresa esta fuera de Venezuela" onchange="functionInt()" value="X" checked="checked" />
                      <label class="form-check-label" for="internacional">
                        <strong>ESTA EMPRESA ESTA EN VENEZUELA</strong>	
                      </label>
                  </div>
            <p> 
                  
            <div id="lista_paises" class="card">
                <select name="select_pais" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                <?php
                  $query=$conexion->query("SELECT country_code, country_name FROM tbl_paises ORDER BY country_name ASC");
                    $countries = array();
                    while( $t = $query->fetch_object()){ $countries[]=$t; }
                    if(count($countries)>0){
                        print "<option value='0'>-- Seleccione Pais de origen -- </option>";
                        foreach ($countries as $t) {
                            if ( $_SESSION['pais'] == $t->country_code ){
                                $seleccion = " selected ";	
                            }else{
                                $seleccion = "";	
                            }
                            print "<option value='$t->country_code' $seleccion> $t->country_name </option>";
                        }
                    }else{
                        print "<option value=''>-- NO HAY DATOS --</option>";
                    }
                  ?>
              </select>
        </div>
                  
                  <div id="card" class="card">
                      <div class="card-header text-white" style="background-color: #5B00B7;"><strong>Establezca la ubicación de la empresa</strong> </div>
                      <div class="card-body" style=" border:1px solid #00AA9E">
    
                      <div class="form-group">
                          <label class="small mb-1" for="pais_edo_city"><i class="fas fa-building"></i> <strong>Dirección de su negocio</strong></label>
                         <div id="lista_paises" class="card">
                           <select name="select_box" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                            <?php
                              $query=$conexion->query("SELECT country_code, country_name FROM tbl_paises where country_code='VE' ORDER BY country_name ASC");
                                $states = array();
                                while( $r = $query->fetch_object()){ $states[]=$r; }
                                if(count($states)>0){
                                    foreach ($states as $s) {
                                        if ( $_SESSION['pais'] == $s->country_code ){
                                            $seleccion = " selected ";	
                                        }else{
                                            $seleccion = "";	
                                        }
                                        print "<option value='$s->country_code' $seleccion> $s->country_name </option>";
                                }
                                }else{
                                print "<option value=''>-- NO HAY DATOS --</option>";
                                }
                              ?>
                          </select>
                    </div>
                      </div>
                      
                      <span>
					  <?php 
                        foreach ($listaErrores as $i => $value) {
                            if ($listaErrores[$i] == "2"){
                                echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
                                echo $array[$listaErrores[$i]] ;
                                echo "</div>";
                            }
                        }
                      ?>
                      </span>
                      <div><strong>Estados </strong></div>
                      <select class="form-control" id="sel_depart" name="estados">
                          <option value="0">- Seleccione Estado -</option>
                          <?php 
                          // llamamos a los registros
                          $sql_department = "SELECT * FROM estados";
                          $department_data = mysqli_query($conexion,$sql_department);
                          while($row = mysqli_fetch_assoc($department_data) ){
                            $departid = $row['codigo'];                        
                            $depart_name = $row['state'];
                            if ( $_SESSION['estados'] == $departid ){
                                $seleccion = " selected ";	
                            }else{
                                $seleccion = "";	
                            }
                            // Opciones con registros
                            echo "<option value='".$departid."' ". $seleccion ." >".$depart_name."</option>";
                          }
                          ?>
                      </select>
                      <div class="clear"></div>
                      <hr>
                      
                       <span>
					  <?php 
                        foreach ($listaErrores as $i => $value) {
							if ($listaErrores[$i] == "3"){
								echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
								echo $array[$listaErrores[$i]] ;
								echo "</div>";
							}
						}
					  ?>
					  </span>
                      <div><strong>Ciudades</strong> </div>
                      
                      <?php 
                        //echo "=edo=". $_SESSION['estados'];
                      ?>
                      
                      <select class="form-control" id="sel_user" name="ciudades">
                          <option value="0">- Seleccione Ciudad -</option>
                          <?php 
                          // llamamos a los registros
                          $sql_department = "SELECT codigo,city FROM ciudades WHERE state*1=".$_SESSION['estados']*1;
                          $department_data = mysqli_query($conexion,$sql_department);
                          while($row = mysqli_fetch_assoc($department_data) ){
                            $userid = $row['codigo'];
                            $name = $row['city'];
                            if ( $_SESSION['ciudades']*1 == $userid*1 ){
                                $seleccion = " selected ";	
                            }else{
                                $seleccion = "";	
                            }
                            // Opciones con registros
                            echo "<option value='".$userid."' ". $seleccion ." >".$name."</option>";
                          }
                          ?>
                      </select>
                      </div>
                  </div>
                  
                  </p>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Dirección del negocio</span>
                    <textarea name="company_address" cols="50" rows="2" required class="form-control" placeholder="Coloque la dirección de acuerdo a la razon social del Rif" aria-label="With textarea" value="<?php echo ""; ?>"><?php echo $_SESSION['company_address']; ?></textarea>
              </div>
    
                  <div class="input-group mb-3">
                    
                   <!--
                    <div class="form-check form-switch">
                     checked 
                      <input id="pertenece_camara" onchange="functionInt()" name="company_pertenece" type="checkbox" class="form-check-input" value="<?php echo ""; ?>">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Pertenece a alguna Cámara?</label>
                    </div>-->
                   <select class="form-control" id="fedecamaras" name="company_camara">
                      <option value="0">- No pertenecemos a ninguna Cámara -</option>
                      <?php 
                      // llamamos a los registros
                      $sql_department = "SELECT * FROM tabla_control where tipo=18 order by nombre";
                      $department_data = mysqli_query($conexion, $sql_department);
                      while($row = mysqli_fetch_assoc($department_data) ){
                        $departid = $row['id'];                        
                        $depart_name = $row['nombre'];
                        if ( $_SESSION['fedecamaras'] == $departid ){
                            $seleccion = " selected ";	
                        }else{
                            $seleccion = "";	
                        }
                        // Opciones con registros
                        echo "<option value='".$departid."' ". $seleccion ." >".$depart_name."</option>";
                      }
                      ?>
                    </select>
                    </div> 
    
    			
                 	<div class="input-group mb-3 ">
                    	<span>
						  <?php 
                            foreach ($listaErrores as $i => $value) {
                                if ($listaErrores[$i] == "4"){
                                    echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
                                    echo $array[$listaErrores[$i]] ;
                                    echo "</div>";
                                }
                            }
                          ?>
                        </span>
                        <div class="col-md-6">
                          <select name="tipo_infraestructura" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                            <?php
                              $query=$conexion->query("select * from tabla_control where tipo=3 order by nombre");
                                $states = array();
                                while( $r = $query->fetch_object()){ $states[]=$r; }
                                if(count($states)>0){
                                    print "<option value=''>-- Seleccione Tipo de Infraestructura -- </option>";
                                    foreach ($states as $s) {
                                        if ( $_SESSION['tipo_infraestructura'] == $s->id ){
                                            $seleccion = " selected ";	
                                        }else{
                                            $seleccion = "";	
                                        }
                                        print "<option value='$s->id' $seleccion> $s->nombre </option>";
                                }
                                }else{
                                print "<option value=''>-- NO HAY DATOS --</option>";
                                }
                              ?>
                          </select>
                        
                          <input name="tipo_infraestructura_otro" value="<?php echo ""; ?>" type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                        
                        </div>
    
                        <span>
                          <?php 
                            foreach ($listaErrores as $i => $value) {
                                if ($listaErrores[$i] == "5"){
                                    echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
                                    echo $array[$listaErrores[$i]] ;
                                    echo "</div>";
                                }
                            }
                          ?>
                        </span>
                        <div class="col-md-6">
                          <select name="area_trabajo" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                            <?php
                              $query=$conexion->query("select * from tabla_control where tipo=4 order by nombre");
                                $states = array();
                                while( $r = $query->fetch_object()){ $states[]=$r; }
                                if(count($states)>0){
                                    print "<option value=''>-- Seleccione Area de trabajo -- </option>";
                                    foreach ($states as $s) {
                                        if ( $_SESSION['area_trabajo'] == $s->id ){
                                            $seleccion = " selected ";	
                                        }else{
                                            $seleccion = "";	
                                        }
                                        print "<option value='$s->id' $seleccion> $s->nombre </option>";
                                }
                                }else{
                                print "<option value=''>-- NO HAY DATOS --</option>";
                                }
                              ?>
                          </select>
        
                          <input name="area_trabajo_otro" value="<?php echo ""; ?>" type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                          
                        </div>
                	</div>
                	
                    
                    <div class="input-group mb-3 ">
                        <span>
                          <?php 
                            foreach ($listaErrores as $i => $value) {
                                if ($listaErrores[$i] == "6"){
                                    echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
                                    echo $array[$listaErrores[$i]] ;
                                    echo "</div>";
                                }
                            }
                          ?>
                        </span>
                        <div class="col-md-6">
                          <select name="sector_industrial" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                           <?php
                              $query=$conexion->query("select * from tabla_control where tipo=1 order by nombre");
                                $states = array();
                                while( $r = $query->fetch_object()){ $states[]=$r; }
                                if(count($states)>0){
                                    print "<option value=''>-- Seleccione Sector Industrial -- </option>";
                                    foreach ($states as $s) {
                                        if ( $_SESSION['sector_industrial'] == $s->id ){
                                            $seleccion = " selected ";	
                                        }else{
                                            $seleccion = "";	
                                        }
                                        print "<option value='$s->id' $seleccion> $s->nombre </option>";
                                }
                                }else{
                                print "<option value=''>-- NO HAY DATOS --</option>";
                                }
                              ?>
                          </select>
                          <input name="sector_industrial_otro" value="<?php echo ""; ?>" type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                        </div>
                    
                        <span>
                          <?php 
                            foreach ($listaErrores as $i => $value) {
                                if ($listaErrores[$i] == "7"){
                                    echo "<div style='color:red;>' Se han detectado los siguientes errores:<br>";
                                    echo $array[$listaErrores[$i]] ;
                                    echo "</div>";
                                }
                            }
                          ?>
                          </span>
                        <div class="col-md-6">
                            <select name="tipo_organizacion" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                                <?php
                              $query=$conexion->query("select * from tabla_control where tipo=2 order by nombre");
                                $states = array();
                                while( $r = $query->fetch_object()){ $states[]=$r; }
                                if(count($states)>0){
                                    print "<option value=''>-- Seleccione Tipo de organización -- </option>";
                                    foreach ($states as $s) {
                                        if ( $_SESSION['tipo_organizacion'] == $s->id ){
                                            $seleccion = " selected ";	
                                        }else{
                                            $seleccion = "";	
                                        }
                                        print "<option value='$s->id' $seleccion> $s->nombre </option>";
                                }
                                }else{
                                print "<option value=''>-- NO HAY DATOS --</option>";
                                }
                              ?>
                            </select>
                            <input name="tipo_organizacion_otro" value="<?php echo ""; ?>" type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                        </div>
              		</div>
              </p>  
          </div>
        </div>
    
          <div class="col-md-8" style="background-color:white;">
            <div class="position-sticky" style="top: 2rem;">
              <div class="position-sticky" style="top: 2rem;">
              
              <div class="p-4 mb-3 bg-secondary-subtle rounded">
                <h4 class="fst-italic">Paso 3 de 4 - De quien representa a la empresa            </h4>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi-person-circle"></i></span>
                    <input name="admin_name" type="text" required class="form-control" placeholder="escriba el nombre" value="<?php echo $_SESSION['admin_name']; ?>" aria-describedby="basic-addon1">
                </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                    <input name="admin_cargo" type="text" required class="form-control" placeholder="cargo en la empresa" value="<?php echo $_SESSION['admin_cargo']; ?>" aria-describedby="basic-addon1">
                  </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="admin_email" type="email" required class="form-control" placeholder="escriba e-mail oficial" value="<?php echo $_SESSION['admin_email']; ?>" aria-describedby="basic-addon1">
                  </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="admin_phone" type="text" required class="form-control" placeholder="escriba número telefono" value="<?php echo $_SESSION['admin_phone']; ?>" aria-describedby="basic-addon1">
                  </div>
                </p>
              </div>
              
              <hr>
              
              <div class="p-4 mb-3 bg-secondary-subtle rounded">
                <h4 class="fst-italic">Paso 4 de 4 - Referencias de empresa clientes           </h4>
                <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1">Rif</span>
                    <input name="ref_rif" type="text" required class="form-control" placeholder="escriba el rif de la empresa 1" 
                    value="<?php echo $_SESSION['ref_rif']; ?>" aria-describedby="basic-addon1">
                    
                    <span class="input-group-text" id="basic-addon1">Rif</span>
                    <input name="ref2_rif" type="text" required class="form-control" placeholder="escriba el rif de la empresa 2" 
                    value="<?php echo $_SESSION['ref2_rif']; ?>" aria-describedby="basic-addon1">
                    
                </div>
    
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                    <input name="ref_razon_social" type="text" required class="form-control" placeholder="nombre de la empresa" 
                    value="<?php echo $_SESSION['ref_razon_social']; ?>" aria-describedby="basic-addon1">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                    <input name="ref2_razon_social" type="text" required class="form-control" placeholder="nombre2 de la empresa" 
                    value="<?php echo $_SESSION['ref2_razon_social']; ?>" aria-describedby="basic-addon1">
                    
                  </div>
    
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="ref_email" type="email" required class="form-control" placeholder="escriba e-mail oficial" 
                    value="<?php echo $_SESSION['ref_email']; ?>" aria-describedby="basic-addon1">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="ref2_email" type="email" required class="form-control" placeholder="escriba e-mail2 oficial" 
                    value="<?php echo $_SESSION['ref2_email']; ?>" aria-describedby="basic-addon1">
                    
                  </div>
    
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="ref_telefono" type="text" required class="form-control" placeholder="escriba número telefono" 
                    value="<?php echo $_SESSION['ref_telefono']; ?>" aria-describedby="basic-addon1">
					
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="ref2_telefono" type="text" required class="form-control" placeholder="escriba número telefono2" 
                    value="<?php echo $_SESSION['ref2_telefono']; ?>" aria-describedby="basic-addon1">
                  
                  </div>
                </p>
              </div>
              
              <hr>
              
              <h4 class="fst-italic">
                <input type="hidden" name="accion" value="paso2"/>
              </h4>
              <p>&nbsp;</p>
              <h4 class="fst-italic">Seguir con página 2          </h4>
              <button type="submit" class="btn btn-secondary" style="background-color:#5B00B7;">grabar, Ir Página 2</button>
              <a class="btn btn-sm btn-outline-secondary" href="../outside.php">Regresar al Menu Principal</a>
              <h4 class="fst-italic"><br>
                <br>
              </h4>
              <hr>
              <br><br>
            </div>
          </div>
        </div>
      </form>
    
    </main>
<br>
<footer align="center" class="blog-footer" style="background-color:black; color:white;">
 Todos los drechos reservados <a href="https://strasourcing.com/">StraSourcing.com</a> por <a href="https://ciudadhive.com">@CP&JCL</a>.
  <p>
    <a href="#">Ir arriba</a>
  </p>
</footer>
	
	
    <script>
	function functionInt() {
		
		var x = document.getElementById("box_int");
		var y = document.getElementById("card");

		var q = document.getElementById("lista_paises");
		
		var z = document.getElementById("pertenece_camara");
		var w = document.getElementById("company_camara");
		
		console.log("valor", x.checked);
		if (x.checked == false){
			y.style.display = "none";
			q.style.display = "block";
			//y.style.visibility = "visible"; // show
		}else{
			y.style.display = "block";
			q.style.display = "none";
			//y.style.visibility = "hidden"; // hide;
		}
		
		if (z.checked == false){
			w.style.display = "none";
		}else{
			w.style.display = "block";
		}
		
	}
	document.getElementById("company_camara").style.display = "none";
	document.getElementById("lista_paises").style.display = "none";
	</script>

  </body>
</html>
