<?php
class EstadosCiudades
{
    // database connection and table name
    private $conn;
    private $table_name = "ciudades";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }
	
	// retrieve records for listing
	
	function readEstados(){
 	    $query = "SELECT id, state FROM estados ORDER BY state";
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		echo $query;
        return $stmt;	
	}
	
	function deleteCiudad($id){
 	    $query = "DELETE FROM ciudades WHERE id=$id";
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		echo $query;
        return $stmt;	
	}
	
	function readCiudades($state){
 	    $query = "SELECT id, codigo, city FROM ciudades WHERE state=$state ORDER BY city";
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		echo $query;
        return $stmt;	
	}
	
	function crearCiudad ($state, $city)
    {
        $query = "INSERT INTO " . $this->table_name . " SET city='$city', pais=58, state=$state";
        //echo $query;
		$stmt = $this->conn->prepare ( $query );
		$this->state	= htmlspecialchars ( strip_tags ( $state ) );
		$this->city 	= htmlspecialchars ( strip_tags ( strtolower ( $city ) ) );
		
		if($stmt->execute () )
		{
			//echo "con exito";
			return true;
		}
		return false; 
	}
    
	function readList ($buscar)
    {
		if ( $buscar == ""){
	        $query = "SELECT a.*, b.state as nombreEstado FROM " . $this->table_name . " a INNER JOIN estados b 
			on (a.state = b.codigo) ORDER BY b.state, a.city limit 300";	
		}else{
	        $query = "SELECT a.*, b.state as nombreEstado FROM " . $this->table_name . " a INNER JOIN estados b 
			on (a.state = b.codigo) WHERE b.state like '%$buscar%' OR a.city like '%$buscar%' order by b.state, a.city";
		}
        //echo $query;
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
        return $stmt;
    }
	
}
?>