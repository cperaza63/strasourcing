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
    <div class="container-fluid"> <a class="navbar-brand" target="_parent" href="../../index.php">Menu Principal</a> </div>
  </div>
</nav>
<div class="container">

  <div class="panel panel-primary">
    <div class="panel-heading" style="background-color:#5B00B7; color:white;">
      <h3 class="panel-title">Relaciona la categoria (<?php echo $_SESSION['continente_id'] . ") - " . $_SESSION['nombre_pais'] . " - " .$_SESSION['nombre_ciudad'] ?>, a multiples Marcas</h3>
    </div>
    <div class="panel-body"> 
    
    <!-- <button class="btn btn-success" type="button" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Agregar Marca</button>
    -->  
    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Agregar Marca</button>
    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#form_marca"><span class="glyphicon glyphicon-search"></span> Consultar por Marca</button>
 <hr>
 	<?php
    if ($consulta == 0 ){
	?>
        <form method="POST" action="borrar.php">
          <table class="table table-bordered">
            <thead class="alert-info">
              <tr>
                <th><input type="checkbox" onclick="selectedCheckbox(this)">
                  Todos</th>
                <th>Categoria</th>
                <th>Sub-categoria</th>
                <th>Grupo</th>
                <th>Nombre Marca</th>
              </tr>
            </thead>
            <tbody style="background-color:#fff;">
              <?php
            require 'conexion.php';
            $query = $db->prepare("SELECT b.nombre, a.*, c.name as nombre_categoria, d.name as nombre_subcategoria, e.name as nombre_grupo
            FROM marca_catsubcatgrupo a
            INNER JOIN spa.tabla_control b on (a.marca = b.id and b.tipo = 8)
            INNER JOIN php_combo.continente c on (a.categoria = c.id)
            INNER JOIN php_combo.pais d on (a.subcategoria = d.id)
            INNER JOIN php_combo.ciudad e on (a.grupo = e.id)
            WHERE a.categoria = '".$_SESSION['continente_id']."' and a.subcategoria = '".$_SESSION['pais_id']."' and a.grupo = '".$_SESSION['ciudad_id']."' order by a.categoria,a.subcategoria,a.grupo, b.nombre
            ");
            $query->execute();
			
            $count_query = $db->prepare("SELECT COUNT(*) as count FROM `marca_catsubcatgrupo`");
            $count_query->execute();
            $row = $count_query->fetch();
            $count=$count=$row['count'];
            
			while($fetch = $query->fetch()){
            ?>
              <tr>
                <?php
                if($count != 0){
                ?>
                <td><input type="checkbox" name="check[]" onclick="countCheckbox()" value="<?php echo $fetch['id']?>"></td>
                <?php }?>
                
                <td><?php echo $fetch['nombre_categoria']?></td>
                <td><?php echo $fetch['nombre_subcategoria']?></td>
                <td><?php echo $fetch['nombre_grupo']?></td>
                <td><?php echo $fetch['nombre']?></td>
              </tr>
              <?php }?>
            </tbody>
            <?php
                if($count != 0){
            ?>
            <tfoot>
              <tr>
                <td colspan="5"><button  onclick="return confirm('Estas seguro de eliminar?')" name="borrar" class="btn btn-secondary pull-right" style="background-color:#5B00B7; color:white;"><span id="count" class="badge">0</span> Borrar</button></td>
              </tr>
            </tfoot>
            <?php }?>
          </table>
        </form> 
    <?php 
	}else{	
	?>
    	<form method="POST" action="borrar.php">
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
            $query = $db->prepare("SELECT b.nombre, a.*, c.name as nombre_categoria, d.name as nombre_subcategoria, e.name as nombre_grupo
            FROM marca_catsubcatgrupo a
            INNER JOIN spa.tabla_control b on (a.marca = b.id and b.tipo = 8)
            INNER JOIN php_combo.continente c on (a.categoria = c.id)
            INNER JOIN php_combo.pais d on (a.subcategoria = d.id)
            INNER JOIN php_combo.ciudad e on (a.grupo = e.id)
            WHERE a.marca = " . $marca_id . " order by b.nombre, a.categoria,a.subcategoria,a.grupo");
            $query->execute();
            $count_query = $db->prepare("SELECT COUNT(*) as count FROM `marca_catsubcatgrupo`");
            $count_query->execute();
            $row = $count_query->fetch();
            $count=$count=$row['count'];
            while($fetch = $query->fetch()){
            ?>
              <tr>
                <?php
                if($count != 0){
                ?>
                <td><input type="checkbox" name="check[]" onclick="countCheckbox()" value="<?php echo $fetch['id']?>"></td>
                <?php }?>
                
                <td><?php echo $fetch['nombre']?></td>
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
                <td colspan="5"><button  onclick="return confirm('Estas seguro de eliminar?')" name="borrar" class="btn btn-secondary pull-right" style="background-color:#5B00B7; color:white;"><span id="count" class="badge">0</span> Borrar</button></td>
              </tr>
            </tfoot>
            <?php }?>
          </table>
        </form>
	<?php
	} // fin de actualizacion
	?>
    </div>
  </div>
  

</div>

<div class="modal fade" id="form_modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="guardar.php">
        <div class="modal-header">
          <h3 class="modal-title">Agregar marca</h3>
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
          <button name="guardar" class="btn btn-secondary" style="background-color:#5B00B7; color:white;"><span class="glyphicon glyphicon-save"></span> Procesar</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal" style="background-color:#5B00B7; color:white;"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
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
          <button name="guardar" class="btn btn-secondary" style="background-color:#5B00B7; color:white;"><span class="glyphicon glyphicon-save"></span> Procesar</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal" style="background-color:#5B00B7; color:white;"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
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