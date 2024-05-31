<?php
include_once 'config/conexion.php';		// mysqli
include_once 'objects/proveedores.php';
include_once 'objects/estadociudades.php';

$proveedores = new Proveedores ( $db );
$estadoCiudades = new EstadosCiudades ( $db );

// Codigo de programa de tabla de proveedores
include_once 'objects/usuarios.php';
$otrosUsuarios = new Usuarios ( $db );
$_SESSION['codigo_programa'] = "142";
include "partials/validar_acceso.php";
//

$edo=0;
$cty=0;
$buscar="";

$tipos[1]="Administrador";
$tipos[2]="Asistente";
$tipos[3]="Proveedor";
$tipos[4]="Empresa";
$alert="";

if(isset($_POST["modal_delete_proveedor"]) && $_POST["modal_delete_proveedor"] == "eliminar"){
	//echo "entre1 " . $_POST["idUsuario"];
	if( isset( $_POST["id"] ) && !empty( $_POST["id"] ) ){
		$stmt = $proveedores->LeerProveedorId($_POST["id"]); 
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
		{	
			//echo "voy a unlink " . $root . $row['folder']. $row['imagen'];
			
			If (unlink($root . "/assets/documentos/imagenes/logos/" . $row['logo_imagen'])) {
				$alert = '<div class="alert alert-success" role="alert">
				la imagen del registro ha sido eliminado con exito!
				</div>';
			} else {
			  $alert = '<div class="alert alert-danger" role="alert">
				La imagen no pudo ser eliminado!
				</div>';
			}	
		}
				
		$stmt = $proveedores->deleteProveedor ($_POST["id"]); 
		if ( $stmt ){
			$alert = '<div class="alert alert-success" role="alert">
			El registro ha sido eliminado con exito!
			</div>';
		}else{
			$alert = '<div class="alert alert-danger" role="alert">
			El registro no pudo ser eliminado!
			</div>';
		}
	}
}

if(isset($_POST["modal_contrato_proveedor"]) && $_POST["modal_contrato_proveedor"] == "actualizar"){
	//echo "entre1 " . $_POST["idUsuario"];
	if( isset( $_POST["id"] ) && !empty( $_POST["id"] ) ){
		$proveedores->id = $_POST["id"];
		$proveedores->contrato = $_POST["contrato"];
		$proveedores->fecha_contrato = $_POST["fecha_contrato"];
		$proveedores->plan = $_POST["plan"];
		$stmt = $proveedores->updateContrato();  
		if ( $stmt ){
			$alert = '<div class="alert alert-success" role="alert">
			El contrato fue asignado ha sido asignado con exito!
			</div>';
		}else{
			$alert = '<div class="alert alert-danger" role="alert">
			El registro no pudo ser eliminado!
			</div>';
		}
	}
}

$idUsuario = "";
$nombre = "";
$correo = "";
$usuario = "";
$estado = "";
$userhive = "";
$folder = "";
$imagen = "";
$tipo= "";

if ( isset($_POST['buscarpor']) ) {
	$buscar = $_POST['buscarpor'];
}

if( isset($_GET['id']) && $_GET['id'] !="" && $_GET['accion'] !=""){
	//echo "cambiar estatus de" . $_GET['id'] . " a " . $_GET['accion'];
	$stmt = $proveedores->cambiarEstatusProveedor ($_GET['id'], $_GET['accion']);
}

if( isset($_POST['edo']) && $_POST['edo'] !="" && $_POST['edo'] !="0"){
	$edo=$_POST['edo']*1;
}
if( isset($_POST['cty']) && $_POST['cty'] !="" && $_POST['cty'] !="0"){
	$cty = $_POST['cty'];
}
?>
