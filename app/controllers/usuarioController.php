<?php
// AREA de mensajes del sistema

if(!isset($_SESSION['loginHive'])){
	?>
	<script>
        alert("Su session ha caducado, por favor autenticarse denuevo...");
        window.location="login.php";
    </script>
    <?php
}		

include_once 'config/conexion.php';		// mysqli
include_once 'objects/usuarios.php';
include_once 'objects/proveedores.php';

$otrosUsuarios = new Usuarios ( $db );
$proveedores = new Proveedores ( $db );

// Codigo de programa de tabla de usuarios
$_SESSION['codigo_programa'] = "140";
include "partials/validar_acceso.php";
//

$tipos[1]="Administrador";
$tipos[2]="Asistente";
$tipos[3]="Proveedor";
$tipos[4]="Empresa";
$alert="";

if(isset($_POST["modal_delete_user"]) && $_POST["modal_delete_user"] == "eliminar"){
	//echo "entre1 " . $_POST["idUsuario"];
	if( isset( $_POST["idUsuario"] ) && !empty( $_POST["idUsuario"] ) ){
		
		$stmt = $otrosUsuarios->LeerUsuarioId($_POST["idUsuario"]); 
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
		{	
			//echo "voy a unlink " . $root . $row['folder']. $row['imagen'];
			
			If (unlink($root . $row['folder']. $row['imagen'])) {
				$alert = '<div class="alert alert-success" role="alert">
				la imagen del registro ha sido eliminado con exito!
				</div>';
			} else {
			  $alert = '<div class="alert alert-danger" role="alert">
				La imagen no pudo ser eliminado!
				</div>';
			}	
		}
				
		$stmt = $otrosUsuarios->deleteUser ($_POST["idUsuario"]); 
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

$idUsuario = "";
$nombre = "";
$correo = "";
$usuario = "";
$estado = "";
$userhive = "";
$folder = "";
$imagen = "";
$tipo= "";
$idEmpresaAdmin="";

if(isset($_GET["idCompany"]) && $_GET["idCompany"] != 0){
	$idEmpresaAdmin = $_GET["idCompany"];
}

$list_cat = array();

if(isset($_GET["id"]) && $_GET["id"] != 0){
	$stmt = $otrosUsuarios->leerUsuarioId($_GET["id"]);
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {	
		$idUsuario = $row['idusuario'];
		$nombre = $row['nombre'];
		$correo = $row['correo'];
		$usuario = $row['usuario'];
		$estado = $row['estado'];
		$userhive = $row['userhive'];
		$folder = $row['folder'];
		$imagen = $row['imagen'];
		$tipo = $row['tipo'];
	}
	if ($idUsuario == ""){
		$alert = '<div class="alert alert-danger" role="alert">
		El usuario no pudo sewr encontrado!
		</div>';
		header('Location: vistaUsuario.php?error=$alert');	
	}
}
if (isset( $_POST["user_cat"] ) && $_POST["user_cat"] <> "" ){ 	
	$user_cat=$_POST["user_cat"];
	$idusuario =$_POST["idusuario"]; 
	$sql = "DELETE FROM usuario_categorias where idusuario = $idusuario";
	//echo $sql;
	$query = mysqli_query($conexion, $sql);
   	
	for ($i=0;$i<count($user_cat);$i++) 
	{ 
		$usu = $user_cat[$i];
		$sql = "INSERT INTO usuario_categorias(idusuario,idcategoria) values ($idusuario, $usu)";
		//echo $sql;
		$query_insert = mysqli_query($conexion, $sql);
	}
}


if (isset($_POST) && !empty($_POST) && isset($_POST['accion']) && $_POST['accion'] == 'a') {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Todo los campos son obligatorios
        </div>';
    } else {
		$tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
		$hint = $_POST['clave'];
        $query = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$email'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-warning" role="alert">
                        El correo ya existe
                    </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO usuario(tipo, nombre,correo,usuario,clave, hint) values ($tipo, '$nombre', '$email', '$user', '$clave', '$hint')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
                        </div>';
				?>
				<script>
	                window.location="vistaUsuario.php";
				</script>	
                <?php
                //header("Location: usuarios.php");
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar
                    </div>';
            }
        }
    }
}

if (isset($_POST) && !empty($_POST) && isset($_POST['accion']) && $_POST['accion'] == 'u') {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        
		$idusuario = $_POST['id'];
		$estado = $_POST['estado'];
        $nombre = trim($_POST['nombre']);
		$password = md5(trim($_POST['password']));
		$hint  = trim($_POST['password']);
		$tipo = $_POST['tipo'];
        $correo = trim(strtolower($_POST['correo']));
        $usuario = trim(strtolower($_POST['usuario']));
		$userhive = $_POST['userhive'];
		if(!empty($_POST['password'])){
			$clave = md5(trim(strtolower($_POST['password'])));
			// actualizo el usuario
			$sq = "UPDATE usuario SET estado=$estado, hint='$hint', clave='$clave', tipo = $tipo, userhive = $userhive, nombre = '$nombre', correo = '$correo' , usuario = '$usuario' WHERE idusuario = $idusuario";
		}else{
					// actualizo el usuario
		$sq = "UPDATE usuario SET estado=$estado, tipo = $tipo, userhive = $userhive, nombre = '$nombre', correo = '$correo' , usuario = '$usuario' WHERE idusuario = $idusuario";
		}
		//echo $sq;
		$sql_update = mysqli_query($conexion, $sq);
        $alert = '<div class="alert alert-success" role="alert">Usuario Actualizado</div>';
		//echo $sq;
    }
}
?>
