<?php
    $host = "localhost";
    $user = "root";
    $clave = "";
    $bd = "spa";
    $conexion = mysqli_connect($host,$user,$clave,$bd);
    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos";
        exit();
    }
    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos de sis_ventas");
    mysqli_set_charset($conexion,"utf8");
	
    $bd = "lacolmenave";

	$conexion_lacolmena = mysqli_connect($host,$user,$clave,$bd);
    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos de la colmena";
        exit();
    }
    mysqli_select_db($conexion_lacolmena,$bd) or die("No se encuentra la base de datos");
    mysqli_set_charset($conexion_lacolmena,"utf8");
	
	
?>
