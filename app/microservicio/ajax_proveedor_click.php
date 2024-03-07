<?php
header('Access-Control-Allow-Origin: *');
include('../config/conexion.php');
$categoria = "";
//echo "id = " . $_GET['id'];
if ( isset($_GET['id']) ){
	$id = $_GET['id'];
	$query = "SELECT idempresa, b.razon_social, date(datetime) as fecha, count(*) as contador, day(datetime) as dia, month(datetime) as mes, year(datetime) as ano 
	FROM bigdata_in a inner join proveedores b on (a.idempresa = b .id) where consultar=1 and tipo=4 
	and programa = 'directorioCategorias' and idempresa = $id 
	group by date(datetime)";
	//echo $query;
	$result = mysqli_query($conexion, $query);
	if ( !$result ) {
		die('Query Failed...');
	}
	$json = array();
	// ahora el resultado lo convertimos en un objeto json
	while( $row = mysqli_fetch_array( $result ) ) {
		$json[] = array(
		'idempresa' => $row['idempresa'],
		'razon_social' => $row['razon_social'],
		'fecha' => $row['fecha'],
		'contador' => $row['contador'],
		'dia' => $row['dia'],
		'mes' => $row['mes'],
		'ano' => $row['ano'],
		);
	}
	// teniendo el objeto [] json creado necesitamos convertirlo a cadena string para poder  transportarlo por la internet
	$jsonstring = json_encode($json);
	echo $jsonstring;
}else{
	echo 0;
}

?>