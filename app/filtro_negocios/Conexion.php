<?php
// simple conexion a la base de datos
function connect(){
	return new mysqli("localhost","root","","php_combo");
}
function connectSPA(){
	return new mysqli("localhost","root","","spa");
}
?>