<?php
session_start();
include "Conexion.php";
$db=connect();
$query=$db->query("select * from pais where continente_id=$_GET[continente_id]");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
	if( $_GET['pais_id'] == $s->id ){
		$seleccion = " selected ";
	}else{
		$seleccion = "";
	}
	
	
	print "<option value=''>-- SELECCIONE PAIS -- <?php  echo $_SESSION[continente_id]; ?></option>";
	foreach ($states as $s) {
		print "<option value='$s->id' >$s->name</option>";
}
}else{
print "<option value=''>-- NO HAY DATOS --</option>";
}
?>