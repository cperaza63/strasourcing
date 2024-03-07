<?php
session_start();
include "config/conexion.php";
$id_user = $_SESSION['iduserHive'];
$permiso = "usuarios";
/*$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    ?>
	<script>
        window.location="permisos.php";
    </script>
    <?php
    //header("Location: permisos.php");;
}
*/
if (isset($_POST['accion']) && $_POST['accion'] == "edit" ) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $sql = "UPDATE tabla_control SET nombre = '$nombre' WHERE id = $id";
    //echo $sql;
    $query_update = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    header("Location: vistaTablaControl.php");
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM tabla_control WHERE id = $id");
    mysqli_close($conexion);
    header("Location: vistaTablaControl.php");
}
