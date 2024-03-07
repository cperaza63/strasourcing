<?php 
include "proveedor_spa_parte4_accion.php"; 
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
    	
        <!-- http://localhost/strasourcing/app/crud_multiples_imagenes.php -->
        <div class="container">  
        <br> 
        <h4>
          <?php echo "Informacion de soporte '".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?>
        </h4>
        </div>
        <div class="container col-6">
            <form method="post" action="proveedor_spa_paso4.php">
            <input type="hidden" name="image_id" value="<?php echo isset($_GET['id']) ? $_GET['id']: 0; ?>">
            <br><br>
             <div align="center" class='form-control'>
                <p>Escoja tipo de soporte<br>
                  <select name="etiqueta" class="form-control">
                  	<option value="TODOS LOS SOPORTES"> TODOS LOS SOPORTES </option>
                    <option value = "IMAGENES Y FOTOS" 
					<?php if( $etiqueta == "IMAGENES Y FOTOS" ){ echo "selected";}?>
                    > IMAGENES Y FOTOS</option>
                    
                    <option value = "CERTIFICACIONES" 
                    <?php if( $etiqueta == "CERTIFICACIONES" ){ echo "selected";}?>
                    > CERTIFICACIONES</option>
                    
                    <option value = "CATALOGOS" 
                    <?php if( $etiqueta == "CATALOGOS" ){ echo "selected";}?>
                    > CATALOGOS</option>
                    
                    <option value = "NOTICIAS" 
                    <?php if( $etiqueta == "NOTICIAS" ){ echo "selected";} ?>
                    value=""> NOTICIAS</option>
                    
                    <option value="VIDEOS"
                    <?php if( $etiqueta == "VIDEOS" ){ echo "selected";}?>
                    > VIDEOS</option>
                    <option value="REFERENCIAS"
                    <?php if( $etiqueta == "REFERENCIAS" ){ echo "selected";}?>
                    > REFERENCIAS</option>
                  </select>
                </p>
                <button type="submit" name="accion" class="btn btn-secondary" value="escoger_soporte" style="background-color:#5B00B7;color:white;">Escoger Soporte</button>
            </div>        
          </form>
      </div>
      
		<br>        
        <br>
        
        <iframe frameBorder="0" class="responsive-iframe" src="../soporte_multiples_imagenes/" width="100%" height="2000px"></iframe>
         
        
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
