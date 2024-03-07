<?php 
include "modals/modal_style.php";
include "controllers/mainController.php";
include "controllers/usuarioController.php";
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
                                    <div class="col-md-10 mx-auto">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <form class="" action="" method="post">
                                                	<input name="accion" type="hidden" value="u" />
                                                    <input name="idusuario" type="hidden" value="<?php echo $idUsuario; ?>" />
                                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-user-edit"></i></button>
                                                    <a href="vistaUsuario.php" class="btn btn-danger-transparent">Volver</a>
                                                    
                                                    <?php echo isset($alert) ? $alert : ''; ?>
                                                    <input type="hidden" name="id" value="<?php echo $idUsuario; ?>">
                                                    
                                                     <div class="form-group">
                                                        <label for="tipo_usuario">Tipo de Usuario</label>
                                                        <select name="tipo" class="form-control">
                                                            <option value="0" <?php if( $tipo == 0 ){ echo "selected"; }?>>0 - No definido</option>
                                                            <option value="1" <?php if( $tipo == 1 ){ echo "selected"; }?>>1 - Administrador</option>
                                                            <option value="2" <?php if( $tipo == 2 ){ echo "selected"; }?>>2 - Asistente</option>
                                                            <option value="3" <?php if( $tipo == 3 ){ echo "selected"; }?>>3 - Usuario Empresa Proveedor</option>
                                                            <option value="4" <?php if( $tipo == 4 ){ echo "selected"; }?>>4 - Usuario Empresa Comprador</option>
                                                        </select>
                                
                                                    </div>
                                                    
                                                    
                                                    <div>
                                                    
                                                        <p>
                                                      <div class="form-inline">
                                                            <button id="myBtnSoporte" type="button" class="btn btn-warning" title="Subir imagen del usuario">
                                                            <i class='fas fa-image'></i></button>
                                                      </div>
                                                      <div align="center"><img src="<?php echo $raizSistema.$folder.$imagen; ?>" height="200px"  alt=""/></div>
                                                        <div id="myModalSoporte" class="modal">						
                                                          <!-- Modal content -->
                                                          <div class="modal-content">
                                                            <!--<div class="modal-header">
                                                              <span class="close">&times;</span>
                                                              <h2>Subir imagen del usuario</h2>
                                                            </div>-->
                                                            <div class="modal-footer">
                                                            <a href="usuarios.php">
                                                            <button class="btn btn-success text-white">
                                                              <h3>Cerrar Ventana y Refrescar</h3>
                                                            </button>
                                                            </a>
                                                            </div>
                                                            <div class="modal-body">
                                                             
                                                              <div class="container_modal"> 
<iframe class="responsive-iframe" src="subirUnArchivo/index.php?tipoTabla=13&idUsuario=<?php echo $idUsuario; ?>&folder=<?php echo "/assets/documentos/imagenes/usuarios/"; ?>"></iframe>
                                                              </div>
                                                            
                                                            </div>
                                                            <!--<div class="modal-footer">
                                                            <a href="usuarios.php">
                                                            <button class="btn btn-success text-white">
                                                              <h3>Cerrar Ventana y Refrescar</h3>
                                                            </button>
                                                            </a>
                                                            </div>-->
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
                                                        
                                                        </p>
                                                    
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre</label>
                                                        <input name="nombre" type="text" required class="form-control" id="nombre" placeholder="Ingrese nombre" value="<?php echo $nombre; ?>">
                                
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="correo">Correo</label>
                                                        <input name="correo" type="text" class="form-control" id="correo" placeholder="Ingrese correo" value="<?php echo $correo; ?>">
                                
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usuario">Usuario / Login</label>
                                                        <input name="usuario" type="text" class="form-control" id="usuario" placeholder="Ingrese usuario" value="<?php echo $usuario; ?>">
                                
                                                      <input type="text" placeholder="Ingrese password" class="form-control" name="password" id="password" value="">
                                                      
                                                    </div>
                                                    
                                                    <!-- onChange="this.form.submit()" -->
                                                    <div class="form-group">
                                                        <label for="Userhive">Usuario de Emrpesa...</label>
                                                        <select name="userhive" class="form-control" id="userhive">
                                                            <option value="0">Seleccionar Empresa</option>
                                                            	<?php
																  $sql = "";
																  if( $tipo == 3 ){
																	$sql = "select * from empresas where estado = 1 order by razon_social";
																  }else{
																	if( $tipo == 4 ){
																	  $sql = "select * from proveedores where estado = 1 order by razon_social";
																	}else{
																	  $sql = "";	
																	}
																  }
																  if( $sql != ""){
																	$query = mysqli_query($conexion, $sql);                                
																	$result = mysqli_num_rows($query);
																	if ($result > 0) {
																	  while ($data = mysqli_fetch_assoc($query)) {
																		if( $tipo == 3 ){
																		  $variable = $data['id'];
																		}else{
																		  if( $tipo == 4 ){
																			$variable = $data['id'];
																		  }
																		}
																		if( $tipo == 3 || $tipo == 4){
																		  ?>
																		  <option value="<?php echo $variable; ?>"
																		  <?php 
																		  if ($userhive == $variable ){ echo "selected"; }
																		  ?>
																		  ><?php echo $data['razon_social'] . " - " . $variable; ?></option>
																		  <?php
																		}
																	  }
																	}	
																  }
																
																?>
                                                        </select>
                                                    </div>
                                                    
                                                    <!-- onChange="this.form.submit()" -->
                                                    
                                                    <?php
													echo "+++" . $_SESSION['tipoHive'] ;
													if($_SESSION['tipoHive'] <= 3){
													?>
                                                    <div class="form-group">
                                                      <label for="Userhive">Categorias habilitadas para recomendaciones... (use Ctrl-click para seleccionar sobre la linea para multiple seleccion)</label>
                                                        <select name="user_cat[]" size="6" multiple="MULTIPLE" class="form-control" id="user_cat">
                                                            <option value="0">Seleccionar Categoria</option>
															<?php
                                                            $sql = "";
                                                            
                                                            $sql = "SELECT a.*, b.image_id, c.folder, c.images, a.status 
                                                            FROM spa.tabla_control b inner join php_combo.continente a on (a.name = b.nombre) 
                                                            inner join spa.table_images c on (b.image_id = c.id)
                                                            where a.status=1
                                                            order by a.status desc, a.id;";
                                                            
                                                            $query = mysqli_query($conexion, $sql);                                
                                                            $result = mysqli_num_rows($query);
                                                            if ($result > 0) {
                                                              while ($data = mysqli_fetch_assoc($query)) {
																$pas =0;															  
																$stmt = $otrosUsuarios->leerUsuarioCategorias($idUsuario); 
																while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
																{			
																	if($data['id'] == $row['idcategoria']) { 
																	$pas =1;
																	}
																}
																	
                                                              ?>
                                                              <option value="<?php echo $data["id"]; ?>"
                                                              <?php 
                                                              if ($pas == 1 ){ echo "selected"; }
                                                              ?>
                                                              ><?php echo $data['name'] . " (" . $data["id"] . ")"; ?></option>
                                                              <?php
                                                                }
                                                              }		
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <?php
													}
													?>
                                                    <!-- onChange="this.form.submit()" -->
                                                    <div class="form-group">
                                                        <label for="estado">Estatus del usuario...</label>
                                                        <select name="estado" class="form-control" id="estado">
                                                            <option value="0"
                                                            <?php if ($estado==0){echo 'selected';} ?>
                                                            >Estado inhabilitado</option>
                                                            <option value="1"
                                                            <?php if ($estado==1){echo 'selected';} ?>
                                                            >Estado activo</option>
                                                            <option value="2"
                                                            <?php if ($estado==2){echo 'selected';} ?>
                                                            >Estado suspendido</option>
                                                        </select>
                                                    </div>
                                                                                      
                                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-user-edit"></i></button>
                                                     <a href="vistaUsuario.php" class="btn btn-danger-transparent">Volver</a>
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
                <!-- END MAIN CONTAINER -->
    
    
    

    


    <!-- BEGIN ELIMINAR SCRIPTS -->  
    <script>
    $(document).ready(function() {		
      $('.eliminar').on('click', function() {
        var id = $(this).data('idUsuario');
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