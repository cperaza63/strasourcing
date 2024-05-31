<?php
session_start();
include "Conexion_spa.php";
$db =  connect();
$usuarios="";
$permisos="";
$acciones="";
$seleccion_Tipo="";

if($_SESSION['tipoHive']*1 == 1){
	$seleccion_Tipo = " and userhive >= 0 ";
}

if($_SESSION['tipoHive']*1 == 2){
	$seleccion_Tipo = " and userhive >= 0 ";
}

if($_SESSION['tipoHive']*1 == 3){
	$seleccion_Tipo = " and tipo=3 and userhive = " . $_SESSION["companyHive"];
}

if($_SESSION['tipoHive']*1 == 4){
	$seleccion_Tipo = " and tipo=4 and userhive = " . $_SESSION["companyHive"];
}

if ( !isset( $_SESSION['usuario_id_role'] ) ) {
	$_SESSION['usuario_id_role']	= "0";
	$_SESSION['permiso_id_role']	= "0";
	$_SESSION['nombre_usuario_role']	= "";
	$_SESSION['nombre_permiso']	= "";
	$_SESSION['nombre_accion']	= "";
}
if ( isset( $_POST['proceso'] ) && $_POST['proceso'] == "consultar" ) {
	if( $_POST["usuario"][0] != "" ){
		$_SESSION['usuario_id_role'] = $_POST["usuario"][0];
		$sq = "select idusuario, nombre from usuario where idusuario=" . $_POST["usuario"][0];
		$array_resultado = array();
		$query=$db->query($sq);
		while($r=$query->fetch_object()){ $array_resultado[]=$r; }		
		if(count($array_resultado) > 0)
		{				
			foreach($array_resultado as $c):
				$_SESSION['nombre_usuario_role'] = $c->nombre;
        	endforeach;
		}
	}
}

// repasamos las listas para actualizar perfiles
if (isset($_POST["usuario"]) && isset($_POST["permiso"]) && isset($_POST["accion"] ) ){ 
	$usuarios=$_POST["usuario"]; 
   	for ($i=0;$i<count($usuarios);$i++) 
	{ 
		$permisos=$_POST["permiso"]; 
		
		for ($j=0;$j<count($permisos);$j++) 
		{
			$acciones=$_POST["accion"]; 
			for ($k=0;$k<count($acciones);$k++) 
			{ 
				/*echo "<br> Usuario " . $i . ": " . $usuarios[$i]; 
				echo "<br> Permiso " . $j . ": " . $permisos[$j]; 	
				echo "<br> Acciones " . $k . ": " . $acciones[$k]; */
				$usu = $usuarios[$i];
				$per = $permisos[$j];
				$acc = $acciones[$k];
				// si existe actualizo la nueva accion, si no la creo
				switch( $acc ){
					case "A":
						$sq = "SELECT * FROM detalle_permisos where id_usuario = ".$usu." and id_permiso=".$per." and agregar='A'";
						break;
					case "M":
						$sq = "SELECT * FROM detalle_permisos where id_usuario = ".$usu." and id_permiso=".$per." and modificar='M'";
						break;
					case "E":
						$sq="SELECT * FROM detalle_permisos where id_usuario = ".$usu." and id_permiso=".$per." and eliminar='E'";
						break;
					case "C":
						$sq="SELECT * FROM detalle_permisos where id_usuario = ".$usu." and id_permiso=".$per." and consultar='C'";
						break;
				}
				//echo "<br>". $sq;
				$query=$db->query($sq);
				$array_result = array();
				$cuantos = count($array_result);
				while($r=$query->fetch_object()){ $array_result[]=$r; }
				
				if(count($array_result) == 0)
				{
					// no hay regidtro, por lo ntato ADDNEW
					
					switch( $acciones[$k] )
					{
						case "A":
							$sql = "INSERT INTO detalle_permisos (id_usuario, id_permiso, agregar, modificar, eliminar, consultar)
						VALUES (". $usu .", " . $per . ", 'A', '', '', '')";
							break;
						case "M":
							$sql = "INSERT INTO detalle_permisos (id_usuario, id_permiso, agregar, modificar, eliminar, consultar)
						VALUES (". $usu .", " . $per . ", '','M', '','')";
							break;
						case "E":
							$sql = "INSERT INTO detalle_permisos (id_usuario, id_permiso, agregar, modificar, eliminar, consultar)
						VALUES (". $usu .", " . $per . ", '','','E','')";
							break;
						case "C":
							$sql = "INSERT INTO detalle_permisos (id_usuario, id_permiso, agregar, modificar, eliminar, consultar)
						VALUES (". $usu .", " . $per . ", '','','','C')";
							break;
					}
					
					//echo $sql;
					
					$result=$db->query($sql);
					if ( $result ) {
						//echo "New record " . $sql;
					} else {
						echo "Error: " . $sql . "<br>" . $db->error;
					}
				} 						
			}
		}
	}
}

$sq = "select * from usuario where idusuario>0 $seleccion_Tipo order by userhive, estado desc, tipo, nombre";
//echo $sq;
$query=$db->query($sq);
$array_users = array();
while($r=$query->fetch_object()){ $array_users[]=$r; }

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
        <li ><a href="../vistaUsuario.php" target="_parent"><h4>Tabla de Usuarios</h4></span></a></li>
        <!--<li ><a target="_parent" href="../../index.php">Menu Principal</a></li>-->
      </ul>

    </div><!-- /.navbar-collapse -->
  
</nav>
<div class="panel-body">
<div class="row">
    <div class="container">
        <br>
    </div>
<div class="col-md-12">
<!--<h1>Categorias - Subcategorias y Grupos</h1>-->
<?php if(isset($_COOKIE["comboadd"])):?>
<p class="alert alert-success">Rol de usuario agregado exitosamente!</p>
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
  <div class="form-group col-md-5">
    <label for="name1">USUARIOS</label>
    <select name="usuario[]" size="10"  multiple class="form-control" id="usuario_id">
		<?php foreach($array_users as $c):?>
              <option value="<?php echo $c->idusuario; ?>" <?php if ( $_SESSION['usuario_id_role']*1 == $c->idusuario*1 ){ echo "selected";}?>
              ><?php echo ucfirst(strtolower($c->nombre)). " (" . $c->userhive . ") e:" . $c->estado . " t:" . $c->tipo ; ?></option>
        <?php endforeach; ?>
    </select>
     <button type="submit" name="proceso" value="consultar" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Consultar</button>
  </div>

  <div class="form-group col-md-4">
    <label for="name1">APLICACIONES DEL SISTEMA</label>
    <select name="permiso[]" size="10" multiple="MULTIPLE" class="form-control" id="permiso_id">
      <?php
	  $query=$db->query("select * from tabla_control where tipo=16");
		$states = array();
		while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			foreach ($states as $s) {
				if ( $_SESSION['permiso_id_role']*1 == $s->id*1 ){
					$_SESSION['nombre_permiso'] = $s->nombre;
					$seleccion = " selected ";	
				}else{
					$seleccion = "";	
				}
				print "<option value='$s->id' $seleccion>  ". ucfirst($s->nombre) . " (" . $s->id . ")</option>";
		}
		}else{
		print "<option value=''>-- NO HAY DATOS --</option>";
		}
	  ?>
   </select>
  </div>

  <div class="form-group col-md-3">
    <label for="name1">PERMISO PARA</label>
    <select name="accion[]" size="5" multiple="MULTIPLE" class="form-control" id="accion_id">
   		<option value="A">Agregar</option>
  		<option value="M">Modificar</option>
   		<option value="E">Eliminar</option>
   		<option value="C">Consultar</option>
   </select>
   <br><br>
   <button type="submit" name="proceso" value="agregar" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Agregar </button>
    <a TARGET="_parent" href="../vistaUsuario.php" class="btn btn-outline-secondary" style="background-color:#5B00B7; color:white;">Salir </a>
  
   
  </div>

  
</form>
</div>
</div>
</div>

<!-- <div class="panel-footer">Sistema SPA</div> -->
</div><!-- /.Cierra-default-panel -->
</div><!-- /.container-fluid -->

<iframe class="responsive-iframe" src="../relacion_marca_cat/index_grupo_roles.php" width="100%" height="2500px" frameborder="0"></iframe>
<br>


<!--<script type="text/javascript">
	$(document).ready(function(){
		$("#usuario_id").change(function(){
			$.get("Paises.php","usuario_id="+$("#usuario_id").val(), function(data){
				$("#permiso_id").html(data);
				console.log(data);
			});
		});

		$("#permiso_id").change(function(){
			$.get("Ciudades.php","permiso_id="+$("#permiso_id").val(), function(data){
				$("#accion_id").html(data);
				console.log(data);
			});
		});
	});
</script>-->

</body>
</html>