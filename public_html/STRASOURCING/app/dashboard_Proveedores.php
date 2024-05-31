<?php 
include "controllers/mainController.php";

/*// AGREGA AL BIGDATA
date_default_timezone_set("America/Caracas"); 
$bigdata->idusuario = $_SESSION['iduserHive'];
$bigdata->datetime = date('Y-m-d H:i:s');
$bigdata->programa = 'dashboard';
$bigdata->agregar = 0;
$bigdata->modificar = 0;
$bigdata->eliminar = 0;
$bigdata->consultar = 1;
$bigdata->idempresa = $_SESSION['companyHive'];
$bigdata->tipo = $_SESSION['tipoHive'];
$bigdata->idmarca = 0;
$bigdata->idorigen = 0;
$bigdata->idcategoria = 0;
$bigdata->idsubcategoria = 0;
$bigdata->idgrupo = 0;
$bigdata->preferencia = 0;
$bigdata->nombre_filtro = '';
$bigdata->estado = 0;
$bigdata->ciudad = 0;
$bigdata->tipo_empresa = 0;
$bigdata->sector = 0;
$bigdata->internet = 0;
$bigdata->verificacion = 0;
$stmt = $bigdata->crearBigdata();*/
include_once 'objects/categorias.php';
$categorias = new Categorias ( $db );

if(!isset( $_SESSION['diasVencidos'])){
 $_SESSION['diasVencidos'] = 0;
}

if(!isset( $_SESSION['diasVigente'])){
 $_SESSION['diasVigente'] = 100;
}

// inicializo el tipo de consulta 0:cat y 1:subcat
if(!isset($_SESSION['changeSubcat'])){
	$_SESSION['changeSubcat'] = 1;	
}
if(!isset($_SESSION['changeSubcatT'])){
	$_SESSION['changeSubcatT'] = 1;	
}
if(!isset($_SESSION['changeSubcatM'])){
	$_SESSION['changeSubcatM'] = 1;	
}
if(!isset($_SESSION['changeSubcatD'])){
	$_SESSION['changeSubcatD'] = 1;	
}
if(!isset($_SESSION['changeSubcatR'])){
	$_SESSION['changeSubcatR'] = 1;	
}
if(!isset($_SESSION['changeSubcatC'])){
	$_SESSION['changeSubcatC'] = 1;	
}

$tituloLista = "Listar por Subcategorias";	
if (isset($_GET['cc']) && $_GET['cc'] != 0) {
	if($_GET['cc'] == 1 ){
		$_SESSION['changeSubcat'] = 1;	
		$tituloLista = "Listar por Subcategorias";	
	}else{
		$_SESSION['changeSubcat'] = -1;	
		$tituloLista = "Listar solo por Categorias";
		$cabecera = "Seleccione una Subcategoria";
	}
}else{
	$_SESSION['changeSubcat'] = 1;		
}

//
// inicializo el tipo de consulta para la torta 0:cat y 1:subcat

$tituloListaT = "Listar por Subcategorias";	
if (isset($_GET['cct']) && $_GET['cct'] != 0) {
	if($_GET['cct'] == 1 ){
		$_SESSION['changeSubcatT'] = 1;	
		$tituloListaT = "Listar por Subcategorias";	
	}else{
		$_SESSION['changeSubcatT'] = -1;	
		$tituloListaT = "Listar solo por Categorias";
	}
}else{
	$_SESSION['changeSubcatT'] = 1;	
}

// inicializo el tipo de consulta para la comparativo mensual

$tituloListaM = "Listar por Subcategorias";	
if (isset($_GET['ccm']) && $_GET['ccm'] != 0) {
	if($_GET['ccm'] == 1 ){
		$_SESSION['changeSubcatM'] = 1;	
		$tituloListaM = "Listar por Subcategorias";	
	}else{
		$_SESSION['changeSubcatM'] = -1;	
		$tituloListaM = "Listar solo por Categorias";
	}
}else{
	$_SESSION['changeSubcatM'] = 1;	
}

// inicializo el tipo de consulta para la comparativo diario

$tituloListaD = "Listar por Subcategorias";	
if (isset($_GET['ccd']) && $_GET['ccd'] != 0) {
	if($_GET['ccd'] == 1 ){
		$_SESSION['changeSubcatD'] = 1;	
		$tituloListaD = "Listar por Subcategorias";	
	}else{
		$_SESSION['changeSubcatD'] = -1;	
		$tituloListaD = "Listar solo por Categorias";
	}
}else{
	$_SESSION['changeSubcatD'] = 1;	
}

$tituloListaR = "Listar por Marcas";	
if (isset($_GET['ccr']) && $_GET['ccr'] != 0) {
	if($_GET['ccr'] == 1 ){
		$_SESSION['changeSubcatR'] = 1;	
		$tituloListaR = "Listar por Marcas";	
	}else{
		$_SESSION['changeSubcatR'] = -1;	
		$tituloListaR = "Listar solo por Marcas";
	}
}else{
	$_SESSION['changeSubcatR'] = 1;	
}

$tituloListaC = "Listar por Subgrupo";	
if (isset($_GET['ccc']) && $_GET['ccc'] != 0) {
	if($_GET['ccc'] == 1 ){
		$_SESSION['changeSubcatC'] = 1;	
		$tituloListaC = "Listar por Subgrupos";	
	}else{
		$_SESSION['changeSubcatC'] = -1;	
		$tituloListaC = "Listar solo por Grupos/productos";
	}
}else{
	$_SESSION['changeSubcatC'] = 1;	
}

/*echo "<br>cc= "  . $_SESSION['changeSubc
at'] ;
echo "<br>cct= " . $_SESSION['changeSubcatT'];
echo "<br>ccm= " . $_SESSION['changeSubcatM'];
echo "<br>ccd= " . $_SESSION['changeSubcatD'];*/

// Grafica 1 - Contador de visitas por los ultimos meses... 
// MySQL database connection code
$connection = mysqli_connect("localhost","root","","spa") or die("Error " . mysqli_error($connection));


//ultimas consultas por categorias
if (!isset($_SESSION['idcategoria'])){
	$_SESSION['idcategoria'] = "";
}

$condicion_cat = "";
if (isset($_POST['idcategoria'])){
	if( $_POST['idcategoria'] != ""){
		$_SESSION['idcategoria'] = $_POST['idcategoria'];
		$condicion_cat = " and idcategoria = " . $_SESSION['idcategoria'];
	}else{
		$_SESSION['idcategoria'] = "";
		$condicion_cat = "";
	}
}else{
	if ($_SESSION['idcategoria']!=""){
		$condicion_cat = " and idcategoria = " . $_SESSION['idcategoria'];
	}else{
		$condicion_cat = "";	
	}	
}


//ultimas consultas por categorias TORTA
if (!isset($_SESSION['idcategoriaT'])){
	$_SESSION['idcategoriaT'] = "";
}
$condicion_catT = "";

if (isset($_POST['idcategoriaT'])){
	if( $_POST['idcategoriaT'] != ""){
		$_SESSION['idcategoriaT'] = $_POST['idcategoriaT'];
		$condicion_catT = " and idcategoria = " . $_SESSION['idcategoriaT'];
	}else{
		$_SESSION['idcategoriaT'] = "";
		$condicion_catT = "";
	}
}else{
	if ($_SESSION['idcategoriaT']!=""){
		$condicion_catT = " and idcategoria = " . $_SESSION['idcategoriaT'];
	}else{
		$condicion_catT = "";
	}	
}

$condicion_catR = "";
if (isset($_POST['idcategoriaR'])){
	if( $_POST['idcategoriaR'] != ""){
		$_SESSION['idcategoriaR'] = $_POST['idcategoriaR'];
		$condicion_catR = " and idcategoria = " . $_SESSION['idcategoriaR'];
	}else{
		$_SESSION['idcategoriaR'] = "";
		$condicion_catR = "";
	}
}else{
	if ($_SESSION['idcategoriaR']!=""){
		$condicion_catR = " and idcategoria = " . $_SESSION['idcategoriaR'];
	}else{
		$condicion_catR = "";	
	}	
}

if (!isset($_SESSION['idcategoriaC'])){
	$_SESSION['idcategoriaC'] = "";
}
$condicion_catC = "";
if (isset($_POST['idcategoriaC'])){
	if( $_POST['idcategoriaC'] != ""){
		$_SESSION['idcategoriaC'] = $_POST['idcategoriaC'];
		$condicion_catC = " and idcategoria = " . $_SESSION['idcategoriaC'];
	}else{
		$_SESSION['idcategoriaC'] = "";
		$condicion_catC = "";
	}
}else{
	if ($_SESSION['idcategoriaC']!=""){
		$condicion_catC = " and idcategoria = " . $_SESSION['idcategoriaC'];
	}else{
		$condicion_catC = "";	
	}	
}


//Cuantos por categoria total vida

if($_SESSION['changeSubcatT']==1){
	if ($condicion_catT==""){
		// es categora y se cuenta las categorias en general
		$sql = "SELECT name, idcategoria, count(idcategoria) as cuantos FROM bigdata_in a inner join php_combo.continente b
		on (a.idcategoria = b.id) where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idcategoria limit 20";
		//echo "<br>1 " . $sql;
	}else{
		// es categoria y se cuenta toda la categoria
		$sql = "SELECT name, idsubcategoria, count(idsubcategoria) as cuantos FROM bigdata_in a inner join php_combo.pais b
		on (a.idsubcategoria = b.id) where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 $condicion_catT and programa='fichaTecnica' and consultar=1
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idsubcategoria limit 20";
		//echo "<br>2" . $sql;
	}
}else{
	if ($condicion_catT==""){
		$sql = "SELECT name, idsubcategoria, count(idsubcategoria) as cuantos FROM bigdata_in a inner join php_combo.pais b
		on (a.idsubcategoria = b.id) where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 $condicion_catT and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idsubcategoria limit 20";
		//echo "<br>3 " . $sql;
	}else{
		$sql = "SELECT name, idgrupo, count(idgrupo) as cuantos FROM bigdata_in a inner join php_combo.ciudad b
		on (a.idgrupo = b.id) where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idgrupo limit 20";
		//echo "<br>4 " . $sql;
	}
}





$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
//create an array
$cat_name = array();
$cat_cant = array();
$i = 0;
$contador = 0;
while($row = mysqli_fetch_assoc($result))
{  
   	$contador++;
	$cat_name[$i] = ""; 
    $cat_cant[$i] = 0; 
    $cat_name[$i] = $row['name']; 
    $cat_cant[$i] = $row['cuantos'];
	$i++; 
}

//ultimas consultas por categorias y MESES 
if (!isset($_SESSION['idcategoriaM'])){
	$_SESSION['idcategoriaM'] = "";
}
$condicion_catM = "";
if (isset($_POST['idcategoriaM'])){
	if( $_POST['idcategoriaM'] != ""){
		$_SESSION['idcategoriaM'] = $_POST['idcategoriaM'];
		$condicion_catM = " and idcategoria = " . $_SESSION['idcategoriaM'];
	}else{
		$_SESSION['idcategoriaM'] = "";
		$condicion_catM = "";	
	}
}else{
	if ($_SESSION['idcategoriaM']!=""){
		$condicion_catM = " and idcategoria = " . $_SESSION['idcategoriaM'];
	}else{
		$condicion_catM = "";
	}	
}


//ultimas consultas por categorias y DIAS 
if (!isset($_SESSION['idcategoriaD'])){
	$_SESSION['idcategoriaD'] = "";
}
$condicion_catD = "";

// acomodar esta condicion....
// Si esta en blanco mostrar todas las categorias
// de lo contrario, hacer el filtro por categoria y mostrar subcategorias....

if (isset($_POST['idcategoriaD'])){
	if( $_POST['idcategoriaD'] != ""){
		$_SESSION['idcategoriaD'] = $_POST['idcategoriaD'];
		$condicion_catD = " and idcategoria = " . $_SESSION['idcategoriaD'];
	}else{
		$_SESSION['idcategoriaD'] = "";
		$condicion_catD = "";
	}
}else{
	if ($_SESSION['idcategoriaD']!=""){
		$condicion_catD = " and idcategoria = " . $_SESSION['idcategoriaD'];
	}else{
		$condicion_catD = "";	
	}	
}




// ULTIMAS CONSULTAS HECHAS POR CATEGORIA
if($_SESSION['changeSubcat']==1){
	if ($condicion_cat==""){
		// es categora y se cuenta las categorias en general
		$sql = "SELECT concat(day(datetime),'/',month(datetime),'/',year(datetime)) as datetime, idcategoria, 
		name, count(idcategoria) as cuantos FROM bigdata_in a inner join php_combo.continente b 
		on (a.idcategoria = b.id) where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idcategoria limit 20";
		$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));	
	}else{
		// es categoria y se cuenta toda la categoria
		$sql = "SELECT concat(day(datetime),'/',month(datetime),'/',year(datetime)) as datetime, idsubcategoria, 
		name, count(idsubcategoria) as cuantos FROM bigdata_in a 
		inner join php_combo.pais b on (a.idsubcategoria = b.id) 
		where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 $condicion_cat and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idsubcategoria limit 20";
		$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));	
	}
}else{
	// es subcategoria y se toma la categoria como un todo y se muestra la suma de grupos de productos
	if ($condicion_cat==""){
		$sql = "SELECT concat(day(datetime),'/',month(datetime),'/',year(datetime)) as datetime, idsubcategoria, 
		name, count(idsubcategoria) as cuantos FROM bigdata_in a 
		inner join php_combo.pais b on (a.idsubcategoria = b.id) 
		where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 $condicion_cat and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idsubcategoria limit 20";
		$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));	
		
	}else{
		// es subcategoria y se cuentan los grupos
		$sql = "SELECT concat(day(datetime),'/',month(datetime),'/',year(datetime)) as datetime, idgrupo, 
		name, count(idgrupo) as cuantos FROM bigdata_in a inner join php_combo.ciudad b 
		on (a.idgrupo = b.id) where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 and programa='fichaTecnica' and consultar=1 
		group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idgrupo limit 20";
		$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));	
	}
}
//create an array
$cat_date9 = array();
$cat_name9 = array();
$cat_cant9 = array();
$i = 0;
$contador9 = 0;
while($row = mysqli_fetch_assoc($result))
{  
	$contador9++;
   	$cat_date9[$i] = "";
	$cat_name9[$i] = ""; 
    $cat_cant9[$i] = 0; 
    $cat_date9[$i] = $row['datetime'];
	$cat_name9[$i] = $row['name']; 
    $cat_cant9[$i] = $row['cuantos']; 
	$i++;
}




//ultimas consultas por marca
$sql = "SELECT concat(day(datetime),'/',month(datetime),'/',year(datetime)) as datetime, idmarca, name, count(idmarca) as cuantos 
FROM bigdata_in a inner join php_combo.continente b on (a.idcategoria = b.id) 
where tipo=3 and programa='fichaTecnica' and consultar=1 
group by year(datetime) desc, month(datetime) desc, day(datetime) desc, idcategoria 
limit 20;";

$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
//create an array
$cat_date2 = array();
$cat_name2 = array();
$cat_cant2 = array();
$i = 0;
$contador2 = 0;
while($row = mysqli_fetch_assoc($result))
{  
	$contador2++;
   	$cat_date2[$i] = "";
	$cat_name2[$i] = ""; 
    $cat_cant2[$i] = 0; 
    $cat_date2[$i] = $row['datetime'];
	$cat_name2[$i] = $row['name']; 
    $cat_cant2[$i] = $row['cuantos']; 
	$i++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Sistema StraSourcing - Proveedores</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png"/>
    <link href="html/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="../assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="../plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" class="dashboard-sales" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <script src="../plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="../plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->

</head>
<body class="sidebar-noneoverflow dashboard-sales">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
1
    <!--  BEGIN NAVBAR  -->
    <?php include "partials/navbar.php"?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include "partials/sidebar.php"?>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
				<?php
				$mensajeVencido = "";
				// AREA de mensajes del sistema
				// $_SESSION['diasVencidos']
				// $_SESSION['diasVigente']
				
				if( $login == 1 ){
					if($_SESSION['diasVencidos'] > 0 && $_SESSION['tipoHive'] > 2){
						$mensajeVencido = "<br>Su contrato ha caido en mora en " . $_SESSION['diasVencidos'] . " dias , su cuenta sera inhabilitada a partir de mañana.... " ;
					}else{
						if($_SESSION['diasVigente'] <= 9 && $_SESSION['tipoHive'] > 2){
							$mensajeVencido = "<span style='color:red;'><br>Dias restantes del contrato es de " . $_SESSION['diasVigente'] . " dias , le recordemos ponerse al corriente con su cuenta, evite desconexiones </span>" ;
						}else{
							if($_SESSION['diasVigente'] <= 30 && $_SESSION['tipoHive'] > 2){
								$mensajeVencido = "<span style='color:blue;'><br>Dias restantes del contrato es de " . $_SESSION['diasVigente'] . " dias , le recordemos ponerse al corriente con su cuenta, evite desconexiones </span>" ;
							}
						}
					}
					$alert="";
					$alert = '<div class="alert alert-success" role="alert">
					Bienvenido usuario '.  $_SESSION['nombreHive'] . ' (' . $_SESSION['loginHive'] . ') a StraSourcing! ' . $mensajeVencido .'
					</div>';
					echo $alert;	
				}else{
					if( isset($_GET['mensajeError']) && $_GET['mensajeError'] != "" ){
						$alert="";
						$alert = '<div class="alert alert-danger" role="alert">
						Atención, error: '.  $_GET['mensajeError'] . ' ...
						</div>';
						echo $alert;	
						$_GET['mensajeError'] = "";
					}
				}
				// fin de area de mensajes del sistema
				?>
                <div class="page-header">
                    <div class="page-title">
                        <h3>Sistema StraSourcing - Proveedores (<?php echo $_SESSION['companyHive'];?>)</h3>
                    </div>
                </div>
					


				
                <div class="row layout-top-spacing">

                	<!-- 
                    TABLA DIARIA CAT 
                    -->
                    
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <!--<div class="widget-two">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-content">
                                        <span class="w-value">Daily sales</span>
                                        <span class="w-numeric-title">Go to columns for details.</span>
                                    </div>
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="daily-sales"></div>
                                </div>
                            </div>
                        </div>-->
                        <div class="widget widget-activity-four">
                          <div class="widget-heading">
                            <h5 class=""> Ultimas consultas hechas por Categoria<br>
                            </h5>
                             <form method="post" action="">	
                              <select name="idcategoria" autofocus class="form-control" id="edo" onchange="this.form.submit()">
                                  <option value="">Escoja una opcion de <?php echo $_SESSION['changeSubcat']==1 ?"Categoria" :"Subcategoria"?></option>
                                  <?php
									// readCategoriasActivas
									if($_SESSION['changeSubcat'] == 1){
										$stmt = $categorias->readCategoriasActivas($_SESSION['idcategoria']);
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
									     <option value="<?php echo $row['id']; ?>" 
                                        <?php
										if ($_SESSION['idcategoria'] == $row['id'] ){
											echo "selected";	 
										}
										 ?>
                                         >
										  <?php 
												echo $row['name']. " (" . $row['id']. ")"; 
												?>
									     </option>
									     <?php
										}
									}else{
										$stmt = $categorias->readCatSubcat();
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
										 ?>
									     <option value="<?php echo $row['idsub']; ?>"                                         
											 <?php
                                            if ($_SESSION['idcategoria'] == $row['idsub'] ){
                                                echo "selected";	 
                                            }
                                             ?>>
										  <?php 
												echo strtoupper($row['subcategoria']). " " . " (" . $row['name']. ")";
												?>
									     </option>
									     <?php
										}	
									}
                                    
                                    ?>
                              </select>
                             </form>
                             <!-- <a href="<php echo $_SESSION['dashboard']; ?>?cc=<php echo $_SESSION['changeSubcat']*-1; ?>"><span class="badge badge-success"><php echo $tituloLista ; ?></span></a>
                              -->  
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        <?php 
										$color = "danger";
										for ($i = 0; $i <= $contador9-1; $i++) {
											if ($cat_cant9[$i] >= 1000){
												$color = "primary";	
											}else if ($cat_cant9[$i] >= 500) {
												$color = "secondary";
											}else if ($cat_cant9[$i] >= 100) {
												$color = "warning";
											}
												
											?>
											<div class="item-timeline timeline-<?php echo $color;?>">
												<div class="t-dot" data-original-title="" title="">
												</div>
												<div class="t-text">
													<p> <?php echo $cat_name9[$i]; ?></p>
													<span class="badge badge-<?php echo $color;?>"><?php echo $cat_cant9[$i]." veces este dia" ; ?></span>
													<p class="t-time"><?php echo $cat_date9[$i]; ?></p>
												</div>
											</div>
										<?php
										}
                                        ?>
                                        
                                        <!--<div class="item-timeline timeline-success">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Send Mail to <a href="javascript:void(0);">HR</a> and <a href="javascript:void(0);">Admin</a></p>
                                                <span class="badge badge-success">Completed</span>
                                                <p class="t-time">2 min ago</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-danger">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Backup <span>Files EOD</span></p>
                                                <span class="badge badge-danger">Pending</span>
                                                <p class="t-time">14:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-dark">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Collect documents from <a href="javascript:void(0);">Sara</a></p>
                                                <span class="badge badge-success">Completed</span>
                                                <p class="t-time">16:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-warning">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Conference call with <a href="javascript:void(0);">Marketing Manager</a>.</p>
                                                <span class="badge badge-primary">In progress</span>
                                                <p class="t-time">17:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-secondary">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Rebooted Server</p>
                                                <span class="badge badge-success">Completed</span>
                                                <p class="t-time">17:00</p>
                                            </div>
                                        </div>


                                        <div class="item-timeline  timeline-warning">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Send contract details to Freelancer</p>
                                                <span class="badge badge-danger">Pending</span>
                                                <p class="t-time">18:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-dark">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Kelly want to increase the time of the project.</p>
                                                <span class="badge badge-primary">In Progress</span>
                                                <p class="t-time">19:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-success">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Server down for maintanence</p>
                                                <span class="badge badge-success">Completed</span>
                                                <p class="t-time">19:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-secondary">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Malicious link detected</p>
                                                <span class="badge badge-warning">Block</span>
                                                <p class="t-time">20:00</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-warning">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Rebooted Server</p>
                                                <span class="badge badge-success">Completed</span>
                                                <p class="t-time">23:00</p>
                                            </div>
                                        </div>-->

                                    </div>                                    
                                </div>

                                <div class="tm-action-btn">
                                <br>
                                	<!--<a href="<php echo $_SESSION['dashboard']; ?>?cc=<php echo $_SESSION['changeSubcat']*-1; ?>">
                                    <span class="badge badge-success"><php echo $tituloLista ; ?></span></a>-->
                                    <!--<button class="btn">Ver todo el mes actual <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
-->                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 
                    TORTA TORTA OTRA TORTA 
                    -->
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <!--<div class="widget-one widget">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value">3,192</span>
                                        <span class="w-numeric-title">Total Orders</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total-orders"></div>
                                </div>
                            </div>
                        </div>-->
                        <div class="widget widget-chart-one">
                          <div class="widget-heading">
                              <h5 class=""> % Consultas anuales por categoría</h5>
                                <ul class="tabs tab-pills">
                                  <li><a href="javascript:void(0);" id="tb_1" class="tabmenu"><?php echo date("Y")?></a></li>
                                </ul>
                             </div>
                             
                          
                          <iframe frameBorder="0" style="overflow: hidden; " 
                            onload="resizeIframe(this)" scrolling="no" width="100%" height="300px" 
                            src="http://localhost/strasourcing/app/chartjsBarra/pie_StackBar.php"></iframe>
                            <div align="center">
                        	<!--<a href="<php echo $_SESSION['dashboard']; ?>?cct=<php echo $_SESSION['changeSubcatT']*-1; ?>"> <span class="badge badge-success">
							<php echo $tituloListaT ; ?></span></a>-->
							</div>
                            <br /><br />
                        </div>	
                    </div>
                    <!--<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">Cantidad de Proveedores por Categoria</h5>
                            </div>
                            <div class="widget-content">
                                <div id="chart-2" class=""></div>
                                
                                <br><br><br>
                            </div>
                        </div>
                    </div>-->
                    
                    
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    	
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">Visitas acumuladas por categoria</h5>
                            	<form method="post" action="">	
                                  <select name="idcategoriaT" autofocus class="form-control" id="edo" onchange="this.form.submit()">
                                      <option value="">Escoja una opcion de <?php echo $_SESSION['changeSubcatT']==1 ?"Categoria" :"Subcategoria"?></option>
                                      <?php
                                        // readCategoriasActivas
                                        if($_SESSION['changeSubcatT'] == 1){
                                            $stmt = $categorias->readCategoriasActivas($_SESSION['idcategoriaT']);
                                            while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
                                            {	
                                                ?>
                                             <option value="<?php echo $row['id']; ?>" 
                                            <?php
                                            if ($_SESSION['idcategoriaT'] == $row['id'] ){
                                                echo "selected";	 
                                            }
                                             ?>
                                             >
                                              <?php 
                                                    echo $row['name']. " (" . $row['id']. ")"; 
                                                    ?>
                                             </option>
                                             <?php
                                            }
                                        }else{
                                            $stmt = $categorias->readCatSubcat();
                                            while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
                                            {	
                                                ?>
                                             <option value="<?php echo $row['idsub']; ?>"
                                              <?php
												if ($_SESSION['idcategoriaT'] == $row['idsub'] ){
													echo "selected";	 
												}
												 ?>>
                                              <?php 
                                                    echo strtoupper($row['subcategoria']). " (" . $row['name']. ")";
                                                    ?>
                                             </option>
                                             <?php
                                            }	
                                        }
                                        
                                        ?>
                                  </select>
                                 </form>
                                 
                            </div>
                            
                            
                            <div class="widget-content">

                                <div class="order-summary">
								<?php
								$barra=array();
                                $barra[0] = "bg-gradient-secondary";
								$barra[1] = "bg-gradient-success";
								$barra[2] = "bg-gradient-warning";
								$barra[3] = "bg-gradient-danger";
								$barra[4] = "bg-gradient-primary";
								// faltam otras barras
								for ($i = 0; $i <= $contador-1; $i++) 
								{
									?>
                                	<div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6><?php echo $cat_name[$i]; ?></h6>
                                                <p class="summary-count"><?php echo $cat_cant[$i]; ?></p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar <?php echo $barra[$i];?>" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php	
								}
                                ?>

                                    <!--<div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6>Manejo de Fluidos</h6>
                                                <p class="summary-count">$37,515</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6>Electricidad y Potencia</h6>
                                                <p class="summary-count">$55,085</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    
                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6>Automatización Robótica</h6>
                                                <p class="summary-count">$55,085</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    
                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6>Fuerza y Movimiento</h6>
                                                <p class="summary-count">$55,085</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>-->
                                    
                                </div>
								
                            </div>
 							<?php
                            for ($i = 0; $i <= 7 - $contador; $i++){
                            	echo "<br />";
							}
							?>
							<div align="center">
                                <!--<a href="<php echo $_SESSION['dashboard']; ?>?cct=<php echo $_SESSION['changeSubcatT']*-1; ?>"><span class="badge badge-success">
                                <php echo $tituloListaT ; ?></span></a>-->
                                <!--<button class="btn">Ver todo el mes actual <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>-->          
                            </div>                   
                        </div>
                        
                    </div>
                    
                
                
                    <!-- 
                    LINEA MES 
                    -->
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    	
                        <div class="widget widget-chart-one">
                          <div class="widget-heading">
                                <h5 class="">Comparativo Mensual por Categoria</h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu"><?php echo date("Y")?></a></li>
                                </ul>
                                <br>
                            </div>
                            <form method="post" action="">
                            <select name="idcategoriaM" autofocus class="form-control" id="edo" onchange="this.form.submit()">
                                    <option value="">Escoja una opcion de <?php echo $_SESSION['changeSubcatM']==1 ?"Categoria" :"Subcategoria"?>
                                    </option>
                                    <?php
									// readCategoriasActivas
									if($_SESSION['changeSubcatM'] == 1){
										$stmt = $categorias->readCategoriasActivas($_SESSION['idcategoriaM']);
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
										   <option value="<?php echo $row['id']; ?>" 
                                           <?php
                                            if ($_SESSION['idcategoriaM'] == $row['id'] ){
                                                echo "selected";	 
                                            }
                                             ?>
                                           >
											<?php  
												echo $row['name']. " (" . $row['id']. ")"; 
												?>
										   </option>
										   <?php
										}
									}else{
										$stmt = $categorias->readCatSubcat();
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
										   <option value="<?php echo $row['idsub']; ?>"
                                            <?php
												if ($_SESSION['idcategoriaM'] == $row['idsub'] ){
													echo "selected";	 
												}
												 ?>>
											<?php 
												echo strtoupper($row['subcategoria']). " (" . $row['name']. ")";
												?>
										   </option>
										   <?php
										}	
									}
                                    
                                    ?>
                                </select>    
                          	</form>
                            <iframe frameBorder="0" style="overflow: hidden; " onload="resizeIframe(this)" 
                                scrolling="no" width="100%" height="300px" 
                                src="http://localhost/strasourcing/app/chartjs-linealDoble/indexBarraProveedor.php?condicion_catM=<?php echo $condicion_catM; ?>">
                            </iframe>
                              
                            <div align="center">
                                <!--<a href="<php echo $_SESSION['dashboard']; ?>?ccm=<php echo $_SESSION['changeSubcatM']*-1; ?>"><span class="badge badge-success">
                                ?php echo $tituloListaM; ?></span></a>-->
                            </div>
                        </div>	
                        
                        <!--<div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="">Visitas últimos 12 meses</h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">2023</a></li>
                                </ul>
                            </div>
    
                            <iframe frameBorder="0" style="overflow: hidden; " onload="resizeIframe(this)" 
                            scrolling="no" width="100%" height="300" 
                            src="http://localhost/strasourcing/app/chartjsBarra/"></iframe>
                        </div>	-->
                        
						<!--<div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="">Visitas al perfil del proveedor</h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Diario/Mes</a></li>
                                </ul>
                            </div>

                            <div class="widget-content">
                                <div class="tabs tab-content">
                                    <div id="content_1" class="tabcontent"> 
                                        <div id="revenueMonthly"></div>
                                    </div>
                                </div>
                            </div>
                        </div>     -->                 
                    </div>
                    <!-- 
                    LINEA DIARIA 
                    -->
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    
                        <div class="widget widget-chart-one">
                          <div class="widget-heading">
                                <h5 class="">Comparativo Diario del mes por Categoria</h5>
                                <ul class="tabs tab-pills">
                                    
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu"><?php echo date("m")."/".date("Y")?></a></li>
                                </ul>
                            </div>
                            <form method="post" action="">
    							<select name="idcategoriaD" autofocus class="form-control" id="edo" onchange="this.form.submit()">
                                    <option value="">Escoja una opcion de <?php echo $_SESSION['changeSubcatD']==1 ?"Categoria" :"Subcategoria"?>
                                    </option>
                                    <?php
									// readCategoriasActivas
									if($_SESSION['changeSubcatD'] == 1){
										$stmt = $categorias->readCategoriasActivas($_SESSION['idcategoriaD']);
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
										   <option value="<?php echo $row['id']; ?>"
											<?php
                                            if ($_SESSION['idcategoriaD'] == $row['id'] ){
                                                echo "selected";	 
                                            }
                                             ?>
                                           >
											<?php 
												echo $row['name']. " (" . $row['id']. ")"; 
												?>
										   </option>
										   <?php
										}
									}else{
										$stmt = $categorias->readCatSubcat();
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
										   <option value="<?php echo $row['idsub']; ?>" 
										   	<?php
												if ($_SESSION['idcategoriaD'] == $row['idsub'] ){
													echo "selected";	 
												}
											?>>
											<?php 
												echo strtoupper($row['subcategoria']). " (" . $row['name']. ")";
												?>
										   </option>
										   <?php
										}	
									}
                                    
                                    ?>
                                </select>
                          	</form>
                          <iframe frameBorder="0" style="overflow: hidden; " onload="resizeIframe(this)" 
                            scrolling="no" width="100%" height="300px" src="http://localhost/strasourcing/app/chartjs-linealDoble/indexProveedor.php?condicion_catD=<?php echo $condicion_catD; ?>">
                            </iframe>
                          
                          <div align="center">
                          <!--`<a href="<php echo $_SESSION['dashboard']; ?>?ccd=<php echo $_SESSION['changeSubcatD']*-1; ?>"> <span class="badge badge-success">
						  <php echo $tituloListaD ; ?></span></a>  -->   
                          </div>
                        
                        </div>	
                        
						<!--<div class="widget widget-chart-one">
                                <div class="widget-heading">
                                    <h5 class="">Visitas al perfil del proveedor</h5>
                                    <ul class="tabs tab-pills">
                                        <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Diario/Mes</a></li>
                                    </ul>
                                </div>
    
                                <div class="widget-content">
                                    <div class="tabs tab-content">
                                        <div id="content_1" class="tabcontent"> 
                                            <div id="revenueMonthly"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->                    
                            
                    </div>
              		
              
              
              
                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                    	<div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="">Comparativo de Categorias ultimo trimestre</h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">
									<?php echo date("m")."/".date("Y"); 
									for($i=0; $i<=2; $i++){
										
									}
									?>
                                    </a></li>
                                </ul>
                            </div>
    						
                            <iframe frameBorder="0" style="overflow: hidden; " onload="resizeIframe(this)" 
                            scrolling="no" width="100%" height="500px" 
                            src="http://localhost/strasourcing/app/chartjsBarra/groupedBar.php"></iframe>
                        </div>	
					</div>



                    <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Las Marcas mas consultadas</h5>
                            </div>
                            <div class="widget-content">
                            <?php
							
							//
							//Las marcas mas demandadas de StraSourcing
							$sql = "SELECT a.datetime, a.idmarca, b.nombre, count(a.idmarca) as cuantos, concat(c.folder,c.images) as imagen 
							FROM bigdata_in a inner join tabla_control b on (a.idmarca = b.id and b.tipo=8 )
							inner join table_images c on (b.image_id = c.id) where a.programa='fichaTecnica' and a.consultar=1
							group by idmarca order by count(a.idcategoria) desc limit 4";
							//echo $sql;
							$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
							//create an array
							while($row = mysqli_fetch_assoc($result))
							{  
								$imagen_marca = $raizSistema."/app/" . $row['imagen']; 
								$contador_marca = $row['cuantos'];
								//echo "cuantos= " . $row['cuantos'];
								?>
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                
                                                <img src="<?php echo $imagen_marca; ?>" height="40" alt=""/> 
												
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo $row['nombre']; ?></h4>
                                                <p class="meta-date"><?php echo "Ultima vez: " . $row['datetime']; ?></p>
                                            </div>

                                        </div>
                                        <div align="right">
                                            <h4><span class="text-danger"><strong><?php echo $contador_marca; ?></strong></span> 
								          </h4>
                                        </div>
                                    </div>
                                </div>
							<?php
							}
                            ?>
                            <!--<div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">SP</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Shaun Park</h4>
                                                <p class="meta-date">4 Aug 1:00PM</p>
                                            </div>
                                        </div>
                                        <div class="t-rate rate-inc">
                                            <p><span>+$66.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">AD</span>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Amy Diaz</h4>
                                                <p class="meta-date">4 Aug 1:00PM</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-inc">
                                            <p><span>+$66.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>Netflix</h4>
                                                <p class="meta-date">4 Aug 1:00PM</p>
                                            </div>

                                        </div>
                                        <div class="t-rate rate-dec">
                                            <p><span>-$32.00</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg></p>
                                        </div>
                                    </div>
                                </div>-->    
                            </div>
                        <br><br><br><br><br><br><br><br><br><br><br><br>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        
                        <div class="widget widget-activity-four">

                            <div class="widget-heading">
                                <h5 class="">Ultimas consultas mensuales por Marca</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        <?php
							
										//
										//Las marcas mas demandadas de StraSourcing
										$sql = "SELECT concat(month(a.datetime), '/' ,year(a.datetime)) as fecha, a.idmarca, b.nombre, 
										count(a.idmarca) as cuantos, concat(c.folder,c.images) as imagen FROM bigdata_in a inner join tabla_control b on 
										(a.idmarca = b.id and b.tipo=8 ) inner join table_images c on (b.image_id = c.id) where a.programa='fichaTecnica' 
										and a.consultar=1 group by year(datetime), month(datetime), idmarca order by count(a.idcategoria) desc limit 30";
										//echo $sql;
										$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
										//create an array
										$color = "danger";
										while($row = mysqli_fetch_assoc($result))
										{
											if ($row['cuantos'] >= 1000){
												$color = "primary";	
											}else if ($row['cuantos'] >= 500) {
												$color = "secondary";
											}else if ($row['cuantos'] >= 100) {
												$color = "warning";
											}
										?> 
                                        <div class="item-timeline timeline-<?php echo $color; ?>">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span><?php echo $row['nombre']; ?></p>
                                                <h5><strong><span class="badge badge-<?php echo $color; ?>"><?php echo $row['cuantos'] . " veces este mes"; ?></span></strong>
                                                </h5>
                                                <p class="t-time"><?php echo $row['fecha']; ?></p>
                                            </div>
                                        </div>
										<?php
										}
										?>
 										
                                        

                                    </div>                                    
                                </div>

                                <div class="tm-action-btn">
                                    <button class="btn">View All <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
                        
                        <div class="widget widget-account-invoice-one">

                            <div class="widget-heading">
                                <h5 class="">Account Info</h5>
                            </div>

                            <div class="widget-content">
                                <div class="invoice-box">
                                    
                                    <div class="acc-total-info">
                                        <h5>Balance</h5>
                                        <p class="acc-amount">$470</p>
                                    </div>

                                    <div class="inv-detail">                                        
                                        <div class="info-detail-1">
                                            <p>Monthly Plan</p>
                                            <p>$ 199.0</p>
                                        </div>
                                        <div class="info-detail-2">
                                            <p>Taxes</p>
                                            <p>$ 17.82</p>
                                        </div>
                                        <div class="info-detail-3 info-sub">
                                            <div class="info-detail">
                                                <p>Extras this month</p>
                                                <p>$ -0.68</p>
                                            </div>
                                            <div class="info-detail-sub">
                                                <p>Netflix Yearly Subscription</p>
                                                <p>$ 0</p>
                                            </div>
                                            <div class="info-detail-sub">
                                                <p>Others</p>
                                                <p>$ -0.68</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="inv-action">
                                        <a href="" class="btn btn-outline-dark">Summary</a>
                                        <a href="" class="btn btn-danger">Transfer</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>-->

                   
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">

                            <div class="widget-heading">
                                <h5 class="">Consultas por Marca de últimos 30 dias</h5>
                                <form method="post" action="">	
                              <select name="idcategoriaR" autofocus class="form-control" id="edo" onchange="this.form.submit()">
                                  <option value="">Escoja una opcion de <?php echo $_SESSION['changeSubcatR']==1 ?"Categoria" :"Subcategoria"?></option>
                                  <?php
									// readCategoriasActivas
									if($_SESSION['changeSubcatR'] == 1){
										$stmt = $categorias->readCategoriasActivas($_SESSION['idcategoriaR']);
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
									     <option value="<?php echo $row['id']; ?>" 
                                        <?php
										if ($_SESSION['idcategoriaR'] == $row['id'] ){
											echo "selected";	 
										}
										 ?>
                                         >
										  <?php 
												echo $row['name']. " (" . $row['id']. ")"; 
												?>
									     </option>
									     <?php
										}
									}else{
										$stmt = $categorias->readCatSubcat();
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
										 ?>
									     <option value="<?php echo $row['idsub']; ?>"                                         
											 <?php
                                            if ($_SESSION['idcategoriaR'] == $row['idsub'] ){
                                                echo "selected";	 
                                            }
                                             ?>>
										  <?php 
												echo strtoupper($row['subcategoria']). " " . " (" . $row['name']. ")";
												?>
									     </option>
									     <?php
										}	
									}
                                    
                                    ?>
                              </select>
                             </form>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">Marca</div></th>
                                                <th><div class="th-content">Nombre</div></th>
                                                <th><div class="th-content">Invoice</div></th>
                                                <th><div class="th-content">Consultas</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
                                
                                            //
                                            //Las marcas mas demandadas de StraSourcing
                                            $sql = "SELECT concat(day(a.datetime), '/' , month(a.datetime), '/' ,year(a.datetime)) as fecha, a.idmarca, b.nombre, 
                                            count(a.idmarca) as cuantos, concat(c.folder,c.images) as imagen FROM bigdata_in a inner join tabla_control b on 
                                            (a.idmarca = b.id and b.tipo=8 ) inner join table_images c on (b.image_id = c.id) 
											where a.programa='fichaTecnica' $condicion_catC  
                                            and a.consultar=1 group by year(datetime), month(datetime), day(datetime), idmarca 
											order by count(a.idcategoria) desc limit 30";
                                            //echo $sql;
                                            $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
                                            //create an array
                                            $color = "danger";
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                if ($row['cuantos'] >= 100){
                                                    $color = "primary";	
                                                }else if ($row['cuantos'] >= 50) {
                                                    $color = "secondary";
                                                }else if ($row['cuantos'] >= 10) {
                                                    $color = "warning";
                                                }
												$imagen_marca = $raizSistema."/app/" . $row['imagen']; 
												//echo $imagen_marca;
												$contador_marca = $row['cuantos'];
                                            ?> 
                                            <tr>
                                                <td><div class="customer-name"><img height="35px" src="<?php echo $row['imagen'];?>" alt="<?php echo $row['nombre'];?>"></div></td>
                                                <td><div class="td-content product-brand"><?php echo $row['nombre'];?></div></td>
                                                <td><div class="td-content pricing"><span class=""><?php echo $row['fecha'];?></span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-<?php echo $color; ?>"><?php echo $row['cuantos'] . " este dia";?></span></div></td>
                                            </tr>
                                            
                                            <?php 
											}
											
											?>
                                            <!--<tr>
                                                <td><div class="td-content customer-name"><img src="../assets/img/90x90.jpg" alt="avatar">Irene Collins</div></td>
                                                <td><div class="td-content product-brand">Speakers</div></td>
                                                <td><div class="td-content">#75844</div></td>
                                                <td><div class="td-content pricing"><span class="">$84.00</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-success">Paid</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="../assets/img/90x90.jpg" alt="avatar">Laurie Fox</div></td>
                                                <td><div class="td-content product-brand">Camera</div></td>
                                                <td><div class="td-content">#66894</div></td>
                                                <td><div class="td-content pricing"><span class="">$126.04</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-danger">Pending</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="../assets/img/90x90.jpg" alt="avatar">Luke Ivory</div></td>
                                                <td><div class="td-content product-brand">Headphone</div></td>
                                                <td><div class="td-content">#46894</div></td>
                                                <td><div class="td-content pricing"><span class="">$56.07</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-success">Paid</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="../assets/img/90x90.jpg" alt="avatar">Ryan Collins</div></td>
                                                <td><div class="td-content product-brand">Sport</div></td>
                                                <td><div class="td-content">#89891</div></td>
                                                <td><div class="td-content pricing"><span class="">$108.09</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-primary">Shipped</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="../assets/img/90x90.jpg" alt="avatar">Nia Hillyer</div></td>
                                                <td><div class="td-content product-brand">Sunglasses</div></td>
                                                <td><div class="td-content">#26974</div></td>
                                                <td><div class="td-content pricing"><span class="">$168.09</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-primary">Shipped</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="../assets/img/90x90.jpg" alt="avatar">Sonia Shaw</div></td>
                                                <td><div class="td-content product-brand">Watch</div></td>
                                                <td><div class="td-content">#76844</div></td>
                                                <td><div class="td-content pricing"><span class="">$110.00</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-success">Paid</span></div></td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                        		
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three">

                            <div class="widget-heading">
                                <h5 class="">Consultas por Subproductos de últimos 30 dias</h5>
                                <form method="post" action="">	
                              <select name="idcategoriaC" autofocus class="form-control" id="edo" onchange="this.form.submit()">
                                  <option value="">Escoja una opcion de <?php echo $_SESSION['changeSubcatC']==1 ?"Categoria" :"Subcategoria"?></option>
                                  <?php
									// readCategoriasActivas
									if($_SESSION['changeSubcatC'] == 1){
										$stmt = $categorias->readCategoriasActivas($_SESSION['idcategoriaC']);
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											?>
									     <option value="<?php echo $row['id']; ?>" 
                                        <?php
										if ($_SESSION['idcategoriaC'] == $row['id'] ){
											echo "selected";	 
										}
										 ?>
                                         >
										  <?php 
												echo $row['name']. " (" . $row['id']. ")"; 
												?>
									     </option>
									     <?php
										}
									}else{
										$stmt = $categorias->readCatSubcat();
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
										 ?>
									     <option value="<?php echo $row['idsub']; ?>"                                         
											 <?php
                                            if ($_SESSION['idcategoriaC'] == $row['idsub'] ){
                                                echo "selected";	 
                                            }
                                             ?>>
										  <?php 
												echo strtoupper($row['subcategoria']). " " . " (" . $row['name']. ")";
												?>
									     </option>
									     <?php
										}	
									}
                                    
                                    ?>
                              </select>
                             </form>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="25%"><div class="th-content">Grupo/Prod</div></th>
                                                <th width="15%"><div class="th-content th-heading">Fecha</div></th>
                                                <th width="25%"><div class="th-content">Categoria</div></th>
                                                <th width="25%"><div class="th-content th-heading">Subcategoria</div></th>
                                                <th width="10%"><div class="th-content">Cuantos</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
                                            //
                                            //Las marcas mas demandadas de StraSourcing
                                            $sql = "SELECT concat(day(a.datetime),'/',month(a.datetime),'/',year(a.datetime) ) as fecha, 
											b.idgrupo, b.gruponame, b.subcatname, b.catname, count(b.idgrupo) as cuantos FROM bigdata_in a 
											inner join php_combo.catsubcatgrupo b on (a.idgrupo = b.idgrupo) 
											where a.programa='fichaTecnica' $condicion_catC 
											group by year(a.datetime), month(a.datetime),day(a.datetime), b.idgrupo order by a.datetime desc limit 30";
                                            //echo $sql;
                                            $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
                                            //create an array
                                            $color = "danger";
                                            while($row = mysqli_fetch_assoc($result))
                                            {
												//echo "==".  $row['cuantos'];
                                            	?> 
                                                <tr>
                                                    <td><div class="td-content product-name"><?php echo $row['gruponame'];?></div></td>
                                                    <td><div class="td-content"><?php echo $row['fecha']; ?></div></td>
                                                    
                                                    <td><div class="td-content"><?php echo $row['subcatname'];?></div></td>
                                                    <td><div class="td-content"><?php echo $row['catname'];?></div></td>
                                                    <td><div class="td-content"><span class="badge outline-badge-<?php echo $color; ?>"><?php echo $row['cuantos'] . " este dia";?></span></div></td>
                                                </tr>
                                                
                                                
											<?php
                                            }
                                            ?>
                                            
                                            <!--<tr>
                                                <td><div class="td-content product-name"><img src="../assets/img/90x90.jpg" alt="product">Sunglasses</div></td>
                                                <td><div class="td-content"><span class="pricing">$56.07</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">$5.07</span></div></td>
                                                <td><div class="td-content">190</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Google</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="../assets/img/90x90.jpg" alt="product">Watch</div></td>
                                                <td><div class="td-content"><span class="pricing">$88.00</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">$20.00</span></div></td>
                                                <td><div class="td-content">66</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Ads</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="../assets/img/90x90.jpg" alt="product">Laptop</div></td>
                                                <td><div class="td-content"><span class="pricing">$110.00</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">$33.00</span></div></td>
                                                <td><div class="td-content">35</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Email</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="../assets/img/90x90.jpg" alt="product">Camera</div></td>
                                                <td><div class="td-content"><span class="pricing">$126.04</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">$26.04</span></div></td>
                                                <td><div class="td-content">30</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Referral</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="../assets/img/90x90.jpg" alt="product">Shoes</div></td>
                                                <td><div class="td-content"><span class="pricing">$108.09</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">$47.09</span></div></td>
                                                <td><div class="td-content">130</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Google</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="../assets/img/90x90.jpg" alt="product">Headphone</div></td>
                                                <td><div class="td-content"><span class="pricing">$168.09</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">$60.09</span></div></td>
                                                <td><div class="td-content">170</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Ads</a></div></td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2023 <a target="_blank" href="https://strasourcing.com">StraSourcing</a>, Todos los Derechos Reservados.</p>
                </div>
               <div class="footer-section f-section-2">
                    <p class=""><a href="login.php?ll=<?php echo $_SESSION['ll']; ?>&pp=<?php echo $_SESSION['pp']; ?>">Desarrollado</a> con <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->


    <!-- <aside id="colorPallet" class="color-pallet">
        <div class="pallet-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></div>

        <div class="p-colors">
            
            <div id="default" class="color-scheme-default"></div>
            <div id="lite" class="color-scheme-lite"></div>

        </div>

    </aside> -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="../plugins/apex/apexcharts.min.js"></script>
    <script src="../assets/js/dashboard/dash_2.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
   	<!-- BEGIN OTHERS SCRIPTS -->
	<script src="../plugins/highlight/highlight.pack.js"></script>
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="../plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END OTHERS STYLES -->
    
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

</body>
</html>