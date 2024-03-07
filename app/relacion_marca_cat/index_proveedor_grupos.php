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
if ( isset($_POST["ver"]) && $_POST["ver"] =="marca"){	
	$consulta = 1;	
	$marca_id = $_POST["tabla_marcas"][0];
	//echo "seleccion " . $marca_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<title>Asigna categorias a las marcas</title>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="container-fluid"> <a class="navbar-brand" target="_parent" href="../../index.php">Carga de Grupos / Productos </a> </div>
  </div>
</nav>
<div class="container">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Asigna grupos / productos a un proveedor</h3>
    </div>
    <div class="panel-body"> 
    
    <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Agregar Marca</button>
    -->  
    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Agregar Grupo</button>
    <a target="_parent" href="index_proveedor_marcas.php?t=inside" class="btn btn-primary" "><span class="glyphicon glyphicon-folder-close"></span> Regresar</a>

 <hr>
 <form method="POST" action="borrar_Proveedor_grupo.php">
        <table class="table table-bordered">
            <thead class="alert-info">
              <tr>
                <th><input type="checkbox" onclick="selectedCheckbox(this)">
                  Todos</th>
                <th>Nombre Marca</th>
                <th>Categoria</th>
                <th>Sub-categoria</th>
                <th>Grupo</th>
              </tr>
            </thead>
            <tbody style="background-color:#fff;">
              <?php
            require 'conexion.php';
			$sq = "SELECT a.id, a.marca, a.categoria, a.subcategoria, a.grupo, c.nombre as nombre_marca, d.name as nombre_categoria, e.name as
nombre_subcategoria , f.name as nombre_grupo FROM spa.proveedor_marcas a inner join spa.tabla_control c on (a.marca = c.id and tipo=8) inner join php_combo.continente d on (a.categoria = d.id) inner join php_combo.pais e on (a.subcategoria = d.id) inner join php_combo.ciudad f on (a.grupo = f.id and a.grupo>0 ) where rif= '" . $_SESSION['rifHive'] . "' and tipo_empresa = 3 group by marca, categoria, subcategoria, grupo";	
			//echo $sq;
			$count_query = $db->prepare("SELECT COUNT(*) as count FROM spa.proveedor_marcas");
            $count_query->execute();
            $row = $count_query->fetch();
            $count=$row['count'];
			
			$query = $db->prepare($sq);			
            $query->execute();

			while($fetch = $query->fetch()){
            ?>
              <tr>
                <?php
                if($count != 0){
                ?>
                <td><input type="checkbox" name="check[]" onclick="countCheckbox()" value="<?php echo $fetch['id']?>"></td>
                <?php }?>
                <td><?php echo $fetch['nombre_marca']?></td>
                <td><?php echo $fetch['nombre_categoria']?></td>
                <td><?php echo $fetch['nombre_subcategoria']?></td>
                <td><?php echo $fetch['nombre_grupo']?></td>
              </tr>
              <?php }?>
            </tbody>
            <?php
                if($count != 0){
            ?>
            <tfoot>
              <tr>
                <td colspan="5"><button  onclick="return confirm('Estas seguro de eliminar?')" name="borrar" class="btn btn-danger pull-right"><span id="count" class="badge">0</span> Borrar</button></td>
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
      <form method="POST" action="guardar_grupo.php">
        <div class="modal-header">
          <h3 class="modal-title">Agregar grupo / producto</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Escoja la Marca</label>
              <select style="font-size:24px;" name="tabla_marcas[]" size="15" required multiple class="form-control" title="Seleccion multiple para las marcas">
				<?php              
				// "select * from tabla_control where tipo = 8 order by nombre"
				$sq = "select * from  php_combo.ciudad where pais_id=" . $_SESSION['pais_id'] . " order by name" ;
             	$query=$conexion->query($sq );
                $grupos = array();
                while($r=$query->fetch_object()){ $grupos[]=$r; }
                if(count($grupos)>0){
                    foreach ($grupos as $s) {
                        print "<option value='$s->id'> $s->name </option>";
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
          <h3 class="modal-title">Ver tabla por marcas,cat y subcategorias</h3>
        </div>
        <div class="modal-body">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Escoja El grupo de productos</label>
              <select style="font-size:24px;" name="tabla_marcas[]" size="15" required class="form-control" title="Seleccione grupos">
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