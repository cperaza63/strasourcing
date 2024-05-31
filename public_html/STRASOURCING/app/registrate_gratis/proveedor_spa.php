<style>

.container_modal {
  position: relative;
  width: 100%;
  height: 650px;
  overflow: hidden;
  padding-top: 0.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 0px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #000fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 5px;
  background-color: #333;
  color: white;
}

.modal-body {padding: 2px 5px;}

.modal-footer {
  padding: 2px 5px;
  background-color: #333;
  color: white;
}
</style>
<?php
include "proveedor_spa_accion.php";
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
  	<body class="center-h center-v" style="background-color:white;">
<!-- 
          <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
              <a class="p-2 link-secondary" href="#">World</a>
              <a class="p-2 link-secondary" href="#">U.S.</a>
              <a class="p-2 link-secondary" href="#">Technology</a>
              <a class="p-2 link-secondary" href="#">Design</a>
              <a class="p-2 link-secondary" href="#">Culture</a>
              <a class="p-2 link-secondary" href="#">Business</a>
              <a class="p-2 link-secondary" href="#">Politics</a>
              <a class="p-2 link-secondary" href="#">Opinion</a>
              <a class="p-2 link-secondary" href="#">Science</a>
              <a class="p-2 link-secondary" href="#">Health</a>
              <a class="p-2 link-secondary" href="#">Style</a>
              <a class="p-2 link-secondary" href="#">Travel</a>
            </nav>
          </div>
        </div> -->

<main > <!--class="container">-->
	<br>
	<div class="container col-12">
          <div class="row row-cols-6 row-cols-lg-5 g-2 g-lg-3">
            <div class="col">
                <form action="proveedor_spa.php" method="post">
                  <button type="submit" name="boton" value="empresa" class="btn btn-<?php echo $color_empresa;?>" >
                   Empresa
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>
            </div>
            <div class="col">
                <form action="proveedor_spa.php" method="post">
                  <button type="submit" name="boton" value="administrador" class="btn btn-<?php echo $color_administrador;?> d-inline-stretch align-items-stretch " >
                    Administrador
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>   
            </div>
            <div class="col">
              <form action="proveedor_spa_paso1.php" method="post">
                   <button type="submit" name="boton" value="contacto" class="btn btn-<?php echo $color_contacto;?> d-inline-stretch align-items-stretch " >
                    Sectores
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>
            </div>
            <div class="col">
               <form action="proveedor_spa_paso2.php" method="post">
                   <button type="submit" name="boton" value="pys" class="btn btn-<?php echo $color_pys;?> d-inline-flex align-items-stretch " >
                    Productos
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>
            </div>
            <div class="col">
               <form action="proveedor_spa_paso3.php" method="post">
                  <button type="submit" name="boton" value="redes" class="btn btn-<?php echo $color_redes;?> d-inline-flex align-items-stretch " >
                    Información
                    <svg class="bi ms-1" width="20" height="20">
                    <use xlink:href="#arrow-right-short"/></svg>
                  </button>
              </form>
            </div>
            
            <div class="col">
               <form action="proveedor_spa_paso4.php" method="post">
                  <button type="submit" name="boton" value="soporte" class="btn btn-<?php echo $color_soporte;?> d-inline-flex align-items-stretch " >
                    Soporte
                    <svg class="bi ms-1" width="20" height="20">
                    <use xlink:href="#arrow-right-short"/></svg>
                  </button>
              </form>
            </div>
            
            <!--<div class="col">
              <a target="_parent" href="http://localhost/spa_users/layout/admin/index.php" class="btn btn-outline-danger d-inline-flex align-items-stretch ">
                Home
                <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
              </a>
            </div>-->
        </div>

        </div>
    
    

    <?php
	
    //echo $color_empresa ." " . $color_administrador. " " .$color_contacto;
	
	if ( $color_contacto == "secondary" ){
	?>
	    <div class="row center-h center-v" >
        <form action="proveedor_spa.php" method="post">
        	<br>
            <h4 class="fst-italic">Información de quien registra la empresa <?php echo "'".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?></h4>
            <br>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi-person-circle"></i></span>
              <input name="user_name" type="text" required class="form-control" placeholder="escriba su nombre" title="escriba su nombre" value="<?php echo $user_name; ?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-envelope-at"></i></span>
              <input name="user_email" type="email" required class="form-control" placeholder="escriba su e-mail" title="escriba su e-mail" value="<?php echo $user_email; ?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-telephone-x"></i></span>
              <input name="user_phone" type="text" required class="form-control" placeholder="escriba su número celular" value="<?php echo $user_phone; ?>" aria-describedby="basic-addon1">
            </div>
            </p>
        	 <button type="submit" name="boton" value="grabar_contacto" class="btn btn-secondary d-inline-flex align-items-center" style="background-color:#5B00B7; color:white;">
                Grabar Contacto
                <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
              </button>
		</form>        
        </div>
	<?php
	}
	?>
	    
    <?php
	if ( $color_administrador == "secondary" ){
	?>

        <div class="container col-12">
	        <form action="proveedor_spa.php" method="post">
              <br>
              <h4 class="fst-italic">De quien representa a la empresa <?php echo "'".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?></h4>
              <br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi-person-circle"></i></span>
                    <input name="admin_name" type="text" required class="form-control" placeholder="escriba el nombre" value="<?php echo $admin_name; ?>" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                    <input name="admin_cargo" type="text" required class="form-control" placeholder="cargo en la empresa" value="<?php echo $admin_cargo; ?>" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="admin_email" type="email" required class="form-control" placeholder="escriba e-mail oficial" value="<?php echo $admin_email; ?>" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="admin_phone" type="text" required class="form-control" placeholder="escriba número telefono" value="<?php echo $admin_phone; ?>" aria-describedby="basic-addon1">
                </div>
                <hr>
				<button type="submit" name="boton" value="grabar_administracion" class="btn btn-secondary d-inline-flex align-items-center" style="background-color:#5B00B7; color:white;">
                Grabar Administrador
                <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
              	</button>
         </form>
     	</div>
        
        <!--<div class="row center-h center-v" >-->
        <div class="container col-12">
        <form action="proveedor_spa.php" method="post">
        	<br>
            <h4 class="fst-italic">Información de quien registra la empresa  <?php echo $_SESSION['companyHive']; ?></h4>
            <br>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi-person-circle"></i></span>
              <input name="user_name" type="text" required class="form-control" placeholder="escriba su nombre" title="escriba su nombre" value="<?php echo $user_name; ?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-envelope-at"></i></span>
              <input name="user_email" type="email" required class="form-control" placeholder="escriba su e-mail" title="escriba su e-mail" value="<?php echo $user_email; ?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-telephone-x"></i></span>
              <input name="user_phone" type="text" required class="form-control" placeholder="escriba su número celular" value="<?php echo $user_phone; ?>" aria-describedby="basic-addon1">
            </div>
            </p>
        	 <button type="submit" name="boton" value="grabar_contacto" class="btn btn-secondary d-inline-flex align-items-center" style="background-color:#5B00B7; color:white;">
                Grabar Contacto
                <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
              </button>
		</form>        
        </div>
        
	<?php
	}
	?>      
    
    
    <?php	
 	if ( $color_empresa == "secondary" ){
		
		//echo "===". $rif_imagen. " " . $logo_imagen;
	?>
	<div class="col-12 p-4 mb-3 bg-secondary-subtle rounded">
      <form action="proveedor_spa.php" method="post">
        <h4 class="fst-italic">Información del Proveedor <?php echo "'".$_SESSION['razonSocialHive']."' - " . $_SESSION['companyHive']; ?></h4>
              <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi-person-circle"></i></span>
                    <input name="company_name" value="<?php echo $company_name; ?>" type="text" required class="form-control" placeholder="escriba la razón social del negocio"  aria-describedby="basic-addon1">
                    
                    <button id="myBtnSoporteLogo" type="button" class="btn btn-warning" title="Subir imagen del logo">
                    <i class='bi bi-card-image'></i></button>                    
                      <div align="center">
                      	<img src="../../assets/documentos/imagenes/logos/<?php echo $logo_imagen; ?>" height="80"  alt="" />
                      </div>
                        <div id="myModalSoporteLogo" class="modal">						
                          <!-- Modal content -->
                          <div class="modal-content">
                            <div class="modal-body">
                              <!--<p><a href="../subirUnArchivo/index.php">Subir imagenes - SPA</a>-->
                              <div class="container_modal"> 
                                  <iframe class="responsive-iframe" src="../subirUnArchivo/index.php?tipoEmpresa=4&tipoTabla=12&idCompany=<?php echo $_SESSION['companyHive']; ?>&folder=<?php echo "/assets/documentos/imagenes/logos/"; ?>"></iframe>
                              </div>
                             <!-- </p>-->
                            </div>
                            <div class="modal-footer">
                            <a href="proveedor_spa.php">
                            <button class="btn btn-secondary" style="background-color:#5B00B7; color:white;">
                              <h3>Cerrar Ventana y Refrescar</h3>
                            </button>
                            </a>
                            </div>
                          </div>                            
                      </div>
                      <script>
                        // Get the modal
                        var modalLogo = document.getElementById("myModalSoporteLogo");
                        
                        // Get the button that opens the modal
                        var btnLogo = document.getElementById("myBtnSoporteLogo");
                        
                        // Get the <span> element that closes the modal
                        var spanLogo = document.getElementsByClassName("close")[0];
                        
                        // When the user clicks the button, open the modal 
                        btnLogo.onclick = function() {
                          modalLogo.style.display = "block";
                        }
                        
                        // When the user clicks on <span> (x), close the modal
                        spanLogo.onclick = function() {
                          modalLogo.style.display = "none";
                        }
                        
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                          if (event.target == modalLogo) {
                            modalLogo.style.display = "block";
                          }
                        }
                        </script>

            </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="company_email" type="email" required class="form-control" placeholder="escriba e-mail oficial del negocio" value="<?php echo $company_email;?>" aria-describedby="basic-addon1">
                  </div>
    
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="company_phone" type="text" required class="form-control" placeholder="escriba su número de telefono o celular de contacto con el negocio" value="<?php echo $company_phone;?>" aria-describedby="basic-addon1">
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
                    <input name="company_rif" value="<?php echo $company_rif; ?>" type="text" required class="form-control" placeholder="escriba su número de RIF del negocio <?php echo $company_rif; ?>"  aria-describedby="basic-addon1">                    
                    <button id="myBtnSoporteRif" type="button" class="btn btn-warning" title="Subir imagen del rif">
                   		 <i class='bi bi-card-image'></i></button>                    
                      <div align="center">
                      	<img src="../../assets/documentos/imagenes/rif/<?php echo $rif_imagen; ?>" height="80"  alt="" />
                      </div>
                        <div id="myModalSoporteRif" class="modal">						
                          <!-- Modal content -->
                          <div class="modal-content">
                            <!--<div class="modal-header">
                              <!--<span class="close">&times;</span>
                              <h2>Subir imagen del Rif</h2>
                            </div>-->
                            <div class="modal-body">
                              <p>
                              <div class="container_modal"> 
                                  <iframe class="responsive-iframe" src="../subirUnArchivo/index.php?tipoEmpresa=4&tipoTabla=14&idCompany=<?php echo $_SESSION['companyHive']; ?>&folder=<?php echo "/assets/documentos/imagenes/rif/"; ?>"></iframe>
                              </div>
                              </p>
                            </div>
                            <div class="modal-footer">
                            <a href="proveedor_spa.php">
                            <button class="btn btn-secondary" style="background-color:#5B00B7; color:white;">
                              <h3>Cerrar Ventana y Refrescar</h3>
                            </button>
                            </a>
                            </div>
                          </div>                            
                      </div>
                      	<script>
                        // Get the modal
                        var modalRif = document.getElementById("myModalSoporteRif");
                        
                        // Get the button that opens the modal
                        var btnRif = document.getElementById("myBtnSoporteRif");
                        
                        // Get the <span> element that closes the modal
                        var spanRif = document.getElementsByClassName("close")[0];
                        
                        // When the user clicks the button, open the modal 
                        btnRif.onclick = function() {
                          modalRif.style.display = "block";
                        }
                        
                        // When the user clicks on <span> (x), close the modal
                        spanRif.onclick = function() {
                          modalRif.style.display = "none";
                        }
                        
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                          if (event.target == modalRif) {
                            modalRif.style.display = "block";
                          }
                        }
                        </script>
                    
                    
                  </div>
                  
                   <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-checklist"></i></span>
                      <textarea size="5" name="empresa_comment" id="empresa_comment" class="form-control" title="Campo breve explicación de su empresa" placeholder="Campo breve explicación de su empresa"><?php echo $empresa_comment; ?></textarea>
                      
                  </div>
    
                  <p>
                  
                  <div class="input-group mb-3">
                      <input name="box_int" type="checkbox" class="form-check-input" id="box_int" title="Si su empresa esta fuera de Venezuela" onchange="functionInt()" value="X" checked="checked" />
                      <label class="form-check-label" for="internacional">
                        <strong>SI SU EMPRESA ESTA EN VENEZUELA COMPLETE ESTADO Y CIUDAD</strong>	
                      </label>
                  </div>
                  
                 
                  <div id="lista_paises" class="card">
                  	Seleccione Pais extranjero - si aplica
                    <select name="select_pais" value="<?php echo $pais; ?>" class="form-control" aria-label="Default select example">
                    <?php
                      $query=$con->query("SELECT country_code, country_name FROM tbl_paises ORDER BY country_name ASC");
                        $countries = array();
                        while( $t = $query->fetch_object()){ $countries[]=$t; }
                        if(count($countries)>0){
                            print "<option value='0'>-- Seleccione Pais de origen -- </option>";
                            foreach ($countries as $t) {
                                if ( $pais == $t->country_code ){
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
                      <div class="card-header text-white" style="background-color: #5B00B7;"><strong>o, establezca la ubicación de la empresa</strong> en Venezuela</div>
                      <div class="card-body" style=" border:1px solid #00AA9E">
    
                      <div class="form-group">
                          <label class="small mb-1" for="pais_edo_city"><i class="fas fa-building"></i> <strong>Dirección de su negocio</strong></label>
                          <span class="center-h center-v" style="background-color:white;">
                          <label class="small mb-1" for="pais_edo_city2"><strong>(<?php echo $latitude, $longitude;?>)</strong></label>
                          </span>
<div id="lista_paises" class="card">
            <select name="select_box" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                            <?php
                              $query=$con->query("SELECT country_code, country_name FROM tbl_paises where country_code='VE' ORDER BY country_name ASC");
                                $states = array();
                                while( $r = $query->fetch_object()){ $states[]=$r; }
                                if(count($states)>0){
                                    foreach ($states as $s) {
                                        if ( $pais == $s->country_code ){
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
                          $department_data = mysqli_query($con,$sql_department);
                          while($row = mysqli_fetch_assoc($department_data) ){
                            $departid = $row['codigo'];                        
                            $depart_name = $row['state'];
                            if ( $estados == $departid ){
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
                      <div><strong>Ciudades</strong> </div>
                      
                      <?php 
                        //echo "=edo=". $estados;
                      ?>
                      
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
                      <select class="form-control" id="sel_user" name="ciudades">
                          <option value="0">- Seleccione Ciudad -</option>
                          <?php 
                          // llamamos a los registros
                          $sql_department = "SELECT codigo,city FROM ciudades WHERE state*1=".$estados*1;
                          $department_data = mysqli_query($con,$sql_department);
                          while($row = mysqli_fetch_assoc($department_data) ){
                            $userid = $row['codigo'];
                            $name = $row['city'];
                            if ( $ciudades*1 == $userid*1 ){
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
                    <textarea name="company_address" cols="50" rows="2" required class="form-control" placeholder="Coloque la dirección de acuerdo a la razon social del Rif" aria-label="With textarea" value="<?php echo ""; ?>"><?php echo $company_address; ?>
                    </textarea>
                    
                    <div class="form-inline">
                        <button id="myBtnSoporte" type="button" class="btn btn-secondary" style="background-color: #5B00B7;color:white;" title="Coordenadas de direccion">
                           Dirección de la Empresa
                          </button><br>
                        <?php 
                        //echo $armoDireccion.  " Coordenadas: " . $latitude_fin .  ", " .  $longitude_fin; 
                        ?>
                      </div>
                      <div id="myModalSoporte" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <!--<div class="modal-header">
                            <!--<span class="close">&times;</span>
                            <h2>Establecer dirección de entrega de pedido</h2>
                            </div>-->
                            <div class="modal-body">
                                <div class="container_modal">
                                <iframe class="responsive-iframe" src="../ubicacionGeografica.php?tipo=empresa"></iframe>
                                </div>
                            </div>
                            <div class="modal-footer"> 
                            <a href="comprador_spa.php&accion=spa&titulo_pagina=Actualización de datos de la empresa Cliente">
                                <button class="btn btn-secondary"  style="background-color: #5B00B7;color:white;">
                                <h3>Cerrar Ventana</h3>
                                </button>
                                </a>
                            </div>
                        </div>
                      </div>
					  <script>
                        // Get the modal
                        var modal = document.getElementById("myModalSoporte");
                        
                        // Get the button that opens the modal
                        var btn = document.getElementById("myBtnSoporte");
                        
                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                        
                        // When the user clicks the button, open the modal 
                        btn.onclick = function() {
                          modal.style.display = "block";
                        }
                        
                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                          modal.style.display = "none";
                        }
                        
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                          if (event.target == modal) {
                            modal.style.display = "block";
                          }
                        }
                        </script>
                    </div>
                    
              </div>
    
                  <div class="col-12 input-group mb-3">
                    
                    <!--<div class="form-check form-switch">
                     checked 
                      <input id="pertenece_camara" onchange="functionInt()" name="company_pertenece" type="checkbox" class="form-check-input" checked>
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
                          $query=$con->query("select * from tabla_control where tipo=3 order by nombre");
                            $states = array();
                            while( $r = $query->fetch_object()){ $states[]=$r; }
                            if(count($states)>0){
                                print "<option value='0'>-- Seleccione Tipo de Infraestructura -- </option>";
                                foreach ($states as $s) {
                                    if ( $tipo_infraestructura == $s->id ){
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
                          $query=$con->query("select * from tabla_control where tipo=4 order by nombre");
                            $states = array();
                            while( $r = $query->fetch_object()){ $states[]=$r; }
                            if(count($states)>0){
                                print "<option value='0'>-- Seleccione Area de trabajo -- </option>";
                                foreach ($states as $s) {
                                    if ( $area_trabajo == $s->id ){
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
                          $query=$con->query("select * from tabla_control where tipo=1 order by nombre");
                            $states = array();
                            while( $r = $query->fetch_object()){ $states[]=$r; }
                            if(count($states)>0){
                                print "<option value='0'>-- Seleccione Sector Industrial -- </option>";
                                foreach ($states as $s) {
                                    if ( $sector_industrial == $s->id ){
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
                          $query=$con->query("select * from tabla_control where tipo=2 order by nombre");
                            $states = array();
                            while( $r = $query->fetch_object()){ $states[]=$r; }
                            if(count($states)>0){
                                print "<option value='0'>-- Seleccione Tipo de organización -- </option>";
                                foreach ($states as $s) {
                                    if ( $tipo_organizacion == $s->id ){
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
       		  <hr>      
              <div class="p-4 mb-3 bg-secondary-subtle rounded">
                <h4 class="fst-italic">Referencias de empresa clientes (Los documentos deben ser colgados en la sección de Soporte)          </h4>
                <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1">Rif</span>
                    <input name="ref_rif" type="text" required class="form-control" placeholder="escriba el rif de la empresa 1" 
                    value="<?php echo $ref_rif; ?>" aria-describedby="basic-addon1">
                    
                    <span class="input-group-text" id="basic-addon1">Rif</span>
                    <input name="ref2_rif" type="text" required class="form-control" placeholder="escriba el rif de la empresa 2" 
                    value="<?php echo $ref2_rif; ?>" aria-describedby="basic-addon1">
                    
                </div>
    
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                    <input name="ref_razon_social" type="text" required class="form-control" placeholder="nombre de la empresa" 
                    value="<?php echo $ref_razon_social; ?>" aria-describedby="basic-addon1">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                    <input name="ref2_razon_social" type="text" required class="form-control" placeholder="nombre2 de la empresa" 
                    value="<?php echo $ref2_razon_social; ?>" aria-describedby="basic-addon1">
                    
                  </div>
    
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="ref_email" type="email" required class="form-control" placeholder="escriba e-mail oficial" 
                    value="<?php echo $ref_email; ?>" aria-describedby="basic-addon1">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                    <input name="ref2_email" type="email" required class="form-control" placeholder="escriba e-mail2 oficial" 
                    value="<?php echo $ref2_email; ?>" aria-describedby="basic-addon1">
                    
                  </div>
    
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="ref_telefono" type="text" required class="form-control" placeholder="escriba número telefono" 
                    value="<?php echo $ref_telefono; ?>" aria-describedby="basic-addon1">
					
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                    <input name="ref2_telefono" type="text" required class="form-control" placeholder="escriba número telefono2" 
                    value="<?php echo $ref2_telefono; ?>" aria-describedby="basic-addon1">
                  
                  </div>
                </p>
              </div>
       		  </p>  
             	 <button type="submit" name="boton" value="grabar_empresa" class="btn btn-secondary d-inline-flex align-items-center" style="background-color: #5B00B7;color:white;">
                Grabar Datos de Empresa
                <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                </button> 
          </div>
        </div>
  	  </form>
    </div>
	<?php
	}
	?>
</main>
<br>
<footer align="center" class="blog-footer" style="background-color:black; color:white;">
  Desarrollado por CP&JCL <a href="https://>strasourcing.com/">StraSourcing.com</a>
  <p>
    <a href="#">ir Arriba</a>
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
	document.getElementById("lista_paises").style.display = "block";
	 document.getElementById("card").style.display = "block";
	</script>
    
    <script>
	/*function functionInt() {
		var x = document.getElementById("pertenece_camara");
		//var x = document.getElementById("box_int");
		var y = document.getElementById("company_camara");
		console.log("valor", x.checked);
		if (x.checked == false){
			y.style.display = "none";
			//y.style.visibility = "visible"; // show
		}else{
			y.style.display = "block";
			//y.style.visibility = "hidden"; // hide;
		}
	}
	document.getElementById("company_camara").style.display = "block";*/
	</script>
    
    
  </body>
</html>
