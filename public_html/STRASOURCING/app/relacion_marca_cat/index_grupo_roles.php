<?php
session_start();

$consulta = 0;	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<title>Perfiles de usuarios</title>
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
      <h3 class="panel-title">Consulta de Roles del usuario <?php echo $_SESSION['nombre_usuario_role'] . " (#". $_SESSION['usuario_id_role'].")"; ?></h3>
    </div>
    <div class="panel-body">            
		<form method="POST" action="borrar_grupo_roles.php">
          <table class="table table-bordered">
            <thead class="alert-info">
              <tr>
                <th><input type="checkbox" onclick="selectedCheckbox(this)">
                  Todos</th>
                <th>Nombre</th>
                <th>Aplicación</th>
                <th>Empresa</th>
                <th>Agregar</th>
                <th>Modifica</th>
                <th>Eliminar</th>
                <th>Consultar</th>
              </tr>
            </thead>
            <tbody style="background-color:#fff;">
            <?php
            $hay = 0;
            require 'conexion_spa.php';
            
            $sql="select a.id, a.id_usuario, a.id_permiso, c.nombre as aplicacion, b.nombre, b.userhive, a.agregar, 
			a.modificar, a.eliminar, a.consultar from detalle_permisos a INNER JOIN usuario b on (a.id_usuario = b.idusuario) 
			INNER JOIN tabla_control c on (a.id_permiso = c.id and c.tipo = 16) where idusuario=" . $_SESSION['usuario_id_role'] . " 
			order by a.id_permiso, c.nombre, a.agregar desc, a.modificar desc, a.eliminar desc, a.consultar desc";
        
            //query result
            $sth = $db->query($sql);
            $hay=0;
            while( $row = $sth->fetch(PDO::FETCH_ASSOC) ) {
                $hay=1;
                ?>
                  <tr>
                    <td><input type="checkbox" name="check[]" onclick="countCheckbox()" value="<?php echo $row['id']?>"></td>
                    <td><?php echo $row['nombre']. " (" . $row['id_permiso'] . ")"?></td>
                    <td><?php echo $row['aplicacion']?></td>
                    <td><?php echo $row['userhive']?></td>
                    <td><?php echo $row['agregar']?></td>
                    <td><?php echo $row['modificar']?></td>
                    <td><?php echo $row['eliminar']?></td>
                    <td><?php echo $row['consultar']?></td>
                  </tr>
                </tbody>
            <?php
            }
            
            if( $hay == 1){
            ?>
            <tfoot>
              <tr>
                <td colspan="5"><button  onclick="return confirm('Estas seguro de eliminar?')" name="borrar" class="btn btn-secondary pull-right" style="background-color:#5B00B7; color:white;"><span id="count" class="badge">0</span> Borrar</button></td>
              </tr>
            </tfoot>
            <?php
            }
            ?>
          </table>
        </form> 
    </div>
  </div>
</div>

<script src="js/jquery-3.2.1.min.js"></script> 
<script src="js/bootstrap.js"></script> 
<script src="js/script.js"></script>
</body>
</html>