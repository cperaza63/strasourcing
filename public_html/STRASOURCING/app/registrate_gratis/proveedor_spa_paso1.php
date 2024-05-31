<style>

.container_modal {
  position: relative;
  width: 100%;
  height: 650px;
  overflow: hidden;
  padding-top: 0.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
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
include "proveedor_spa_parte1_accion.php"; 
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
    .bi2 {        vertical-align: -.125em;
        fill: currentColor;
}
    </style>
    
<!-- style="background-color:#E6E6E6;"-->
  </head>
  <body>
	<main > <!--class="container" >-->
		<br>
        <div class="container-fluid col-12">
          <div class="row row-cols-6 row-cols-lg-5 g-2 g-lg-3">
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
                    <svg class="bi ms-1" width="20" height="20">
                    <use xlink:href="#arrow-right-short"/></svg>
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
        

      <div class="form-check">
      	<br>
      	<h4 class="fst-italic">Información de los Sectores de <?php echo "'".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?></h4>
      	<br>
      	<div class="card">
        <form action="proveedor_spa_paso1.php" method="post">
          <div class="input-group col-12">
          
          <table width="100%" align="center" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Sector</th>
                  <th scope="col">Porcentaje</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
              	<?php
					$sql = "SELECT a.id, a.idProveedor, a.sector, a.porcentaje, b.nombre, b.image_id, c.images FROM proveedor_sectores a 
					inner join tabla_control b ON (b.id = a.sector) 
					left join table_images c ON (b.image_id = c.id) 
					where b.tipo=11 and a.idProveedor = '" . $_SESSION['companyHive'] . "'";
					//echo $sql;
					$query=$con->query($sql);
					$i=0;
					$sectores = array();
					while($r=$query->fetch_object()){ $sectores[]=$r; }
					if(count($sectores)>0){
						foreach ($sectores as $s) {
							$i++;
						?>
						<tr>
						  <th scope="row"><?php echo $s->sector; ?></th>
                          <td>
                          	<img src="<?php echo "http://localhost/strasourcing/app/crud_imagenes/uploads/" . $s->images; ?>" width="80px" alt=""/>
						  </td>
						  <td><?php echo $s->nombre; ?></td>
						  <td><?php echo $s->porcentaje; ?> %</td>
                          <td>
                          <a title="Eliminar relacion sector <?php echo $s->nombre;?> del proveedor <?php echo $s->idProveedor;?>" href="proveedor_spa_paso1.php?del=<?php echo $s->id; ?>" class="btn btn-outline-danger"><i class="bi bi-eraser"></i></a></td>
						</tr>
						<?php
						}
					}else{
						print "<option value=''>-- NO HAY DATOS --</option>";
					}
				?>				
              </tbody>
            </table>
            
            <select name="sector" class="form-select" aria-label="Default select example" id="sector">
              <option value="">- Seleccione un Sector de acción -</option>
              <?php
				if( isset($rif_proveedor) ){
					$sql = "select * from tabla_control where tipo = 11 order by tipo desc, nombre";	
				}else{
					$sql = "select * from tabla_control where tipo = 8 order by tipo desc, nombre";		
				}
				
				echo $sql;
				
				$query=$con->query($sql);
				
				$marcas = array();
				while($r=$query->fetch_object()){ $marcas[]=$r; }
				if(count($marcas)>0){
					foreach ($marcas as $s) {
						?>
						  <option value="<?php echo $s->id; ?>"><?php echo $s->nombre; ?></option>
						  <?php
						}
					}else{
						print "<option value=''>-- NO HAY DATOS --</option>";
					}
			?>
            </select>
            
            <input name="porcentaje_sector" type="text" class="form-control" id="porcentaje_sector" placeholder="coloque porcentaje del sector..." aria-describedby="basic-addon1">
            <button name="grabar_sector" value="grabar_sector" type="submit" class="btn btn-secondary" style="background-color:#5B00B7; color:#white;">Agregar Sector</button>    
          
            
		  </form>    
        </div>
	</div>     
     
	<br><br>
     
     <div class="form-check">
      	<br>
      	<h4 class="fst-italic">Información de las Revisiones de <?php echo "'".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?></h4>
      	<br>
      	<div class="card">
        <form action="proveedor_spa_paso1.php" method="post">
          <div class="input-group col-12">
          
          <table width="100%" align="center" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Revisor</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
              	<?php
					$sql = "SELECT * FROM proveedor_revisiones a 
					where idProveedor = '" . $_SESSION['companyHive'] . "'";
					//echo $sql;
					$query=$con->query($sql);
					$i=0;
					$sectores = array();
					while($r=$query->fetch_object()){ $sectores[]=$r; }
					if(count($sectores)>0){
						foreach ($sectores as $s) {
							$i++;
						?>
						<tr>
						  <th scope="row"><?php echo $s->id; ?></th>
						  <td><?php echo $s->tipo; ?></td>
						  <td><?php echo $s->revisor; ?></td>
                          <td>
                          <a title="Eliminar la revisión <?php echo $s->revisor;?>" href="proveedor_spa_paso1.php?delrevision=<?php echo $s->id; ?>" class="btn btn-outline-danger"><i class="bi bi-eraser"></i></a></td>
						</tr>
						<?php
						}
					}else{
						print "<option value=''>-- NO HAY DATOS --</option>";
					}
				?>				
              </tbody>
            </table>
            
            <select name="tipoRevision" class="form-select" aria-label="Default select example" id="tipoRevision">
			  <option value="A">- Revisión APROBADA -</option>
              <option value="P">- Revisión PENDIENTE -</option>
            </select>
            
            <input name="nombre_revisor" type="text" class="form-control" id="nombre_revisor" placeholder="coloque la organizacion que hace la revisión..." aria-describedby="basic-addon1">
            <button name="grabar_revision" value="grabar_revision" type="submit" class="btn btn-secondary" style="background-color:#5B00B7; color:#white;">Agregar Revision</button>    
          
		  </form>    
        </div>
	</div>

      
      </div>
  </main>
	<br>
    <footer align="center" class="blog-footer" style="background-color:black; color:white;">
      Desarrollado por CP&JCL <a href="https://>strasourcing.com/">StraSourcing.com</a>
      <p>
        <a href="#">ir Arriba</a>
      </p>
    </footer>


<script type="text/javascript">
	$(document).ready(function(){

		$("#sel_depart").change(function(){
			var deptid = $(this).val();
			console.log("entre", deptid);
			$.ajax({
				url: 'extraer_pais.php',
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

<script>
	function myFunctionP() {
		
		var x1 = document.getElementById("flexRadioDefault1");
		var x2 = document.getElementById("flexRadioDefault2");
		var y = document.getElementById("productos");
		var z = document.getElementById("servicios");
		var a = document.getElementById("parte_producto");
		

		if (x1.style.display === "none") {
			y.style.display = "none";
			a.style.display = "none";
			z.style.display = "block";
		} else {
			x2.value = "on";
			x1.value = "";
			y.style.display = "block";
			a.style.display = "block";
			z.style.display = "none";
		}
		//document.getElementById("seccionSubmit").style.display = "block";
	}
	
		
	function myFunctionS() {
			
		var x1 = document.getElementById("flexRadioDefault1");
		var x2 = document.getElementById("flexRadioDefault2");
		var y = document.getElementById("servicios");
		var z = document.getElementById("productos");
		var a = document.getElementById("parte_producto");
					
		if (x2.style.display === "none") {
		
			z.style.display = "block";
			y.style.display = "none";
			a.style.display = "none";
		} else {
			x1.value = "on";
			x2.value = "";
			y.style.display = "block";
			z.style.display = "none";
			a.style.display = "block";
		}
		//document.getElementById("seccionSubmit").style.display = "block";
		document.getElementById("parte_producto").style.display = "none";
	}
	
	function mostrarAutorizacion() {
		var x = document.getElementById("tipo_empresa");
		var y = document.getElementById("myBtnSoporte");
		console.log("valor", x.checked);
		if (x.value != '1'){
			y.style.display = "none";
			//y.style.visibility = "visible"; // show
		}else{
			y.style.display = "block";
			//y.style.visibility = "hidden"; // hide;
		}
	}
	document.getElementById("myBtnSoporte").style.display = "none";
	document.getElementById("productos").style.display = "block";
	document.getElementById("servicios").style.display = "none";
	//document.getElementById("seccionSubmit").style.display = "none";
	document.getElementById("parte_producto").style.display = "block";
	
</script>
    
  </body>
</html>
