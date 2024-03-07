<?php
session_start();
if(!isset($_SESSION['loginHive'])){
	?>
	<script>
        alert("Su session ha caducado, por favor autenticarse denuevo...");
        window.location="login.php";
    </script>
    <?php
}
/* ** estas son las variables de session del usuario actualmente conectado ***
$_SESSION['idUsuario'] = $usuarios->idUsuario;s
$_SESSION['usuario'] = strtolower($usuarios->usuario);
$_SESSION['clave'] = $usuarios->clave;
$_SESSION['estado'] = $usuarios->estado;
$_SESSION['tipoHive'] = $usuarios->tipo;
$_SESSION['imagen'] = $usuarios->imagen;
$_SESSION['folder'] = $usuarios->folder;
$_SESSION['active'] = $usuarios->userhive;
*/
$_SESSION['raiz'] = "http://localhost/strasourcing";
$raizSistema = $_SESSION['raiz'];
// para ubicar imaneges

$root=$_SERVER['DOCUMENT_ROOT']. "/STRASOURCING"; 
// para eliminar registros echo $root;

$imagenes_usuarios = $raizSistema."/assets/documentos/imagenes/usuarios/";
$imagenes_logos = $raizSistema."/assets/documentos/imagenes/logos/";
$imagenes_rif = $raizSistema."/assets/documentos/imagenes/rif/";
$imagenes_autorizaciones = $raizSistema."/assets/documentos/imagenes/autorizaciones/";
$imagenes_soportes_archivos = $raizSistema."/assets/documentos/soportes/archivos/";
$imagenes_soportes_imagenes = $raizSistema."/assets/documentos/soportes/imagenes/";

$logoUser = $raizSistema.$_SESSION['folderHive'].$_SESSION['imagenHive'];
if( $_SESSION['companyHive'] != 0 ){
	$logoCompany = $imagenes_logos.$_SESSION['logoHive'];	
}else{
	$logoCompany = $imagenes_usuarios."/logoCompany.png";	
}

include_once 'objects/tablaContacto.php';

include_once 'config/database.php';
include_once 'objects/bigdata.php';
$database = new Database ();
$db = $database->getConnection ();
$bigdata = new Bigdata ( $db );

$login = 0;
if (isset($_GET['login']) && $_GET['login'] == 1){
	$login = 1;
            
}else{
	$login = 0;
}
?>
