<?php
$conexion = new mysqli("localhost","root","","spa");
	
session_start();
if ( !isset( $_SESSION['nombre_continente'] ) ) {
	$_SESSION['continente_id']	= "0";
	$_SESSION['pais_id']	= "0";
	$_SESSION['ciudad_id']	= "0";
	$_SESSION['nombre_continente']	= "";
	$_SESSION['nombre_pais']	= "";
	$_SESSION['nombre_ciudad']	= "";
}
$consulta = 0;	
$agregar_grupo = "";

if ( isset($_POST["ver"]) && $_POST["ver"] =="marca"){	
	$consulta = 1;	
	$marca_id = $_POST["tabla_marcas"][0];
	//echo "seleccion " . $marca_id ." " .$_SESSION['rifHive'];
}

if ( !isset($_SESSION['rifHive'])) {
	$_SESSION['rifHive'] = "0";
}
//echo "rif= " . $_SESSION['rifHive'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<title>Asigna categorias a las marcas</title>
</head>
<body>

<div class="container">

  <div class="panel">
    <div>
      <h4><strong>Lista de las categorias y subcategorias por cada marca del Proveedor</strong></h4>
    </div>
    <div class="panel-body"> 
    
    <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Agregar Marca</button>
    -->  

    <form method="POST" action="borrar_Proveedor_marca.php">
        <?php
		if (isset($_GET['t']) && $_GET['t'] == "inside") {
			?>
            <input name="t" type="hidden" value="<?php echo $_GET['t']; ?>">
            <?php	
		}
		?>
    	
          <table class="table table-bordered">
            <thead class="alert-secondary " style="background-color:#5B00B7; color:white;">
              <tr>
                <th><input type="checkbox" onclick="selectedCheckbox(this)">
                  Todos</th>
                <th>Rif</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Sub-categoria</th>
                <th>Tipo empresa</th>
                
                <?php
				if (isset($_GET['t']) && $_GET['t'] == "inside") {
					?>
	    	        <th>Acción</th>                
            	    <?php
				}else{
					if (isset($_POST['t']) && $_POST['t'] == "inside") {
					?>
	    	        <th>Acción</th>                
            	    <?php
					}
				}
                ?>
                
              </tr>
            </thead>
            <tbody style="background-color:#fff;">
              <?php
			  ////////////////////////////////
			  $rif_proveedor = $_SESSION['rifHive'];
			  ////////////////////////////////
            require 'conexion_spa.php';
			
			$sql = "SELECT a.id, a.rif, a.marca, a.tipo_empresa, a.categoria, a.subcategoria, b.nombre as marcaName, c.name as catName,
			d.name as subcatName, i.images, b.id as idMarca FROM proveedor_marcas a left join tabla_control b on (a.marca = b.id ) 
			left join table_images i on (b.image_id = i.id ) inner join php_combo.continente c on (a.categoria = c.id) 
			inner join php_combo.pais d on (a.subcategoria = d.id) WHERE rif = '$rif_proveedor' order by marca, categoria, subcategoria"; 
			
			$query = $db->prepare($sql);
            $query->execute();
            $count_query = $db->prepare("SELECT COUNT(*) as count FROM proveedor_marcas WHERE rif = '$rif_proveedor'");
            $count_query->execute();
            $row = $count_query->fetch();
            $count=$count=$row['count'];
            while($fetch = $query->fetch()){
				if( $fetch['tipo_empresa'] == "1" ){
					$nombre_tipo = "Distribuidor Autorizado";
				}else if( $fetch['tipo_empresa'] == "2" ){
					$nombre_tipo = "Fabrica de la Marca";
				}else if( $fetch['tipo_empresa'] == "3" ){
					$nombre_tipo = "Comercializadora";
				}
				$m = $fetch['marca'];
				$mn = $fetch['marcaName'];
				$c = $fetch['categoria'];
				$s = $fetch['subcategoria'];
            ?>
              <tr>
                <?php
                if($count != 0){
                ?>
                <td><input type="checkbox" name="check[]" onclick="countCheckbox()" value="<?php echo $fetch['id']?>"></td>
                <?php }?>
                
                <td><?php echo $fetch['rif']?></td>
                <td>
				<img src="http://localhost/strasourcing/app/crud_imagenes/uploads/<?php echo $fetch['images']; ?>" width="80px" alt=""/>
				<?php echo "<br>".$fetch['marcaName'];?></td>
                <td><?php echo $fetch['catName']?></td>
                <td><?php echo $fetch['subcatName']?></td>
                <td><?php echo $nombre_tipo?></td>
                
					<?php
                    if (isset($_GET['t']) && $_GET['t'] == "inside") {
                    ?>
                        <td><a href="../Combobox_3_cat/index_grupos.php?mn=<?php echo $mn;?>&m=<?php echo $m; ?>&c=<?php echo $c; ?>&s=<?php echo $s; ?>" class="btn btn-secondary" style="background-color:#5B00B7; color:white;"><span class="glyphicon glyphicon-plus"></span></i>  Grupo / Prod</a></td>
                    <?php
                    }
                    ?>
                
              </tr>
              <?php }?>
            </tbody>
            <?php
                if($count != 0){
            ?>
            <tfoot>
              <tr>
              	<td>
                </td>
                <td colspan="5"><button  onclick="return confirm('Estas seguro de excluir de la lista?')" name="borrar" class="btn btn-outline-primary pull-right"><span id="count" class="badge">0</span> Excluir</button></td>
              </tr>
            </tfoot>
            <?php }?>
          </table>
        </form>	
	
    </div>
  </div>
  

</div>

<div class="modal fade" id="form_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="guardar.php">
        <div class="modal-header">
          <h3 class="modal-title">Agregar usuario</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Escoja la Marca</label>
              <select style="font-size:24px;" name="tabla_marcas[]" size="15" required multiple class="form-control" title="Seleccion multiple para las marcas">
				<?php              
             	$query=$conexion->query("select * from tabla_control where tipo = 8 order by nombre");
                $marcas = array();
                while($r=$query->fetch_object()){ $marcas[]=$r; }
                if(count($marcas)>0){
                    foreach ($marcas as $s) {
                        print "<option value='$s->id'> $s->nombre </option>";
                    }
                }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                }
             	?>
              </select>
            </div>

          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="guardar" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Procesar</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="form_marca" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="index.php">
      	<input type="hidden" name="ver" value="marca" />
        <div class="modal-header">
          <h3 class="modal-title">Ver tabla por marca</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Escoja la Marca</label>
              <select style="font-size:24px;" name="tabla_marcas[]" size="15" required class="form-control" title="Seleccione una marcas">
				<?php              
             	$query=$conexion->query("select * from tabla_control where tipo = 8 order by nombre");
                $marcas = array();
                while($r=$query->fetch_object()){ $marcas[]=$r; }
                if(count($marcas)>0){
                    foreach ($marcas as $s) {
                        print "<option value='$s->id'> $s->nombre </option>";
                    }
                }else{
                    print "<option value=''>-- NO HAY DATOS --</option>";
                }
             	?>
              </select>
            </div>

          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal-footer">
          <button name="guardar" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Procesar</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="js/jquery-3.2.1.min.js"></script> 
<script src="js/bootstrap.js"></script> 
<script src="js/script.js"></script>
</body>
</html>