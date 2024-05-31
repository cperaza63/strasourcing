<?php 
session_start();
include "../partials/header_registrate.php";
include "../config/conexion.php";
$error="";
$alert="";
$marca=0;
$tipo_empresa = 0;
$categoria=0;
$subcategoria=0;

// mientras, solo pruebas
//$_SESSION['rifHive'] = "J-22222222-9";
$rif_proveedor= $_SESSION['rifHive'];
//
//


//echo "hola ". $_POST['marca'] ." ".$_POST['tipo_empresa']." ".$_POST['categoria']." ".$_POST['subcategoria'];
// selecciona la marca de trabajo
if( isset( $_POST['agregar_categoria'] ) && $_POST['agregar_categoria'] ="agregar_categoria"){
	
	if( $_POST['marca'] != "" ){
		$_SESSION['marca'] = $_POST['marca'];
		$marca = $_POST['marca'];	
	}else{
		$error = "Marca<br>";
	}
	
	if( $_POST['tipo_empresa'] != "" ){
		$_SESSION['tipo_empresa'] = $_POST['tipo_empresa'];
		$tipo_empresa = $_POST['tipo_empresa'];	
	}else{
		$error = "Tipo de empresa<br>";
	}
	
	if( $_POST['categoria'] != "" ){
		$_SESSION['categoria'] = $_POST['categoria'];
		$categoria = $_POST['categoria'];	
	}else{
		$error = $error . "Categoria<br>";
	}
	$cerveza = $_POST['subcategoria'];
	$cuantos = count($cerveza);
		//echo $cuantos;	
	if ($error ==""){
		
		///echo "procedo a grabar";	
		
		for ($i=0;$i<$cuantos;$i++)
		{
			//echo "<br> Cerveza " . $i . ": " . $cerveza[$i];
			$sql = "SELECT * FROM proveedor_marcas WHERE rif = '$rif_proveedor' and marca = $marca and categoria= $categoria 
			and subcategoria=" . $cerveza[$i];
			//echo "<br>" . $sql;
			$query = mysqli_query($conexion, $sql);
			$result = mysqli_fetch_array($query);
			if ($result > 0) {
				//echo "si hay y no agrega ";
			}else{
				if ( $cerveza[$i] != "" ){
					$sql = "INSERT INTO proveedor_marcas 
					(rif, marca, tipo_empresa, categoria, subcategoria) values 
					('$rif_proveedor', $marca, $tipo_empresa, $categoria, ".$cerveza[$i].")";	
					//echo $sql; 
					if ($conexion->query($sql) === TRUE) {
					  //echo "Una nueva marca propuesta por Usted ha sido agregada con exito!";
					} else {
					  echo "Error: " . $sql . "<br>" . $conexionn->error;
					}
				}
			}
		}		
	}else{
		echo $error;
	}
}

// selecciona la marca de trabajo
if ( !isset($_SESSION['marca']) ){
	$_SESSION['marca']=0;	
}

// sabemo si esta marca pertenece al proveedor
$marca_otro = 0;

if( isset( $_POST['buscar_marcas'] ) && $_POST['marca'] !=""){
	//echo " por aqui= " . $_POST['marca'];
	$_SESSION['marca'] = $_POST['marca'];
	$marca = $_POST['marca'];
	// 
	$sql = "SELECT * FROM tabla_control WHERE id = $marca and tipo=10 and rif_proveedor= '$rif_proveedor'";
	$result = $conexion->query($sql);
	$row = $result->fetch_row();
	if ( empty( $row ) ) {
		$marca_otro = 0;
	}else{
		$marca_otro = 1;
	}
}else{
	$marca = $_SESSION['marca'];
}


//echo "== ".$marca_otro;
// solo para grabar el registro
if( isset( $_POST["grabar_marca"] ) ){
	
	$otra_marca = $_POST["otra_marca"];
	
	$sql = "SELECT * FROM tabla_control WHERE tipo=10 and  nombre = '$otra_marca' and  rif_proveedor= '$rif_proveedor'";
	//echo $sql;
	$query = mysqli_query($conexion, $sql);
    
	$result = mysqli_fetch_array($query);
    
	if ($result > 0) {
	$alert = '<div class="alert alert-success" role="alert"> Atención, la marca que usted quiere agregar ya se encuentra registrada...</div>';
		echo $alert;
	}else{
		if ( isset($rif_proveedor ) && isset( $otra_marca ) ){
			$sql = "INSERT INTO tabla_control (tipo, nombre, nombre_tabla, image_id, rif_proveedor) values (10,'$otra_marca','Otras Marcas',0,'$rif_proveedor')";	
			
			//echo $sql; 
			
			if ($conexion->query($sql) === TRUE) {
			  //echo "Una nueva marca propuesta por Usted ha sido agregada con exito!";
			} else {
			  echo "Error: " . $sql . "<br>" . $conexionn->error;
			}
			
		}else{
			?>
			<script>
				alert("Atención, la marca que usted quiere agregar ya se encuentra registrada...");
			</script>
			<?php
		}
		?>
		<script>
			alert("Marca ha sido agregada a su lista propuesta...");
		</script>
		<?php
	}

}
// solo para productos
if( isset( $_POST["tipoProducto"] ) ){
	
}

// solo para servicios
if( isset( $_POST["tipoServicio"] ) ){



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
    

  </head>
  <body style="background-color:#E6E6E6;">
    <br><br><br><br>
    <main class="container" style="background-color:white;">
   	    <div class="container" >
          <header class="blog-header lh-1 py-3">
            <div class="row flex-nowrap justify-content-end align-items-end">
              <div class="col-4 d-flex justify-content-end align-items-end">
                <a class="btn btn-sm btn-outline-secondary" href="../outside.php">Regresar al Menu principal</a>
              </div>
            </div>
          </header>
        </div>
        <div class="col-md-12 px-0" style="background-color:white;">
          <h5 class="display-4 fst-italic">Registración del PROVEEDOR </h5>
          	<br>
            <div class="form-check" style="background-color:white;">
              <input name="flexRadioDefaultA" type="radio" class="form-check-input" id="flexRadioDefault1" onclick="myFunctionP()" checked="checked" >
              <label class="form-check-label" for="flexRadioDefault1" style="color:#5B00B7;" >
                <strong>EMPRESA QUE MANEJA PRODUCTOS</strong>
              </label>
            </div>
            <div class="form-check" style="background-color:white;">
              <input class="form-check-input" type="radio" name="flexRadioDefaultA" id="flexRadioDefault2" onclick="myFunctionS()">
              <label class="form-check-label" for="flexRadioDefault2" style="color:#5B00B7;">
                <strong>EMPRESA QUE OFRECE SERVICIOS</strong>
              </label>
            </div>
			<br>
        </div>
     

      <form name="form_parte2" action="" method="post">
        <div  class="row g-5 center-h center-v" >
          <!-- PASO #1 -->
          <div class="col-md-10" style="background-color:white;">
            <div id = "productos" class="p-4 mb-3 bg-secondary-subtle rounded">
            	
                <input type="hidden" name="tipoProducto" value= "p" />
                
                <h4 class="fst-italic">Información de Empresa PARTE 2 de 3 - Rif <?php echo $rif_proveedor; ?></h4>
                
              <p class=" text-justify mb-0" >
              <div class="input-group mb-3" >
                <select name="marca" class="form-select" aria-label="Default select example" id="marca">
                  <option value="">- Seleccione una Marca -</option>
                    <?php
					
					if( isset($rif_proveedor) ){
						$sql = "select * from tabla_control where tipo = 8 or (tipo = 10 and rif_proveedor = '$rif_proveedor') order by tipo desc, nombre";	
					}else{
						$sql = "select * from tabla_control where tipo = 8 order by tipo desc, nombre";		
					}
					
					//echo $sql;
					
					$query=$conexion->query($sql);
					
					$marcas = array();
					while($r=$query->fetch_object()){ $marcas[]=$r; }
					if(count($marcas)>0){
						foreach ($marcas as $s) {
							?>
							<option value="<?php echo $s->id; ?>"
                            	<?php echo $s->id == $marca ? "selected": ""; ?>
                            > <?php echo $s->nombre; ?></option>
                            <?php
							}
						}else{
							print "<option value=''>-- NO HAY DATOS --</option>";
						}
					?>
                  </select>
                  <button name="buscar_marcas" value="buscar_marcas" type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                  <input name="otra_marca" type="text" class="form-control" id="otra_marca" placeholder="otro, especifique..." aria-describedby="basic-addon1">
                  
                  <button name="grabar_marca" value="grabar_marca" type="submit" class="btn btn-secondary" style="background-color:#5B00B7;">Grabar Marca</button>
              </div>
               
                
           	  <div><strong>Relacion con Marca</strong> </div>
              <div class="input-group mb-3">
                  <select name="tipo_empresa" required class="form-control" id="tipo_empresa" aria-label="Default select example" onclick="mostrarAutorizacion()">
                    <option value="2" <?php echo $tipo_empresa == 2 ? "selected": ""; ?>>Es una fábrica de la marca</option>
                    <option value="3" <?php echo $tipo_empresa == 3 ? "selected": ""; ?>>Es una comercializadora de la marca</option>
                    <option value="1" <?php echo $tipo_empresa == 1 ? "selected": ""; ?>>Es un distribuidor Autorizado</option>
                  </select>
                  <!--<button id="carta_autorizacion" type="submit" class="btn btn-outline-warning" <i class='bi bi-card-image' title="Subir autorización">Subir Carta Autorización</button>-->
              </div>
               
                <!-- cargamos categoirias -->              
                <div><strong>Categorias </strong></div>
                	<?php
					if ( $marca_otro*1 == 1 ){
					?>
                        <select class="form-control" id="sel_depart" name="categoria">
                            <option value="0">- Seleccione Categoria -</option>
                            <?php 
                            // llamamos a los registros
                            $sql_department = "SELECT * FROM php_combo.continente group by name";
                            $department_data = mysqli_query($conexion,$sql_department);
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
					}else{
						?>
						<select class="form-control" id="sel_depart" name="categoria">
                            <option value="0">- Seleccione Categoria ...-</option>
                            <?php 
                            // llamamos a los registros del proveedor
                            $sql_department = "SELECT a.marca, a.categoria as id, b.name FROM php_combo.marca_catsubcatgrupo a inner join php_combo.continente b on (a.categoria = b.id) where a.marca = $marca group by a.categoria";
							//echo $sql_department;
                            $department_data = mysqli_query($conexion,$sql_department);
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
					}
					?>
				
                  <!-- cargamos subcategoirias -->
	              <div><strong>Subcategorias</strong> </div>
                  	

                        <select name="subcategoria[]" size="5" multiple="MULTIPLE" class="form-control" id="sel_user">
                            
                            <?php
                            $sql_department = "SELECT * FROM php_combo.pais where continente_id = $categoria";
                            $department_data = mysqli_query($conexion,$sql_department);
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
                    
                <br>    
				<div class="col-12 d-flex justify-content-end align-items-end">
                    <button id="agregar_categoria" name="agregar_categoria" value="agregar_categoria" type="submit" class="btn btn-secondary"  style="background-color:#5B00B7;">Agregar categoria </button>
                </div>
                <br>
	           <div id="parte_producto" class="clear">                
                    <iframe class="responsive-iframe" src="../relacion_marca_cat/index_Proveedor_marcas.php?t=outside" width="100%" height="700px" style="border:none;"></iframe>	
                   </div>
           	</div>
              
               </p>
               
	
            <div id = "servicios" class="p-4 mb-3 bg-secondary-subtle rounded">
            
            	<input type="hidden" name="tipoServicio" value= "s" />                
                
              <h4 class="fst-italic">Información de la Empresa - PARTE 2 de 3 - Rif <?php echo $rif_proveedor; ?></h4>
              <p class=" text-justify mb-0" >
                <br>
                <iframe class="responsive-iframe" src="../servicios_checbox" width="100%" height="610px" style="border:none;"></iframe>

              </p>
            </div>
            <hr>
            </div>
            <div class="col-md-8" style="background-color:white;">
                <div class="position-sticky" style="top: 2rem;">
                    <input type="hidden" name="accion" value="paso3"/>
                    <h4 class="fst-italic">Seguir con página 3</h4>
                    <a href="./proveedor_paso3.php"> 
						<button name="accion" value="paso3" type="button" class="btn btn-secondary" style="background-color:#5B00B7;">Ir paso 3</button>
                    </a>
                   <div class="row flex-nowrap justify-content-end align-items-end">
			          <div class="col-4 d-flex justify-content-end align-items-end">
           		        <a class="btn btn-sm btn-outline-secondary" href="proveedor.php">Regresar al PASO 1</a>
                      </div>
                   </div>

                  <hr>
                  <br>
                </div>
              </div>
           </form>
           
       </div>
   </div>
        
        
        
        </form>
      </div>
  </main>
	<br>
   <footer align="center" class="blog-footer" style="background-color:black; color:white;">
 Todos los drechos reservados <a href="https://strasourcing.com/">StraSourcing.com</a> por <a href="https://ciudadhive.com">@CP&JCL</a>.
  <p>
    <a href="#">Ir arriba</a>
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
	myFunctionP();
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
		var y = document.getElementById("carta_autorizacion");
		console.log("valor", x.checked);
		if (x.value != '1'){
			y.style.display = "none";
			//y.style.visibility = "visible"; // show
		}else{
			y.style.display = "block";
			//y.style.visibility = "hidden"; // hide;
		}
	}
	document.getElementById("carta_autorizacion").style.display = "none";
	document.getElementById("productos").style.display = "block";
	document.getElementById("servicios").style.display = "none";
	//document.getElementById("seccionSubmit").style.display = "none";
	document.getElementById("parte_producto").style.display = "block";
	
</script>
    
  </body>
</html>
