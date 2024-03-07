<?php 
include "proveedor_spa_parte3_accion.php"; 
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
  <body >
<main>
   <br>
    <div class="container col-12">
          <div class="row row-cols-8 row-cols-lg-5 g-2 g-lg-3">
            <div class="col">
                <form action="proveedor_spa.php" method="post">
                  <button type="submit" name="boton" value="empresa" class="btn btn-<?php echo $color_empresa;?> d-inline-flex align-items-center" >
                   Empresa
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>
            </div>
            <div class="col">
                <form action="proveedor_spa.php" method="post">
                  <button type="submit" name="boton" value="administrador" class="btn btn-<?php echo $color_administrador;?> d-inline-flex align-items-center" >
                    Administrador
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>   
            </div>
            <div class="col">
              <form action="proveedor_spa_paso1.php" method="post">
                   <button type="submit" name="boton" value="contacto" class="btn btn-<?php echo $color_contacto;?> d-inline-flex align-items-center" >
                    Sectores
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>
            </div>
            <div class="col">
               <form action="proveedor_spa_paso2.php" method="post">
                   <button type="submit" name="boton" value="pys" class="btn btn-<?php echo $color_pys;?> d-inline-flex align-items-center" >
                    Productos
                    <svg class="bi ms-1" width="20" height="20"><use xlink:href="#arrow-right-short"/></svg>
                  </button>
               </form>
            </div>
            <div class="col">
               <form action="proveedor_spa_paso3.php" method="post">
                  <button type="submit" name="boton" value="redes" class="btn btn-<?php echo $color_redes;?> d-inline-flex align-items-center" >
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
        </div>

        </div>
    
    <div class="container">  
    <br> 
    <h4>
      <?php echo "Informacion y Redes sociales '".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?>
    </h4>
    </div>
    
    <form action="" method="post">
      <div class="row g-5 center-h center-v">
          <!-- PASO #1 -->
            <div class="col-md-10" style="background-color:white;">
              
              <div class="p-4 mb-3 bg-secondary-subtle rounded">
              	<hr>
                  <h4 class="fst-italic">Información de la Empresa - Redes Sociales</h4>
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
					<hr>
                    <h4 class="fst-italic">Información de la Empresa - Más Información </h4>
                   <p>	
                     <strong>Rango de cantidad de trabajadores: </strong>
                <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="bi bi-people"></i></span>
                          <input name="rango1_trabajadores" type="text" required class="form-control" placeholder="Rango 1 de trabajadores" value="<?php echo $_SESSION['rango1_trabajadores'] ; ?>" aria-describedby="basic-addon1">
                          - 
                          <input name="rango2_trabajadores" type="text" required class="form-control" placeholder="Rango 2 de trabajadores" value="<?php echo $_SESSION['rango2_trabajadores'] ; ?>" aria-describedby="basic-addon1">
                        </div>
                    <strong>Cantidad de Clentes: </strong>
<div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-people"></i></i></span>
            <input  name="cantidad_clientes" type="text" required class="form-control" placeholder="escriba el link a su cuenta de Instagram" value="<?php echo $_SESSION['cantidad_clientes'] ; ?>" aria-describedby="basic-addon1">
                </div>
    				<strong>Condiciones de pago:</strong>
<div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-credit-card"></i></span>
                    <select name="condiciones_pago" required class="form-control" id="condiciones_pago" aria-label="Default select example">
				              <option value="">- Seleccione condicion de pago -</option>
                              
                              <option value="contado" 
							  <?php if( $_SESSION['condiciones_pago'] == "contado"){
								  echo "selected"; 
								  }?> 
                              > Contado </option>
                              
                              <option value="credito"
       							  <?php if( $_SESSION['condiciones_pago'] == "credito" ){
								  echo "selected"; 
								  }?> 
                              > Crédito </option>
                              
            </select>
                        </div>
                     <strong>Ofrece garantias:</strong>
<div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-emoji-smile"></i></span>
           	  <strong>
           	  <select name="garantia" required class="form-control" id="garantia" aria-label="Default select example">
                        	  <option value="">- Seleccione condicion de pago -</option>
                        	  
                        	  <option value="1" 
                                    <?php if( $_SESSION['garantia'] == "1"){
                                      echo "selected"; 
                                      }?> 
                                > (SI) ofrece grarantías </option>
                        	  
                        	  <option value="0"
                                    <?php if( $_SESSION['garantia'] == "0" ){
                                    echo "selected"; 
                                    }?> 
                                > (NO) ofrece grarantías </option>
                      	  </select>
                        </strong></div>
                        <strong>					
                        Servicio post-venta:</strong>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-bandaid"></i></span>
                          <select name="servicio_postventa" required class="form-control" id="servicio_postventa" aria-label="Default select example">
                                            <option value="">- Seleccione servicio post-venta -</option>
                                            
                                            <option value="1" 
                                                <?php if( $_SESSION['servicio_postventa'] == "1"){
                                                  echo "selected"; 
                                                  }?> 
                                            > (SI) ofrece servicio post-venta </option>
                                          
                                            <option value="0"
                                                <?php if( $_SESSION['servicio_postventa'] == "0" ){
                                                echo "selected"; 
                                                }?> 
                                            > (NO) ofrece servicio post-venta </option>
                        </select>
                </div>
                   </p>
                   <hr>
                    <h4 class="fst-italic">&nbsp;</h4>
						<button type="submit" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Grabar Datos </button>
                  </p>
            	</div>
            </div>
			</div>            
          </form>
          <hr>
      </main>

    <footer align="center" class="blog-footer" style="background-color:black; color:white;">
      Desarrollado por CP&JCL <a href="https://>strasourcing.com/">StraSourcing.com</a>
      <p>
        <a href="#">ir Arriba</a>
      </p>
    </footer>

  </body>
</html>
