<?php 
include "controllers/mainController.php";
include "config/conexion.php";
include_once 'objects/tablaContacto.php';
include_once 'objects/proveedores.php';
include_once 'objects/empresas.php';
$tablaContactos = new TablaContactos ( $db );
$proveedores = new Proveedores ( $db );
$empresas = new Empresas ( $db );

include_once 'objects/usuarios.php';
$otrosUsuarios = new Usuarios ( $db );
include "controllers/recomendacionesRifController.php";
$_SESSION['codigo_programa'] = "208";
// Codigo de programa de tablas de control
include "partials/validar_acceso.php";
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
                <div class="page-header">
                    <div class="page-title">
                        <h3>Recomendaciones del Proveedor</h3>
                    </div>
                </div>
                
            <?php
				if( $activarModal == "Y"){
					if (!isset($_SESSION['nombre_empresa'])){
						$_SESSION['nombre_empresa']="";
					}
					$stmt2 = $empresas->readRif($_SESSION['consulta_rif']); 
					while ( $row2 = $stmt2->fetch ( PDO::FETCH_ASSOC ) ) 
					{
						//echo "si ahy" . $row2['razon_social'];
						$_SESSION['nombre_empresa'] = $row2['razon_social'];
						break;
					}
					?>
                    <br>
                    <div class="col-xl-11 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing" >
					
					  <form method="post" action="recomendaciones.php">
					  
					  <div class="widget-three">
						  <div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle">
                            <strong>Empresa <?php echo strtoupper($_SESSION['nombre_empresa']); ?> - <?php echo $_SESSION['consulta_rif'];?>
                            </strong></h5>
							
						  </div>
						  <div class="modal-body ">
							<div class="row g-9 center-h center-v" >
								<div class="p-6 mb-3 bg-secondary-subtle rounded container">
									 <h4 class="fst-italic">Quiero que nos recomienden para esta(s) categoría(s) </h4>
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
							<a href="recomendaciones.php" class="btn btn-secondary">Cerrar</a>
						  </div>
						</div>
					  
					  </form>
					</div>
                    <?php
				}
			?>
            
            
                
            <!-- Modal -->
            <?php
			if( isset ( $_GET['idRecomendar'] ) &&  $_GET['idRecomendar'] != "" && $activarModal != "Y" ){
                $query = "SELECT a.*, b.razon_social, c.name FROM solicitud_categorias a inner join 
				php_combo.continente c on (a.categoria = c.id) inner join proveedores b on (a.idCompany = b.id) 
				WHERE a.id = ". $_GET['idRecomendar'] . " group by a.id";
				
				// echo $query;
				
				$result = mysqli_query($conexion, $query);
				if ( !$result ) {
					die('Query Failed...');
				}else{
					$cuantas_solicitudes = $result->num_rows;
					while( $row = mysqli_fetch_array( $result ) ) {
						$idEmpresa = $row[''];
						$razon_social = $row['razon_social'];
						$numero_rif = $row['rif'];
						$solicitud_categoria = $row['id'];
						$idProveedor = $row['idCompany'];
						
					}
				}
				?>
                <div class="col-xl-11 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                  <form method="post" action="recomendaciones.php">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Categorías a Recomendar</h5>
                      </div>
                      
                      <div class="modal-body ">
                      
                      	<div class="container">                        
                            <input readonly class="form-control" name="razon_social" value="<?php echo $razon_social; ?>" />
                            <input readonly class="form-control" name="numero_rif" value="<?php echo $numero_rif; ?>" />
                            <input readonly class="form-control" name="solicitar_categoria" value="<?php echo $solicitud_categoria; ?>" />
                            <input readonly class="form-control" name="idProveedor" value="<?php echo $idProveedor; ?>" />
                        </div>
                        <div class="container">
                            <div class="row">
                                 <h6>Condiciones de Pago</h6>
                                  <select id="condiciones_pago" class="form-control" name="condiciones_pago" required>
                                    <option value="">Seleccione una sola opción</option>
                                    <option value="1.5">Crédito -30- días</option>
                                    <option value="1.4">Crédito -15- días</option>
                                    <option value="1.3">Crédito -07- días</option>
                                    <option value="1.2">Por adelantado 50%</option>
                                    <option value="1.1">Por adelantado 51% - 100%</option>
                                  </select>
                                <br>
                                 <h6>Negociaciones</h6>
                                  <select id="negociaciones" class="form-control" name="negociaciones" required>
                                    <option value="">Seleccione una sola opción</option>
                                    <option value="2.5">Reducciones >= a un 5%</option>
                                    <option value="2.4">Reducciones 3 - 4.9%</option>
                                    <option value="2.3">Reducciones 1 - 2.9%</option>
                                    <option value="2.2">Reducciones < 1%</option>
                                    <option value="2.1">Sin reducciones</option>
                                  </select>
                                <br>
                                 <h6>Tiempo de entrega</h6>
                                  <select id="tiempo_entrega" class="form-control" name="tiempo_entrega" required>
                                    <option value="">Seleccione una sola opción</option>
                                    <option value="3.5">Menor al ofertado</option>
                                    <option value="3.4">Igual al ofertado</option>
                                    <option value="3.3">Mayor al ofertado</option>
                                    <option value="3.2">Mayor al ofertado + impacto en el cliente</option>
                                    <option value="3.1">No entrego</option>
                                  </select>
                                <br>
                                 <h6>Calidad</h6>
                                  <select id="calidad" class="form-control" name="calidad" required>
                                    <option value="">Seleccione una sola opción</option>
                                    <option value="4.1">Cumplimiento con las condiciones del producto solicitado, incluyendo empaque y facil manejo o conteo</option>
                                    <option value="4.2">No cumplimiento con las condiciones del producto solicitado, incluyendo empaque y facil manejo o conteo</option>
                      
                                  </select>
                                <br>
                                 <h6>Garantía</h6>
                                  <select id="garantia" class="form-control" name="garantia" required>
                                    <option value="">Seleccione una sola opción</option>
                                    <option value="5.5">Incluye garantia en los productos suminstrados</option>
                                    <option value="5.0">No Incluye garantia en los productos suminstrados</option>
                                  </select>
                                <br>
                                <h6>Soporte</h6>
                                  <select id="soporte" class="form-control" name="soporte" required>
                                    <option value="">Seleccione una sola opción</option>
                                    <option value="6.5">Ofrece soporte técnico en los productos suminstrados</option>
                                    <option value="6.0">No ofrece soporte técnico en los productos suminstrados</option>
                                  </select>
                                <br>
                                <br><br>
                                <br>
                                <h5>Para finalizar la encuestra</h5>
                                <select id="recomiendo" class="form-control" name="recomiendo">
                                    <option value="">Recomendaria a este proveedor?</option>
                                    <option value="1">Si lo recomiendo</option>
                                    <option value="2">No lo recomiendo</option>
                                    <option value="0">No estoy seguro</option>
                                </select>
                                </p>
                            </div>
                        </div>
                      </div>
                      
                      <div class="modal-footer">
                        <button type="submit" name="accion" value="recomendar" class="btn btn-secondary" 
                        style="background-color:#5B00B7;" >Salvar recomendación</button>
                        <a class="btn btn-secondary" href="recomendaciones.php">Cancelar</a>
                      </div>
                    
                    </div>
                  </form>  
                </div>
            <?php
			}
			?>
            <!-- fin de Modal -->
                                        
                                        
                <div class="row layout-top-spacing">
					<?php
                    if (isset($_SESSION['accionR']) && $_SESSION['accionR'] == "no"){
                    ?>
					<div class="col-xl-11 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    	<div class="widget-three">
                            <iframe style="border:none;" class="responsive-iframe" src="registrate_gratis/empresaRecomendacion.php" 
                            width="100%" height="2100px"></iframe>    
                    	</div>
                    </div>
                    <br>
					<?php    					
                    }
                    ?>
                    
                    <?php
                    if (isset($_SESSION['accionR']) && $_SESSION['accionR'] != "no"){
                    ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">Resumen de Solicitudes</h5>
                            </div>
                            <div class="widget-content">

                                <div class="order-summary">
									<?php
										$cuantos_pendientes=0;
										$cuantos_aprobados = 0;
										$cuantos_rechazados = 0;
									  	
										// llamamos a los registros
										
										$sql_department = "SELECT * FROM solicitud_categorias WHERE estatus=0 AND idCompany = ".$_SESSION['companyHive'];
									  	$department_data = mysqli_query($conexion,$sql_department);
									  	$cuantos_pendientes = $department_data->num_rows;
										
										$sql_department = "SELECT * FROM solicitud_categorias WHERE estatus=1 AND idCompany = ".$_SESSION['companyHive'];
									  	$department_data = mysqli_query($conexion,$sql_department);
									  	$cuantos_aprobados = $department_data->num_rows;
										
										$sql_department = "SELECT * FROM solicitud_categorias WHERE estatus=2 AND idCompany = ".$_SESSION['companyHive'];
									  	$department_data = mysqli_query($conexion,$sql_department);
									  	$cuantos_rechazados = $department_data->num_rows;
										
										$total_solicitudes = $cuantos_pendientes + $cuantos_aprobados + $cuantos_rechazados; 
										echo "Total solicitudes " . $total_solicitudes;

										if ( $total_solicitudes > 0 ){
											$pPendientes =($cuantos_pendientes /$total_solicitudes) * 100; 
											$pAprobadas  =($cuantos_aprobados /$total_solicitudes)  * 100; 
											$pRechazadas =($cuantos_rechazados /$total_solicitudes) * 100;	
										}else{
											$pPendientes = 0; 
											$pAprobadas  = 0; 
											$pRechazadas = 0;												
										}
									?>
                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6>Aprobadas</h6>
                                                <p class="summary-count"><?php echo $cuantos_aprobados;?> empresa(s)</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: <?php echo $pAprobadas;?>%" aria-valuenow="<?php echo $pAprobadas;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                        </div>
                                        <div class="w-summary-details">
                                            
                                            <div class="w-summary-info">
                                                <h6>Rechazadas</h6>
                                                <p class="summary-count"><?php echo $cuantos_rechazados;?> empresa(s)</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: <?php echo $pRechazadas;?>%" aria-valuenow="<?php echo $pRechazadas;?>" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                <h6>Pendientes</h6>
                                                <p class="summary-count"><?php echo $cuantos_pendientes;?> empresa(s)</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: <?php echo $pPendientes;?>%" aria-valuenow="<?php echo $pPendientes;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                      <div class="widget widget-activity-four">

                            <div class="widget-heading">
                                <h5 class="">Solicitudes por fecha</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
										<?php
										$nombre_estatus = "";
										$ne = "primary";
                                        $query = "SELECT a.*, b.razon_social, c.name FROM solicitud_categorias a inner join 
										php_combo.continente c on (a.categoria = c.id) inner join empresas b on (a.rif = b.numero_rif) 
										WHERE a.idCompany = ".$_SESSION['companyHive'] . " order by a.date";
										//echo "===" . $query;
                                        $result = mysqli_query($conexion, $query);
                                        if ( !$result ) {
                                            die('Query Failed...');
                                        }else{
                                            $cuantas_solicitudes = $result->num_rows;
                                            while( $row = mysqli_fetch_array( $result ) ) {
                                               	switch( $row['estatus']){
													case 0:
													$nombre_estatus = "Pendiente";
													$ne = "warning";
													break;
													case 1:
													$nombre_estatus = "Aprobado";
													$ne = "success";
													break;
													case 2:
													$nombre_estatus = "Rechazado";
													$ne = "danger";
													break;
												}
												
                                                ?>
                                                <div class="item-timeline timeline-warning">
                                                    <div class="t-dot" data-original-title="" title="">
                                                    </div>
                                                    <div class="t-text">
                                                        <p><span><?php echo $row['razon_social'] . " (" . $row['name'].")"; ?></span></p>
                                                        <span class="badge badge-<?php echo $ne; ?>"><?php echo $nombre_estatus; ?></span>
                                                        <p class="t-time"><?php echo $row['date']; ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--<div class="item-timeline timeline-success">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>Nombre de</span> Empresa #2</p>
                                                <span class="badge badge-success">Completado</span>
                                                <p class="t-time">10/06/2023</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-warning">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>Nombre de</span> Empresa #3</p>
                                                <span class="badge badge-warning">Pendiente</span>
                                                <p class="t-time">08/04/2023</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-success">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>Nombre de</span> Empresa #4</p>
                                                <span class="badge badge-success">Completado</span>
                                                <p class="t-time">25/05/2022</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-warning">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>Nombre de</span> Empresa #4</p>
                                                <span class="badge badge-warning">Pendiente</span>
                                                <p class="t-time">17/06/2023</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-danger">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>Nombre de</span> Empresa #5</p>
                                                <span class="badge badge-success">Rechazada</span>
                                                <p class="t-time">21/03/2022</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-warning">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>Nombre de</span> Empresa #6</p>
                                                <span class="badge badge-warning">Pendiente</span>
                                                <p class="t-time">14/02/2023</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline  timeline-warning">
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
                                    <button class="btn">ordenado por fecha y empresa 
									<!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
									stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
									class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
                        
                        <div class="widget widget-account-invoice-one">

                            <div class="widget-heading">
                                <h5 class="">Nueva solicitud</h5>
                            </div>
							
                            <form method="post" action="recomendaciones.php">
                            <div class="widget-content">
                            
                            <iframe frameBorder="0" src="http://localhost/strasourcing/app/autocompletar/" width="100%" height="270px"> </iframe>
                                <div class="invoice-box">
                                    
                                  <!--<div class="acc-total-info">
                                    <h5></h5>
                                      <select id="letra" class="form-control" name="letra" onChange="submit()">
                                        <option value="">Seleccione tipo de rif</option>
                                        <option value="V" <php if( isset( $_POST['letra'] ) && $_POST['letra']=="V"){echo "selected";}?>>V - Forma natural</option>
                                        <option value="J" <php if( isset( $_POST['letra'] ) && $_POST['letra']=="J"){echo "selected";}?>>J - Registro Jurídico</option>
                                        <option value="E" <php if( isset( $_POST['letra'] ) && $_POST['letra']=="E"){echo "selected";}?>>E - Empresa Extranjera</option>
                                        <option value="G" <php if( isset( $_POST['letra'] ) && $_POST['letra']=="G"){echo "selected";}?>>G - Gubernamental</option>
                                        <option value="P" <php if( isset( $_POST['letra'] ) && $_POST['letra']=="P"){echo "selected";}?>>P - No se que es esto</option>
                                      </select>
                                    <br>
                                    
                                    <h6>
                                    
                                    <select id="rif" class="form-control" name="rif">
                                    <option value="">Seleccione una Empresa</option>
                                    	<php
										$letra="";
										if( isset($_POST['letra']) && $_POST['letra']!="" ){
											$_SESSION['letra'] = $_POST['letra'];
											$stmt = $empresas->readletraRif($_SESSION['letra']); 
											while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
											{
												$siva="1";
											?>
												<option value="<php echo $row['numero_rif']; ?>">
												<php echo $row['razon_social']." " .$row['numero_rif']; ?>
                                                </option>
											<php	
											}
										}    
										?>                                    
                                    </select>
                                    </h6>
                                    </div>

                                  <div class="inv-detail">                                        
                                    <p><h6>
                                    Para solicitar una recomendación deberá seleccionar la de lista
                                    , delo contrario haga click en Continuar sin empresa...
                                    </h6></p>
                                  </div>-->

                                    <div class="inv-action">
                                    
                                        <a href="recomendaciones.php?accionR=no" 
                                        class="btn btn-outline-dark">Continuar sin empresa</a>
                                        <?php
										if($siva=="1"){
											?>
                                            <button type="button" class="btn btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#exampleModalCenter">Solicitar a Empresa</button>
											<?php
										}
										?>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">

                            <div class="widget-heading">
                                <h5>Solicitud de Recomendación de Empresa</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            	<th><div class="th-content">Id</div></th>
                                                <th><div class="th-content">Logo</div></th>
                                                <th><div class="th-content">nombre Empresa</div></th>
                                                <th><div class="th-content">Categoria</div></th>
                                                <th><div class="th-content">Fecha</div></th>
												<th><div class="th-content">Puntuación</div></th>
                                                <?php 
												if($_SESSION['tipoHive'] == 3){	
												?>
                                                <th><div class="th-content">Acción</div></th>
                                                <?php
												}
												?>
                                                <th><div class="th-content">Estado</div></th>
                                                <th><div class="th-content">email Enviado?</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php
											$nombre_estatus = "";
											$ne = "primary";
											
											$query ="SELECT datediff(now(), a.fecha_respuesta) as dias_diferencia, a.id as idSolicitud, a.*, b.razon_social, b.numero_rif, b.contrato, c.name, b.logo_imagen, b.admin_nombre 
											FROM solicitud_categorias a inner join php_combo.continente c on (a.categoria = c.id) 
											inner join empresas b on (a.rif = b.numero_rif) WHERE a.idCompany = ".$_SESSION['companyHive'] . 
											" order by b.razon_social, c.name, a.date ";
											
											//echo $query;
											$log_m = "../assets/img/favicon.ico";
											$result = mysqli_query($conexion, $query);
											if ( !$result ) {
												die('Query Failed...');
											}else{
												$cuantas_solicitudes = $result->num_rows;
												while( $row = mysqli_fetch_array( $result ) ) {
													// pendiente preguntar por la fecla de cumlimiemto de un ano
													$logo = $imagenes_logos.$row['logo_imagen'];
													switch( $row['estatus']){
														case 0:
														$nombre_estatus = "Pendiente";
														$ne = "warning";
														break;
														case 1:
														$nombre_estatus = "Aprobado";
														$ne = "success";
														break;
														case 2:
														$nombre_estatus = "Rechazado";
														$ne = "danger";
														break;
													}
													
													$nombre_puntuacion="";
													
													if( intval(($row['puntuacion']/26)*100 ) == 0){
														$nombre_puntuacion = "Sin evaluación";
													}elseif( intval(($row['puntuacion']/26)*100 ) <= 20){
														$nombre_puntuacion = "Deficiente";
													}elseif( intval(($row['puntuacion']/26)*100 ) <= 40) {
														$nombre_puntuacion = "Regular";
													}elseif ( intval(($row['puntuacion']/26)*100 ) <= 60){
														$nombre_puntuacion = "Bueno";
													}elseif ( intval(($row['puntuacion']/26)*100 ) <= 80){
														$nombre_puntuacion = "Muy Bueno";
													}else{
														$nombre_puntuacion = "Excelente";
													}
													?>
                                                    <tr>
                                                    	<td><?php echo $row['id']; ?></td>
                                                        <td><div class="td-content customer-name"><img src="
														<?php 
															echo $row['logo_imagen'] != "" ?$logo :$log_m;?>
                                                        " alt="avatar">
														<?php 
														echo trim($row['admin_nombre']) != "" ? $row['admin_nombre']: $row['numero_rif']." (NR)"; ?>
                                                        </div></td>
                                                        <td><div class="td-content product-brand"><?php echo $row['razon_social']; ?></div></td>
                                                        <td><div class="td-content"><?php echo $row['name']; ?></div></td>
                                                        <td><div class="td-content pricing"><span class=""><?php echo $row['date']; ?></span></div></td>
                                                        <td><div class="td-content pricing"><span class=""><?php echo $nombre_puntuacion . "<br>" . intval(($row['puntuacion']/26)*100); ?>%</span></div></td>
                                                        <?php
															if($_SESSION['tipoHive'] == 3  ){	
																if($ne == "warning"){
																	?>
																	<td><div class="td-content">
																	<a class="btn btn-secondary" href="recomendaciones.php?idRecomendar=<?php echo $row['id']; ?>">Evaluar</a>
																	</td>    
																	<?php
																}else{
																	?>
																	<td><div class="td-content">
																	<a class="btn btn-primary" href="#">Evaluado</a>
																	</td>   
																	<?php
																}
															}
														
														
														?>
                                                        <td><div class="td-content"><span class="badge outline-badge-<?php echo $ne; ?>"><?php echo $nombre_estatus; ?></span></div></td>
                                                        <?php
															if ($row['contrato'] == 0){
																if($row['enviado'] == 0 ){
																	?>
																	<td><div class="td-content">
																	<a class="btn btn-secondary" href="recomendaciones.php?idSolicitud=<?php echo $row['idSolicitud']; ?>&rifExt=<?php echo $row['numero_rif']; ?>">Enviar</a>
																	</td>    
																	<?php
																}
															}
															
														?>
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
                    <?php
					}
					?>
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