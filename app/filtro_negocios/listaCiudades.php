<?php
include "Conexion.php";
$dbSPA=connectSPA();
$query=$dbSPA->query("select * from ciudades where state=$_GET[edo_id]");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
print "<option value=''>Todas las ciudades</option>";
foreach ($states as $s) {
	print "<option value='$s->id'>$s->city</option>";
}
}else{
print "<option value=''>-- NO HAY DATOS --</option>";
}
?>