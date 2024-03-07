<?php
//
// validamos que el usuario pueda agregar - modificar - eliminar - consultar
//

//echo "==". $_SESSION['iduserHive'] .  ", " .  $_SESSION['codigo_programa'];
$stmt = $otrosUsuarios->LeerUsuarioAcceso($_SESSION['iduserHive'], $_SESSION['codigo_programa']); 

$nombrPrograma = [
"138" => "DashBoard",
"140" => "*** Tabla de Usuarios ***",
"141" => "*** Tabla de Empresas ***",
"142" => "*** Tabla de Proveedores ***",
"143" => "*** Tabla de Estados y Ciudades ***",
"144" => "*** Catefgorias y Subcategorias ***",
"145" => "*** Tablas de Control ***",
"146" => "*** Tabla de contactos al sistema ***",
"147" => "*** Perfil de usuarios ***",
"148" => "*** Información de la empresa ***",
"149" => "*** Directorio de proveedores ***",
"150" => "*** Información del proveedor ***",
"208" => "*** Recomendacion del proveedor ***"
];

$siHay = 0;

while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) 
{
	$siHay=1;
	break;
}

if( $_SESSION['tipoHive'] == 1 ){
	$siHay = 1;
}

if($siHay == 0){
?>
	<script>
        window.location="<?php echo $_SESSION['dashboard']; ?>?mensajeError=Usted no tiene permiso para trabajar en este programa <?php echo $nombrPrograma[$_SESSION['codigo_programa']]?>"
    </script>
    <?php	
}
//
// fin de la rutina de validacion de acceso
//
?>