<?php 
session_start();
// MySQL database connection code
$connection = mysqli_connect("localhost","root","","spa") or die("Error " . mysqli_error($connection));
//Fetch productos data
$sql = "SELECT year(a.datetime) as ano, b.name, count(a.idcategoria) as cuantos
FROM bigdata_in a inner join php_combo.continente b on (a.idcategoria = b.id)
where idempresa =" . $_SESSION['companyHive'] . " and a.idcategoria>0 and name<>'' and year(datetime) >= 2023 
and tipo=3 and programa='fichaTecnica' and consultar=1
group by a.idcategoria";
//echo $sql;
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
//create an array
$array = array();
$i = 0;
while($row = mysqli_fetch_assoc($result))
{  
    $producto = $row['name'];
    $unidades_vendidas = $row['cuantos'];
    $array['cols'][] = array('type' => 'string'); 
    $array['rows'][] = array('c' => array( array('v'=> $producto), array('v'=>(int)$unidades_vendidas)) );
	
	//$producto = 'Otros';
//    $unidades_vendidas = 20;
//    $array['cols'][] = array('type' => 'string'); 
//    $array['rows'][] = array('c' => array( array('v'=> $producto), array('v'=>(int)$unidades_vendidas)) );
	
}
$data = json_encode($array);
echo $data;
?>