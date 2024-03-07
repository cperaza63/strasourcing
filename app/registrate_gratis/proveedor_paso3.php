<?php 
session_start();

include_once '../config/database.php';
$database = new Database ();
$db = $database->getConnection ();

include "../partials/header_registrate.php";
include "../config/conexion.php";

include_once '../objects/tablaControl.php';
$tabla_control = new Tabla_Control ( $db );
$plan="";
$error="";
$marca=0;
$tipo_empresa = 0;
$categoria=0;
$subcategoria=0;
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

//
// mientras, solo pruebas
//$_SESSION['rifHive'] = "J-22222222-9";
$rif_proveedor= $_SESSION['rifHive'];
//
//

if ( !isset($_SESSION['rifHive'])) {
	$_SESSION['rifHive'] = "0";
}else{
	$rif_proveedor = $_SESSION['rifHive'];	
}

if( isset($_POST["proveedor_web"])){
	
	$_SESSION["proveedor_web"] = $_POST["proveedor_web"] != "" ? $_POST["proveedor_web"]: "http://";
	$_SESSION['instagram'] = $_POST["instagram"] != "" ? $_POST["instagram"]: "http://";
	$_SESSION['facebook'] = $_POST["facebook"] != "" ? $_POST["facebook"]: "http://";
	$_SESSION['twitter'] = $_POST["twitter"] != "" ? $_POST["twitter"]: "http://";
	$_SESSION['youtube'] = $_POST["youtube"] != "" ? $_POST["youtube"]: "http://";
	$_SESSION["linkedin"] = $_POST["linkedin"] != "" ? $_POST["linkedin"]: "http://";
	$_SESSION['tiktok'] = $_POST["tiktok"] != "" ? $_POST["tiktok"]: "http://";
	$_SESSION['plan'] = $_POST["plan"] != "" ? $_POST["plan"]: "B";
	// grabo y me salgo
	
	$query = "UPDATE proveedores SET proveedor_web = '" .$_SESSION["proveedor_web"]
	. "', instagram = '" .$_SESSION["instagram"]. "', facebook = '" .$_SESSION["facebook"]. "', twitter = '" 
	.$_SESSION["twitter"]. "', youtube = '" .$_SESSION["youtube"]. "', linkedin = '" .$_SESSION["linkedin"]
	. "', tiktok = '" .$_SESSION["tiktok"]. "', plan = '" . $_SESSION["plan"] . "' WHERE numero_rif = '$rif_proveedor'";
	
	//echo $query;
	
	$result = mysqli_query($conexion, $query);	
	if ( !$result ){
		die('Query Failed!');
	}
	echo "Se actualizo sin problemas";
	
	
	// preparamos los datos del email de respuesta
	$email = $_SESSION['user_email'];
	$contacto = $_SESSION['user_name'];
	$asunto = "Gracias por registrar su empresa como proveedor al sistema de Strasourcing, estaremos en contacto con Usted tan pronto como sea posible...";
	$mensajeEmail = "Usted se ha registrado al sistema Strasourcing como Proveedor: " . $_SESSION['company_name'] . 
	"<br>Telefono: " . $_SESSION['admin_phone']. "<br>Email: ". $_SESSION['admin_email'] . "<br><br>Atencion: <br>Nuestro proceso de registro es gratis, un asesor loc contactara para continuar con el proceso de adjudicacion de codigo definitivo en el portal de Strasourcing.<br>Para ello debemos revisar toda su informacion y hacer contacto en fisico con el administrador de la empresa....";
	$retorno = "http://localhost/strasourcing/app/outside.php";
	
	session_destroy()
	?>
	<script>
       //var mensaje="*** ATENCION *** La solicitud ha sido agregada con exito, Usted recibirá una notificación por email con las credenciales para que pueda  acceder a su area de trabajo y asi comenzar a usar el sistema de STRASOURCING...";	  
	   alert("La solicitud ha sido agregada con exito, Usted recibirá una notificación por email con las credenciales para que pueda  accesder a su area de trabajo y asi comenzar a usar el sistemde StraSourcing...");
	   window.location="http://localhost/strasourcing/app/enviarcorreo/index.php?email=<?php echo $email; ?>&contacto=<?php echo $contacto; ?>&usuario=<?php echo $_SESSION['user_name']; ?>&asunto=<?php echo $asunto; ?>&mensaje=<?php echo $mensajeEmail?>&retorno=http://localhost/strasourcing/app/outside.php";	
	   //window.location="http://localhost/STRASOURCING/app/outside.php?mensaje=" + mensaje;
    </script>
    <?php
}else{
	$_SESSION["proveedor_web"] = "";
	$_SESSION['instagram'] = "";
	$_SESSION['facebook'] = "";
	$_SESSION['twitter'] = "";
	$_SESSION['youtube'] = "";
	$_SESSION["linkedin"] = "";
	$_SESSION['tiktok'] = "";
}

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>SISTEMA SPA | registrate gratis</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
	<link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico">
    <!--  BEGIN CUSTOM STYLE FILE  -->

    <link href="http://localhost/STRASOURCING/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    
    <!--  BEGIN SWEETALERT STYLE FILE  -->
    <link href="http://localhost/STRASOURCING/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/STRASOURCING/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/STRASOURCING/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
	<!--  END SWEETALERT STYLE FILE  -->
	
    <script src="http://localhost/STRASOURCING/plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="http://localhost/STRASOURCING/plugins/highlight/highlight.pack.js"></script>
    <script src="http://localhost/STRASOURCING/assets/js/scrollspyNav.js"></script>
    <script src="http://localhost/STRASOURCING/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="http://localhost/STRASOURCING/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END OTHERS STYLES -->
    
    <!-- BEGIN JQUERY 3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- END PAGE JQUERY 3.3.1 -->
    
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
  <body style="background-color:#E6E6E6;">
    	<br><br><br><br>
      <div class="container" style="background-color:white;">
        <header class="blog-header lh-1 py-3">
          <div class="row flex-nowrap justify-content-end align-items-end">
            <div class="col-4 d-flex justify-content-end align-items-end">
              <a class="btn btn-sm btn-outline-secondary" href="../outside.php">Regresar al Menu principal</a>
            </div>
          </div>
        </header>

		<main class="container"  >
           <form action="" method="post">
              <div class="row g-12 center-h center-v">
                  <!-- PASO #1 -->
                    <div class="col-md-9" style="background-color:white;">
                      
                      <div class="p-4 mb-3 bg-secondary-subtle rounded">
                          <h4 class="fst-italic">Información de la Empresa - PARTE 3 de 5 - Rif <?php echo $rif_proveedor; ?></h4>
                        <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-globe2"></i></span>
                              <input name="proveedor_web" value="<?php echo $_SESSION['proveedor_web'] ; ?>" type="text" class="form-control" placeholder="coloque la pagian web del negocio" aria-describedby="basic-addon1">
                            </div>
                            <hr>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-instagram"></i></i></span>
                              <input  name="instagram" value="<?php echo $_SESSION['instagram'] ; ?>" type="text" class="form-control" placeholder="escriba el link a su cuenta de Instagram" aria-describedby="basic-addon1">
                            </div>
        
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-facebook"></i></span>
                              <input  name="facebook" value="<?php echo $_SESSION['facebook'] ; ?>" type="text" class="form-control" placeholder="escriba el link a su cuenta de Facebook" aria-describedby="basic-addon1">
                            </div>
        
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-twitter"></i></span>
                              <input  name="twitter" value="<?php echo $_SESSION['twitter'] ; ?>" type="text" class="form-control" placeholder="escriba el link a su cuenta de Twitter" aria-describedby="basic-addon1">
                            </div>
        
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-linkedin"></i></span>
                              <input  name="linkedin" value="<?php echo $_SESSION['linkedin'] ; ?>" type="text" class="form-control" placeholder="escriba el link a su cuenta de LinkedIn" aria-describedby="basic-addon1">
                            </div>
        
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-youtube"></i></span>
                              <input  name="youtube" value="<?php echo $_SESSION['youtube'] ; ?>" type="text" class="form-control" placeholder="escriba el link a su cuenta de Youtube" aria-describedby="basic-addon1">
                            </div>
        
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="bi bi-tiktok"></i></span>
                              <input  name="tiktok" value="<?php echo $_SESSION['tiktok'] ; ?>" type="text" class="form-control" placeholder="escriba el link a su cuenta de Tik Tok" aria-describedby="basic-addon1">
                            </div>
        
        
        
        					<div class="p-4 mb-3 bg-secondary-subtle rounded">
                                <h4 class="fst-italic">Paso 4 de 5 - Escoja el plan que desearia usar</h4>
                                <div class="table-responsive">
                                    <table class="table" width="80%" border="0">
                                      <tr>
                                        <th>DESCRIPCION</td>
                                        <th>BASICO <br> 0% / anual</td>
                                        <th>AVANZADO <br> 60$ / anual</td>
                                      </tr>
                                      <?php 
                                        $vEmpresa = array();
                                        $vProveedor = array();
                                        $stmt = $tabla_control->readPlanProveedor();
                                        $i=0;
                                        $j=0;
                                        while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
                                        {
                                            if(substr($row['nombre'], 0, 11) == "PLAN BASICO") {
                                                $i++;
                                                $vEmpresa[$i][0] = substr($row['nombre'], 13, strlen($row['nombre'])-11);
                                                $vEmpresa[$i][1] = $row['valor'];
                                            }else{
                                                if(substr($row['nombre'], 0, 13) == "PLAN AVANZADO") {
                                                    
                                                    $j++;
                                                    $vProveedor[$i][0] = substr($row['nombre'], 15, strlen($row['nombre'])-13);
                                                    $vProveedor[$j][1] = $row['valor'];
                                                }	
                                            }						
                                        }  
                                        $n = $i;
                                        for($i=1; $i<= $n; $i++){
                                        ?>
                                            <tr>
                                            <td align="left"><strong><?php echo $vEmpresa[$i][0];?></strong></td>
                                            <td align="center"><h6><?php echo $vEmpresa[$i][1];?></h6></td>
                                            <td align="center"><h6><?php echo $vProveedor[$i][1];?></h6></td>
                                          </tr>  
                                        <?php
                                        }
                                        ?>       
                                        
                                        
                                        <tr>
                                            <td align="left"><strong><</td>
                                          <td align="center"><h6>Plan Basico</h6> <input name="plan" type="radio" class="form-control" value="B" checked="checked"></td>
                                          <td align="center"><h6>Plan Avanzado</h6><input name="plan" type="radio" class="form-control" value="A"></td>
                                          </tr>  
                                                  
                                    </table>
                                </div>
                              </div>
        					
        
        
                            <h4 class="fst-italic">Paso 5 de 5 - Enviar solicitud</h4>
                            <p>Doy fe de que la información suministrada en este formulario es veraz y puede ser confirmada por medio de el o los representantres de la empresa que se intenta registrar en el portal de StraSourcing.</p>
                            <button type="submit" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Grabar y Enviar solicitud</button>
                            <a class="btn btn-sm btn-outline-secondary" href="proveedor_paso2.php">Regresar al PASO 2</a>
        
                          </p>
                    </div>
                    </div>
        
                    </div>            
                  </form>
                  <hr>
              </main>
      </div>

    <footer align="center" class="blog-footer" style="background-color:black; color:white;">
     Todos los drechos reservados <a href="https://strasourcing.com/">StraSourcing.com</a> por <a href="https://ciudadhive.com">@CP&JCL</a>.
      <p>
        <a href="#">Ir arriba</a>
      </p>
    </footer>
  </body>
</html>
