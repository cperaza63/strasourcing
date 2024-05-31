<?php
include "../controllers/recomendacionesController.php";
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
    <title>SISTEMA SPA | empresas para recomendaciones</title>
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
    <style type="text/css">
    .bi1 {        vertical-align: -.125em;
        fill: currentColor;
}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
    
  	</head>
  	<body class="center-h center-v" style="background-color:white;">
    <div class="container" style="background-color:white;">
      <header class="blog-header lh-1 py-3">
        <div class="row flex-nowrap justify-content-end align-items-end">
          <div class="col-4 d-flex justify-content-end align-items-end">
            <a target="_parent" class="btn btn-sm btn-outline-secondary" href="../recomendaciones.php?accion=si">Regresar</a>
          </div>
        </div>
      </header>
    </div>
    <div class="container" style="background-color:white;">
      <header class="blog-header lh-1 py-3">
      <span class="display-4 fst-italic">Socilitud de carta de recomendación</span>
    </div>
    <main class="container" style="background-color:white;">
  <form action="" method="post">
	<div class="row g-5 center-h center-v" >
                 
    <div class="col-md-8" style="background-color:white;">
        
	<div class="p-4 mb-3 bg-secondary-subtle rounded">
            <h4 class="fst-italic">Información de la Empresa          </h4>
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

              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rif</span>
                <input name="company_rif" value="<?php echo $_SESSION['numero_rif']; ?>" type="text" required class="form-control" placeholder="escriba su número de RIF del negocio"  aria-describedby="basic-addon1">
              </div>
              
               <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="bi bi-card-checklist"></i></span>
                  <textarea size="5" name="empresa_comment" id="empresa_comment" class="form-control" title="Campo breve explicación de su empresa" placeholder="Campo breve explicación de su empresa"><?php echo $_SESSION["empresa_comment"]; ?></textarea>
              </div>

              <p>
              <div class="card">
                  <div class="card-header text-white" style="background-color: #5B00B7;"><strong>Establezca la ubicación de la empresa</strong> </div>
                  <div class="card-body" style=" border:1px solid #00AA9E">

                  <div class="form-group">
                      <label class="small mb-1" for="pais_edo_city"><i class="fas fa-building"></i> <strong>Dirección de su negocio</strong></label>
                      <?php
                          require_once "../select_pais/index.php";
                      ?>
                  </div>
                  <div><strong>Estados </strong></div>
                  <select class="form-control" id="sel_depart" name="estados">
                      <option value="0">- Seleccione Estado -</option>
                      <?php 
                      // llamamos a los registros
                      $sql_department = "SELECT * FROM estados";
                      $department_data = mysqli_query($conexion, $sql_department);
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
              	
                <div class="form-check form-switch">
                <!-- checked -->
                  <input id="pertenece_camara" onchange="functionInt()" name="company_pertenece" type="checkbox" class="form-check-input" value="<?php echo ""; ?>">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Pertenece a alguna Cámara?</label>
                </div>
                <input name="company_camara" id="company_camara" value="<?php echo ""; ?>" type="text" class="form-control" placeholder="por favor especifique..." aria-describedby="basic-addon1">
              </div> 


              <div class="input-group mb-3 ">
                <div class="col-md-6">
                  <select name="tipo_infraestructura" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                    <?php
					  $query=$conexion->query("select * from tabla_control where tipo=3 order by nombre");
						$states = array();
						while( $r = $query->fetch_object()){ $states[]=$r; }
						if(count($states)>0){
							print "<option value='0'>-- Seleccione Tipo de Infraestructura -- </option>";
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

                <div class="col-md-6">
                  <select name="area_trabajo" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                    <?php
					  $query=$conexion->query("select * from tabla_control where tipo=4 order by nombre");
						$states = array();
						while( $r = $query->fetch_object()){ $states[]=$r; }
						if(count($states)>0){
							print "<option value='0'>-- Seleccione Area de trabajo -- </option>";
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
                <div class="col-md-6">
                  <select name="sector_industrial" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                   <?php
					  $query=$conexion->query("select * from tabla_control where tipo=1 order by nombre");
						$states = array();
						while( $r = $query->fetch_object()){ $states[]=$r; }
						if(count($states)>0){
							print "<option value='0'>-- Seleccione Sector Industrial -- </option>";
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
                <div class="col-md-6">
                    <select name="tipo_organizacion" value="<?php echo ""; ?>" class="form-control" aria-label="Default select example">
                        <?php
					  $query=$conexion->query("select * from tabla_control where tipo=2 order by nombre");
						$states = array();
						while( $r = $query->fetch_object()){ $states[]=$r; }
						if(count($states)>0){
							print "<option value='0'>-- Seleccione Tipo de organización -- </option>";
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
          <div class="p-4 mb-3 bg-secondary-subtle rounded">
            <h4 class="fst-italic">Información de persona contacto </h4>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi-person-circle"></i></span>
              <input name="user_name" type="text" required class="form-control" placeholder="escriba su nombre" title="escriba su nombre" value="<?php echo $_SESSION['user_name']; ?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-envelope-at"></i></span>
              <input name="user_email" type="email" required class="form-control" placeholder="escriba su e-mail" title="escriba su e-mail" value="<?php echo $_SESSION['user_email']; ?>" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon2"><i class="bi bi-telephone-x"></i></span>
              <input name="user_phone" type="text" required class="form-control" placeholder="escriba su número celular" value="<?php echo $_SESSION['user_phone']; ?>" aria-describedby="basic-addon1">
            </div>
          </div>
        </div>
      </div>
    
    <div class="row g-12 center-h center-v" >
        <div class="p-6 mb-3 bg-secondary-subtle rounded">
         <h4 class="fst-italic">Recomendar estas categorías</h4>
            <select name="categorias[]" size="5" multiple class="form-control" aria-label="Default select example" value="<?php echo ""; ?>">
               <?php
                  $query=$conexion->query("SELECT b.name, a.* FROM spa.proveedor_marcas a inner join php_combo.continente b 
				  on(a.categoria = b.id) where a.idCompany=". $_SESSION['companyHive'] ." group by b.name");
                    $states = array();
                    while( $r = $query->fetch_object()){ $states[]=$r; }
                    if(count($states)>0){
                        print "<option value='0'>-- Seleccione las categorias -- </option>";
                        foreach ($states as $s) {
                            print "<option value='$s->categoria' $seleccion> $s->name </option>";
                    }
                    }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                    }
                  ?>
          </select>
          
          <button type="submit" name="accion" value="incluir" 
          class="btn btn-secondary" style="background-color:#5B00B7;" >Incluir a lista</button>
    	</div>
        <div class="p-6 mb-3 bg-secondary-subtle rounded">
        	<h4 class="fst-italic">...</h4>
            <select name="cat_incluidas" size="5" multiple class="form-control" aria-label="Default select example" value="<?php echo ""; ?>">
               <?php
                  $query=$conexion->query("SELECT b.name, a.* FROM spa.solicitud_categorias a 
				  inner join php_combo.continente b on(a.categoria = b.id) 
				  where a.idCompany=". $_SESSION['companyHive'] ." and rif='".$_SESSION['numero_rif']."' group by b.name;");
                    $states = array();
                    while( $r = $query->fetch_object()){ $states[]=$r; }
                    if(count($states)>0){
                        print "<option value='0'>-- Categorias seleccionadas -- </option>";
                        foreach ($states as $s) {
                            print "<option value='$s->categoria' $seleccion> $s->name </option>";
                    }
                    }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                    }
                  ?>
              </select>
          <button type="submit" name="accion" value="excluir" 
          class="btn btn-secondary" style="background-color:#5B00B7;" >Excluir de lista</button>
    	</div>
    </div>
    
    <div class="col-md-8" style="background-color:white;">
        <div class="position-sticky" style="top: 2rem;">
          <div class="position-sticky" style="top: 2rem;">
        	<hr>
              <h4 class="fst-italic">Enviar solicitud</h4>
              <p>La información suministrada en este formulario será guardada en Strasourcing y por lo tanto los datos puedan ser comprobados por medio de los representantres de la empresa.</p>
              <button type="submit" name="accion" value="grabar_comprador" class="btn btn-secondary" style="background-color:#5B00B7;" >Enviar solicitud</button>		
	          <a target="_parent" class="btn btn-sm btn-outline-secondary" href="../recomendaciones.php?accion=si">Regresar</a>
			<hr>
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
	
	document.getElementById("company_camara").style.display = "none";
	
	</script>
    
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

    
  </body>
</html>
