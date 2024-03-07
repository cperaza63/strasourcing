<?php
class Tabla_Control
{
    // database connection and table name
    private $conn;
    private $table_name = "tabla_Control";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }
	
	function readPlanComprador ()
    {
		 try {			 
			$query = "SELECT tipo, id, nombre_tabla, nombre, valor FROM " . $this->table_name . " where (tipo=19) order by nombre desc";
			//echo "<br>" . $query;
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function readPlanProveedor ()
    {
		 try {			 
			$query = "SELECT tipo, id, nombre_tabla, nombre, valor FROM " . $this->table_name . " where (tipo=20) order by nombre desc";
			//echo "<br>" . $query;
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
}
?>