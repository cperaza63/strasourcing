<?php 
session_start();
include "Conexion.php";
$db 	=  connect();
$dbSPA 	=  connectSPA();
include_once '../config/conexion.php';	
include_once '../objects/tablaContacto.php';
$s="";
$m="";
$id = 0;
if(!isset($_SESSION['accion_dir'] ) ) {
	$_SESSION['accion_dir'] = "categoria";
	$_SESSION['formula_id']=""; 
}

if( isset($_GET['accion']) && $_GET['accion']!=""){
	$_SESSION['accion_dir'] = $_GET['accion'];	
}

if (isset( $_POST['formulas'] ) && $_POST['formulas'] != "" ) {
	$_SESSION['formula_id']= $_POST['formulas'];
}
								
if(!isset($_SESSION['formulas_registro'] ) ) {
	$_SESSION['formulas_registro']="";
	$_SESSION['formula_id']=""; 
}
$searchResultHTML = "";
$query5 = "";

//echo "===". $_SESSION['accion_dir'];

include('inc/header.php');

if( isset($_GET['cat']) ){
	$_SESSION['continente_id'] = isset($_GET['cat']);	
}

if( empty( $_SESSION['pais_id']) ){
	 $_SESSION['pais_id'] = 0;
}

if( empty( $_SESSION['ciudad_id']) ){
	 $_SESSION['ciudad_id'] = 0;
}

if( !isset($_SESSION['preferencia']) ){
	$_SESSION['preferencia'] = "";
}

if( !isset($_SESSION['marca_seleccion']) ){
	$_SESSION['marca_seleccion'] = "";
}

if( isset($_POST['preferencia']) ){
	$_SESSION['preferencia'] = $_POST['preferencia'];
	$preferencia = $_POST['preferencia'];
}else{
	$preferencia = $_SESSION['preferencia'];
}

if( !isset($_SESSION['pais_origen']) ){
	$_SESSION['pais_origen'] = "";
}

if( !isset($_SESSION['nombre_origen']) ){
	$_SESSION['nombre_origen'] = "";
}
if( !isset($_SESSION['marca_producto']) ){
	$_SESSION['marca_producto'] = "";
}
if( !isset($_SESSION['marca_nombre']) ){
	$_SESSION['marca_nombre'] = "";
}
if( !isset($_SESSION['ciudad_id']) ){
	$_SESSION['ciudad_id'] = "";
}



// aqui la rutina para mandar los nuevos mensaje
if (isset($_POST['submit']) && !empty($_POST['submit']) && $_POST['submit'] == 'Enviar') {
    $alert = "";
    if ( (empty($_POST['idEmpresa']) && empty($_POST['idProveedor'] ) ) || empty($_POST['asunto']) || empty($_POST['mensaje'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Todo los campos son obligatorios
        </div>';
        echo "algo esta vacio";
    } else {
		
        $idEmpresa   = isset($_POST['idEmpresa']) ? $_POST['idEmpresa'] : 0;
        $idProveedor = isset($_POST['idProveedor']) ? $_POST['idProveedor'] : 0;
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
        $telefonoEmpresa = "";
        $emailEmpresa = "";
        $direccionEmpresa = "";
        $nombreEmpresa = "";
		
		//echo "<br>Administrador:" . $idEmpresa;
		$negocio = 1;
		$telefonoEmpresa = "n/a";
		$emailEmpresa = "?@?.?";
		$direccionEmpresa = "n/a";
		$nombreEmpresa = "Administracion";
		$rifDestino = "n/a"; 
        
        $sq = "SELECT * FROM tabla_contactos where companyDestino= $negocio 
        and usuario = '" . $_SESSION['loginHive'] . "' and comentario = '$asunto $mensaje'";
        
        //echo $sq;
        
        $query = mysqli_query($conexion, $sq);
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-warning" role="alert">
                        El mensaje ya existe, esta duplicado
                    </div>';
            echo $alert;
        } else {
            $sq1= "INSERT INTO tabla_contactos(rifDestino, rifEnvia, companyEnvia, companyDestino, usuario, 
            telefono, email, direccion, empresa, comentario) values (
            '" . $rifDestino . "', '" .$_SESSION['rifHive'] . "', " . $_SESSION['companyHive'] . ", " . $negocio . ", '" . $_SESSION['loginHive'] . "', 
            '$telefonoEmpresa', '$emailEmpresa', '$direccionEmpresa', '$nombreEmpresa', '$asunto $mensaje')";
            //echo $sq1;
            $query_insert = mysqli_query($conexion, $sq1);
            
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            mensaje enviado
                        </div>';
				?>
				<script>
					alert('Mensaje enviado');
	                //window.location="vistaContactanos.php";
				</script>	
                <?php
                //header("Location: usuarios.php");
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al enviar mensajeria
                    </div>';
            }
        }
    }
}
// fin de rutina de nuevos mensaje


?>
<title>Busqueda y Filtro de Negocios con StraSourcing</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
<script src="js/search.js"></script>
<link rel="stylesheet" href="css/style.css">
<?php include('inc/container.php');?>
<div class="container">		
	<!--<h2>Busqueda y Filtro de Negocios con StraSourcing</h2>-->
	<?php
	include 'class/Product.php';
	$product = new Product();	
	?>
	<div class="row">
	  <form method="post">
        
          <div id="barra_lateral" class="col-md-3"> 
          	
            <div class="list-group">
              <div class="user-profile" align="center"><a href="#"><img src="<?php echo $_SESSION['imagencat_selected'];?>" alt="avatar" height="90"></a></div>
              <h5><strong>Categoria Seleccionada (#<?php echo $_SESSION['continente_id']; ?>)</strong></h5><strong>
                <input class="form-control" id="categoria" style="color:#5B00B7;" value="<?php echo $_SESSION['nombrecat_selected'];?>" readonly>
                <input id="idCategoria" type="hidden" value="<?php echo $_SESSION['continente_id'];?>">
                </strong>
                
                
              <h5><strong>Subcategorías</strong></h5>
                <select name="pais_id" class="form-control productDetail" id="subcategoria" style="color:#5B00B7;">
                  <?php
                  $query=$db->query("select * from pais where continente_id=$_SESSION[continente_id]");
                    $states = array();
                    while($r=$query->fetch_object()){ $states[]=$r; }
                    if(count($states)>0){
                        print "<option value=''>Todas las Subcategorias</option>";
                        foreach ($states as $s) {
                            if ( $_SESSION['pais_id'] == $s->id ){
                                $_SESSION['nombre_pais'] = $s->name;
                                $seleccion = " selected ";	
                            }else{
                                $seleccion = "";	
                            }
                            print "<option value='$s->id' $seleccion> $s->name </option>";
                    }
                    }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                    }
                  ?>
               </select>
    
              <h5><strong>Grupos de Productos</strong></h5>
                <select name="ciudad_id"  class="form-control productDetail" id="grupo" style="color:#5B00B7;">
                    <?php
						
						$sq= "select * from ciudad where pais_id = " . $_SESSION['pais_id'];
						echo $sq;
						
                        $query=$db->query( "select * from ciudad where pais_id = " . $_SESSION['pais_id'] );
                        $states = array();
                        while($r=$query->fetch_object()){ $states[]=$r; }
                        if(count($states)>0){
                            print "<option value=''>Todos los grupos de productos</option>";
                            foreach ($states as $s) {
                                if ( $_SESSION['ciudad_id'] == $s->id ){
                                    $seleccion = " selected ";	
                                    $_SESSION['nombre_ciudad'] = $s->name;
                                }else{
                                    $seleccion = "";	
                                }
                                print "<option value='$s->id' $seleccion> $s->name </option>";
                            }
                        }else{
                            print "<option value=''>-- NO HAY DATOS --</option>";
                        }
                    ?>
               </select>
               
               <h5><strong>Preferencia de búsqueda</strong></h5>	
              <select name="preferencia" id="preferencia" class="form-control productDetail" style="color:#5B00B7;">
                    <option value="">Escoja como quiere buscar</option>
                    <option value="marca"  <?php if ( $_SESSION['preferencia'] == "marca"){ echo "selected";}?>><strong>Por marca del producto</strong></option>
                    <option value="origen" <?php if ( $_SESSION['preferencia'] == "origen"){ echo "selected";}?>><strong>Por país de origen de la marca</strong></option>
              </select>
               
                <select id="marca_producto" class="form-control productDetail" name="marca_producto" style="color:#5B00B7;" required>
                    <?php
						// $_SESSION['marca_producto']
						
                        $sq= "SELECT a.marca, b.nombre, a.categoria, a.subcategoria, b.rif_proveedor FROM proveedor_marcas a inner join tabla_control b ON (tipo=8 and a.marca = b.id) WHERE a.idCompany=0 and a.categoria = 1 and subcategoria=1 group by a.marca";
                        echo $sq;
                        $query = $dbSPA->query($sq);
                        $states = array();
                        while($r=$query->fetch_object()){ $states[]=$r; }
                        if(count($states)>0){
                            print "<option value=''>Todas las marcas de productos</option>";
							print "<option value='0'>*** NO CONSIGO LA MARCA ***</option>";
                            foreach ($states as $s) {
                                if ( $m == $s->marca ){
                                    $seleccion = " selected ";	
                                    $_SESSION['marca_nombre'] = $s->nombre;
                                }else{
                                    $seleccion = "";	
                                }
                                print "<option value='$s->marca' ><strong> $s->nombre</strong></option>";
                            }
                        }else{
                            print "<option value=''>-- NO HAY DATOS --</option>";
                        }
                    ?>
                </select>
              
                  <div class="list-group">
                      <select id="pais_origen" class="form-control productDetail" name="pais_origen" style="color:#5B00B7;">
                        <?php
                            $sq= "SELECT c.country_code, c.country_name, a.categoria, a.subcategoria, a.marca, b.rif_proveedor FROM proveedor_marcas a inner join tabla_control b ON (tipo=8 and a.marca = b.id) INNER JOIN tbl_paises c ON (b.rif_proveedor = c.country_code) WHERE a.idCompany=0 and a.categoria = 1 and subcategoria=1 group by b.rif_proveedor";
                            echo $sq;
                            $query = $dbSPA->query($sq);
                            $states = array();
                            while($r=$query->fetch_object()){ $states[]=$r; }
                            if(count($states)>0){
                                print "<option value=''>Todos los paises de origen</option>";
								print "<option value='0'>*** NO CONSIGO PAIS DE ORIGEN ***</option>";
                                foreach ($states as $s) {
                                    if ( $_SESSION['pais_origen'] == $s->country_code ){
                                        $seleccion = " selected ";	
                                        $_SESSION['nombre_origen'] = $s->country_name;
                                    }else{
                                        $seleccion = "";	
                                    }
                                    print "<option value='$s->country_code' $seleccion><strong> $s->country_name </strong></option>";
                                }
                            }else{
                                print "<option value=''>-- NO HAY DATOS --</option>";
                            }
                        ?>
                    </select>
              </div>
              
              <div id="asistencia" class="list-group">
                <h5><strong>Si desea asistencia en la búsqueda</strong></h5>
					<a href="#" class="btn btn-secondary" style="background-color:#5B00B7; color:white;"
                     data-toggle="modal" data-target="#nuevo_mensaje">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    Enviar solicitud soporte
                    </a>
                </div>  


            <div class="list-group">
            <h5><strong>Guardar su filtro de búsqueda</strong></h5>
              <input id="texto_etiqueta" name="texto_etiqueta" type="text" class="form-control" placeholder="ej:empresas en Valencia" />
              <button type="button" id="etiquetar" name="etiquetar" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                Etiquetar busqueda
                </button>
                <div id="mensaje_etiqueta"></div>
            </div>
                
				
                
				<h5><strong>Búsqueda Avanzada</strong></h5>
              	
              <h5><strong>por Estado</strong></h5>
                <select id="listaEstados" class="form-control productDetail" name="listaEstados" style="color:#5B00B7;">
                  <?php
                  $query=$dbSPA->query("select id, state from estados order by state");
                    $states = array();
                    while($r=$query->fetch_object()){ $states[]=$r; }
                    if(count($states)>0){
                        print "<option value=''>Todos los Estados</option>";
                        foreach ($states as $s) {
                            print "<option value='$s->id' $seleccion> $s->state </option>";
                    }
                    }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                    }
                  ?>
               </select>
    
              <h5><strong>por Ciudad</strong></h5>
                <select id="listaCiudades" class="form-control productDetail" name="listaCiudades" style="color:#5B00B7;">
                    <option value="">Todas las ciudades</option>
               </select>
              
               <br>
               <h5><strong>Actividad Comercial</strong></h5>

               <h5><strong>Tipo de Empresa</strong></h5>
	           	<select id="tipo_empresa" class="form-control productDetail" style="color:#5B00B7;" name="tipo">
                    <option value="">Selecciona todos los tipos de empresas</option>
                    <option value="2">Fabricante de la marca</option>
                    <option value="3">Comercializadora</option>
                    <option value="1">Distribuidor Autorizado</option>
	            </select>
              
           	  <h5><strong>Especializado en el Sector</strong></h5>
	           	<select id="listaSectores" class="form-control productDetail" name="listaSectores" style="color:#5B00B7;">
                	<option value="">Selecciona todos los sectores</option>
                  <?php				  
				  $sql = "SELECT a.id, a.idProveedor, a.sector, a.porcentaje, b.nombre, b.image_id, c.images FROM proveedor_sectores a 
                  inner join tabla_control b ON (b.id = a.sector) 
                  left join table_images c ON (b.image_id = c.id) 
                  where b.tipo=11 group by a.sector order by b.nombre";
                  $query=$dbSPA->query($sql);
                    $states = array();
                    while($r=$query->fetch_object()){ $states[]=$r; }
                    if(count($states)>0){
                        foreach ($states as $s) {
                            print "<option value='$s->sector' $seleccion> $s->nombre </option>";
                    }
                    }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                    }
                  ?>
               </select>
              
              	<h5><strong>Con información en el internet</strong></h5>
	           	<select id="soporte_internet" class="form-control productDetail" name="internet" style="color:#5B00B7;">
                    <option value="">Selecciona todas la empresa</option>
                    <option value="web">Utiliza página web oficial</option>
                    <option value="redes">Está en las redes sociales</option>
	            </select>
              
                <h5><strong>Con verificación del proveedor</strong></h5>
	           	<select id="verificacion_proveedor" class="form-control productDetail" style="color:#5B00B7;">
                    <option value="">Selecciona todas las empresas</option>
                    <option value="mg">Verificado por Mg</option>
                    <option value="tercero">Verificado por un tercero</option>
                    <option value="pendiente">Por verificar</option>
	            </select>
              
              
				<div style="display: none">          	
                	<h5><strong>Marca</strong></h5>
                    <select id="marca" class="form-control" style="color:#5B00B7;">
                    <option value="">Selecciona todas las marca</option>
                    <option value="Honor">Honor</option>
                    <option value="Moto">Moto</option>
                    <option value="Google">Google</option>
	                </select>
				</div>
                
              <h5><strong>Selección</strong></h5>
                <input class="form-control" id="accion_menu" value="<?php echo $_SESSION['accion_dir']; ?>" readonly >
				<input class="form-control" id="formula_registro" value="<?php echo $_SESSION['formula_id']; ?>" readonly >
                 
            </div>    
            
            <div class="list-group" style="display: none">
              <h5><strong>Precio<strong></h5>	
                <div class="list-group-item">
                    <input id="priceSlider" data-slider-id='ex1Slider' type="text" data-slider-min="1000" data-slider-max="65000" data-slider-step="1" data-slider-value="14"/>
                    <div class="priceRange"><span  style="color:#5B00B7;">1000 - 65000</span></div>
                    <input type="hidden" id="minPrice" value="0" />
                    <input type="hidden" id="maxPrice" value="65000" />                  
                </div>			
            </div>
            <div class="list-group" style="display: none">
              <h5><strong>RAM<strong></h5>
                <?php			
                $ram = $product->getRam();
                foreach($ram as $ramDetails){	
                ?>
                <div class="list-group-item checkbox">
                <label><input type="checkbox" class="productDetail ram" value="<?php echo $ramDetails['ram']; ?>" > <span style="color:#5B00B7;"><?php echo $ramDetails['ram']; ?> GB</span></label>
                </div>
                <?php    
                }
                ?>
            </div>    
            <div class="list-group" style="display: none">
                <h5><strong>Almacenamiento interno<strong></h5>
                <?php
                $storage = $product->getStorage();
                foreach($storage as $storageDetails){	
                ?>
                <div class="list-group-item checkbox">
                <label><input type="checkbox" class="productDetail storage" value="<?php echo $storageDetails['storage']; ?>"><span style="color:#5B00B7;"><?php echo $storageDetails['storage']; ?> GB</span></label>
                </div>
                <?php
                }
                ?> 
            </div>
        </div>
        
    </form>
    
    <div class="col-md-9">
		<br />
		<?php
		if(isset( $_SESSION['accion_dir'] ) && $_SESSION['accion_dir'] =="favoritos" ) {
			// leemos solo los registros relacio con marcas y categorias
			
			$sql4 = "SELECT a.*, e.state as nombreEstado FROM proveedores a inner join estados e on (a.state = e.id ) 
			inner join proveedor_favoritos c on ( a.id = c.idProveedor ) 
			where c.favorito=1 and a.logo_imagen<>'0' and idusuario = " . $_SESSION['iduserHive'];
			//echo $sql4;	
			$query5    = $dbSPA->query($sql4);
			$states = array();
			while($r=$query5->fetch_object()){ $states[]=$r; }
			
			foreach ($states as $s) {
				$searchResultHTML .= '
				<div class="col-sm-4 col-lg-4 col-md-4">
					<div style="border:3px solid #ccc; border-radius:0px 10px 0px 10px; border-style:dashed; padding:10px; margin-bottom:10px; height:350px;">
						<div align="center">
							<a href="../fichaTecnica.php?id='. $s->id .'">
							<img width="170px" height: "50px" src="http://localhost/STRASOURCING/assets/documentos/imagenes/logos/'. $s->logo_imagen .'"  alt=""></a>
							<p align="center"><strong><a href="#">'. $s->razon_social .'</a></p>
							<h5 style="text-align:center;" class="text-danger">id: '. $s->id .'</h5>
							<h6 style="text-align:center;" class="text-danger">'. $s->telefono_empresa .'</h6>
							<h6 style="text-align:center;" class="text-danger">'. $s->admin_nombre .'</h6>
							<h6 style="text-align:center;" class="text-danger">'. $s->email_empresa .'</h6>
							<h6 style="text-align:center;" class="text-danger">'. $s->nombreEstado .'</h6>
							<h6 style="text-align:center;" class="text-danger">'. $s->numero_rif . '</h6>
							</strong>
						</div>
					</div>
				</div>
				';
			}
			print $searchResultHTML;
			
			
			
		}else{
			if(isset($_POST['formulas'] ) && $_POST['formulas'] !="" ) {
			?>
				<div class="row">
				<?php
					$_SESSION['accion_dir'] = "formulas";
					$sql4 = "SELECT * FROM formulas where id =".$_POST['formulas'];
					$query=$dbSPA->query($sql4);
					$states = array();
					$marca = "";$categoria = "";$subcategoria = "";$grupo = "";$preferencia = "";$state = "";$ciudad = "";$tipo = "";$sector = "";$soporte = "";
					$verificado="";
					while($r=$query->fetch_object()){ $states[]=$r; }
					$siHay = count($states);
					if ( $siHay > 0 ){
						foreach ($states as $s) {
							$_SESSION['formula_id'] = $s->id;
							$categoria = $s->categoria;
							$subcategoria = $s->subcategoria;
							$grupo = $s->grupo;
							$preferencia = $s->preferencia;
							$state = $s->estado;
							$ciudad = $s->ciudad;
							$tipo = $s->tipo_empresa;
							$sector = $s->sector;
							$soporte = $s->soporte_internet;
							$verificado = $s->verificacion_proveedor;
							// armo el query;
							$filtro_categoria = "";
							$filtro_subcategoria = "";
							$filtro_grupo = "";
							$filtro_marca = "";
							$filtro_state = "";
							$filtro_ciudad = "";
							if ( $categoria !=0){
								$filtro_categoria = " and categoria = $categoria";
							}
							if ( $subcategoria !=0){
								$filtro_subcategoria = " and subcategoria = $subcategoria";
							}
							if ( $grupo !=0){
								$filtro_grupo = " and grupo = $grupo";
							}
							if ( $marca !=0){
								$filtro_marca = " and marca= $marca";
							}
							if ( $state !=0){
								$filtro_state = " and a.state= $state";
							}
							if ( $ciudad !=0){
								$filtro_ciudad = " and a.ciudad= $ciudad";
							}
						}
						$marca = "";$categoria = "";$subcategoria = "";$grupo = "";$preferencia = "";$state = "";$ciudad = "";$tipo = "";$sector = "";$soporte = "";
						$verificado="";
					}
					if($siHay > 0 ){
					$sql5 = "SELECT a.*, e.state as nombreEstado FROM proveedores a inner join estados e on (a.state = e.id ) 
					where estado = 1 and logo_imagen<>'0' $filtro_state $filtro_ciudad order By a.razon_social";	
					$query5    = $dbSPA->query($sql5);
					$states = array();
					while($r=$query5->fetch_object()){ $states[]=$r; }
					
					foreach ($states as $s) {
						$searchResultHTML .= '
						<div class="col-sm-4 col-lg-4 col-md-4">
							<div style="border:3px solid #ccc; border-radius:0px 10px 0px 10px; border-style:dashed; padding:10px; margin-bottom:10px; height:350px;">
								<div align="center">
									<a href="../fichaTecnica.php?id='. $s->id .'">
									<img width="170px" height: "50px" src="http://localhost/STRASOURCING/assets/documentos/imagenes/logos/'. $s->logo_imagen .'"  alt=""></a>
									<p align="center"><strong><a href="#">'. $s->razon_social .'</a></p>
									<h5 style="text-align:center;" class="text-danger">id: '. $s->id .'</h5>
									<h6 style="text-align:center;" class="text-danger">'. $s->telefono_empresa .'</h6>
									<h6 style="text-align:center;" class="text-danger">'. $s->admin_nombre .'</h6>
									<h6 style="text-align:center;" class="text-danger">'. $s->email_empresa .'</h6>
									<h6 style="text-align:center;" class="text-danger">'. $s->nombreEstado .'</h6>
									<h6 style="text-align:center;" class="text-danger">'. $s->numero_rif . '</h6>
									</strong>
								</div>
							</div>
						</div>
						';
					}
					print $searchResultHTML;
				}
				?>
				</div>
				<?php
			}else{
				?>
				<div class="row searchResult"></div>
				<?php
				
				/*$preferencia= 0;
				if( isset($_SESSION['preferencia']) && $_SESSION['preferencia'] =="marca"){
					$preferencia = 1;
				}else{
					if( isset($_SESSION['preferencia']) && $_SESSION['preferencia'] =="origen"){
						$preferencia = 2;
					}	
				}
				$sq1= "INSERT INTO bigdata_in SET
				idusuario = " . $_SESSION['iduserHive'] . ", 
				datetime = '" . date('Y-m-d H:i:s') . "', 
				programa = 'spaDirectorio_categorias_filtro', 
				agregar=0, 
				modificar=0, 
				eliminar=0, 
				consultar= 2, 
				idempresa = " . $_SESSION['companyHive'] . ", 
				tipo = ". $_SESSION['tipoHive'] .", 
				idmarca = " .$_POST['marca'] . ", 
				idcategoria = " . $_POST['categoria'] . ",
				idsubcategoria = " . $_POST['subcategoria'] . ", 
				idgrupo = ".  $_POST['grupo'] .",  
				preferencia = ". $preferencia . ", 
				nombre_filtro = '', 
				estado = " . $_POST['estado'] .", 
				ciudad = " . $_POST['ciudad'] . ", 
				tipo_empresa = " . $_POST['tipo'] . ", 
				sector = " . $_POST['sector'] . ", 
				internet = " . $val . ", 
				verificacion = " . $verificado . ")";
				$query_insert = mysqli_query($this->dbConnect, $sq1);
				//*/
			}
		}
        ?>
	</div>
    	
</div>	
<?php include('inc/footer.php');

/*$searchResultHTML .= '
	<div class="col-sm-4 col-lg-4 col-md-4">
		<div style="border:3px solid #ccc; border-radius:0px 10px 0px 10px; border-style:dashed; padding:10px; margin-bottom:10px; height:350px;">
			<div align="center">
				<img height="150px" src="http://localhost/STRASOURCING/assets/documentos/imagenes/logos/'. $row['logo_imagen'] .'"  alt=""  >
				</div>
				<p align="center"><strong><a href="#">'. $row['razon_social'] .'</a></p>
				<h5 style="text-align:center;" class="text-danger">id: '. $row['id'] .'</h5>
				<h6 style="text-align:center;" class="text-danger">'. $row['telefono_empresa'] .'</h6>
				<h6 style="text-align:center;" class="text-danger">'. $row['admin_nombre'] .'</h6>
				<h6 style="text-align:center;" class="text-danger">'. $row['email_empresa'] .'</h6>
				<h6 style="text-align:center;" class="text-danger">'. $row['nombreEstado'] .'</h6>
				<h6 style="text-align:center;" class="text-danger">'. $row['numero_rif'] . '</h6>
				</strong>
			</div>
		</div>
	</div>
	';*/
?>

<div id="nuevo_mensaje" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title text-white" id="my-modal-title">Nuevo Mensaje</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="row">                       
                        <div class="col-lg-12">
                            <div class="form-group">
                                Seleccione Empresa
                                <select name="idEmpresa" class="form-control" id="edo" required>
                                        <option value="1">StraSourcing - Administración</option>
                                </select>   
                            </div>
                        </div>
						
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nombre">Asunto</label>
                                <input type="text" class="form-control" placeholder="Ingrese Asunto del mensaje" required
                                name="asunto" id="asunto">
                            </div>
						</div>
                        
                        <div class="col-lg-12">                    
                            <div class="form-group">
                                <label for="correo">Mensaje</label>
                                <textarea rows="4" class="form-control" name="mensaje" id="mensaje" required></textarea>
                            </div>
                        </div>
                     </div>
                     <input type="submit" value="Enviar" class="btn btn-secondary" name="submit">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
<script type="text/javascript">

	$(document).ready(function(){
		$("#asistencia").css("display", "none");
		$("#marca_producto").css("display", "none");
		$("#pais_origen").css("display", "none");
		
		$("#continente_id").change(function(){
			$.get("Paises.php","continente_id="+$("#continente_id").val(), function(data){
				$("#pais_id").html(data);
				console.log(data);
			});
		});

		$("#subcategoria").change(function(){
			$.get("Ciudades.php","pais_id="+$("#subcategoria").val(), function(data){
				$("#grupo").html(data);
				console.log(data);
			});
		});
		
		$("#listaEstados").change(function(){
			$.get("listaCiudades.php","edo_id="+$("#listaEstados").val(), function(data){
				$("#listaCiudades").html(data);
				console.log(data);
			});
		});
		
		$("#marca_producto").change(function(){
			if ($("#marca_producto").val() == '0') {
			  $("#asistencia").css("display", "block");
			} 
		});
		
		$("#pais_origen").change(function(){
			if ($("#pais_origen").val() == '0') {
			  $("#asistencia").css("display", "block");
			} 
		});
		
		$("#accion_menu").change(function(){
			$.get("listaCiudades.php","edo_id="+$("#listaEstados").val(), function(data){
				$("#listaCiudades").html(data);
				console.log(data);
			});
			if ($("#accion_menu").val() == 'formulas') {
			  $("#accion_menu").css("display", "none");
			} else {
			   $("#accion_menu").css("display", "block");
			}
		});
		
		$("#etiquetar").click(function(){
			
			$.get("etiquetar.php", {
			categoria: $("#idCategoria").val(),
			subcategoria: $("#subcategoria").val(),
			grupo: $("#grupo").val(),
			preferencia: $("#preferencia").val(),
			marca: $("#marca_producto").val(),
			origen: $("#pais_origen").val(), 
			texto_etiqueta: $("#texto_etiqueta").val(),
			tipo: $("#tipo_empresa").val(),
			sector: $("#listaSectores").val(),
			estado:$("#listaEstados").val(),
			ciudad:$("#listaCiudades").val(),
			verificado:$("#verificacion_proveedor").val()
			
			 }, function(data){
				$("#mensaje_etiqueta").html(data);
				console.log("formulasData:",data);
			});
		});
		
		$seleccion= "selected";
		$("#preferencia").click(function(){
			if ($("#preferencia").val() == 'marca') {
			  $("#marca_producto").css("display", "block");
			  $("#pais_origen").css("display", "none");
			} else {
			  if ($("#preferencia").val() == 'origen') {
				  $("#marca_producto").css("display", "none");
				  $("#pais_origen").css("display", "block");
			  }else{
				  $("#marca_producto").css("display", "none");
				  $("#pais_origen").css("display", "none");
			  }
			}
		});
	});
</script>

<script>
	var ctrlKeyDown = false;
	
	$(document).ready(function(){    
		$(document).on("keydown", keydown);
		$(document).on("keyup", keyup);
	});
	
	function keydown(e) { 
	
		if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
			// Pressing F5 or Ctrl+R
			e.preventDefault();
		} else if ((e.which || e.keyCode) == 17) {
			// Pressing  only Ctrl
			ctrlKeyDown = true;
		}
	};
	
	function keyup(e){
		// Key up Ctrl
		if ((e.which || e.keyCode) == 17) 
			ctrlKeyDown = false;
	};
	</script>