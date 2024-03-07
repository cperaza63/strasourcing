<?php
session_start();
include "Conexion.php";
$db =  connect();
$query=$db->query("select * from continente");
$countries = array();
$nombreMarca = "";
$nombreCat = "";
$nombreSubcat = "";
$seleccion = "";

while($r=$query->fetch_object()){ $countries[]=$r; }


if ( !isset( $_SESSION['nombre_continente'] ) ) {
	$_SESSION['continente_id']	= "0";
	
	$_SESSION['pais_id']	= "0";
	$_SESSION['ciudad_id']	= "0";
	$_SESSION['nombre_continente']	= "";
	$_SESSION['nombre_pais']	= "";
	$_SESSION['nombre_ciudad']	= "";
	$_SESSION['continente_id']	= "";
	$_SESSION['pais_id']	= "";
	$_SESSION['ciudad_id']	= "";
}

if( isset($_GET['m']) && isset($_GET['c']) && isset($_GET['s'])) {
	$_SESSION['marca_nombre'] = $_GET['mn'];
	$_SESSION['marca_id'] = $_GET['m'];
	$_SESSION['continente_id'] = $_GET['c'];
	$_SESSION['pais_id'] = $_GET['c'];
	$_SESSION['ciudad_id']	= $_GET['s'];
	$m = $_SESSION['continente_id'];
	$c = $_SESSION['pais_id'];
	$s = $_SESSION['ciudad_id'];
}else{
	$m = $_SESSION['continente_id'];
	$c = $_SESSION['pais_id'];
	$s = $_SESSION['ciudad_id'];
}

if(!isset($_SESSION['marca_nombre'])){
	$_SESSION['marca_nombre'] = "";
}
$query=$db->query("select * from spa.tabla_control where tipo=8 and id = $m");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
	foreach ($states as $sas) {
		$nombreMarca = $sas->nombre;
		$_SESSION['marca_nombre'] = $nombreMarca;
		$_SESSION['marca_id'] = $sas->id;
	}
}

if( isset($_POST['accion']) ) {
	if ( $_POST['continente_id']<>'0' || $_POST['pais_id'] <>'0' || $_POST['ciudad_id']<>'0' )   {
		$_SESSION['continente_id']	= $_POST['continente_id'];
		$c = $_SESSION['continente_id'];
		$_SESSION['pais_id']	= $_POST['pais_id'];
		$s = $_SESSION['pais_id'];
		//$_SESSION['ciudad_id']	= $_POST['ciudad_id'];
		//$g = $_SESSION['ciudad_id'];
		//echo "regreso " . $_POST['accion']. " " . $_SESSION['continente_id'] . " " . $_SESSION['pais_id'] . " " . $g ;	
		
	} else{
		?>
		<script>
			alert("Campos incompletos, revise");
		</script>
		<?php	
	}
	
}


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
      <a class="navbar-brand" href="./">Sistema SPA</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="./">Inicio <span class="sr-only">(current)</span></a></li>
        <li ><a href="./Nuevo.php">Agregar  Regsitros</a></li>
        <li ><a target="_parent" href="../../index.php"> Menu Principal</a></li>
      </ul>

    </div><!-- /.navbar-collapse -->
  
</nav>

<div class="panel-body">
<div class="row">
<div class="col-md-12">
<h1>Grupos/ Productos de: <?php echo $nombreMarca; ?></h1>
<?php if(isset($_COOKIE["comboadd"])):?>
<p class="alert alert-success">Grupo/Producto agregado exitosamente!</p>
<?php setcookie("comboadd",0,time()-1); endif; ?>
</div>
</div>
<div class="row">
<div class="col-md-6">
<!-- 
accion = Agregar.php?opt=all 
<php 
if ($edo*1 == $data['codigo']*1 ){ echo "selected"; }
?>
-->
<form method="post" action="index_grupos.php">
   
    <div class="form-group">
	    <label for="name1">Categoria</label>
	    <select id="pais_id" class="form-control" name="continente_id" required>
		  <?php
          $query=$db->query("select * from php_combo.continente where id=$c");
          $states = array();
          while($r=$query->fetch_object()){ $states[]=$r; }
            if(count($states)>0){
                foreach ($states as $xxx) {
                    print "<option value='$xxx->id'> $xxx->name </option>";
	            }
          }
		  else
		  {
	       	print "<option value=''>-- NO HAY DATOS --</option>";
          }
          ?>
	    </select>
    </div>
    
    <div class="form-group">
    <label for="name1">Subcategoria</label>
    <select id="pais_id" class="form-control" name="pais_id" required>
      <?php
	  $query=$db->query("select * from php_combo.pais where id = $s");
		$registros = array();
		while($r=$query->fetch_object()){ $registros[]=$r; }
		if(count($registros)>0){
			foreach ($registros as $xxx) {
				print "<option value='$xxx->id'> $xxx->name </option>";
			}
		}
		else
		{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
	  ?>
   </select>
  </div>
  
  <div class="form-group">
    <label for="name1">Marca</label>
    <input name="marca_sel" class="form-control" value="<?php echo $_SESSION['marca_nombre']; ?>" />
  </div>
  
  <!--<div class="form-group">
    <label for="name1">Grupo / Producto</label>
    <select id="ciudad_id" class="form-control" name="ciudad_id" required>
    	<php
			$seleccion = "";
			$query=$db->query("select * from  php_combo.ciudad where pais_id=" . $s );
			$states = array();
			while($r=$query->fetch_object()){ $states[]=$r; }
			if(count($states)>0){
				print "<option value=''>-- SELECCIONE GRUPO --</option>";
				foreach ($states as $xxx) {
					?>
				<option value="<php echo $xxx->id; ?>"
                    <php
  						if( $_SESSION['ciudad_id'] == $xxx->id ){
							echo "selected";
						}
                    ?>
                    > <php echo $xxx->name; ?>
				<php
				}
			}else{
				print "<option value=''>-- NO HAY DATOS --</option>";
			}
		?>
   </select>
  </div>-->

  <button type="submit" name="accion" value="asignar" class="btn btn-success">Consultar Marcas</button>
</form>
</div>
</div>
</div>

<!-- <div class="panel-footer">Sistema SPA</div> -->
</div><!-- /.Cierra-default-panel -->
</div><!-- /.container-fluid -->

<iframe class="responsive-iframe" src="../relacion_marca_cat/index_proveedor_grupos.php" width="100%" height="1000px"></iframe>
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