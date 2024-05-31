<?php
session_start();
include "Conexion.php";
$db =  connect();
$query=$db->query("select * from continente");
$countries = array();
while($r=$query->fetch_object()){ $countries[]=$r; }


if ( !isset( $_SESSION['nombre_continente'] ) ) {
	$_SESSION['continente_id']	= "0";
	$_SESSION['pais_id']	= "0";
	$_SESSION['ciudad_id']	= "0";
	$_SESSION['nombre_continente']	= "";
	$_SESSION['nombre_pais']	= "";
	$_SESSION['nombre_ciudad']	= "";
}


if( isset($_POST['accion']) ) {
	if ( $_POST['continente_id']<>'0' || $_POST['pais_id'] <>'0' || $_POST['ciudad_id']<>'0' )   {
		$_SESSION['continente_id']	= $_POST['continente_id'];
		$_SESSION['pais_id']	= $_POST['pais_id'];
		$_SESSION['ciudad_id']	= $_POST['ciudad_id'];
		//echo "regreso " . $_POST['accion']. " " . $_SESSION['continente_id'] . " " . $_SESSION['pais_id'] . " " , $_SESSION['ciudad_id'];	
	} else{
		?>
		<script>
			alert("Campos incompletos, revise");
		</script>
		<?php	
	}
	
}

$query=$db->query("select * from continente");
$countries = array();
while($r=$query->fetch_object()){ $countries[]=$r; }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Categorias - SPA</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


</head>
<body>
<BR>
 <div class="container">
<div class="panel panel-default">


<nav class="navbar navbar-default">
 
    <!-- Extra para moviles mostrar -->
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
        <li ><a href="./"><span style="color:#5B00B7"><h4>Relacion con Marcas</h4></span></a></li>
        <li ><a href="./Nuevo.php"><h4>Agregar Cat/Subcat/Grupos</h4></span></a></li>
        <!--<li ><a target="_parent" href="../../index.php">Menu Principal</a></li>-->
      </ul>

    </div><!-- /.navbar-collapse -->
  
</nav>

<div class="panel-body">
<div class="row">
<div class="col-md-12">
<!--<h1>Categorias - Subcategorias y Grupos</h1>-->
<?php if(isset($_COOKIE["comboadd"])):?>
<p class="alert alert-success">Categoria combo agregado exitosamente!</p>
<?php setcookie("comboadd",0,time()-1); endif; ?>
</div>
</div>
<div class="row">
<div class="col-md-12">
<!-- 
accion = Agregar.php?opt=all 
<php 
if ($edo*1 == $data['codigo']*1 ){ echo "selected"; }
?>
-->
<form method="post" action="">
  <div class="form-group col-md-6">
    <label for="name1">Categorias</label>
    <select class="form-control" name="continente_id" id="continente_id" required>
      <option value="">-- SELECCIONE --</option>
		<?php foreach($countries as $c):?>
              <option value="<?php echo $c->id; ?>" <?php if ( $_SESSION['continente_id']*1 == $c->id*1 ){ echo "selected";}?>
              ><?php echo $c->name; ?></option>
        <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group col-md-6">
    <label for="name1">Subcategorias</label>
    <select name="pais_id" required class="form-control" id="pais_id">
      <?php
	  $query=$db->query("select * from pais where continente_id=$_SESSION[continente_id]");
		$states = array();
		while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE *SUBCATEGORIA* </option>";
			foreach ($states as $s) {
				if ( $_SESSION['pais_id']*1 == $s->id*1 ){
					$_SESSION['nombre_pais'] = $s->name;
					$seleccion = " selected ";	
				}else{
					$seleccion = "";	
				}
				print "<option value='$s->id' $seleccion> $s->name </option>";
		}
		}else{
		print "<option value=''>-- NO HAY DATOS --</option>";
		}
	  ?>
   </select>
  </div>

  <div class="form-group col-md-9">
    <select name="ciudad_id" required class="form-control" id="ciudad_id">
    	<?php
			$query=$db->query("select * from ciudad where pais_id=$_SESSION[pais_id]");
			$states = array();
			while($r=$query->fetch_object()){ $states[]=$r; }
			if(count($states)>0){
				print "<option value=''>-- SELECCIONE GRUPO DE PRODUCTOS --</option>";
				foreach ($states as $s) {
					if ( $_SESSION['ciudad_id']*1 == $s->id*1 ){
						$seleccion = " selected ";	
						$_SESSION['nombre_ciudad'] = $s->name;
					}else{
						$seleccion = "";	
					}
					print "<option value='$s->id' $seleccion> $s->name </option>";
				}
			}else{
				print "<option value=''>-- NO HAY DATOS --</option>";
			}
		?>
   </select>
  </div>

  <button type="submit" name="accion" value="asignar" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Consultar Marcas</button>
  <a href="../<?php echo $_SESSION['dashboard']; ?>" target="_parent" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Volver</a>
</form>
</div>
</div>
</div>

<!-- <div class="panel-footer">Sistema SPA</div> -->
</div><!-- /.Cierra-default-panel -->
</div><!-- /.container-fluid -->

<div align="center">
<iframe class="responsive-iframe" src="../relacion_marca_cat" width="80%" height="850px" frameborder="0"></iframe>
</div>
<br>


<script type="text/javascript">
	$(document).ready(function(){
		$("#continente_id").change(function(){
			$.get("Paises.php","continente_id="+$("#continente_id").val(), function(data){
				$("#pais_id").html(data);
				console.log(data);
			});
		});

		$("#pais_id").change(function(){
			$.get("Ciudades.php","pais_id="+$("#pais_id").val(), function(data){
				$("#ciudad_id").html(data);
				console.log(data);
			});
		});
	});
</script>

</body>
</html>