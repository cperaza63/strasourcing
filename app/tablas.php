<?php 
include "config/conexion.php";
if ( isset($_SESSION['iduserHive']) && $_SESSION['iduserHive']>0){
	$id_user = $_SESSION['iduserHive'];	
}else{
	$_SESSION['iduserHive'] = 0;
	$id_user = 0;
}
$vector= array("Sector Industrial", 
	"Tipo de Organización", "Tipo de Infraestructura", "Tipo de Area de Trabajo", "Tipo de Area de Trabajo", 
	"Servicios Profesionales", "Servicios en Planta", "Redes Sociales", "Marcas de productos", "Familia de productos", 
	"Sector campo de acción", "logo de empresa", "imagen de usuario", "rif de la empresa", "autorización de empresa", "", 
	"permisos a programas", "Categoria de productos", "Convenio Compradores", "Convenko Proveedores");

/*if($_SESSION['tipoHive'] < 4){
    $permiso = "productos";
    $sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
    $existe = mysqli_fetch_all($sql);
    if (empty($existe) && $id_user != 1) {
        ?>
        <script>
            window.location="permisos.php";
        </script>
        <?php
        //header("Location: permisos.php");;
    }
}*/

$countrySelected = "";

if ( isset( $_POST['select_box']) && $_POST['select_box'] != "" ) {
	$countrySelected = $_POST['select_box'];
	$sql = "UPDATE tabla_control SET rif_proveedor = '" . $_POST['select_box'] . "' WHERE id = ". $_POST['index_item'];
	echo $sql;
	$query = mysqli_query($conexion, $sql);
	?>
	<script>
		//alert("Pais actualizado");
		window.location="vistaTablaControl.php";
	</script>	
    <?php
}

if (isset($_GET['proceso']) && isset( $_GET['item_id'] ) && isset( $_GET['image_id'] ) ) {

    if( $_GET['proceso'] == "update_image"){
        $sql = "UPDATE tabla_control SET image_id = " . $_GET['image_id'] . " WHERE id = ". $_GET['item_id'];
        $query = mysqli_query($conexion, $sql);
        $alert = '<div class="alert alert-success" role="alert">
		La image ya fue asignada con exito!
		</div>';
    }

}

if (isset($_POST['tipoTabla']) && isset( $_POST['nombre'] ) ) {
	
    $tipoTabla = $_POST['tipoTabla'];
    $_SESSION['tipoTabla'] = $tipoTabla;

    if ( $tipoTabla ==""){
        $cadena_Tipotabla = "";
    }else{
        $cadena_Tipotabla = " AND tipo = '$tipoTabla' ";
    }
    $menos = $tipoTabla;
    //echo "===" . $menos*1;
    $nombre_tabla = $vector[$menos*1];
	$nombre = !empty($_POST['nombre']) ? strtoupper($_POST['nombre']) : "";
	$alert = "";
	if (empty($tipoTabla) || empty($nombre)) {
		$alert = '<div class="alert alert-danger" role="alert">
			Todo los campos son obligatorios
		  </div>';
	} else {
        
        $sql = "SELECT * FROM tabla_control WHERE id > 0 " . $cadena_Tipotabla . " and ucase(nombre)='$nombre'";
        $query = mysqli_query($conexion, $sql);
		$result = mysqli_fetch_array($query);
		if ($result > 0) {
			$alert = '<div class="alert alert-warning" role="alert">
					El item ya existe
				</div>';
		} else {
			
			if($_SESSION['tipoTabla'] == 19 || $_SESSION['tipoTabla'] == 20 ){
				$valor=" ";
				if(isset($_POST['valor']) && $_POST['valor'] !=""){
					$valor= $_POST['valor'];
				}
				$sql = "INSERT INTO tabla_control(tipo,nombre,nombre_tabla, valor) values ('$tipoTabla', '$nombre','$nombre_tabla', '$valor')";	
			}else{
				$sql = "INSERT INTO tabla_control(tipo,nombre,nombre_tabla) values ('$tipoTabla', '$nombre','$nombre_tabla')";	
			}
			

            //echo $sql;

            $query_insert = mysqli_query($conexion, $sql);
			if ($query_insert) {
				$alert = '<div class="alert alert-success" role="alert">
			Item Registrado
		  </div>';
			} else {
				$alert = '<div class="alert alert-danger" role="alert">
			Error al registrar el item
		  </div>';
			}
		}
	}
}

$buscarporpto= "";
$buscarpor = "";
if( !isset($_SESSION['tipoTabla']) || $_SESSION['tipoTabla'] =="" ){ 
    $_SESSION['tipoTabla'] = "0";     
    $tipoTabla = $_SESSION['tipoTabla'];
} 
$buscar = $_SESSION['tipoTabla'];
if ( isset($_POST['tipoTabla'] ) && $_POST['tipoTabla']  !=""  && $_POST['tipoTabla']  !="0"){
	$buscarporpto = " tipo = " . $_POST['tipoTabla'];
    $buscar = $_POST['tipoTabla'];
    $_SESSION['tipoTabla'] = $_POST['tipoTabla'];
    $tipoTabla = $_POST['tipoTabla'];
}else{
    $buscar = $_SESSION['tipoTabla'];    
    $buscarporpto = " a.tipo = " . $_SESSION['tipoTabla'];
}
?>
<br>
<form method="post" action="vistaTablaControl.php">
  <div class="row">
    <div class="col-lg-3">
      <select name="tipoTabla" class="form-control" id="tipoTabla">
        <option value="0" <?php if ($buscar == "0") { echo "selected";} ?>>Seleccione Tipo de Tabla</option>
        <option value="1" <?php if( $buscar == "1") { echo "selected";}?>><?php echo "Sector Industrial";?></option>
        <option value="2" <?php if( $buscar == "2") { echo "selected";}?>><?php echo "Tipo de Organización";?></option>
        <option value="3" <?php if( $buscar == "3") { echo "selected";}?>><?php echo "Tipo de Infraestructura";?></option>
        <option value="4" <?php if( $buscar == "4") { echo "selected";}?>><?php echo "Tipo de Area de Trabajo";?></option>
        <option value="5" <?php if( $buscar == "5") { echo "selected";}?>><?php echo "Servicios Profesionales";?></option>
        <option value="6" <?php if( $buscar == "6") { echo "selected";}?>><?php echo "Servicios en Planta";?></option>
        <option value="7" <?php if( $buscar == "7") { echo "selected";}?>><?php echo "Redes Sociales";?></option>
        <option value="8" <?php if( $buscar == "8") { echo "selected";}?>><?php echo "Marcas de productos";?></option>
        <option value="9" <?php if( $buscar == "9") { echo "selected";}?>><?php echo "Familia de productos";?></option>
        <option value="11" <?php if( $buscar == "11") { echo "selected";}?>><?php echo "Sector Campo de Acción";?></option>
        <option value="12" <?php if( $buscar == "12") { echo "selected";}?>><?php echo "logo de empresa";?></option>
        <option value="13" <?php if( $buscar == "13") { echo "selected";}?>><?php echo "imagen de usuario";?></option>
        <option value="14" <?php if( $buscar == "14") { echo "selected";}?>><?php echo "rif de la empresa";?></option>
        <option value="15" <?php if( $buscar == "15") { echo "selected";}?>><?php echo "autorización de empresa";?></option>
        <option value="16" <?php if( $buscar == "16") { echo "selected";}?>><?php echo "permisos a programas";?></option>
		<option value="17" <?php if( $buscar == "17") { echo "selected";}?>><?php echo "Categoria de productos";?></option>
		<option value="18" <?php if( $buscar == "18") { echo "selected";}?>><?php echo "Camaras de Venezuela";?></option>
        <option value="19" <?php if( $buscar == "19") { echo "selected";}?>><?php echo "Convenio Compradores";?></option>
		<option value="20" <?php if( $buscar == "20") { echo "selected";}?>><?php echo "Convenio Proveedores";?></option>
      </select>
    </div>
    <div class="col-lg-3">
      <button class="btn btn-secondary mb-2" type="submit" onChange="this.form.submit()"><i class="fas fa-search"></i></button>
    </div>
  </div>
</form>
<br>
<?php
	if ($_SESSION['tipoHive'] <= 2 ){
	?> 
	<button class="btn btn-outline-secondary mb-2" type="button" data-toggle="modal" data-target="#nueva_tabla"><i class="fas fa-plus"></i></button>
	<?php } ?>
    <br>
<?php echo isset($alert) ? $alert : ''; ?>
 <div class="table-responsive">
     <table class="table table-striped table-bordered" id="tbl">
         <thead style="background-color:#5B00B7;" >
             <tr>
                 <th class="text-white">id#</th>
                 <th class="text-white">Nombre</th>
                 <th class="text-white">Imagen</th>
                <?php 
				if($_SESSION['tipoTabla'] == 19 || $_SESSION['tipoTabla'] == 20 ){
				?>
                	<th class="text-white">Valor</th>
                <?php
				}
                ?>
                 <th class="text-white">Tabla</th>
             </tr>
         </thead>
         <tbody>
             <?php
                if( empty($buscarporpto) || !isset($buscarporpto)){
                    $buscarporpto = 0;
                }
				$sq= "SELECT a.*, b.folder, b.images, c.country_name FROM tabla_control a 
				left join tbl_paises c on (a.rif_proveedor = c.country_code) 
				left join table_images b on (a.image_id = b.id) 
				where $buscarporpto order by a.nombre";
				//echo "=resultado=" . $sq;
                $query = mysqli_query($conexion, $sq);
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {                    
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
						$valor = $data['valor'];
                        $armoImagen = "./".$data['folder'].$data['images'];
                        
                        //echo "==" . $armoImagen;
                    ?>
                     <tr valign="top">
                         <td valign="top"><?php echo $data['id']; ?></td>
                         <td valign="top">
                            <form action="eliminar_tabla_control.php" method="post">
                                <input type="hidden" value="<?php echo $data['id']; ?>" name="id">
                                <input type="hidden" value="edit" name="accion">
                                <input class="form-control" type="text" value="<?php echo strtoupper($data['nombre']); ?>" name="nombre">
                                
                                <button class="btn btn-light" type="submit"><i class='fas fa-edit fa-2x'></i> </button>
								
                                <a href="vistaCrudImagenes.php?id=<?php echo $data['id']; ?>" class="btn btn-light">
                                <i class='fas fa-image fa-2x'></i></a>
                                
                                <?php
								if($data['tipo'] == 8 ){
								?>
								<iframe class="responsive-iframe" frameborder="0"  scrolling="no"
                                src="select_pais/indexTodo.php?nombre_pais=<?php echo $data['country_name'];?>&country=<?php echo $data['rif_proveedor'];?>&index_item=<?php echo $data['id']; ?>" width="520px" height="60px">
                                </iframe>
								<?php	
								}
								?>
                                
                            </form>
                         </td>
                         <td valign="top">
                         <?php if(isset($data['images'])){?>
                            <img src='<?php echo $armoImagen; ?>' class='img-thumbnail' width='80px' height='75px' />
                         <?php
                         }
                         ?>
                        </td>
                        
                        <?php 
						if($_SESSION['tipoTabla'] == 19 || $_SESSION['tipoTabla'] == 20 ){
						?>
							<th valign="top"><?php echo $valor; ?></th>
						<?php
						}
						?>
                        
                         <td valign="top"><?php echo $data['nombre_tabla']; ?></td>
                         <td valign="top">
                         
                        <?php
							if ($_SESSION['tipoHive'] <= 2){
						?> 
                            <form action="eliminar_tabla_control.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                            <button class="btn btn-light" type="submit" onclick="return confirm('Estás seguro que deseas eliminar este item?');"><i class='fas fa-trash-alt fa-2x'></i> </button>
                            </form>
                         <?php 
							}
						 ?>
                         
                         </td>
                     </tr>
             <?php }
                } ?>
         </tbody>

			
     </table>
 </div>
 
           
 <div id="nueva_tabla" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-secondary text-white">
                 <h5 class="modal-title" id="my-modal-title" style="color:white;">Nuevo Item de Tabla</h5>
                 <button class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="" method="post" autocomplete="off">
                    <select name="tipoTabla" class="form-control" id="tipoTabla">
                        <option value="0" <?php if ($buscar == "0") { echo "selected";} ?>>Seleccione Tipo de Tabla</option>
                        <option value="8" <?php if( $buscar == "8") { echo "selected";}?>><?php echo "Marcas de productos";?></option>
                        <option value="9" <?php if( $buscar == "9") { echo "selected";}?>><?php echo "Familia de productos";?></option>
                        <option value="1" <?php if( $buscar == "1") { echo "selected";}?>><?php echo "Sector Industrial";?></option>
                        <option value="2" <?php if( $buscar == "2") { echo "selected";}?>><?php echo "Tipo de Organización";?></option>
                        <option value="3" <?php if( $buscar == "3") { echo "selected";}?>><?php echo "Tipo de Infraestructura";?></option>
                        <option value="4" <?php if( $buscar == "4") { echo "selected";}?>><?php echo "Tipo de Area de Trabajo";?></option>
                        <option value="5" <?php if( $buscar == "5") { echo "selected";}?>><?php echo "Servicios Profesionales";?></option>
                        <option value="6" <?php if( $buscar == "6") { echo "selected";}?>><?php echo "Servicios en Planta";?></option>
                        <option value="7" <?php if( $buscar == "7") { echo "selected";}?>><?php echo "Redes Sociales";?></option>
                        <option value="11" <?php if( $buscar == "11") { echo "selected";}?>><?php echo "Sector Campo de Acción";?></option>
                        <option value="12" <?php if( $buscar == "12") { echo "selected";}?>><?php echo "logo de empresa";?></option>
                        <option value="13" <?php if( $buscar == "13") { echo "selected";}?>><?php echo "imagen de usuario";?></option>
                        <option value="14" <?php if( $buscar == "14") { echo "selected";}?>><?php echo "rif de la empresa";?></option>
						<option value="15" <?php if( $buscar == "15") { echo "selected";}?>><?php echo "autorización de empresa";?></option>
                        <option value="16" <?php if( $buscar == "16") { echo "selected";}?>><?php echo "permisos a programas";?></option>
                        <option value="17" <?php if( $buscar == "17") { echo "selected";}?>><?php echo "Categoria de productos";?></option>
                        <option value="18" <?php if( $buscar == "18") { echo "selected";}?>><?php echo "Camaras de Venezuela";?></option>
                        <option value="19" <?php if( $buscar == "19") { echo "selected";}?>><?php echo "Convenio Compradores";?></option>
						<option value="20" <?php if( $buscar == "20") { echo "selected";}?>><?php echo "Convenio Proveedores";?></option>
                    </select>
                     <?php echo isset($alert) ? $alert : ''; ?>
                     <div class="form-group">
                         <label for="nombre">Nombre</label>
                         <input type="text" placeholder="Ingrese nombre del item" name="nombre" id="nombre" class="form-control">
                     </div>
                     <?php
					if ( $_SESSION['tipoTabla'] == 19 || $_SESSION['tipoTabla'] == 20){
					?>
                    	<div class="form-group">
                         <label for="valor">Valor</label>
                         <input type="text" placeholder="Ingrese el valor del item del plan" name="valor" id="valor" class="form-control">
                     	</div>
                    <?php	 
					}
					?>
                     <input type="submit" value="Guardar Item" class="btn btn-secondary">
                     <button class="btn btn-success" data-dismiss="modal" aria-label="Close">Cerrar</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
