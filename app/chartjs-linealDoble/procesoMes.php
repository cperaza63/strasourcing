<?php
// Declaramos el fichero de conexión
include_once("config.php");
	
	$condicion_catM = "";
	if ( isset($_GET['condicion_catM']) ){
		$condicion_catM = $_GET['condicion_catM'];
	}
	$connection = mysqli_connect("localhost","root","","spa") or die("Error " . mysqli_error($connection));
	
	
	//Cuantas visitas por categoria y mes
	$year = date('Y');
	$total=array();
	for ($month = 1; $month <= 12; $month ++){
		
		if($_SESSION['changeSubcatM']==1){
			if ($condicion_catM==""){
				// es categora y se cuenta las categorias en general
				$sql = "SELECT datetime, name, idcategoria, count(idcategoria) as total 
				FROM bigdata_in a 
				inner join php_combo.continente b on (a.idcategoria = b.id) 
				where month(datetime)='$month' and year(datetime)='$year' and name<>'' 
				group by month(a.datetime), idcategoria";
			}else{
				// es categoria y se cuenta toda la categoria
				
				$sql = "SELECT datetime, name, idsubcategoria, count(idsubcategoria) as total 
				FROM bigdata_in a 
				inner join php_combo.pais b on (a.idsubcategoria = b.id) 
				where tipo=3 and $condicion_catM and programa='fichaTecnica' and consultar=1 
				and month(datetime)='$month' and year(datetime)='$year' and name<>'' 
				group by month(a.datetime), idsubcategoria";
			}
		}else{
			if ($condicion_catM==""){
				$sql = "SELECT datetime, name, idsubcategoria, count(idsubcategoria) as total 
				FROM bigdata_in a 
				inner join php_combo.pais b on (a.idsubcategoria = b.id) 
				where tipo=3 $condicion_catM and programa='fichaTecnica' and consultar=1  and 
				month(datetime)='$month' and year(datetime)='$year' and name<>'' 
				group by month(a.datetime), idsubcategoria";
			}else{
				$sql = "SELECT datetime, name, idgrupo, count(idgrupo) as total 
				FROM bigdata_in a 
				inner join php_combo.ciudad b on (a.idgrupo = b.id) 
				where tipo=3 $condicion_catM and programa='fichaTecnica' and consultar=1  and 
				month(datetime)='$month' and year(datetime)='$year' and name<>'' 
				group by month(a.datetime), idgrupo";
			}
		}
		
		//echo $sql;
		
		/*if($_SESSION['changeSubcatM']==1){			
			$sql = "SELECT datetime, name, idcategoria, count(idcategoria) as total 
			FROM bigdata_in a 
			inner join php_combo.continente b on (a.idcategoria = b.id) 
			where month(datetime)='$month' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), idcategoria";
		}else{
			$sql = "SELECT datetime, name, idcategoria, count(idcategoria) as total 
			FROM bigdata_in a 
			inner join php_combo.continente b on (a.idcategoria = b.id) 
			where month(datetime)='$month' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), idcategoria";
		}*/
		//"select sum(monto) as total from tbl_ventas where month(venta_fecha)='$month' and year(venta_fecha)='$year'"		
		$query = $db->prepare($sql);
		$query->execute();
		$row = $query->fetch();
		$total[]=$row['total'];
	}

	$tjan = $total[0];
	$tfeb = $total[1];
	$tmar = $total[2];
	$tapr = $total[3];
	$tmay = $total[4];
	$tjun = $total[5];
	$tjul = $total[6];
	$taug = $total[7];
	$tsep = $total[8];
	$toct = $total[9];
	$tnov = $total[10];
	$tdec = $total[11];

	// cuantas visitas a negocios por categoria por mes
	$year = $year;
	$pnum=array();
	for ($pmonth = 1; $pmonth <= 12; $pmonth ++){
		$sql = "SELECT datetime, name, count(*) as ptotal 
		FROM bigdata_in a 
		inner join php_combo.continente b on (a.idcategoria = b.id) 
		where month(datetime)=$pmonth and year(datetime)='$year' and name<>'' 
		group by month(a.datetime), idcategoria";
	
		if($_SESSION['changeSubcatM']==1){
			if ($condicion_catM==""){
				$sql = "SELECT datetime, name, idcategoria, count(idcategoria) as ptotal 
				FROM bigdata_in a 
				inner join php_combo.continente b on (a.idcategoria = b.id) 
				where month(datetime)='$pmonth' and year(datetime)='$year' and name<>'' 
				group by month(a.datetime), idcategoria";
			}else{
				$sql = "SELECT datetime, name, idsubcategoria, count(idsubcategoria) as ptotal 
				FROM bigdata_in a 
				inner join php_combo.pais b on (a.idsubcategoria = b.id) 
				where idcategoria = " . $_SESSION['idcategoriaM'] . " and month(datetime)='$pmonth' and year(datetime)='$year' and name<>'' 
				group by month(a.datetime), idsubcategoria";				
			}
		}else{
			$sql = "SELECT datetime, name, idcategoria, count(idcategoria) as ptotal 
			FROM bigdata_in a 
			inner join php_combo.continente b on (a.idcategoria = b.id) 
			where month(datetime)='$pmonth' and year(datetime)='$year' and name<>'' 
			group by month(a.datetime), idcategoria";
		}
		
 		//echo "<br>".$sql;
 	// "select sum(monto) as ptotal from tbl_ventas where month(venta_fecha)='$pmonth' and year(venta_fecha)='$pyear'"		
		$pquery = $db->prepare($sql);
		$pquery->execute();
		$prow = $pquery->fetch();
		$ptotal[]=$prow['ptotal'];
	}
	
	$pjan = $ptotal[0];
	$pfeb = $ptotal[1];
	$pmar = $ptotal[2];
	$papr = $ptotal[3];
	$pmay = $ptotal[4];
	$pjun = $ptotal[5];
	$pjul = $ptotal[6];
	$paug = $ptotal[7];
	$psep = $ptotal[8];
	$poct = $ptotal[9];
	$pnov = $ptotal[10];
	$pdec = $ptotal[11];
?>