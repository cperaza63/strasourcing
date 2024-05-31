<?php
class Proveedores
{
    // database connection and table name
    private $conn;
    private $table_name = "proveedores";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }
	
	function readtodoProveedor ()
    {
		$query = "SELECT id, numero_rif, razon_social, email_empresa, telefono_empresa, direccion_empresa, state, ciudad, plan FROM " . 
		$this->table_name . " where estado=1 order by razon_social";	
		 try {			 
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function updateContrato ()
    {
		 try {			 
		 
		 	if ($this->fecha_contrato == date("Y-m-d")) {
				$fec = ""; 
			}else{
				$fec = ", fecha_contrato='". $this->fecha_contrato . "'";
			}
			
			$query = "UPDATE " . $this->table_name . " set contrato = ". $this->contrato . $fec . ", plan = '" . $this->plan . "' where id = " . $this->id;
			//echo "<br>" . $query;
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			return true;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function readletraRif ($l)
    {
		$query = "SELECT id, numero_rif, razon_social, email_empresa, telefono_empresa, direccion_empresa, 
		state, ciudad, plan FROM " . $this->table_name . " where estado=1 and left(numero_rif, 1) = '$l' order by razon_social";
		//echo "<br>=== " . $query;
		try {			 
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function LeerProveedorId ($id){
		try {			 
			$query = "SELECT * FROM " . $this->table_name . " WHERE id= " . $id;
			$stmt = $this->conn->prepare ( $query );
			if($stmt->execute ()){
				//echo "<br>............................." . $query;
				return $stmt;	
			};
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}	
	}
	
	function cambiarEstatusProveedor ($idCompany, $accion)
    {
		 try {			 
			$query = "UPDATE " . $this->table_name . " set estado = $accion where id = $idCompany";
			//echo "<br>" . $query;
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			return true;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function deleteProveedor ($id)
    {
		 try {			 
			$query = "DELETE FROM " . $this->table_name . " WHERE id= " . $id;
			//echo "<br>" . $query;
			$stmt = $this->conn->prepare ( $query );
			if($stmt->execute ()){
				return true;	
			};
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	
	function readProveedor ()
    {
		 try {			 
			$query = "SELECT idUsuario, nombre, correo, usuario, clave, estado, userhive, tipo, hint, 
			imagen, folder, plan FROM " . $this->table_name . " WHERE lcase(usuario)= '" . $this->usuario . "' 
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
	
	function LeerProveedores ($estado, $ciudad, $buscar)
    {
		$porEstado	= "";
		$porCiudad	= "";
		$porPalabra	= "";
		
		if( $estado != "" && $estado != "0" ){ 
			$porEstado = " AND a.state  = " . $estado;
		}
		if( $ciudad != "" && $ciudad != "0" ){ 
			$porCiudad = " AND a.ciudad  = " . $ciudad;
		}
		if( $buscar != "" && $buscar != "0"){ 
			$porPalabra= " AND (numero_rif like '%$buscar%' OR 
			razon_social like '%$buscar%' OR 
			email_empresa like '%$buscar%' OR 
			telefono_empresa like '%$buscar%' OR 
			direccion_Empresa like '%$buscar%' OR 
			contacto_nombre like '%$buscar%' OR 
			admin_nombre like '%$buscar%')";
		}

		$query = "SELECT a.*, b.state, c.city FROM proveedores a
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