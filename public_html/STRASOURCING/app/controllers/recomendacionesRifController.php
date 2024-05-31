<?php 

$error= "";
$pasa=1;

//Declaramos una variable para almacenar errores y mostrarlos después
$errores =""; 
$siva="0";

//echo "<br>leido = " . $_GET['asunto']. " " . $_GET['leido'];
if (isset($_GET['asunto']) && $_GET['asunto'] == 11 ){
	if (isset($_GET['leido']) && $_GET['leido'] != 0 ){
		$query = "UPDATE tabla_contactos SET estatus=1 WHERE asunto= " . $_GET['asunto'] . " and solicitud_categoria=" . $_GET['leido'];
		$result = mysqli_query($conexion, $query);
	}
}

if(!isset ($_SESSION['consulta_rif'])){
	$_SESSION['consulta_rif'] = "";
}
	
if(isset ($_POST['rif'])){
	$_SESSION['consulta_rif'] = $_POST['rif'];
}

$activarModal = "N";
$rif_seleccion = "";
if(isset($_POST['accion']) && $_POST["accion"] == "modalSolicitar"){
	$activarModal = "Y";
	$rif_seleccion = $_SESSION['consulta_rif'];
	//echo "vamos con ".$rif_seleccion;
}

if(!isset ($_GET['accionR'])){
	$_SESSION['accionR'] = "";
}
if(isset ($_GET['accionR']) && $_GET['accionR'] != "" ){
	$_SESSION['accionR'] = $_GET['accionR'];
}
$rif_seleccion = "";

if(isset($_POST['accion']) && $_POST['accion'] == "recomendar"){
	echo "=solicitar_categoria=" . $_POST['solicitar_categoria'];
	echo "=Rs=" . $_POST['razon_social'];
	echo "=Nr=" . $_POST['numero_rif'];	
	
	$condiciones_pago 	= ($_POST['condiciones_pago'] - 1 ) * 10;
	$negociaciones 		= ($_POST['negociaciones'] - 2 ) * 10;
	$tiempo_entrega 	= ($_POST['tiempo_entrega'] - 3 ) * 10;
	$calidad 			= ($_POST['calidad'] - 4 ) * 10;
	$garantia 			= ($_POST['garantia'] - 5 ) * 10;
	$soporte 			= ($_POST['soporte'] - 6 ) * 10;
	$puntuacion = $condiciones_pago + $negociaciones + $tiempo_entrega + $calidad + $garantia + $soporte;
	//echo "<br>Puntuacion = " . $puntuacion;
	
	$query = "DELETE FROM evaluacion WhERE solicitud_categoria = " . $_POST['solicitar_categoria'];
	$result = mysqli_query($conexion, $query);
	//
	$sql = "INSERT INTO evaluacion ( idCompany, idProveedor, rif, condiciones_pago, negociaciones, tiempo_entrega, calidad,
	garantia, soporte, solicitud_categoria, puntuacion) Values (" . 
	$_SESSION['companyHive'] .", " . 
	$_POST['idProveedor'] . ", '" . $_POST['numero_rif'] . 
	"', $condiciones_pago, $negociaciones, $tiempo_entrega, $calidad, $garantia, $soporte, " . $_POST['solicitar_categoria'] . ", $puntuacion )";
	//echo "<br>" . $sql;
	$result = mysqli_query($conexion, $sql);
	//
	$query = "UPDATE solicitud_categorias SET estatus = " . $_POST['recomiendo'] . " WhERE ID = " . $_POST['solicitar_categoria'];
	$result = mysqli_query($conexion, $query);
	//
}

//echo "Se agrego sin problemas";
if( isset( $_GET['rifExt'] ) && $_GET['rifExt'] != "" ){
	// preparamos los datos del email de respuesta
	$stmt = $empresas->readRif($_GET['rifExt']); 
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
	{		
		$link_evaluacion= "<a href='http://localhost/strasourcing/app/recomendacionesEmpRif.php?rif=".$_GET['rifExt']."'>Click aqui para referirlo al programa</a>";
		
		$email = $row['email_empresa'];
		$contacto = $row['contacto_nombre'];
		$adminNombre =  $row['contacto_nombre'].", " . $row['email_empresa'];
		
		$asunto = "La empresa " . $row['razon_social']. " la cual pertenece al registro de StraSourcing Venezuela";
		
		$mensajeEmail = "El sistema Strasourcing en una plataforma donde concurren proveedores y compradores en pro de lograr conexiones efectivas en el campo de procura y abastecimiento. <br>Dentro de las herramientas de StraSourcing esta la facilidad de poder evaluar a un Proveedor que Ustedes conocen muy bien.<br>Nuestro proceso de evaluacion al proveedor esta establecido por una serie de preguntas que Usted podra responder por cada categoria en la cual su proveedor les ha prestado servicio.<br>Usted podra reponder por cada categoria por separado y sus respuestas seran reenviadas al sistema lo que servira de buena referencia al momento de ser contactado por los compradores quienes hacen vida en StraSourcing.<br>$link_evaluacion";
		
		$retorno = "http://localhost/strasourcing/app/recomendaciones.php";
		
		$wl = "http://localhost/strasourcing/app/enviarcorreo/index.php?email=$email&contacto=$contacto&usuario=$adminNombre&asunto=$asunto&retorno=$retorno&link=$link_evaluacion&mensaje=$mensajeEmail";
		
		
		$query = "UPDATE solicitud_categorias set enviado=1 WhERE ID = " . $_GET['idSolicitud'];
		//echo "<br>" . $query;
		$result = mysqli_query($conexion, $query);
		?>
		<script>
			alert("La solicitud ha sido enviada por email con exito, Su cliente recibirá una notificación por email para invitarlo a que responda al cuestionario del sistema de StraSourcing...");
			window.location="<php echo $wl; ?>";
		</script>
		<?php
	}
}

if( $_SESSION['consulta_rif'] != ""){	
	if(isset($_POST['accion']) && $_POST['accion'] == "incluir"){
		//echo "accion = " .$_POST['accion'] . " " . $_SESSION['consulta_rif'];
		$stmt = $empresas->readRif($_SESSION['consulta_rif']); 
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
		{		
			//echo "entre";
			$idEmpresa = $row['id'];
			$rif_seleccion = $row['numero_rif'];
			//echo "<br>===". $rif_seleccion  ;
			if( isset( $rif_seleccion ) && $rif_seleccion  !="" ){
				$siHay = 0;	
				// procedemos a crear el detalle de categorias
				if (isset($_POST['accion']) && $_POST['accion'] == "incluir"){
					$lista_cat = $_POST["categorias"]; 
					//recorremos el array de categorias seleccionadas
					for ($i=0;$i<count($lista_cat);$i++)    
					{     
						//echo "<br> Categorias " . $i . ": " . $lista_cat[$i];
						// borro las categorias
						$query = "DELETE FROM solicitud_categorias WhERE categoria = ".  $lista_cat[$i] . 
						" and rif='" . $rif_seleccion ."' and idCompany = " . $_SESSION['companyHive'];
						//echo "<br>" . $query;
						$result = mysqli_query($conexion, $query);
						// creo los registros de categorias
						$query = "SELECT * FROM solicitud_categorias WhERE categoria = ".  $lista_cat[$i] . 
						" and rif='" . $rif_seleccion ."' and idCompany = " . $_SESSION['companyHive'];
						//echo "<br>".$query;
						$result = mysqli_query($conexion, $query);
						if ( !$result ) {
							die('Query Failed...');
						}else{
							$siCat = 0;
							
							$query = "INSERT into solicitud_categorias(rif, idCompany, categoria) 
							VALUES ('" . $rif_seleccion ."', " . $_SESSION['companyHive'] . ", " . $lista_cat[$i] . ")"; 
							//echo "<br>                           ".$query;
							$result = mysqli_query($conexion, $query);	
							if ( !$result ){
								die('Query Failed!');
							}
							
							//echo " ahora colocamos el mensaje en el archivo tabla_contactos";
							$tablaContactos->usuario	  = $_SESSION['loginHive'];
							$tablaContactos->rifEnvia = $_SESSION['rifHive'];
							$tablaContactos->rifDestino = $_SESSION['consulta_rif'] ;
							$tablaContactos->companyEnvia = $_SESSION['companyHive'];
							$tablaContactos->companyDestino = $idEmpresa;
							$tablaContactos->empresa 	= $_SESSION['nombreHive'];
							$tablaContactos->asunto 	= 12; 
							$tablaContactos->comentario = "Solicitud de Recomendación recomendacion #". $lista_cat[$i] ." del proveedor #".$_SESSION['companyHive'];	
							$tablaContactos->crearContactoAempresa($_SESSION['consulta_rif'], $lista_cat[$i], $_SESSION['companyHive'], $_SESSION['rifHive'] );
							
							//$companyHive, $solicitud_categoria, $idProveedor 
							// emperesa proveedor, idEmpresa
							?>
							<script>
								alert("La solicitud de recomendacion a la empresa ha sido creada con exito...");
								window.parent.location="http://localhost/strasourcing/app/recomendaciones.php";
							</script>
							<?php	
						}	
					} 	
				}
			}
		}
	}
}
?>