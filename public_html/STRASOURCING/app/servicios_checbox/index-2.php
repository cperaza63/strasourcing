<?php 

session_start();

//$_SESSION['rifHive'] ="345345353453";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/offcanvas.css"/>
	</head>
<body>
<main class="container-fluid">
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">
    
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form_modal1"> Agregar Categorias a la Marca</button>
    </h6>

    <div class="d-flex text-muted pt-5">
			<table class="table table-bordered">
			<thead class="btn-primary">
				<tr>
					<th width="5%">#</th>
					<th width="15%">Servicio</th>
					<th width="50%">Programas</th>
                    <th width="20%">Comentario</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
			<?php
                require 'config.php';
                $query = $db->prepare("SELECT a.*, if( tipo_servicio = 5, 'Servicios Profesionales', 'Servicioss en Planta') as nombre_servicio FROM servicios_proveedor a where rif='". $_SESSION['rifHive'] ."'");
                $query->execute();
                
                if($query->rowCount() == 0){
					echo '<tr>
						<td colspan="4"></td>
				     </tr>';
			 
				}else {
				$n=0;
				$data = $query->fetchAll();
				foreach ($data as $value): 
				$n++;   
				echo '<tr>
						<td>'.$n.'</td>
						<td>'.$value["nombre_servicio"].'</td>
						<td>'.$value["programas"].'</td>
						<td>'.$value["comentario"].'</td>
				     </tr>';
			 endforeach;	
				}
				$db = null;
				?>
			</tbody>
		</table>

    </div>
  </div>
</main>


<div class="modal fade" id="form_modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Servicios Profesionales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="insertar.php" method="POST">
      <input type="hidden" name="tipo_servicio" value="5" />
      <div class="modal-body">        	
		<div class="col-md-12">
            <div class="form-group">
                <label>Comentario:</label>
                <textarea size="5" class="form-control" id="comentario" name="comentario" required title="Breve comentario de los servicios Profesionales" placeholder="Breve comentario de los servicios Profesionales"></textarea>
            </div>
            <div class="form-group">
                <label>Programas:</label>
            </div>
								
<div class="card bg-light" style="width: 100%;">
  <div class="card-body">
  <div class="row" id="servicios_profesionales">
       <div>
            <!-- checkbox -->
          <div class="col-md-5">
            <div class="custom-control custom-checkbox mr-sm-2">
                    <label><input type="checkbox" name="programas[]" value="dan Cursos" > dan Cursos</label>
            </div>
            </div>
            <!-- End: checkbox -->
            <!-- checkbox -->
            <div class="col-md-5">
            <div class="custom-control custom-checkbox mr-sm-2">
                            <label><input type="checkbox" name="programas[]" value="hacen Talleres" > hacen Talleres</label>
            </div>      
            </div>
            <!-- End: checkbox -->
            <!-- checkbox -->
            <div class="col-md-5">
            <div class="custom-control custom-checkbox mr-sm-2">
                            <label><input type="checkbox" name="programas[]" value="dan Asesorías" > dan Asesorías</label>
            </div>      
            </div>
            <!-- End: checkbox -->
            <!-- checkbox -->
            <div class="col-md-5">
            <div class="custom-control custom-checkbox mr-sm-2">
                            <label><input type="checkbox" name="programas[]" value="dan Consultorías" > dan Consultorías</label>
            </div>      
            </div>
            <!-- End: checkbox -->
            <!-- checkbox -->
            <div class="col-md-5">
            <div class="custom-control custom-checkbox mr-sm-2">
                            <label><input type="checkbox" name="programas[]" value="emiten Certificaciones" > emiten Certificaciones</label>
            </div>      
            </div>
            <!-- End: checkbox -->
            <!-- checkbox -->
            <div class="col-md-5">
            <div class="custom-control custom-checkbox mr-sm-2">
                           <label><input type="checkbox" name="programas[]" value="otorgan Permisología" > otorgan Permisología</label>
            </div>      
            </div>
            <!-- End: checkbox -->
          </div>
        </div>
    </div>
</div>	
	</div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button name="guardar" type="submit" class="btn btn-primary">Registrar Ahora</button>
      </div>
      </form>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="form_modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLabel">Servicios en Planta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="insertar.php" method="POST">
      
      <input type="hidden" name="tipo_servicio" value="6" />
      
      <div class="modal-body">        	
		<div class="col-md-12">
            <div class="form-group">
                <label>Comentario:</label>
                <textarea size="5" class="form-control" id="comentario" name="comentario" required title="Breve comentario sobre los servicios en planta" placeholder="Breve comentario sobre los servicios en planta"></textarea>
            </div>
            <div class="form-group">
                <label>Programas:</label>
            </div>
								
			<div class="card bg-light" style="width: 100%;">
              <div class="card-body">
                <div class="row" id="servicios_enplata">
                    <div  >
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="programas[]" value="Mantenimiento Correctivo" > Mantenimiento Correctivo</label>
                        </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                        <label><input type="checkbox" name="programas[]" value="Mantenimiento Preventivo" > Mantenimiento Preventivo</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                        <label><input type="checkbox" name="programas[]" value="Mantenimiento Predictivo" > Mantenimiento Predictivo</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                        <label><input type="checkbox" name="programas[]" value="Construcción" > Construcción</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                        <label><input type="checkbox" name="programas[]" value="Reparaciones" > Reparaciones</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                       <label><input type="checkbox" name="programas[]" value="Proyectos Llave en mano" > Proyectos Llave en mano</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                       <label><input type="checkbox" name="programas[]" value="Básicos" > Básicos</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                       <label><input type="checkbox" name="programas[]" value="Limpieza" > Limpieza</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                       <label><input type="checkbox" name="programas[]" value="Vigilancia" > Vigilancia</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                                       <label><input type="checkbox" name="programas[]" value="Otro" > Otro</label>
                        </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                </div>
            </div>
            </div>	
                </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button name="guardar" type="submit" class="btn btn-primary">Registrar Ahora</button>
                  </div>
                  </form>
                  </div>
                </div>
              </div>
  
  
</div>

    
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>


</html>