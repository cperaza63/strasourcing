<?php
session_start();
if(isset($_SESSION['idUsuario'])){
	session_destroy();	
}
include_once 'config/conexion.php';
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

if( isset($_POST['cambioPassword']) && $_POST['cambioPassword'] !=""){
	
	$usuarios->usuario = strtolower($_POST['login']);
	$usuarios->email = $_POST['email'];
	$stmt = $usuarios->readUserLogin();
	$i=0;
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) )
	{	
		$i = 1;
		// mando el email a ciudadhive para sepan que hay un recordatorio
		$email = $_POST['email'];
		$contacto = $_POST['login'];
		$asunto		  ="Cambio de Clave del usuario " . $contacto . " en el sistema de StraSourcing...";
		$mensajeEmail = "<a href='http://localhost/strasourcing/app/cambioClave.php?u=".$_SESSION['iduserHive']."'>Por favor haga click AQUI para dirigirlo al programa de cambio de clave...</a>";
		$retorno= "http://localhost/strasourcing/app/outside.php";
		$cadena = "http://localhost/strasourcing/app/enviarcorreo/index.php?email=" . $email . "&contacto=" . $contacto . "&usuario=" . $_SESSION['iduserHive'] . "&asunto=" . $asunto. " &mensaje=" . $mensajeEmail . "&retorno=" . $retorno;

		//echo "<br>" . $cadena;
		
		?>
		<script>
		alert("<?php echo $asunto . ", Vamos a enviar a su correo la infomacion para el cambio de Clave, por favor dirijase a su cuenta de correo para colocar su nueva clave de acceso. Recuerde que es posible que este email caiga en lista de Sopam, de ser asi por favor reactivelo como NO SPAM..."; ?>");
		window.location="<?php echo $cadena; ?>";
		</script> 
		<?php
	}	
	//Los datos suministrados no concuerdan con la base de datos, por favor revise...	
	if ( $i == 0 ){
		$alert = '<div class="alert alert-danger" role="alert">
		</div>';
		echo $alert;
	}
}

if(!isset($_SESSION['dashboard'])){
	$_SESSION['dashboard']="";
}

if( isset($_GET['ll']) && $_GET['pp'] !=""){
	$_POST['username'] = $_GET['ll'];
	$_POST['password'] = $_GET['pp'];
}

if (isset($_POST['username']) && isset($_POST['password'])) {
	$alert = '';
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$alert = '<div class="alert alert-danger" role="alert">
		Ingrese su usuario y su clave
		</div>';
		echo $alert;
	} else {
		$usuarios->usuario = strtolower($_POST['username']);
		$usuarios->clave = $_POST['password'];
		
		if( isset($_GET['ll']) && $_GET['ll'] !=""){
			$stmt = $usuarios->readUserAdmin();
		}else{
			$stmt = $usuarios->readUser();	
		}
			
		$i=0;
		while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) )
		{	
			$_SESSION['dashboard'] = "dashboard.php";
			$i++;
			// userHive es el company_padre que esta logueado
			$_SESSION['companyHive'] = $row['userhive'];
			// idUsuario es el user_id que esta logueado
			$_SESSION['iduserHive'] = $row['idusuario'];
			// idUsuario es el nombre que esta logueado
			$_SESSION['nombreHive'] = $row['nombre'];
			// nombre es el login del usuario conectado
			$_SESSION['loginHive'] = strtolower($row['usuario']);
			// estado es el estatus del usuario, 1:activo
			$_SESSION['estadoHive'] = $row['estado'];
			// tipo es la clasificacion del usuario, 1:admin, 2:asistente, 3:empresa, 4:proveedor
			$_SESSION['tipoHive'] = $row['tipo'];
			$_SESSION['imagenHive'] = $row['imagen'];
			$_SESSION['folderHive'] = $row['folder'];
			
			if( $_SESSION['tipoHive'] == 3 ){
				$_SESSION['dashboard'] = "dashboard_Compradores.php";
				// busco el rif de la empresa si
				$stmt = $empresas->LeerEmpresaId($_SESSION['companyHive']);
				$i=0;
				while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) )
				{	
					$i++;
					$_SESSION['rifHive'] = $row['numero_rif'];
					$_SESSION['razonSocialHive'] = $row['razon_social'];
					$_SESSION['logoHive'] = $row['logo_imagen'];
					$_SESSION['emailEmpresa'] = $row['email_empresa'];
					
					$_SESSION['diasVencidos'] = 0;
					$_SESSION['diasVigente'] = 0;
					
					// verfico si esta al dia con el contrato
					$fechaActual = date('Y-m-d'); 
					$datetime1 = date_create($row['fecha_contrato']);
					$datetime2 = date_create($fechaActual);
					$interval = $datetime1->diff($datetime2);
					if($datetime2 == $datetime1) {
						$_SESSION['diasVencidos'] = $interval->format('%a') * 1 ;
						$_SESSION['diasVigente'] =0;
						
					}else{
						if($datetime2 > $datetime1) {
							$_SESSION['diasVigente'] = $interval->format('%a') * 1;
							$_SESSION['diasVencidos'] =0;
							
							// mando el email a ciudadhive para sepan que hay un recordatorio
							$email = $_SESSION['emailEmpresa'];
							$contacto = "Comprador " . $_SESSION['razonSocialHive'] . " Cta: " . $_SESSION['companyHive'];
							$asunto		  ="Su cuenta " .$_SESSION['companyHive']. " de StraSourcing esta suspendida...";
							$mensajeEmail = "Usted debera ponerse al corriente con el pago de su afilición anual con StraSourcing....";
							$retorno= "http://localhost/strasourcing/app/outside.php";
							$cadena = "http://localhost/strasourcing/app/enviarcorreo/index.php?email=" . $email . "&contacto=" . $contacto . "&usuario=" . $_SESSION['iduserHive'] . "&asunto=" . $asunto. " &mensaje=" . $mensajeEmail . "&retorno=http://localhost/strasourcing/app/outside.php";
                            ?>
							<script>
							alert("<?php echo $asunto . ", se ha denegado el acceso al sistema"; ?>");
							window.location="<?php echo $cadena; ?>";
							</script>
							<?php
						}else{
							$_SESSION['diasVigente'] = $interval->format('%a') * 1;
							$_SESSION['diasVencidos'] =0;
						}
					}
				}

			}else{
				if( $_SESSION['tipoHive'] == 4 ){
					$_SESSION['dashboard'] = "dashboard_Proveedores.php";
					// busco el rif de la empresa si
					$stmt = $proveedores->LeerProveedorId($_SESSION['companyHive']);
					$i=0;
					while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) )
					{	
						$i++;
						$_SESSION['rifHive'] = $row['numero_rif'];
						$_SESSION['razonSocialHive'] = $row['razon_social'];
						$_SESSION['logoHive'] = $row['logo_imagen'];
						$_SESSION['emailEmpresa'] = $row['email_empresa'];
						
						$_SESSION['diasVencidos'] = 0;
						$_SESSION['diasVigente'] = 0;
						
						// verfico si esta al dia con el contrato
						$fechaActual = date('Y-m-d'); 
						$datetime1 = date_create($row['fecha_contrato']);
						$datetime2 = date_create($fechaActual);
						$interval = $datetime1->diff($datetime2);
						if($datetime2 == $datetime1) {
							$_SESSION['diasVencidos'] = $interval->format('%a') * 1 ;
							$_SESSION['diasVigente'] =0;
							
						}else{
							if($datetime2 > $datetime1) {
								$_SESSION['diasVigente'] = $interval->format('%a') * 1;
								$_SESSION['diasVencidos'] =0;
								
								// mando el email a ciudadhive para sepan que hay un recordatorio
								$email = $_SESSION['emailEmpresa'];
								$contacto = "Proveedor " . $_SESSION['razonSocialHive'] . " Cta: " . $_SESSION['companyHive'];
								$asunto		  ="Su cuenta " .$_SESSION['companyHive']. " de StraSourcing esta suspendida...";
								$mensajeEmail = "Usted debera ponerse al corriente con el pago de su afilición anual con StraSourcing....";
								$retorno= "http://localhost/strasourcing/app/outside.php";
								$cadena = "http://localhost/strasourcing/app/enviarcorreo/index.php?email=" . $email . "&contacto=" . $contacto . "&usuario=" . $_SESSION['iduserHive'] . "&asunto=" . $asunto. " &mensaje=" . $mensajeEmail . "&retorno=http://localhost/strasourcing/app/outside.php";
								?>
								<script>
								alert("<?php echo $asunto . ", se ha denegado el acceso al sistema"; ?>");
								window.location="<?php echo $cadena; ?>";
								</script>
								<?php
							}else{
								$_SESSION['diasVigente'] = $interval->format('%a') * 1;
								$_SESSION['diasVencidos'] =0;
							}
						}
					}	
				}else{
					$_SESSION['dashboard'] = "dashboard.php";	
				}
			}		

			// AGREGA AL BIGDATA
			date_default_timezone_set("America/Caracas"); 
			$bigdata->idusuario = $_SESSION['iduserHive'];
			$bigdata->datetime = date('Y-m-d H:i:s');
			$bigdata->programa = 'login';
			$bigdata->agregar = 0;
			$bigdata->modificar = 0;
			$bigdata->eliminar = 0;
			$bigdata->consultar = 1;
			$bigdata->idempresa = $_SESSION['companyHive'];
			$bigdata->tipo = $_SESSION['tipoHive'];
			$bigdata->idmarca = 0;
			$bigdata->idorigen = 0;
			$bigdata->idcategoria = 0;
			$bigdata->idsubcategoria = 0;
			$bigdata->idgrupo = 0;
			$bigdata->preferencia = 0;
			$bigdata->nombre_filtro = '';
			$bigdata->estado = 0;
			$bigdata->ciudad = 0;
			$bigdata->tipo_empresa = 0;
			$bigdata->sector = 0;
			$bigdata->internet = 0;
			$bigdata->verificacion = 0;
			$stmt = $bigdata->crearBigdata();
			?>
			<script>
			//alert('<?php echo $_SESSION['dashboard']; ?>')
			window.location="<?php echo $_SESSION['dashboard']; ?>?login=1";
			</script>
			<?php
		}
	
		if( $i == 0 ){
			$alert = '<div class="alert alert-danger" role="alert">
			La Contraseña, Usuario esta(n) Incorrecto(s), o el usuario no existe o no esta activo...
			</div>';
			echo $alert;	
		}
	}
}
?>