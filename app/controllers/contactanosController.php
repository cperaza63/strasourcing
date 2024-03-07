<?php 
//echo "<br><br><br><br>llegue a contact";
$pais = "VE";
$alert = "";
$usuario = "";
$telefono = "";
$email = "";
$contacto="";
$empresa = "";
$estado = "";
$ciudad = "";
$asunto = "";
$comentario = "";
$direccion = "";
$website = "";
$mensajeEmail = "";

include_once 'config/database.php';
include_once 'objects/tablaContacto.php';
include_once 'objects/estadoCiudades.php';

$database = new Database ();
$db = $database->getConnection ();
$tablaContactos = new TablaContactos ( $db );
$estadosCiudades = new EstadosCiudades ( $db );

if( isset( $_POST["grabarDatos"] ) && !empty($_POST["grabarDatos"]) ){
    // validamos los campos
    if( 
	(!isset($_POST['usuario']) || empty($_POST['usuario']))  || 
	(!isset($_POST['empresa']) || empty($_POST['empresa']))  || 
	(!isset($_POST['telefono']) || empty($_POST['telefono']))  || 
	(!isset($_POST['email']) || empty($_POST['email']))  || 
	(!isset($_POST['estados']) || empty($_POST['estados']))  || 
	(!isset($_POST['ciudades']) || empty($_POST['ciudades']))  || 
	(!isset($_POST['asunto']) || empty($_POST['asunto']))  || 
	(!isset($_POST['comentario']) || empty($_POST['comentario']))  || 
	(!isset($_POST['website']) || empty($_POST['website'])) ||
	(!isset($_POST['direccion']) || empty($_POST['direccion'])) 
	){
		echo "=" . $_POST['usuario'] . " " . $_POST['empresa'] . " " . $_POST['telefono'] . " " . $_POST['email'] . " " . $_POST['etados'] . " " . $_POST['ciudades'] . " " . $_POST['asunto'] . " " . $_POST['comentario'] . " " . $_POST['website'] . " " . $_POST['direccion'] . " ";
        ?>
            <script>
                alert("Existe(n) campos que estan vacios, por favor revise...");
                //history.go(-1);
            </script>
        <?php
    }else{
		$tablaContactos->usuario = $_POST['usuario'];
		$tablaContactos->empresa = $_POST['empresa'];
		$tablaContactos->email = $_POST['email'];
		$tablaContactos->telefono = $_POST['telefono'];
		$tablaContactos->estado = $_POST['estados'];
		$tablaContactos->ciudad = $_POST['ciudades'];
		$tablaContactos->asunto = $_POST['asunto'];
		$tablaContactos->comentario = $_POST['comentario'];
		$tablaContactos->direccion = $_POST['direccion'];
		$tablaContactos->website = $_POST['website'];
		$stmt = $tablaContactos->crearContacto();
		
		
		// mando el email a ciudadhive para sepan que hay email
		$email = "carlosperazavz@hotmail.com";
		$contacto = "Carlos Peraza";
		$asunto		  ="Una empresa lo ha contactado por medio del servicio de contactos del sistema...";
		$mensajeEmail = "Hay un nuevo mensaje de contacto para CiudadHive, Empresa: " . $_POST['empresa'] . 
		"<br>Telefono: " . $_POST['telefono']. "<br>Email: ".$_POST['email']. "<br><br>Mensaje: ".$_POST['comentario'];
		
		//echo $mensajeEmail;
		?>
		<script>
		  swal({
			title: 'Gracias por contactarnos!',
			text: 'Uno de nuestros promotores estará en contacto con Usted pronto...',
			timer: 2000,
			padding: '2em',
			onOpen: function () {
			  swal.showLoading()
			}
		  }).then(function (result) {
			if (
			  // Read more about handling dismissals
			  result.dismiss === swal.DismissReason.timer
			) {
			  window.location="http://localhost/strasourcing/app/enviarcorreo/index.php?email=<?php echo $email; ?>&contacto=<?php echo $contacto; ?>&usuario=<?php echo $_POST['usuario']; ?>&asunto=<?php echo $asunto; ?>&mensaje=<?php echo $mensajeEmail?>&retorno=http://localhost/strasourcing/app/outside.php";
			}
		  })
		</script>
		<?php
	}
}
?>