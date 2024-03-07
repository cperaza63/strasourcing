<?php
include_once 'config/conexion.php';		// mysqli
include_once 'objects/proveedores.php';
include_once 'objects/estadociudades.php';

$proveedores = new Proveedores ( $db );
$estadoCiudades = new EstadosCiudades ( $db );

// Codigo de programa de tabla de empresas
include_once 'objects/usuarios.php';
$otrosUsuarios = new Usuarios ( $db );
$_SESSION['codigo_programa'] = "143";
include "partials/validar_acceso.php";
//

$buscar="";
$alert="";

if ( isset( $_POST['registrar'] ) && $_POST['registrar'] == 'Registrar'){
	$stmt = $estadoCiudades->crearCiudad ($_POST['estado'], $_POST['ciudad']); 
	if( $stmt ){
		$alert = '<div class="alert alert-success" role="alert">
		Ciudad Agregada a la lista con exito!
		</div>';		
	}else{
		$alert = '<div class="alert alert-danger" role="alert">
		La ciudad no pudo ser agregada
		</div>';	
	}
}

if ( isset( $_POST['buscarpor'] ) && $_POST['buscarpor'] != ''){
	$buscar  = $_POST['buscarpor'];
}

// para eliminar
if(isset($_POST["modal_delete_ciudad"]) && $_POST["modal_delete_ciudad"] == "eliminar"){
	//echo "entre1 " . $_POST["id"];
	if( isset( $_POST["id"] ) && !empty( $_POST["id"] ) ){
						
		$stmt = $estadoCiudades->deleteCiudad ($_POST["id"]); 
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
		El usuario no pudo ser encontrado!
		</div>';
		//header('Location: vistaUsuario.php?error=$alert');	
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
					alert('Usuario Registrado');
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
		echo $sq;
		$sql_update = mysqli_query($conexion, $sq);
        $alert = '<div class="alert alert-success" role="alert">Usuario Actualizado</div>';
		echo $sq;
    }
}
?>
