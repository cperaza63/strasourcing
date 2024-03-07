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
include "proveedor_spa_parte2_accion.php"; 
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

      <!--<div class="form-check">
      	<br>
      	<h4 class="fst-italic">Información de la Empresa - Productos y Servicios</h4>
      	<br>
      	<div class="row">
        <form action="" method="post">
          <div class="input-group col-12" style="margin-left:50px;">
          
          <table width="100%" align="center" class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sector</th>
                  <th scope="col">Porcentaje</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
              	<?php
$sql = "SELECT a.id, a.idProveedor, a.sector, a.porcentaje, b.nombre, b.image_id, c.images FROM proveedor_sectores a inner join tabla_control b ON (b.id = a.sector) left join table_images c ON (b.image_id = c.id) where b.tipo=11 and a.idProveedor = '" . $_SESSION['companyHive'] . "'";
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
                          <a title="Eliminar relacion sector <?php echo $s->nombre;?> del proveedor <?php echo $s->idProveedor;?>" href="proveedor_spa_paso2.php?del=<?php echo $s->id; ?>" class="btn btn-danger"><i class="bi bi-eraser"></i></a></td>
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
            <button name="grabar_sector" value="grabar_sector" type="submit" class="btn btn-primary">Agregar Sector</button>    
          
            
		  </form>    
        </div>
	</div>-->  
    	<div class="container-fluid">  
        <br> 
     	<h4>
		  <?php echo "Productos y Servicios de '".$_SESSION['razonSocialHive']."' ".$_SESSION['companyHive']; ?>
        </h4>
        </div>
        
        <br>
       <div class="container-fluid">
       	
         <div class="form-check">
          <input name="flexRadioDefaultA" type="radio" class="form-check-input" id="flexRadioDefault1" onclick="myFunctionP()" checked="checked" >
          <label class="form-check-label" for="flexRadioDefault1" style="color:#5B00B7;" >
            <strong>EMPRESA QUE MANEJA PRODUCTOS</strong>
          </label>
        </div>
    
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefaultA" id="flexRadioDefault2" onclick="myFunctionS()">
          <label class="form-check-label" for="flexRadioDefault2" style="color:#5B00B7;">
            <strong>EMPRESA QUE OFRECE SERVICIOS</strong>
          </label>
        </div>
	  </div>
      <form name="form_parte2" action="proveedor_spa_paso2.php" method="post">

          <!-- PASO #1 -->
          <div class="col-md-12" style="background-color:white;">
            <div id = "productos" class="p-4 mb-3 bg-secondary-subtle rounded">
            	
                <input type="hidden" name="tipoProducto" value= "p" />
                
                
                
              <p class=" text-justify mb-0" >
              
              
           	  <div class="container" style="background-color:white;">
                    <header class="blog-header lh-1 py-3">
                      <div class="row flex-nowrap justify-content-center align-items-end">
                        
                      </div>
                    </header>
              </div>

                <!-- cargamos categoirias -->              
                <div><strong>Categoria </strong>- Establezca un categoria que será relacionada con la marca </div>
                	<?php
					/*echo "===" . $marca_otro ;
					if ( $marca_otro*1 == 0 ){*/
					?>
                        <select class="form-control" id="sel_depart" name="categoria">
                            <option value="0">- Seleccione Categoria -</option>
                            <?php 
                            // llamamos a los registros
                            $sql_department = "SELECT * FROM php_combo.continente where status=1 group by name";
							$department_data = mysqli_query($con,$sql_department);
                            while($row = mysqli_fetch_assoc($department_data) ){
                                $departid = $row['id'];
                                $depart_name = $row['name'];
                            
                                // Opciones con registros
                                ?>
                                <option value="<?php echo $departid; ?>" 
                                <?php echo $categoria == $departid ? "selected": "" ?>
                                ><?php echo $depart_name ." - " . $departid ?></option>
                                <?php
                            }
                            ?>
                        </select>                    
					<?php
					/*}else{
						?>
						<select class="form-control" id="sel_depart" name="categoria">
                            <option value="0">- Seleccione Categoria ...-</option>
                            <?php 
                            // llamamos a los registros del proveedor
                            $sql_department = "SELECT a.marca, a.categoria as id, b.name FROM php_combo.marca_catsubcatgrupo a inner join php_combo.continente b on (a.categoria = b.id) where a.marca = $marca group by a.categoria";
							//echo $sql_department;
                            $department_data = mysqli_query($con,$sql_department);
                            while($row = mysqli_fetch_assoc($department_data) ){
                                $departid = $row['id'];
                                $depart_name = $row['name'];
                            
                                // Opciones con registros
                                ?>
                                <option value="<?php echo $departid; ?>" 
                                <?php echo $categoria == $departid ? "selected": "" ?>
                                ><?php echo $depart_name ." - " . $departid ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
					}*/
					?>
				
                  <!-- cargamos subcategoirias -->
	              <div><strong>Subcategorias</strong> <strong> </strong>- Establezca un sub-categoria que será relacionada con la marca</div>
                  	

                        <select name="subcategoria[]" size="5" multiple="MULTIPLE" class="form-control" id="sel_user">
                            
                            <?php
                            $sql_department = "SELECT * FROM php_combo.pais where continente_id = $categoria";
                            $department_data = mysqli_query($con,$sql_department);
                            while($row = mysqli_fetch_assoc($department_data) ){
                                $departid = $row['id'];
                                $depart_name = $row['name'];
                                ?>
                                <option value="<?php echo $departid; ?>"  
                                    <?php for ($i=0;$i<$cuantos;$i++) { 
                                    if( $cerveza[$i] == $departid){
                                        echo "selected";                                
                                        }
                                    }
                                    ?>
                                    ><?php echo $depart_name; ?></option>
                                    <?php
                            }
                            ?>
                        </select>    
                    
              <hr>
              <strong>Escoja una  Marca</strong> - que se relacione con la categoria y subcategoria anterior seleccionada<strong> (<em>* - es una maca propuesta por el proveedor</em>)</strong>
<div class="input-group mb-3">
          <select name="marca" class="form-select" aria-label="Default select example" id="marca" >
                  <option value="">- Seleccione una Marca -</option>
                    <?php
					
					//
					// mientras, solo pruebas
					
					 // $rif_proveedor= "345345353453";
					 
					//
					//

					if( isset($rif_proveedor) ){
						$sql = "select * from tabla_control where tipo = 8 or (tipo = 10 and rif_proveedor = '$rif_proveedor') order by tipo desc, nombre";	
					}else{
						$sql = "select * from tabla_control where tipo = 8 order by tipo desc, nombre";		
					}
					
					//echo $sql;
					
					$query=$con->query($sql);
					
					$marcas = array();
					while($r=$query->fetch_object()){ $marcas[]=$r; }
					if(count($marcas)>0){
						foreach ($marcas as $s) {
							$marcaProviene = $s->tipo == 10 ? " *": "";
							?>
							<option value="<?php echo $s->id; ?>"
                            	<?php echo $s->id == $marca ? "selected": ""; ?>
                            > <?php echo $s->nombre . $marcaProviene; ?></option>
                            <?php
							}
						}else{
							print "<option value=''>-- NO HAY DATOS --</option>";
						}
					?>
                </select>
                  <button name="buscar_marcas" value="buscar_marcas" type="submit" class="btn btn-secondary" style="background-color:#5B00B7; color:white;"><i class="bi bi-search"></i></button>
                  <input name="otra_marca" type="text" class="form-control" id="otra_marca" placeholder="otro, especifique, luego esta marca podrá ser incorporada a nuestra lista" aria-describedby="basic-addon1">
                  
                  <button name="grabar_marca" value="grabar_marca" type="submit" class="btn btn-outline-secondary" style="color:#5B00B7;">Grabar otra Marca</button>
              </div>
           	  <div><strong>Como representa su empresa a esta  Marca</strong> - se le pedira un soporte si es distribuidor autorizado</div>
              <div class="input-group mb-3">
                  <select name="tipo_empresa" required class="form-control" id="tipo_empresa" aria-label="Default select example" onclick="mostrarAutorizacion()">
                    <option value="2" <?php echo $tipo_empresa == "2" ? "selected": ""; ?>>Es una fábrica de la marca - Rif #<?php echo $rif_proveedor; ?></option>
                    <option value="3" <?php echo $tipo_empresa == "3" ? "selected": ""; ?>>Es una comercializadora de la marca - Rif #<?php echo $rif_proveedor; ?></option>
                    <option value="1" <?php echo $tipo_empresa == "1" ? "selected": ""; ?>>Es un distribuidor Autorizado - Rif #<?php echo $rif_proveedor; ?></option>
                  </select>
                  
                  <button id="myBtnSoporte" type="button" class="btn btn-warning" title="Subir Autorización">
                    <i class='bi bi-card-image'></i> Autorizacion </button>        
                    
                   
                <div id="myModalSoporte" class="modal">						
                          <!-- Modal content -->
                          <div class="modal-content">
                            <!--<div class="modal-header">
                              <!--<span class="close">&times;</span>
                              <h2>Subir imagen autorización la empresa</h2>
                            </div>-->
                            <div class="modal-body">
                              <!--<p><a href="../subirUnArchivo/index.php">Subir imagenes - SPA</a>-->
                              <div class="container_modal"> 
                                  <iframe class="responsive-iframe" src="../subirUnArchivo/index1.php?tipoEmpresa=4&tipoTabla=15&marca=<?php echo $marca; ?>&rifCompany=<?php echo $rif_proveedor; ?>&folder=<?php echo "/assets/documentos/imagenes/logos/"; ?>"></iframe>
                              </div>
                             <!-- </p>-->
                            </div>
                            <div class="modal-footer">
                            <a href="proveedor_spa_paso2.php">
                            <button class="btn btn-secondary" style="background-color:#5B00B7; color:white;">
                              <h3>Cerrar Ventana y Refrescar</h3>
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
             
              
              <div class="col-12 d-flex justify-content-end align-items-end">
          <button id="agregar_categoria" name="agregar_categoria" value="agregar_categoria" type="submit" class="btn btn-secondcary" style="background-color:#5B00B7; color:white;">Agregar categoria </button>
              </div>
                <br>
                
                 <div class="input-group mb-3">
                 <h5>Autorizaciones de uso de la marca</h5>
                  <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col"># Rif</th>
                              <th scope="col">Marca</th>
                              <th scope="col">Autorización</th>
                              <th scope="col">Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = "SELECT a.id, a.rif, a.marca, b.nombre, a.imagen FROM proveedor_marcas a inner join tabla_control b ON (b.id = a.marca) where b.tipo=8 and a.imagen <>'' and a.rif = '" . $rif_proveedor . "' group by a.marca";
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
                              <th scope="row"><?php echo $s->rif; ?></th>
                              <td><?php echo $s->nombre; ?></td>
                              <td>
                                <img src="<?php echo "../../assets/documentos/imagenes/autorizaciones/". $s->imagen; ?>" width="80px" alt=""/>
                              </td>
                              <td>
                              <a title="Eliminar imagen autorizacion de la marca del proveedor" href="proveedor_spa_paso2.php?delImagen=<?php echo $s->id; ?>" class="btn btn-outline-danger"><i class="bi bi-eraser"></i></a></td>
                            </tr>
                            <?php
                            }
                        }else{
                            print "<option value=''>-- NO HAY DATOS --</option>";
                        }
                    ?>				
                  </tbody>
                </table>
              </div>                
                
                <br>
	           <div id="parte_producto" class="clear">                
                    <iframe class="responsive-iframe" src="../relacion_marca_cat/index_Proveedor_marcas.php?t=inside" width="100%" height="3800px" style="border:none;"></iframe>	
                   </div>
           	</div>
              
               </p>
               
	
            <div id = "servicios" class="p-4 mb-3 bg-secondary-subtle rounded">
            
            	<input type="hidden" name="tipoServicio" value= "s" />                
                
              
              <p class=" text-justify mb-0" >
                <br>
                <iframe class="responsive-iframe" src="../servicios_checbox" width="100%" height="1400px" style="border:none;"></iframe>

              </p>
            </div>
            <hr>
            </div>
           </form>
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
