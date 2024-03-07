<?php include "controllers/loginController.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - Login Cover Page</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/structure.css" rel="stylesheet" type="text/css" class="structure" />
    <link href="../assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/forms/switches.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
        if (typeof jQuery == 'undefined') {
            var include = '<script type="text/javascript" src="../storefront/view/default/javascript/jquery-1.11.0.min.js"><\/script>';
            document.write(include);
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>	
    <!-- END THEME GLOBAL STYLES -->
</head>
<body class="form">
    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                	<?php
					// AREA de mensajes del sistema
					if( isset($_GET['mensajeError']) && $_GET['mensajeError'] != "" ){
						$alert="";
						$alert = '<div class="alert alert-success" role="alert">
						Atención, '.  $_GET['mensajeError'] . ' ...
						</div>';
						echo $alert;	
						$_GET['mensajeError'] = "";
					// fin de area de mensajes del sistema
					}
					?>
                    <div class="form-content">
                        <h1 class=""><a href="../index.html"><span class="brand-name" style="color:#5B00B7;">StraSourcing.com</span></a></h1>
                        <form class="text-left" method="post" action="login.php">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Login del usuario">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5B00B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Clave secreta">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block" style="color:#5B00B7;">Mostrar Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-secondary" style="background-color:#5B00B7; color:white;" value="">Entrar</button>
                                        <a href="outside.php" class="btn btn-outline-secondary">Menu</a>
                                    </div>
                                    
                                </div>

                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                          <input type="checkbox" class="new-control-input">'
                                           <button class="btn btn-secondary" type="button" data-toggle="modal" 
                            				data-target="#nuevo_usuario" style="color:#5B00B7;">Olvidó su Clave?</button>
                                        </label>
                                    </div>
                                </div>

								
                            </div>
                            
                            <div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-white">
                                            <h5 class="modal-title text-white" id="my-modal-title">Restauración de su Clave de Acceso</h5>
                                            <button class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" autocomplete="off">  
                                            	<input type="hidden" name="cambioPassword" value="1" />             
                                              <div class="form-group">
                                                    <label for="nombre">E-mail</label>
                                                    <input type="text" class="form-control" placeholder="Ingrese el email de usuario" name="email" id="email">
                                                </div>
                                                
                                              <div class="form-group">
                                                    <label for="usuario">Usuario</label>
                                                    <input type="text" class="form-control" placeholder="Ingrese el login del Usuario" name="login" id="login">
                                                </div>
                                               
                                                <input type="submit" value="Enviar" class="btn btn-secondary">
                                                <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>                        
                        <p class="terms-conditions">© 2023 Todos los derechos reservados. <a href="outisde.php" style="color:#5B00B7;">CP&JL</a> es un producto de Carlos Peraza & Juan C. Latouche. <a href="javascript:void(0);" style="color:#5B00B7;">Privacidad</a>, <a href="javascript:void(0);" style="color:#5B00B7;">Terminos y condiciones</a>.</p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../plugins/highlight/highlight.pack.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src="../assets/js/scrollspyNav.js"></script>
    <script src="../assets/js/authentication/form-1.js"></script>
    <!-- END THEME GLOBAL STYLE -->    
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->   
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>