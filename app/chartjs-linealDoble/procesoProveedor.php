<?php
session_start();
// Declaramos el fichero de conexión
include_once("config.php");
$connection = mysqli_connect("localhost","root","","spa") or die("Error " . mysqli_error($connection));
//Cuantas visitas por categoria y mes total consulta

$condicion_catD = "";
if ( isset($_GET['condicion_catD']) ){
	$condicion_catD = $_GET['condicion_catD'];
}
	
$year = date('Y');
$mes = 8;
$total=array();
for ($pday = 1; $pday <= 31; $pday ++){
	/*$sql = "SELECT datetime, name, idcategoria, count(idcategoria) as total FROM bigdata_in a inner join php_combo.continente b
on (a.idcategoria = b.id) where month(datetime)='$month' and year(datetime)='$year' and name<>'' 
group by month(a.datetime), idcategoria";*/
	
	if($_SESSION['changeSubcatD']==1){
		if ($condicion_catM==""){
			$sql = "SELECT idempresa, month(datetime), day(datetime), name, idcategoria, count(idcategoria) as total 
			FROM bigdata_in a 
			inner join php_combo.continente b on (a.idcategoria = b.id) 
			where tipo=3  $condicion_catD and programa='fichaTecnica' and consultar=1  and
			day(datetime)='$pday' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), day(a.datetime), idcategoria";
		}else{
			// es categoria y se cuenta toda la categoria
			$sql = "SELECT idempresa, month(datetime), day(datetime), name, idsubcategoria, count(idsubcategoria) as total 
			FROM bigdata_in a inner join php_combo.pais b on (a.idsubcategoria = b.id) 
			where tipo=3  $condicion_catD and programa='fichaTecnica' and consultar=1 and 
			day(datetime)='$pday' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), day(a.datetime), idsubcategoria";
		}
	}else{
		if ($condicion_catD==""){
			/*$sql = "SELECT datetime, name, idsubcategoria, count(idsubcategoria) as total 
			FROM bigdata_in a 
			inner join php_combo.pais b on (a.idsubcategoria = b.id) 
			where tipo=3 $condicion_catM and programa='fichaTecnica' and consultar=1  and 
			month(datetime)='$month' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), idsubcategoria";*/
			
			$sql = "SELECT idempresa, month(datetime), day(datetime), name, idsubcategoria, count(idsubcategoria) as total 
			FROM bigdata_in a inner join php_combo.pais b on (a.idsubcategoria = b.id) 
			where tipo=3  $condicion_catD and programa='fichaTecnica' and consultar=1 and 
			day(datetime)='$pday' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), day(a.datetime), idsubcategoria";
			
		}else{
			$sql = "SELECT idempresa, month(datetime), day(datetime), name, idgrupo, count(idgrupo) as total 
			FROM bigdata_in a inner join php_combo.ciudad b on (a.idgrupo = b.id) 
			where tipo=3  $condicion_catD and programa='fichaTecnica' and consultar=1 and 
			day(datetime)='$pday' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), day(a.datetime), idgrupo";
		}
	}
	//echo $sql;
	//"select sum(monto) as total from tbl_ventas where month(venta_fecha)='$month' and year(venta_fecha)='$year'"		
	$query = $db->prepare($sql);
	$query->execute();
	$row = $query->fetch();
	$total[]=$row['total'];
}

$d1 = $total[0];
$d2 = $total[1];
$d3 = $total[2];
$d4 = $total[3];
$d5 = $total[4];
$d6 = $total[5];
$d7 = $total[6];
$d8 = $total[7];
$d9 = $total[8];
$d10 = $total[9];
$d11 = $total[10];
$d12 = $total[11];
$d13 = $total[12];
$d13 = $total[13];
$d14 = $total[14];
$d15 = $total[15];
$d16 = $total[16];
$d17 = $total[17];
$d18 = $total[18];
$d19 = $total[19];
$d20 = $total[20];
$d21 = $total[21];
$d22 = $total[22];
$d23 = $total[23];
$d24 = $total[24];
$d25 = $total[25];
$d26 = $total[26];
$d27 = $total[27];
$d28 = $total[28];
$d29 = $total[29];
$d30 = $total[30];
// cuantas visitas a negocios por categoria por mes
$year = $year;
$mes = 8;
$pnum=array();
for ($pmonth = 1; $pmonth <= 31; $pmonth ++){
	if($_SESSION['changeSubcatD']==1){
		if ($condicion_catD==""){
			$sql = "SELECT idempresa, month(datetime), day(datetime), name, idcategoria, count(*) as ptotal 
			FROM bigdata_in a inner join php_combo.continente b on (a.idcategoria = b.id) 
			where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 $condicion_catD and programa='fichaTecnica' and consultar=1  and  
			day(datetime)='$pmonth' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), day(a.datetime), idcategoria";
		}else{				
			$sql = "SELECT idempresa, month(datetime), day(datetime), name, idcategoria, count(*) as ptotal 
			FROM bigdata_in a inner join php_combo.pais b on (a.idsubcategoria = b.id) 
			where idempresa =" . $_SESSION['companyHive'] . " and tipo=3 $condicion_catD and programa='fichaTecnica' and consultar=1  and 
			day(datetime)='$pmonth' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), day(a.datetime), idsubcategoria";
		}
	}else{
		$sql = "SELECT idempresa, month(datetime), day(datetime), name, idcategoria, count(*) as ptotal 
		FROM bigdata_in a inner join php_combo.continente b on (a.idcategoria = b.id) 
		where day(datetime)='$pmonth' and month(datetime)='$mes' and year(datetime)='$year' and name<>'' 
		group by month(a.datetime), day(a.datetime), idcategoria";
	}
	
	
	//echo "<br>".$sql;
// "select sum(monto) as ptotal from tbl_ventas where month(venta_fecha)='$pmonth' and year(venta_fecha)='$pyear'"		
	$pquery = $db->prepare($sql);
	$pquery->execute();
	$prow = $pquery->fetch();
	$pnum[]=$prow['ptotal'];
}

$p1 = $pnum[0];
$p2 = $pnum[1];
$p3 = $pnum[2];
$p4 = $pnum[3];
$p5 = $pnum[4];
$p6 = $pnum[5];
$p7 = $pnum[6];
$p8 = $pnum[7];
$p9 = $pnum[8];
$p10 = $pnum[9];
$p11 = $pnum[10];
$p12 = $pnum[11];
$p13 = $pnum[12];
$p14 = $pnum[13];
$p15 = $pnum[14];
$p16 = $pnum[15];
$p17 = $pnum[16];
$p18 = $pnum[18];
$p19 = $pnum[19];
$p20 = $pnum[20];
$p21 = $pnum[21];
$p22 = $pnum[22];
$p23 = $pnum[23];
$p24 = $pnum[24];
$p25 = $pnum[25];
$p26 = $pnum[26];
$p27 = $pnum[27];
$p28 = $pnum[28];
$p29 = $pnum[29];
$p30 = $pnum[30];	
?>