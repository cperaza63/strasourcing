<?php 
include "controllers/mainController.php";
include "controllers/usuarioController.php";

include_once 'objects/empresas.php';
$empresas = new Empresas ( $db );

include_once 'objects/proveedores.php';
$proveedores = new Proveedores ( $db );

// Codigo de programa de tabla de contactos
include_once 'objects/usuarios.php';
$otrosUsuarios = new Usuarios ( $db );
$_SESSION['codigo_programa'] = "140";
include "partials/validar_acceso.php";
//

$idEmpresa = 0;
$idProveedor = 0;
if (!isset($_SESSION['idEmpresa_filtro'])){
$_SESSION['idEmpresa_filtro'] = "";	
}

if (!isset($_SESSION['idProveedor_filtro'])){
$_SESSION['idProveedor_filtro'] = "";	
}

if (isset( $_POST['idEmpresa'] ) &&  $_POST['idEmpresa'] != 0 ){
	$idEmpresa = $_POST['idEmpresa'];
	$_SESSION['idEmpresa_filtro'] = $idEmpresa; 
}else{
	 $idEmpresa = $_SESSION['idEmpresa_filtro'];
}

if (isset( $_POST['idProveedor'] ) &&  $_POST['idProveedor'] != 0 ){
	$idProveedor = $_POST['idProveedor'];
	$_SESSION['idProveedor_filtro'] = $idProveedor;
}else{
	$idProveedor = $_SESSION['idProveedor_filtro'];
}

if (isset( $_POST['ListaEmpresas'] ) &&  $_POST['listaEmpresas'] != 0 ){
	$idEmpresa = $_POST['idEmpresa'];
}
if (isset( $_POST['ListaProveedores'] ) &&  $_POST['listaProveedores'] != 0 ){
	$idProveedor = $_POST['idProveedor'];
}					
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>STRASOURCING - Custom Styled DataTables</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="../https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/custom_dt_custom.css">

    <link href="../assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    
    <!-- JavaScript para conmfirmar delete o no-->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <!-- FIN DE JavaScript para conmfirmar delete o no-->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../plugins/sweetalerts/promise-polyfill.js"></script>
    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
	<!-- BEGIN OTHERS SCRIPTS -->
	<script src="../plugins/highlight/highlight.pack.js"></script>
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="../plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END OTHERS STYLES -->
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../plugins/table/datatable/datatables.js"></script>
	|<!-- END PAGE LEVEL SCRIPTS -->
        
</head>
<body class="sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <?php include "partials/navbar.php"?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include "partials/sidebar.php"?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <!--<div class="widget-content widget-content-area text-center">
                    <button id="successfully" class="mr-2 btn btn-primary message">Basic message</button>
                    <script>
                    $('#successfully').on('click', function () {
                      swal({
                          title: 'Saved succesfully',
                          padding: '2em'
                        })
                    })
                    </script>
                </div>-->
                <?php 
					// area de mensajes
					echo $alert; 
					$alert="";
				?>
                <div class="page-header">
                    <div class="page-title">
                        <h3>Control de Usuarios</h3>
                    </div>
                </div>
                
				
                <div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-secondary text-white">
                                <h5 class="modal-title text-white" id="my-modal-title">Nuevo Usuario</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" autocomplete="off">
                                	<input name="accion" type="hidden" value="a" />
                                    <?php echo isset($alert) ? $alert : ''; ?>
                                    
                                    <div class="form-group">
                                        <label for="tipo">Tipo de Usuario</label>
                                        <select name="tipo" class="form-control">
                                            <option value="0">0 - No definido</option>
                                            <option value="1">1 - Administrador</option>
                                            <option value="2">2 - Asistente</option>
                                            <option value="3">3 - Usuario Empresa Proveedor</option>
                                            <option value="4">4 - Usuario Empresa Comprador</option>
                                        </select>
                
                                    </div>
                                                        
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input type="email" class="form-control" placeholder="Ingrese Correo Electrónico" name="correo" id="correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="usuario">Usuario</label>
                                        <input type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario">
                                    </div>
                                    <div class="form-group">
                                        <label for="clave">Contraseña</label>
                                        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="clave" id="clave">
                                    </div>
                                    <input type="submit" value="Registrar" class="btn btn-secondary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
				
                <?php			
				if( $_SESSION['tipoHive'] <= 2){
				?>
                <br>
                <form method="post" action="vistaUsuario.php">
                    <div class="row">
                      <div class="col-lg-3">
                         <select name="idEmpresa" class="form-control" id="edo">
                                <option value="0">Seleccionar Empresa</option>
                                <?php
                                $stmt = $empresas->readtodoEmpresa();
								while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
								{	
									?>
								   <option value="<?php echo $row['id']; ?>"
								   <?php 
								   if ($idEmpresa == $row['id'] ){ echo "selected"; }
								   ?>
								   ><?php echo $row['razon_social']. " (" . $row['id']. ")"; ?></option>
								   <?php
                                }
                                ?>
                        </select>   
                         </div>
                         
                         <div class="col-lg-2">
                        <button name="listaEmpresas" class="btn btn-secondary mb-2" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                         
                         <div class="col-lg-3">
                         <select name="idProveedor" class="form-control" id="edo">
                                <option value="0">Seleccionar Proveedor</option>
                                <?php
                                $stmt = $proveedores->readtodoProveedor();
								while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
								{	
									?>
								   <option value="<?php echo $row['id']; ?>"
								   <?php 
								   if ($idProveedor == $row['id'] ){ echo "selected"; }
								   ?>
								   ><?php echo $row['razon_social']. " (" . $row['id']. ")"; ?></option>
								   <?php
                                }
                                ?>
                        </select>   
                         </div>      

                        <div class="col-lg-2">
                        <button name="listaProveedores" class="btn btn-secondary mb-2" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <br>
                <?php
				}
				?>
				<div class="row layout-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4><?php 
										switch($_SESSION['tipoHive']){
											case "1":
												echo "Administrador";	
												break;
											case "2":
												echo "Asistente";	
												break;

											case "3":
												echo "Empresa";	
												break;

											case "4":
												echo "Proveedor";	
												break;

										}
										
										?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                            <button class="btn btn-secondary" type="button" data-toggle="modal" 
                            data-target="#nuevo_usuario"><i class="fas fa-plus"></i></button>
              
                                <div class="table-responsive mb-4">
                                    <table id="style-3" class="table style-3  table-hover">
                                        <thead>
                                            <tr>
                                                <th class="checkbox-column text-center" style="color:#2E005B;"> Usuario </th>
                                                <th class="text-center" style="color:#2E005B;">Image</th>
                                                <th style="color: #2E005B;">Tipo/usuario</th>
                                                <th style="color:#2E005B;" width="20%">Nombre completo</th>
                                                <th style="color:#2E005B;">Empresa</th>
                                                <th style="color:#2E005B;" width="20%">e-mail</th>
                                                <th class="text-center" style="color:#2E005B;">Estatus</th>
                                                <th class="text-center" style="color:#2E005B;" width="20%">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
										$filtroNegocio = 0;
										if( isset($_POST['listaEmpresas']) && $_POST['listaEmpresas'] !="0"){
											$filtroNegocio = $idEmpresa;
										}else{
											if( isset($_POST['listaProveedores']) && $_POST['listaProveedores'] !="0"){
												$filtroNegocio = $idProveedor;
											}else{
												$filtroNegocio = $_SESSION['companyHive'];
											}
										}
										//echo"===".$_SESSION['tipoHive']." " . $filtroNegocio;
										$stmt = $otrosUsuarios->LeerUsuarios($_SESSION['tipoHive'], $filtroNegocio); 
										while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
										{	
											switch($row['tipo']){
												case "1":
													$tipo_selec = "Administrador";	
													break;
												case "2":
													$tipo_selec = "Asistente";	
													break;
	
												case "3":
													$tipo_selec = "Empresa";	
													break;
	
												case "4":
													$tipo_selec = "Proveedor";	
													break;
	
											}
										?>
	                                        <tr>
                                                <td class="checkbox-column text-center idUsuario">
                                                <span id="id"><?=$row['idusuario']?></span>
                                                </td>
                                                <td class="text-center">
                                                    <img src="<?=$raizSistema.$row['folder'] . $row['imagen']?>" 
                                                    class="profile-img" alt="avatar">
                                                </td>
                                                <td><span id="tipo"><?= $tipo_selec . " - " . $row['userhive']; ?></span></td>
                                                <td><span id="nombre"><?= $row['nombre']?></span></td>
                                                <td><span id="razon_Social">
                                                <?php
												if( $row['tipo'] == '3' ){
													//echo "===". $row['tipo'];
													echo $row['razon_social'];
												} else{
													if( $row['tipo'] == '4' ){
														//echo "===". $row['tipo'];
														echo $row['razon_social'];	
													}else{
														echo "Admin - " . $row['userhive'];
													}
												}
												?>
                                                </span></td>
                                                <td><span id="correo"><?= $row['correo']?></span></td>
                                                
                                                <td class="text-center">
                                                <?php
													switch( $row['estado'] ){
													case 0:
														?>
														<span class="shadow-none badge badge-danger">Inhabilitado</span>
														<?php
														break;													
													case 1:
														?>
														<span class="shadow-none badge badge-primary">Activo</span>
														<?php
														break;
													case 2:
														?>
														<span class="shadow-none badge badge-warning">Suspendido</span>
														<?php
														break;
													}
												?>
                                                </td>
                                                
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        
                                                        <li><a href="vistaRoles.php?id=<?=$row['idusuario']?>"
                                                        class="bs-tooltip" 
                                                        data-placement="top" 
                                                        data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="M160 16a80.07 80.07 0 0 0-76.09 104.78l-57.57 57.56A8 8 0 0 0 24 184v40a8 8 0 0 0 8 8h40a8 8 0 0 0 8-8v-16h16a8 8 0 0 0 8-8v-16h16a8 8 0 0 0 5.66-2.34l9.56-9.57A80 80 0 1 0 160 16Zm0 144a63.7 63.7 0 0 1-23.65-4.51a8 8 0 0 0-8.84 1.68L116.69 168H96a8 8 0 0 0-8 8v16H72a8 8 0 0 0-8 8v16H40v-28.69l58.83-58.82a8 8 0 0 0 1.68-8.84A64 64 0 1 1 160 160Zm32-84a12 12 0 1 1-12-12a12 12 0 0 1 12 12Z"/></svg></a>
                                                        </li>
                                                        
                                                        <li><a href="vista_usuario_update.php?id=<?=$row['idusuario']?>"
                                                        class="bs-tooltip" 
                                                        data-placement="top" 
                                                        data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                        </li>
                                                        
                                                        <li><span
                                                        data-toggle="modal" 
                                                        data-target="#deleteChildrensn<?=$row['idusuario']?>" 
                                                        class="bs-tooltip" 
                                                        data-placement="top" 
                                                        data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            
											<?php 
											include "modals/modal_usuario_delete.php"; 
										}
										?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
        <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    
    
    <script>
        // var e;
        c1 = $('#style-1').DataTable({
            headerCallback:function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            },
            columnDefs:[ {
                targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                    return'<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                }
            }],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        multiCheck(c1);

        c2 = $('#style-2').DataTable({
            headerCallback:function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            },
            columnDefs:[ {
                targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                    return'<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                }
            }],
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5 
        });

        multiCheck(c2);

        c3 = $('#style-3').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        multiCheck(c3);
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->  
	
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <!-- BEGIN ELIMINAR SCRIPTS -->  
    <script>
    $(document).ready(function() {		
      $('.eliminar').on('click', function() {
        var id = $(this).data('idusuario');
        //eliminar(id);
		console.log("paso a eliminar", id);
      });
    
      var eliminar = function(id) {
        alertify.confirm("Deseas eliminar al usuario", function() {
    
          // confirma eliminar
          $.post('microservicio/ajax_delete_User.php', { idUsuario: id }, function(data) {
            // se eliminó correctamente
            alertify.success('Usuario eliminado');
          }).fail(function() {
            // ocurrió un error
            alertify.error('Error al eliminar usuario');
          });
    
        });
      }
    });
	</script>
    <!-- BEGIN ELIMINAR SCRIPTS -->  


</body>
</html>