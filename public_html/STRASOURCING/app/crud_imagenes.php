<?php include_once "includes/header.php";
include "../conexion.php";
$id_user = $_SESSION['iduserHive'];
if($_SESSION['tipoHive'] < 4){
    $permiso = "distribuidores";
    $sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
    $existe = mysqli_fetch_all($sql);
    if (empty($existe) && $id_user != 1) {
        ?>
        <script>
            window.location="permisos.php";
        </script>
        <?php
        //header("Location: permisos.php");
    }
}

if( isset($_GET['id']) && !empty( $_GET['id']) ){

    // recordar estas variables para manejar la imagen actual
    $_SESSION['codigo_tabla'] = $_GET['id'];
    $_SESSION['image_id'] = "";

    $query  = "SELECT *  FROM tabla_control where id=" . $_SESSION['codigo_tabla'];

    //echo $query;

	$result = mysqli_query($conexion, $query);
	if (mysqli_num_rows($result) > 0) {				

		while($row = mysqli_fetch_assoc($result)) {

            $imagen = $row['image_id'];
            
            if ( empty($imagen )){
                echo "no hay imagen asignada";
            }else{
                $_SESSION['image_id']  = $imagen;
                echo "Tabla #". $_SESSION['tipoTabla'] .", imagen asignada #". $_SESSION['image_id']." del item #" . $_SESSION['codigo_tabla'];
            }
            
        }
    }

}
?>
<iframe class="responsive-iframe" src="./crud_imagenes/" width="100%" height="3500px"></iframe>
<?php 
 mysqli_close($conexion);
include_once "includes/footer.php"; 
?>

