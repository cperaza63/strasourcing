<?php 
include "controllers/mainController.php";
include "controllers/tablacontactosController.php";
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
    <script src="../plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="../plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    
    <!-- JavaScript para conmfirmar delete o no-->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <!-- FIN DE JavaScript para conmfirmar delete o no-->
	<script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
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

	<!-- BEGIN OTHERS SCRIPTS -->
	<script src="../plugins/highlight/highlight.pack.js"></script>
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="../plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END OTHERS STYLES -->
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../plugins/table/datatable/datatables.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->  
        
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
                <div class="page-header">
                    <div class="page-title">
                        <h3>Control de Usuarios</h3>
                    </div>
                </div>
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
												echo "Proveedor";	
												break;

											case "4":
												echo "Administrador";	
												break;

										}
										?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">

								<div class="row">
                                    <div class="col-md-8 mx-auto">
                                    
                                    	<button class="btn btn-success mb-2" type="button" data-toggle="modal" data-target="#nuevo_mensaje2"><i class="fas fa-plus"></i></button>

                                    
                                        <div class="card">
                                           <div class="card-body">
                                                <form class="" action="" method="post">
                                                <a href="vistaContactanos.php" class="btn btn-secondary">Volver</a>
                                           <div>                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="Fecha">Fecha</label>
                                        <input name="fecha" type="text" class="form-control" value="<?php echo $date; ?>" >
                
                                    </div>


                                    <div class="form-group ">
                                        <label for="nombre">Nombre</label>
                                        <input name="nombre" type="text" required class="form-control" value="<?php echo $usuario; ?>" >
                                
                                    </div>
                                    
                                    <div class="form-group">
                                      <label for="website">Comentario</label>
                                        <textarea name="comentario" rows="5" class="form-control"><?php echo $comentario; ?></textarea>
                
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input name="correo" type="text" class="form-control" value="<?php echo $email; ?>" >
                
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input name="telefono" type="text" class="form-control" value="<?php echo $telefono; ?>" >
                
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        <input name="direccion" type="text" class="form-control" value="<?php echo $direccion; ?>" >
                
                                    </div>
                                    
                                    <?php
									if ( !is_numeric($state) ){
									?>
                                    <div class="form-group">
                                        <label for="state">Ciudad y Estado</label>
                                        <input name="state" type="text" class="form-control" value="<?php echo $city." en " . $state; ?>" >
                
                                    </div>
                                    <?php
									}
                                    ?>
                                    <div class="form-group">
                                        <label for="website">WebSite</label>
                                        <input name="website" type="text" class="form-control" value="<?php echo $website; ?>" >
                
                                    </div>
                                         <a href="vistaUsuario.php" class="btn btn-secondary">Volver</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-wrapper">
    <div class="footer-section f-section-1">
        <p class="">Copyright © 2023 <a target="_blank" href="https://designreset.com">StraSourcing,</a> Todos los derechos reservados.</p>
        </div>
        <div class="footer-section f-section-2">
            <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>CP&amp;JCL</p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
</div>

<div id="nuevo_mensaje" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title text-white" id="my-modal-title">Respondiendo al Mensaje</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="vistaContactanos.php">
					<div>
                    	<p>
                        
                        </p>
                        <div class="form-group">
                            <label for="nombre">Asunto</label>
                            <input type="text" class="form-control" placeholder="Ingrese Asunto del mensaje" required
                            name="asunto" id="asunto">
                        </div>
                        <div class="form-group">
                            <label for="correo">Mensaje</label>
                            <textarea rows="4" class="form-control" name="mensaje" id="mensaje" required>
                            </textarea>
                        </div>
            
                        <input type="submit" value="Enviar" class="btn btn-secondary" name="submit">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="nuevo_mensaje2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title text-white" id="my-modal-title">Respondiendo al Mensaje...</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="vista_contactanos_show.php">
					<div>
                    	
                        <div class="form-group">
                            <label for="nombre">Asunto</label>
                            <input type="text" class="form-control" placeholder="Ingrese Asunto del mensaje" required
                            name="asunto" id="asunto">
                        </div>
                        <div class="form-group">
                            <label for="correo">Mensaje</label>
                            <textarea rows="4" class="form-control" name="mensaje" id="mensaje" required>
                            </textarea>
                        </div>
            
                        <input type="submit" value="Enviar" class="btn btn-secondary" name="submit">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
						<hr>                        
                        
                        <div class="form-group">
                          <label for="website">Comentario</label>
                            <textarea readonly name="comentario" rows="5" class="form-control"><?php echo $comentario; ?></textarea>
    
                        </div>
                    	
                         <div class="form-group ">
                            <label for="nombre">Nombre</label>
                            <input readonly name="nombre" type="text" class="form-control" value="<?php echo $usuario; ?>" >
                    
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input readonly name="correo" type="text" class="form-control" value="<?php echo $email; ?>" >
    
                        </div>
                        
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input readonly name="telefono" type="text" class="form-control" value="<?php echo $telefono; ?>" >
    
                        </div>
                        
                       
                        
                         
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>