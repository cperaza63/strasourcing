<?php 
include "config/conexion.php";

include "controllers/mainController.php";

// Codigo de programa de tabla de contactos
include_once 'objects/usuarios.php';
$otrosUsuarios = new Usuarios ( $db );

include_once 'objects/categorias.php';
$categorias = new Categorias ( $db );

$_SESSION['codigo_programa'] = "149";
// Codigo de programa de tablas de control
include "partials/validar_acceso.php";

include_once 'objects/bigdata.php';
$bigdata = new Bigdata ( $db );
// AGREGA AL BIGDATA
date_default_timezone_set("America/Caracas"); 
$bigdata->idusuario = $_SESSION['iduserHive'];
$bigdata->datetime = date('Y-m-d H:i:s');
$bigdata->programa = 'directorioCategorias';
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
$stmt = $bigdata->crearBigdata();
//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>STRASOURCING - Contact List Application</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="../https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="../assets/css/forms/theme-checkbox-radio.css">
    <link href="../plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->    
</head>
<body class="sidebar-noneoverflow application">
    
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

                <div class="page-header">
                    <div class="page-title">
                        <h3>Categorias disponibles para búsqueda</h3>
                    </div>
                </div>
                
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container grid">

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                    <form class="form-inline my-2 my-lg-0">
                                        <div class="<?php echo $_SESSION['dashboard']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control product-search" id="input-search" placeholder="Busqueda de categorias...">
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
									<!--	<svg id="btn-add-contact" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>-->
                                        <div class="switch align-self-center"><!---active-view-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid active-view"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                           
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                                    <div class="add-contact-box">
                                                        <div class="add-contact-content">
                                                            <form id="addContactModalTitle">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input type="text" id="c-name" class="form-control" placeholder="Name">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-email">
                                                                            <i class="flaticon-mail-26"></i>
                                                                            <input type="text" id="c-email" class="form-control" placeholder="Email">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-occupation">
                                                                            <i class="flaticon-fill-area"></i>
                                                                            <input type="text" id="c-occupation" class="form-control" placeholder="Occupation">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="contact-phone">
                                                                            <i class="flaticon-telephone"></i>
                                                                            <input type="text" id="c-phone" class="form-control" placeholder="Phone">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="contact-location">
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input type="text" id="c-location" class="form-control" placeholder="Location">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="btn-edit" class="float-left btn">Save</button>

                                                    <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>

                                                    <button id="btn-add" class="btn">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="searchable-items grid">
                                <div class="items items-header-section">
                                    <div class="item-content">
                                        <div class="">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input" id="contact-check-all">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <h4>Name</h4>
                                        </div>
                                        <div class="user-email">
                                            <h4>Email</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">Location</h4>
                                        </div>
                                        <div class="user-phone">
                                            <h4 style="margin-left: 3px;">Phone</h4>
                                        </div>
                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </div>
                                    </div>
                                </div>
								
                                <?php  
								if($_SESSION['tipoHive'] == 4 ){
									$sq= "SELECT a.*, b.image_id, c.folder, c.images, a.status FROM spa.tabla_control b
									inner join php_combo.continente a on (a.name = b.nombre)
									inner join spa.table_images c on (b.image_id = c.id)  
									inner join proveedor_marcas d on (d.categoria = a.id)
                  					where a.status=1 and d.rif = '" . $_SESSION['rifHive'] . "'
									group by a.status desc, a.id;";	
								}else{
									$sq= "SELECT a.*, b.image_id, c.folder, c.images, a.status FROM spa.tabla_control b
									inner join php_combo.continente a on (a.name = b.nombre)
									inner join spa.table_images c on (b.image_id = c.id)
									order by a.status desc, a.id;";								
								}   
                                //echo "=== " . $sq;                           
								$imagen = "";
                                $query = mysqli_query($conexion, $sq);
                                $result = mysqli_num_rows($query);
                                if ($result > 0) {
                                    while ($data = mysqli_fetch_assoc($query)) {                    
	                                $imagen = "http://localhost/strasourcing/app/".$data['folder'].$data['images'];
									if($data['status'] == 1){
										$linkgo = "spaDirectorio.php?cat=" . $data['id'] . "&nombre_cat=" . $data['name'] . "&imagen_cat=" . $imagen;
										$color="#ffffff";
									}else{
										$linkgo = "#";
										$color="#fafafa";
									}
									?>
                                		<div class="items">
                                    <div class="item-content" style="background-color:<?php echo $color;?>">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <a href="<?php echo $linkgo; ?>">
                                            <img src="<?php echo $imagen; ?>" alt="avatar" height="200px"></a>
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Alan Green"><br>
                                              <h5><?php echo $data['name']; ?></h5><br>
                                              </p>
                                            </div>
                                        </div>
								
                                        <div class="action-btn">
                                        <?php
										if( $data['status'] == 1){
											?>
											<a href="spaDirectorio.php?cat=<?php echo $data['id']; ?>&nombre_cat=<?php echo $data['name']; ?>&imagen_cat=<?php echo $imagen; ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" 
											viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4">
											<path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/>
											<path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/>
											<path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
	                                        </a>                                        
                                            <?php
										}else{
											?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" 
											viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4">
											<path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/>
											<path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/>
											<path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg> 	
                                           	<?php
										}
										?>
                                        </div>
                                    </div>
                                </div>
									<?php
									}
								}
								?>
                                
                               <!--/* <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/descarga (1).jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Linda Nelson">Instrumentacion y control</p>
                                            </div>
                                        </div>
                                         <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/images (1).jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Lila Perry">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/images (2).jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                                <p class="user-name" data-name="Andy King">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/images.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Instrumentacion y control">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/diningroom.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Xavier">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/bedroom.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Susan">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/diningroom.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                                <p class="user-name" data-name="Traci Lopez">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                       <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/livingroom2.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Traci Lopez">Instrumentacion y control</p>
                                                
                                          </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/forest.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Traci Lopez">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/nature (1).jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Traci Lopez">Instrumentacion y control</p>
                                                
                                            </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="../assets/img/nature.jpg" alt="avatar" height="90">
                                            <div class="user-meta-info">
                                              <p class="user-name" data-name="Traci Lopez">Instrumentacion y control</p>
                                                
                                          </div>
                                        </div>
                                        <div class="user-email" style="text-align:justify" >Es un dispositivo que se utiliza para medir y/o manipular distintas variables físicas del proceso. Las variables pueden ser por ejemplo el flujo, la temperatura, el nivel o la presión, etc. </p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title"># Empesas: </p>
                                            <p class="usr-location" data-location="Boston, USA">117</p>
                                        </div>

                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke-linejoin="round" stroke-width="4"><path fill="#2F88FF" stroke="#000" d="M21 38C30.3888 38 38 30.3888 38 21C38 11.6112 30.3888 4 21 4C11.6112 4 4 11.6112 4 21C4 30.3888 11.6112 38 21 38Z"/><path stroke="#fff" stroke-linecap="round" d="M26.657 14.3431C25.2093 12.8954 23.2093 12 21.0001 12C18.791 12 16.791 12.8954 15.3433 14.3431"/><path stroke="#000" stroke-linecap="round" d="M33.2216 33.2217L41.7069 41.707"/></g></svg>
                                        </div>
                                    </div>
                                </div>*/-->
                            </div>

                        </div>
                    </div>
                </div>
                </div>
        <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2023 <a target="_blank" href="https://strasourcing.com">StraSourcing</a>, Todos los derechos reservados.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
        <!-- END MAIN CONTAINER -->
    
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
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../assets/js/apps/contact.js"></script>
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