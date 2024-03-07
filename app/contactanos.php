<?php include "partials/header_outside.php"?>
<?php include "controllers/contactanosController.php"?>
        
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>


        <!--  BEGIN CONTENT AREA  -->

        <div id="content" class="container">
            <form method="post" action="">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>Area de contacto - Procura y Abastecimiento</h3>
                    </div>
                </div>
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                            	<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="section contact">
                                        <div class="info">
                                            <h5 class="">informacion de contacto</h5>
                                                <div class="float-right">
	                                                <a href="outside.php" class="btn btn-outline-secondary">Regresar</a>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="usuario">Nombre y Apellido</label>
                                                               <input name="usuario" type="text" required class="form-control mb-4" id="usuario" placeholder="nombre de usuario" value="<?= $usuario ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="empresa">Empresa que representa</label>
                                                                <input name="empresa" type="text" required class="form-control mb-4" id="empresa" placeholder="nombre de la empresa de contacto" value="<?= $empresa ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">e-mail</label>
                                                                <input name="email" type="email" required class="form-control mb-4" id="location" placeholder="direccion de correo" value="<?= $email ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone">Telefono</label>
                                                                <input name="telefono" type="text" required class="form-control mb-4" id="telefono" placeholder="Coloque su telefono contacto" value="<?= $telefono ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="direccion">Dirección</label>
                                                                <input name="direccion" type="text" required class="form-control mb-4" id="direccion" placeholder="Dirección de la empresa" value="<?= $direccion ?>">
                                                            </div>
                                                        </div>                                    
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="website">Website</label>
                                                                <input name="website" type="url" class="form-control mb-4" id="website" placeholder="Indique la pagina web de la empresa" value="<?= $website ?>">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="asunto">Estado</label>
                                                                <select name="estados" required class="form-control" id="estados" title="Seleccione estado">
                                                                	<option value='' >Escoja Estado</option>
   	                                                                <?php
																	$stmt = $estadosCiudades->readEstados(); 
																	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
																	{	
																		?>
                                                                        <option value='<?=$row['id']?>' ><?=$row['state']?></option>
                                                                        <?php
																	}
																	?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="asunto">Ciudad</label>
                                                                <select name="ciudades" required class="form-control" id="ciudades">
                                                                    <option>Seleccione una ciudad</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="section work-platforms">
                                        <div class="info">
                                            <h5 class="">Coloque su comentario</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">

                                                    <div class="platform-div">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="asunto">Asunto</label>
                                                                <select name="asunto" class="form-control" id="asunto" title="ERscoja un asunto del contacto">
                                                                    <option>Seleccione un asunto de interés</option>
                                                                    <option value="0">Quiero saber mas acerca del sistema</option>
                                                                    <option value="1">Me interesa registrarme de una vez</option>
                                                                    <option value="2">Me gustaria contactarlos personalmente</option>
                                                                    <option value="4">Pertenezco a una camara/organizacion </option>
                                                                    <option value="5">Quiero saber mas acerca de los costos corporativos </option>
                                                                    <option value="6">Donde puedo obtener mas informacion/bibliografia </option>
                                                                    <option value="7">Quiero ser aliado de Ustedes</option>
                                                                    <option value="8">Otro distinto a estas opciones</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="platform-description">Comentario</label>
                                                            <textarea name="comentario" rows="10" required class="form-control mb-4" id="platform-description" placeholder="aqui puede extenderte en tus comentarios..." title="escriba su comentario"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="float-right">
                                                <button name="grabarDatos" value="grabarDatos" id="multiple-messages" class="btn btn-secondary">Grabar Datos</button>
                    							<button id="limpiar" class="btn btn-outline-secondary">Limpiar datos</button>
                                            </div>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </form>
             </div>
        </div>

        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="../plugins/dropify/dropify.min.js"></script>
    <script src="../plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="../assets/js/users/account-settings.js"></script>
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
    
	<script>
    function Verificar()
    {
    var tecla=window.event.keyCode;
		if (tecla==116) {
		 confirm('Si recarga la página perdera todos los datos ingresados,<br> ¿Deseas recargar la página?"', function (result) {
			 if (result) {
				   location.reload();
			  } else {
				   event.keyCode=0;
		event.returnValue=false;
			  }
		}); 
		
		}
    }
	</script>
    
    <script type="text/javascript">
		// RUNTINA QUE LIMPIA LAS VARIABLES - limpiar()
		var enviado =false;
		$("#limpiar").on("click", function(e){
		  e.preventDefault();
		 if(!enviado){
			enviado=true;
			$("form select").each(function() { this.selectedIndex = 0 });
			$("form input[type=text] , form textarea").each(function() { this.value = '' });
			$("form input[type=email] , form text").each(function() { this.value = '' });
			$("form input[type=url] , form text").each(function() { this.value = '' });
			$("form input[type=select] , form select").each(function() { this.value = '' });
		 }
		});
		
		// RUTINA AJAX PARA ALIMENTAR CIUDADES
		$(document).ready(function(){
			$('#estados').on('change',function(){
				var estadoID = $(this).val();
				console.log("cambio", estadoID);
				if(estadoID){
					$.ajax({
					type:'POST',
					url:'microservicio/ajax_estados.php',
					data:'id_estado='+estadoID,
					success:function(html){
						$('#ciudades').html(html);
						}
					});		
				}else{
					$('#ciudades').html('<option value="">Selecciona un estado primero</option>');
				}
			});
		});
	</script>
</body>
</html>