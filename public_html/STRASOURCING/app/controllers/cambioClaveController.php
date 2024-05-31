<?php
session_start();
if(isset($_SESSION['idUsuario'])){
	session_destroy();	
}
include_once 'config/database.php';
include_once 'objects/tablaContacto.php';
include_once 'objects/usuarios.php';
include_once 'objects/empresas.php';
include_once 'objects/proveedores.php';
include_once 'objects/bigdata.php';
$database = new Database ();
$db = $database->getConnection ();
$usuarios = new Usuarios ( $db );
$empresas = new Empresas ( $db );
$proveedores = new Proveedores ( $db );
$bigdata = new Bigdata ( $db );

$alert = "";

$idusuario = 0;
if(isset($_GET['u'])){
	$idusuario = $_GET['u'];
	//echo "idg " . $idusuario; 
}else{
	if(isset($_POST['idusuario'])){
		$idusuario = $_POST['idusuario'];
		//echo "idp " . $idusuario; 
	}
}
if (isset($_POST['password1']) && isset($_POST['password2'])) {
	$alert = '';
	if (empty($_POST['password1']) || empty($_POST['password2'])) {
		$alert = '<div class="alert alert-danger" role="alert">
		Ingrese su clave, algun dato falta
		</div>';
		echo $alert;
	} else {
		if ( ($_POST['password1'] == $_POST['password2']) && $idusuario > 0) {
			//echo "entre3 ". $_POST['password1'] . " " . $_POST['password2'];
			$stmt = $usuarios->cambiarClave($idusuario, md5($_POST['password1']) );
			$alert = '<div class="alert alert-success" role="alert">
			La Contraseña fue cambiada con exito... <a href="http://localhost/strasourcing/app/login.php">click aqui para ir al menu principal</a>
			</div>';
			echo $alert;	
		}else{
			$alert = '<div class="alert alert-danger" role="alert">
			La Contraseñas no coinciden o falta un parametro, favor revisar...
			</div>';
			echo $alert;	
		}
	}
}
?>