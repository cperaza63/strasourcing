<?php 
include "config.php";
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
  <body class="center-h center-v">
    

    

    
<div class="container">
  <header class="blog-header lh-1 py-3">
    <div class="row flex-nowrap justify-content-end align-items-end">
      <div class="col-4 d-flex justify-content-end align-items-end">
        <a class="btn btn-sm btn-outline-danger" href="../outside.php">Regresar al Menu principal</a>
      </div>
    </div>
  </header>

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
  </div> -->
</div>

<main class="container">
  <div class=" row p-4 p-md-5 mb-4 rounded text-bg-dark">
    <div class="col-md-8 px-0">
      <h2 class="display-4 fst-italic">Registración de la empresa como Comprador </h2>
      <p class="lead my-3">Aqui se debe colocar el texto que explica lo que una empresa experimentara cuando se registre en SPA.
        Dándole una idea de lo bueno que es registrarse como una empresa que requiere de oferentes reales y confiables.
    </p>
    </div>
    <div align="center" class="col-md-3 px-0">
        <img src="http://localhost/spa_admin/assets/img/logo.png" width="150">  
    </div>
  </div>
	
    <!--
  <div class="row mb-2">
    <div class="col-md-6 " >
      <div class="bg-light row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-danger">Area de Publicidad</strong>
          <h3 class="mb-0">Aqui Nombre del negocio que publicita</h3>
          <div class="mb-1 text-body-secondary">Oferta</div>
          <p class="card-text mb-auto">Párrafo corto que describe el texto publicitario.</p>
          <a href="#" class="stretched-link">Desea ver nuestras promociones</a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img width="200" height="250" src="http://localhost/spa_admin/assets/img/disponible.jpg" />
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="bg-light row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-danger">Area de Publicidad</strong>
          <h3 class="mb-0">Aqui Nombre del negocio que publicita </h3>
          <div class="mb-1 text-body-secondary">Oferta</div>
          <p class="mb-auto">Párrafo corto que describe el texto publicitario.</p>
          <a href="#" class="stretched-link">Desea ver nuestras promociones</a>
        </div>
        <div class="col-auto d-none d-lg-block">
        <img width="200" height="250" src="http://localhost/spa_admin/assets/img/disponible.jpg" />
        </div>
      </div>
    </div>
  </div>
	-->
  
  <form action="" method="post">
    <div class="row g-5 center-h center-v">
      <div class="col-md-8">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 bg-secondary-subtle rounded">
            <h4 class="fst-italic">Paso 1 de 4 - Información de quien registra la empresa      </h4>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi-person-circle"></i></span>
              <input type="text" class="form-control" placeholder="escriba su nombre" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-envelope-at"></i></span>
              <input type="email" class="form-control" placeholder="escriba su e-mail" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-telephone-x"></i></span>
              <input type="text" class="form-control" placeholder="escriba su número celular" aria-describedby="basic-addon1">
            </div>
            </p>
          </div>
        </div>
      </div>
    <div class="col-md-8">
        
      <div class="p-4 mb-3 bg-secondary-subtle rounded">
            <h4 class="fst-italic">Paso 2 de 4 - Información de la Empresa          </h4>
          <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi-person-circle"></i></span>
                <input type="text" class="form-control" placeholder="escriba la razón social del negocio" aria-describedby="basic-addon1">
        </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                <input type="email" class="form-control" placeholder="escriba e-mail oficial del negocio" aria-describedby="basic-addon1">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                <input type="text" class="form-control" placeholder="escriba su número de telefono o celular de contacto con el negocio" aria-describedby="basic-addon1">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rif</span>
                <input type="text" class="form-control" placeholder="escriba su número de RIF del negocio" aria-describedby="basic-addon1">
              </div>
              
              <p>
              <div class="card">
                  <div class="card-header text-white" style="background-color: #00AA9E;"><strong>Establezca la ubcación de la empresa</strong> </div>
                  <div class="card-body" style=" border:1px solid #00AA9E">

                  <div class="form-group">
                      <label class="small mb-1" for="pais_edo_city"><i class="fas fa-building"></i> <strong>Dirección de su negocio</strong></label>
                      <?php
                          require_once "../select_pais/index.php";
                      ?>
                  </div>
                  <div><strong>Estados </strong></div>
                  <select class="form-control" id="sel_depart" name="estados">
                      <option value="0">- Seleccione -</option>
                      <?php 
                      // llamamos a los registros
                      $sql_department = "SELECT * FROM estados";
                      $department_data = mysqli_query($con,$sql_department);
                      while($row = mysqli_fetch_assoc($department_data) ){
                          $departid = $row['codigo'];
                          $depart_name = $row['state'];
                      
                          // Opciones con registros
                          echo "<option value='".$departid."' >".$depart_name."</option>";
                      }
                      ?>
                  </select>
                  <div class="clear"></div>
                  <hr>
                  <div><strong>Ciudades</strong> </div>
                  <select class="form-control" id="sel_user" name="ciudades">
                      <option value="0">- Seleccione -</option>
                  </select>
                  </div>
              </div>
              </p>
              <div class="input-group mb-3">
                <span class="input-group-text">Dirección del negocio</span>
                <textarea rows="2" cols="50" class="form-control" aria-label="With textarea" placeholder="Coloque la direcció de acuerdo a la razon social del Rif"></textarea>
          </div>

              <div class="input-group mb-3">
              	
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Pertenece a alguna Cámara?</label>
                </div>
                <input type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
              </div> 


              <div class="input-group mb-3 ">
                <div class="col-md-6">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Tipo Infraestructura</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>

                  <input type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">

                </div>

                <div class="col-md-6">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Tipo área de trabajo</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>

                  <input type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                  
                </div>
            </div>
            <div class="input-group mb-3 ">
                <div class="col-md-6">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Sector Industrial</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <input type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                </div>
                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Tipo de Organización</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <input type="text" class="form-control" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                </div>
          </div>
              

            </p>

            
      </div>
    </div>

      <div class="col-md-8">
        <div class="position-sticky" style="top: 2rem;">
          <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 bg-secondary-subtle rounded">
            <h4 class="fst-italic">Paso 3 de 4 - De quien representa a la empresa            </h4>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi-person-circle"></i></span>
                <input type="text" class="form-control" placeholder="escriba el nombre" aria-describedby="basic-addon1">
            </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-diagram-3"></i></span>
                <input type="text" class="form-control" placeholder="cargo en la empresa" aria-describedby="basic-addon1">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-at"></i></span>
                <input type="email" class="form-control" placeholder="escriba e-mail oficial" aria-describedby="basic-addon1">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-x"></i></span>
                <input type="text" class="form-control" placeholder="escriba número telefono" aria-describedby="basic-addon1">
              </div>
            </p>
          </div>
          <hr>
          <h4 class="fst-italic">
            <input type="hidden" name="accion" value="paso2"/>
          </h4>
          <h4 class="fst-italic">Seguir con el paso 5</h4>
          <p>Doy fe de que la información suministrada en este formulario es veraz y puede ser confirmada por medio de el o los representantres de la empresa que se intenta registrar en el portal de SPA.</p>
          <button type="submit" class="btn btn-primary">grabar, Ir Paso 2</button>
          <a class="btn btn-sm btn-outline-danger" href="../outside.php">Regresar al Menu Principal</a>
          <h4 class="fst-italic"><br>
            <br>
          </h4>
          <hr>
          <br><br>
        </div>
      </div>
    </div>
  </form>
    <!--
    <div class="row mb-2">
      <div class="col-md-6 " >
        <div class="bg-light row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-danger">Area de Publicidad</strong>
            <h3 class="mb-0">Aqui Nombre del negocio que publicita</h3>
            <div class="mb-1 text-body-secondary">Oferta</div>
            <p class="card-text mb-auto">Párrafo corto que describe el texto publicitario.</p>
            <a href="#" class="stretched-link">Desea ver nuestras promociones</a>
          </div>
          <div class="col-auto d-none d-lg-block">
              <img width="200" height="250" src="http://localhost/spa_admin/assets/img/disponible.jpg" />
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-light row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-danger">Area de Publicidad</strong>
            <h3 class="mb-0">Aqui Nombre del negocio que publicita </h3>
            <div class="mb-1 text-body-secondary">Oferta</div>
            <p class="mb-auto">Párrafo corto que describe el texto publicitario.</p>
            <a href="#" class="stretched-link">Desea ver nuestras promociones</a>
          </div>
          <div class="col-auto d-none d-lg-block">
          <img width="200" height="250" src="http://localhost/spa_admin/assets/img/disponible.jpg" />
          </div>
        </div>
      </div>
    </div>
    -->
</main>

<footer align="center" class="blog-footer">
  Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
  </body>
</html>
