<?php
include "Conexion.php";
$db =  connect();
$query=$db->query("select * from continente");
$countries = array();
while($r=$query->fetch_object()){ $countries[]=$r; }

$query=$db->query("select * from pais");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }

$query=$db->query("select * from ciudad");
$cities = array();
while($r=$query->fetch_object()){ $cities[]=$r; }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Combo 3 Niveles Catsubcat</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="panel panel-default">
<BR>

<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Coleccion de etiquetas nav links, forms, y otros contenidos -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="./"><h4>Relacion con Marcas</h4><span class="sr-only">(current)</span></a></li>
        <li ><a href="./Nuevo.php"><span style="color:#5B00B7"><h4>Agregar Cat/Subcat/Grupos</h4></span></a></li>
        <!--<li ><a target="_parent" href="../../index.php">Menu Principal</a></li>-->
      </ul>

    </div><!-- /.navbar-collapse -->
</nav>


<div class="panel-body">
<div class="row">
<div class="col-md-12">
<!--<h1>Agregar Categorias, Subcategorias y Grupos</h1>-->
<?php if(isset($_COOKIE["countryadd"])):?>
<p class="alert alert-success">Categoria Agregado exitosamente!</p>
<?php setcookie("countryadd",0,time()-1); endif; ?>
<?php if(isset($_COOKIE["stateadd"])):?>
<p class="alert alert-info">Subcategoria N1 Agregado exitosamente!</p>
<?php setcookie("stateadd",0,time()-1); endif; ?>
<?php if(isset($_COOKIE["cityadd"])):?>
<p class="alert alert-warning">Subcategoria N2 Agregada exitosamente!</p>
<?php setcookie("cityadd",0,time()-1); endif; ?>
<?php
if(!isset($_POST['continente_id'])){
	$_POST['continente_id']="";	
}
if(!isset($_POST['pais_id'])){
	$_POST['pais_id']="";	
}

if(!isset($_POST['ciudad_id'])){
	$_POST['ciudad_id']="";	
}

?>

</div>
</div>
<div class="row">
<div class="col-md-4">
<h3>Nueva Categoria</h3>
<form method="post" action="Agregar.php?opt=country">
  <div class="form-group">
    <label for="name1">Escriba la nueva categoria</label>
    :
    <input type="text" class="form-control" id="name1" name="name" placeholder="Nombre" required>
  </div>
  <button type="submit" class="btn btn-default" style="background-color:#5B00B7; color:white;">Agregar Registro</button>
</form>
</div>
<div class="col-md-4">
<h3>Lista de categoria</h3>
<form method="post" action="Agregar.php?opt=state">
  <div class="form-group">
    <label for="name1">Categorias</label>
    <select class="form-control" name="continente_id" required>
      <option value="">-- SELECCIONE --</option>
		<?php foreach($countries as $c):?>
      		<option value="<?php echo $c->id; ?>"
            <?php 
			if($c->id == $_POST['continente_id'] ){
				echo "selected";	
			}
			?>
            ><?php echo $c->name; ?></option>
		<?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="name1">Escriba la nueva subcategoria:</label>
    <input type="text" class="form-control" id="name1" name="name" placeholder="Nombre" required>
  </div>
  <button type="submit" class="btn btn-default" style="background-color:#5B00B7; color:white;">Agregar Registro</button>
</form>
</div>
<div class="col-md-4">
<h3>Lista de subcategorias</h3>
<form method="post" action="Agregar.php?opt=city">
  <div class="form-group">
    <label for="name1">Subcategorias</label>
    <select class="form-control" name="pais_id" required>
      <option value="">-- SELECCIONE --</option>
<?php foreach($states as $c):?>
      <option value="<?php echo $c->id; ?>" 
      <?php 
 	  if($c->id == $_POST['pais_id'] ){
			echo "selected";	
	  }
	  ?>
      ><?php echo $c->name; ?></option>
<?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="name1">Escriba una nuevo grupo de productos:</label>
    <input type="text" class="form-control" id="name1" name="name" placeholder="Nombre" required>
  </div>
  <button type="submit" class="btn btn-default" style="background-color:#5B00B7; color:white;">Agregar Registro</button>
</form>
</div>

<div class="col-md-4">
  <h3>Lista de Grupos</h3>
  <form method="post" action="Agregar.php?opt=city">
    <div class="form-group">
      <label for="name">Grupos de productos</label>
      <select class="form-control" name="ciudad_id" required>
        <option value="">-- SELECCIONE --</option>
        <?php foreach($cities as $c):?>
        <option value="<?php echo $c->id; ?>" 
        <?php 
		  if($c->id == $_POST['ciudad_id'] ){
				echo "selected";
		  }
		  ?>
        ><?php echo $c->name; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </form>
</div>

</div>
</div>

<!--<div class="panel-footer">Sistema SPA</div>-->
</div><!-- /.Cierra-default-panel -->
</div><!-- /.container-fluid -->
</body>
</html>