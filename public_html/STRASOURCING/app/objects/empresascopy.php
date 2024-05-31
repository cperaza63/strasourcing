<?php
class Empresas
{
    // database connection and table name
    private $conn;
    private $table_name = "empresas";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }

	function deleteEmpresa ($id)
    {
		 try {			 
			$query = "DELETE FROM " . $this->table_name . " WHERE id= " . $id;
			//echo "<br>" . $query;
			if($stmt->execute ()){
				return true;	
			};
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function readEmpresa ()
    {
		 try {			 
			$query = "SELECT idUsuario, nombre, correo, usuario, clave, estado, userhive, tipo, hint, 
			imagen, folder FROM " . $this->table_name . " WHERE lcase(usuario)= '" . $this->usuario . "' 
			AND clave = '" . md5($this->clave) . "' LIMIT 1";
			$stmt = $this->conn->prepare ( $query );
			$this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
			//echo "<br>" . $query;
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function LeerEmpresas ($estado, $ciudad, $buscar)
    {
		$porEstado	= "";
		$porCiudad	= "";
		$porPalabra	= "";
		
		if( $estado != "" && $estado != "0" ){ 
			$porEstado = " AND state  = " . $estado;
		}
		if( $ciudad != "" && $ciudad != "0" ){ 
			$porCiudad = " AND ciudad  = " . $ciudad;
		}
		if( $buscar != "" && $buscar != "0"){ 
			$porPalabra= " AND (numero_rif like '%$buscarpor%' OR 
			razon_cocial like '%$buscarpor%' OR 
			email_empresa like '%$buscarpor%' OR 
			telefono_empresa like '%$buscarpor%' OR 
			direccion_Empresa like '%$buscarpor%' OR 
			contacto_nombre like '%$buscarpor%' OR 
			admin_nombre like '%$buscarpor%')";
		}

		$query = "SELECT a.*, b.state, c.city FROM empresas a
		INNER JOIN estados b ON(a.state = b.id)
		INNER JOIN ciudades c ON(a.ciudad = c.codigo) WHERE a.id> 0 $porEstado $porCiudad $porPalabra 
		ORDER BY b.state, c.city, a.razon_Social";
		//echo "<br>" . $query;
		 try {
			$stmt = $this->conn->prepare ( $query );	
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; 
		}
    }
}
?>