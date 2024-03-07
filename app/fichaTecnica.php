<style>
#g-table tbody tr > td{
	border: 0px solid rgb(220,220,220);
	height: 35px;
	padding-left: 3px;
}
#g-table{
	margin-left:10px;
	padding-left: 50px;
	margin-top: 20px;
	overflow-x:auto;
}
</style>
<?php 
include "controllers/mainController.php";
include "config/conexion.php";
include_once 'objects/tablaContacto.php';
include_once 'objects/proveedores.php';
include_once 'objects/empresas.php';

include_once 'config/database.php';
include_once 'objects/bigdata.php';

$database = new Database ();
$db = $database->getConnection ();
$bigdata = new Bigdata ( $db );

$tablaContactos = new TablaContactos ( $db );
$proveedores = new Proveedores ( $db );
$empresas = new Empresas ( $db );
include "controllers/recomendacionesRifEmpController.php";
$estrellas = 0;
$estrellaValor = 0;
$accionFavorito = 0;
date_default_timezone_set("America/Caracas"); 

if ( isset ($_GET['accionFavorito'] ) && $_GET['accionFavorito'] !="" ){
	echo "estoy2 agregando bigdata= ".$_SESSION['dir_categoria'];	
	$idCompany =  $_GET['id'];
	$_SESSION['idCompanyView'] = $idCompany;
	$query = "SELECT * FROM proveedor_favoritos where idProveedor = " . $idCompany . " and idusuario = " . $_SESSION['iduserHive'];
	//echo "===" . $query;
	$result = mysqli_query($conexion, $query);
	if ( !$result ) {
		die('Query Failed...');
	}else{
		$cuantas_solicitudes = $result->num_rows;
		if( $cuantas_solicitudes == 0 ){
			$query = "INSERT INTO proveedor_favoritos set 
			favorito = " . $_GET['accionFavorito'] . ", " . "
			idusuario = " . $_SESSION['iduserHive'] . ", " . "
			idCompany = " . $_SESSION['companyHive'] . ", " . "
			idProveedor = " . $idCompany;
			//echo $query;
			$result = mysqli_query($conexion, $query);
		}else{
			$query = "UPDATE proveedor_favoritos set favorito = " . $_GET['accionFavorito'] ." where idusuario = " . $_SESSION['iduserHive'] . " and idProveedor = " . $_GET['id'];
			//echo $query;
			$result = mysqli_query($conexion, $query);	
		}	
	}
}

// tomamos la informacion de la empresa
if ( isset($_GET['id']) && $_GET['id'] > 0 ){
	$idCompany =  $_GET['id'];
	$_SESSION['idCompanyView'] = $idCompany;
	$query = "SELECT d.puntuacion, b.city as nombreCiudad, c.state as nombreEstado, a.* FROM proveedores a
	inner join estados c on (a.state = c.id)
	inner join ciudades b on (a.ciudad = b.id)
	left join evaluacion d on (a.id = d.idProveedor)
	where a.id = " .$idCompany . " group by a.id ";

	$result = mysqli_query($conexion, $query);
	if ( !$result ) {
		die('Query Failed...');
	}else{
		//echo "===" . $query;
		$cuantas_solicitudes = $result->num_rows;
		while( $row = mysqli_fetch_array( $result ) ) {
			$empresa = $row['razon_social'];
			$logo = $row['logo_imagen'];
			$rif = $row['numero_rif'];
			$ciudad = $row['nombreCiudad'];
			$estado = $row['nombreEstado'];
			$email = $row['email_empresa'];
			$direccion = $row['direccion_empresa'];
			$telefono_empresa = $row['telefono_empresa'];
			$admin_nombre = $row['admin_nombre'];
			$admin_cargo = $row['admin_cargo'];
			$admin_email = $row['admin_email'];
			$admin_telefono = $row['admin_telefono'];
			$proveedor_web = $row['proveedor_web'];
			$instagram = $row['instagram'];
			$facebook = $row['facebook'];
			$linkedin = $row['linkedin'];
			//$favorito = $row['favorito'];
			$rango1_trabajadores = $row["rango1_trabajadores"];
			$rango2_trabajadores = $row["rango2_trabajadores"];
			$cantidad_clientes = $row["cantidad_clientes"];
			$condiciones_pago = $row["condiciones_pago"];
			$garantia = $row["garantia"];
			$servicio_postventa = $row["servicio_postventa"];
			
			if($row['puntuacion'] > 0 ){
				$estrellas = ($row['puntuacion'] / 26)*100;
				if ( $estrellas <=20){
					$estrellaValor = 1;
				}elseif( $estrellas <=40 ){
					$estrellaValor = 2;
				}elseif( $estrellas <=60 ){
					$estrellaValor = 3;
				}elseif( $estrellas <=80 ){
					$estrellaValor = 4;
				}else{
					$estrellaValor = 5;
				}
			}
		}
		
	}
}

//echo "agregando fichatecnica3= ".$_SESSION['dir_categoria'];		
// AGREGA AL BIGDATA

$bigdata->idusuario = $_SESSION['iduserHive'];
$bigdata->datetime = date('Y-m-d H:i:s');
$bigdata->programa = 'fichaTecnica';
$bigdata->agregar = 0;
$bigdata->modificar = 0;
$bigdata->eliminar = 0;
$bigdata->consultar = 1;
$bigdata->idempresa = $_SESSION['companyHive'];
$bigdata->tipo = $_SESSION['tipoHive'];
$bigdata->idmarca = $_SESSION['dir_marca'];
$bigdata->idorigen = $_SESSION['dir_origen'];
$bigdata->idcategoria = $_SESSION['dir_categoria'];
$bigdata->idsubcategoria = $_SESSION['dir_subcategoria'];
$bigdata->idgrupo = $_SESSION['dir_grupo'];
$bigdata->preferencia = $_SESSION['dir_preferencia'];
$bigdata->nombre_filtro = '';
$bigdata->estado = $_SESSION['dir_estado'];
$bigdata->ciudad = $_SESSION['dir_ciudad'];
$bigdata->tipo_empresa = $_SESSION['dir_tipo'];
$bigdata->sector = $_SESSION['dir_sector'];
$bigdata->internet = $_SESSION['dir_internet'];
$bigdata->verificacion = $_SESSION['dir_verifica'];
$stmt = $bigdata->crearBigdata();



// Get data from database para grafica
$resultado = $conexion->query("SELECT b.nombre as sector, a.porcentaje FROM proveedor_sectores a inner join tabla_control b on (a.sector = b.id and b.tipo=11) 
where a.idProveedor = " . $idCompany . " ORDER BY porcentaje DESC");

$accionFavorito = 1;
$imagenFavorito = "pngvacio.png";

$query = "SELECT * FROM proveedor_favoritos where idProveedor = " . $idCompany . " and idusuario = " . $_SESSION['iduserHive'];
//echo $query;
$result = mysqli_query($conexion, $query);
if ( !$result ) {
	die('Query Failed...');
}else{
	while( $row = mysqli_fetch_array( $result ) ) {
		//echo "=pas2=" . $query;
		$acc = $row['favorito'];
		if ( $acc == 1 ){
			$imagenFavorito = "pngegg.png";
			$accionFavorito = 0;
		}else{
			$imagenFavorito = "pngvacio.png";
			$accionFavorito =  1;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>STRASOURCING - Sales Dashboard </title>
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/loader.css">
    
    <script src="../assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES 
    <link href="../plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">-->
    <link href="../assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" class="dashboard-sales" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
    <script src="../plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="../plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
	
	<!-- Para grafica -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
    
        var data = google.visualization.arrayToDataTable([
          ['Sector', 'Porcentaje'],
          <?php
          if($resultado->num_rows > 0){
              while($row = $resultado->fetch_assoc()){
                echo "['".$row['sector']."', ".$row['porcentaje']."],";
              }
          }
          ?>
        ]);
        
		// title: 'Sectores donde particpa',
        var options = {
            width: 480,
            height: 250,
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        
        chart.draw(data, options);
    }
    </script>
	<!-- Fin de graficar -->
    
</head>
<body>

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <!--  BEGIN CONTENT AREA  -->
        
            <div  class="layout-px-spacing">
            
				<?php
				// AREA de mensajes del sistema
				if( $login == 1 ){
					$alert="";
					$alert = '<div class="alert alert-success" role="alert">
					Bienvenido usuario '.  $_SESSION['nombreHive'] . ' ' . $_SESSION['loginHive'] . ' a SPA!
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
                
                
               <!-- <div class="page-header">
                    <div class="page-title">
                        <h3>Ficah Tecnica <php echo $_SESSION['razonSocialHive']. " " . $_SESSION['companyHive'];?></h3>
                    </div>
                </div>-->
                <br>
                
                    
                 <div class="row">
                    <div align="center" class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">
                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table align="left" class="table">
                                        <tbody>
                                            <tr>
                                                <td width="20%">
                                                <div align="center" class="widget-heading">
                                                <img style="border-radius: 50%;" src="<?php echo $imagenes_logos.$logo; ?>" height="100"  alt=""/></td>
                                                
                                                <td width="30%">
                                                <div align="center" class="widget-heading">
                                                    <h5><?php echo $empresa; ?></h5>
                                                    <h6><?php echo $rif; ?></h6>
                                                    <a href="filtro_negocios/index.php" class="btn btn-secondary">Regresar</a>
                                                </div>
                                                </td>
                                                 
                                                <td width="20%">
                                                <div align="center" class="widget-heading">
													<?php 
                                                    for($i=0;$i<$estrellaValor;$i++){
                                                    ?>
                                                        <img src="../assets/img/estrella.jpg" width="40" alt=""/>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                  <h6>Puntuación <?php echo $estrellas; ?></h6>
                                                </div>
                                                
                                                
                                                <div align="center" class="widget-heading">
                                                	<a href="fichaTecnica.php?id=<?php echo $idCompany; ?>&accionFavorito=<?php echo $accionFavorito;?>">
                                                 	<img src="../assets/img/<?php echo $imagenFavorito; ?>" alt="" width="40" title="Click aqui para activar o desactivar favorito a este proveedor..."/>
                                                	</a>
                                                </div>
                                              </td>
                                            </tr>
                                            
                                                        
                                        </tbody>
                                        
                                    </table>
                              </div>
                            </div>
                        </div>
                     </div>
					
                    <div align="center" class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                      <div class="widget widget-activity-four">
    					<div class="widget-content">
                            <div class="widget-heading">
                                <h5 class="">Marcas que promueve</h5>
                            </div>
                          <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                
                                <div class="user-info-list">
                                    <table id="g-table">
                                      <tr>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle>
                                                </svg></td>
                                        <td><span style="color:#5B00B7;"><?php echo $direccion;?></span></td>
                                        
                                      </tr>
                                      <tr>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line>
                                                </svg></td>
                                        <td><span style="color:#5B00B7;"><?php echo $ciudad. ", " . $estado;?></span></td>
                                        
                                      </tr>
                                      <tr>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg></td>
                                        <td><span style="color:#5B00B7;"><?php echo $rif;?></span></td>
                                        
                                      </tr>
                                      <tr>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                                                </svg></td>
                                        <td>
                                            <span style="color:#5B00B7;"><?php echo"Empresa: " . $email;?><br>
                                            <?php echo "Admin: " . $admin_email;?></span>
                                             <br> <br>
                                        </td>
                                        
                                     
                                      <tr>
                                        <td>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                        </td>
                                        <td><span style="color:#5B00B7;"><?php echo "Empresa: ".$telefono_empresa; ?><br>
                                            <?php echo "Admin: " . $admin_telefono;?></span></td>
                                        
                                      </tr>
                                      
                                      <tr>
                                        <td>
                                            <ul class="contacts-block list-unstyled">
                                              <li class="contacts-block__item">
                                                
                                              </li>
                                            </ul>
                                        </td>  
                                      </tr>
                                      
                                      <tr>
                                        <td>
                                        <span style="color:#5B00B7;"><strong<?php echo "Cargo: ".$admin_cargo; ?></strong></span>	
                                        </td>
                                        
                                        <td>
                                            <span style="color:#5B00B7;"><?php echo "Administrador: ".$admin_nombre; ?></span>	
                                        </td>  
                                      </tr>
                                      
                                      <tr>
                                        <td>
                                            <ul class="contacts-block list-unstyled">
                                              <li class="contacts-block__item">
                                                
                                              </li>
                                            </ul>
                                        </td>
                                      </tr>
                                        
                                      <tr>
                                        <td>
                                        
                                        </td>
                                        
                                        <td>
                                           <div class="">
                                                <ul class="contacts-block list-unstyled">
                                                    
                                                    <li class="contacts-block__item">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <div class="social-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                                                </div>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <div class="social-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                                                </div>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <div class="social-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>                                    
                                        </div>
                                        </td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table>                                   
                                </div>
                            </div>
                        </div>
                      </div>  
                    </div>
                </div>
                
                
                
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div>
                        <div class="widget widget-activity-four">
                            <div class="widget-content"
                                <div class="mt-container mx-auto">
                                	<div class="widget-heading">
                                        <h5 class="">Marcas que Representa</h5>
                                    </div>
                                    <div class="timeline-line">
                                        <?php
										//  class="widget-three"
                                        $nombre_estatus = "";
                                        $ne = "primary";
										$query = "SELECT a.marca, c.folder, c.images, b.nombre FROM proveedor_marcas a 
										inner join tabla_control b on (a.marca = b.id and b.tipo=8) 
										inner join table_images c on (b.image_id = c.id) 
										where a.idCompany = " . $idCompany . " group by b.nombre limit 5";
                                        $result = mysqli_query($conexion, $query);
                                        if ( !$result ) {
                                            die('Query Failed...');
                                        }else{
                                            $cuantas_solicitudes = $result->num_rows;
                                            while( $row = mysqli_fetch_array( $result ) ) {
                                                ?>
                                                <div class="item-timeline timeline-warning">
                                                    <div class="t-dot" data-original-title="" title=""></div>
                                                  <div class="t-text">
                                                    <h5><span><?php echo $row['nombre']; ?></span></h5>
                                                    <img src="<?php echo $row['folder'].$row['images']; ?>" height="50"  alt=""/>
                                                        
                                                    
                                                  </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    
                    <div class="widget widget-activity-four">
                        <div class="widget-heading">
                            <h5 class="">Participación en el mercado</h5>
                        </div>
                        <div class="widget-content">
							<div class="mt-container mx-auto">
                            	<div id="piechart"></div>
                            </div>            
                        </div>
                    </div>
                
                </div>
                
                
                <div align="center" class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-activity-four">
    					<div class="widget-content">
                            <div class="widget-heading">
                                <h5 class="">Condiciones Comerciales</h5>
                            </div>
                          <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                
                                <div class="user-info-list"><br>
                                    <table id="g-table">
                                      <tr>
                                        <td><h5><span style="color:#5B00B7;"><?php echo "Rango/Trabajadores";?></span></h5></td>
                                        <td><h5><span style="color:#5B00B7;"><?php echo $rango1_trabajadores . " - " . $rango2_trabajadores;?></span></h5></td>
                                        
                                      </tr>
                                      <tr>
                                        <td>
                                        	<h5><span style="color:#5B00B7;"><?php echo "Términos de pago";?></span></h5>
                                        </td>
                                        <td><h5><span style="color:#5B00B7;"><?php echo strtoupper($condiciones_pago);?></span></h5></td>
                                        
                                      </tr>
                                      <tr>
                                        <td><h5><span style="color:#5B00B7;"><?php echo "Ofrece garantías?";?></span></h5></td>
                                        <td><h5><span style="color:#5B00B7;">
										<?php 
										if( $garantia == 1){
											  echo "Si"; 
										}else{
											echo "No";
										}?> 
										</span></h5></td>
                                        
                                      </tr>
                                      <tr>
                                        <td><h5><span style="color:#5B00B7;"><?php echo "Servicio Post-venta?";?></span></h5></td>
                                        <td><h5><span style="color:#5B00B7;">
										<?php 
										if( $servicio_postventa == 1){
											  echo "Si"; 
										}else{
											echo "No";
										}?> 
										</span></h5></td>
                                        
                                      
                                     </table>
                                     <br><br><br>                           
                                </div>
                            </div>
                        </div>
                      </div>  
                    </div>
                </div>
                    
                <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">

                        <div class="widget-heading">
                            <h5>Categorias-Subcategorias-Grupos-Marcas</h5>
                        </div>

                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">Categoria</div></th>
                                            <th><div class="th-content">Subcategoria</div></th>
                                            <th align="left"><div class="th-content">Grupo/Prod.</div></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nombre_estatus = "";
                                        $ne = "primary";
                                        $query = "SELECT b.name as categoria, c.name as subcategoria, d.name as grupo FROM proveedor_marcas a
										inner join php_combo.continente b on (a.categoria = b.id) 
										inner join php_combo.pais c on (a.subcategoria = c.id) 
										inner join php_combo.ciudad d on (a.grupo = d.id) 
										where a.idCompany = ".$idCompany." group by a.categoria, a.subcategoria, a.grupo;";
                                        //echo $query;
                                        $log_m = "../assets/img/favicon.ico";
                                        $result = mysqli_query($conexion, $query);
                                        if ( !$result ) {
                                            die('Query Failed...');
                                        }else{
                                            $cuantas_solicitudes = $result->num_rows;
                                            while( $row = mysqli_fetch_array( $result ) ) {
                                                ?>                                            
                                                <tr>
                                                    <td><h6><?php echo $row['categoria']; ?></h6></td>
                                                    <td><h6><?php echo $row['subcategoria']; ?></h6></td>
                                                    <td><h6><?php echo $row['grupo']; ?></h6></td>
                                                   <td></td>
                                                    </tr>
                                                <?php
                                                }
                                            }
                                            ?>     
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <a href="fichaTecnica.php?id=19362">Presione Click Aqui! o F5 para volver a consultar la lista de soportes....</a>
                    <div class="widget widget-activity-four">
                        <iframe frameBorder="0" class="responsive-iframe" src="soporte_multiples_imagenes/indexView.php" width="100%" height="1000px"></iframe>
                    </div>
                
                </div>
                    
                
                    

                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Categorias a Recomendar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body ">
                            <div class="row g-12 center-h center-v" >
                                <div class="p-6 mb-3 bg-secondary-subtle rounded container">
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
                                    </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="accion" value="incluir" class="btn btn-secondary" 
                            style="background-color:#5B00B7;" >Incluir a lista</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2023 <a target="_blank" href="https://designreset.com">StraSourcing</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>CP&amp;JCL</p>
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

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS
    <script src="../plugins/apex/apexcharts.min.js"></script> 
    <script src="../assets/js/dashboard/dash_2.js"></script>-->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
   	<!-- BEGIN OTHERS SCRIPTS -->
	<script src="../plugins/highlight/highlight.pack.js"></script>
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="../plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END OTHERS STYLES -->

	<script type="text/javascript">
		$(document).ready(function(){
			$("#letra").change(function(){
				$.get("Combobox_3_cat/Proveedores.php","letra="+$("#letra").val(), function(data){
					$("#rif").html(data);
					console.log(data);
				});
			});
	
			$("#pais_id").change(function(){
				$.get("Ciudades.php","pais_id="+$("#pais_id").val(), function(data){
					$("#ciudad_id").html(data);
					console.log(data);
				});
			});
		});
	</script>