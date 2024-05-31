<?php
include_once 'config/conexion.php';		// mysqli
include_once 'objects/usuarios.php';
include_once 'objects/tablaContacto.php';
include_once 'objects/estadociudades.php';
include_once 'objects/empresas.php';
include_once 'objects/proveedores.php';

$empresas = new Empresas ( $db );
$proveedores = new Proveedores ( $db );

$otrosUsuarios = new Usuarios ( $db );
$tablaContactos = new TablaContactos ( $db );
$estadoCiudades = new EstadosCiudades ( $db );
$buscar="";
$alert="";

if ( isset( $_POST['buscarpor'] ) && $_POST['buscarpor'] != ''){
	$buscar  = $_POST['buscarpor'];
}


// aqui la rutina para mandar los nuevos mensaje
if (isset($_POST) && !empty($_POST) && $_POST['submit'] == 'Enviar') {
    $alert = "";
    if ( (empty($_POST['idEmpresa']) && empty($_POST['idProveedor'] ) ) || empty($_POST['asunto']) || empty($_POST['mensaje'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Todo los campos son obligatorios
        </div>';
        echo $alert;
    } else {
		
        $idEmpresa   = isset($_POST['idEmpresa']) ? $_POST['idEmpresa'] : 0;
        $idProveedor = isset($_POST['idProveedor']) ? $_POST['idProveedor'] : 0;
        $asunto = $_POST['asunto'];
        $mensaje = $_POST['mensaje'];
        $telefonoEmpresa = "";
        $emailEmpresa = "";
        $direccionEmpresa = "";
        $nombreEmpresa = "";
		
		if ($idEmpresa > 1 ){
            $negocio = $idEmpresa;
            $stmt = $empresas->LeerEmpresaId ($idEmpresa); 
            //echo "<br>antes del while :" . $idEmpresa;
            while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
            {
                //echo "<br>adentro";
                $telefonoEmpresa = $row['telefono_empresa'];
                $emailEmpresa = $row['email_empresa'];
                $direccionEmpresa = $row['direccion_empresa'];
                $nombreEmpresa = $row['razon_social'];
                $rifDestino = $row['numero_rif'];
            }

        }else{
            if ($idProveedor > 1 ){
                $negocio = $idProveedor;
                //echo "<br>idProveedor:" . $idProveedor;
                $stmt = $proveedores->LeerProveedorId ($idProveedor); 
                while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
                {
					$telefonoEmpresa = $row['telefono_empresa'];
					$emailEmpresa = $row['email_empresa'];
					$direccionEmpresa = $row['direccion_empresa'];
					$nombreEmpresa = $row['razon_social'];
					$rifDestino = $row['numero_rif'];
                }
            }else{
                //echo "<br>Administrador:" . $idEmpresa;
                $negocio = 1;
                $telefonoEmpresa = "n/a";
                $emailEmpresa = "?@?.?";
                $direccionEmpresa = "n/a";
                $nombreEmpresa = "Administracion";
                $rifDestino = "n/a"; 
            }
        }

        
        $sq = "SELECT * FROM tabla_contactos where companyDestino= $negocio 
        and usuario = '" . $_SESSION['loginHive'] . "' and comentario = '$asunto $mensaje'";
        
        //echo $sq;
        
        $query = mysqli_query($conexion, $sq);
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-warning" role="alert">
                        El mensaje ya existe, esta duplicado
                    </div>';
            echo $alert;
        } else {
            $sq1= "INSERT INTO tabla_contactos(estatus, rifDestino, rifEnvia, companyEnvia, companyDestino, usuario, 
            telefono, email, direccion, empresa, comentario) values (0, '" . $rifDestino . "', '" .$_SESSION['rifHive'] . "', " . $_SESSION['companyHive'] . ", " . $negocio . ", '" 
			. $_SESSION['loginHive'] . "', 
            '$telefonoEmpresa', '$emailEmpresa', '$direccionEmpresa', '$nombreEmpresa', '$asunto $mensaje')";
            //echo $sq1;
            $query_insert = mysqli_query($conexion, $sq1);
            
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            mensaje enviado
                        </div>';
				?>
				<script>
					//alert('Mensaje enviado');
	                //window.location="vistaContactanos.php";
				</script>	
                <?php
                //header("Location: usuarios.php");
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al enviar mensajeria
                    </div>';
            }
        }
    }
}
// fin de rutina de nuevos mensaje

// inhabilito
if ( isset($_GET["id"]) && $_GET["id"] != 0 ){
	$sq1= "UPDATE tabla_contactos SET estatus = 2 where id = " . $_GET["id"];
	//echo "<>" .$sq1;
	$query_insert = mysqli_query($conexion, $sq1);
	
}

// para eliminar
if(isset($_POST["modal_delete_contactanos"]) && $_POST["modal_delete_contactanos"] == "eliminar"){
	//echo "entre1 " . $_POST["id"];
	if( isset( $_POST["id"] ) && !empty( $_POST["id"] ) ){
						
		$stmt = $tablaContactos->deleteContacto ($_POST["id"]);
		if ( $stmt ){
			$alert = '<div class="alert alert-success" role="alert">
			El mensaje ha sido eliminado con exito!
			</div>';
		}else{
			$alert = '<div class="alert alert-danger" role="alert">
			El mensaje no pudo ser eliminado!
			</div>';
		}
	}
}

$id = "";
$date = "";
$usuario = "";
$telefono = "";
$enail = "";
$empresa = "";
$ciudad = "";
$comentario = "";
$direccion= "";
$website= "";
$estado="";
$ciudad = "";

if (isset($_GET['leido']) && $_GET['leido'] != 0 ){
	$query = "UPDATE tabla_contactos SET estatus=1 WHERE id=" . $_GET['leido'];
	$result = mysqli_query($conexion, $query);
}

if(isset($_GET["id"]) && $_GET["id"] != 0){
	$stmt = $tablaContactos->leerContactoId($_GET["id"], $_SESSION['tipoHive']);
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {	
		//echo "entre";
		$id = $_GET["id"];
		$date = $row['date'];
		$usuario = $row['usuario'];
		$telefono = $row['telefonoEmpresa'];
		$email = $row['emailEmpresa'];
		$empresa = $row['empresa'];
		$comentario = $row['comentario'];
		$direccion= $row['direccionEmpresa'];
		$website= $row['website'];
		$state=$row['estadoEmpresa'];
		$city = $row['ciudadEmpresa'];
	}
	if ($id == ""){
		$alert = '<div class="alert alert-danger" role="alert">
		El mensaje no pudo ser encontrado!
		</div>';
		//header('Location: vistaContactanos.php?error=$alert');	
	}
}
?>
