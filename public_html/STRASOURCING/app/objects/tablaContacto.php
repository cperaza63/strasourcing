<?php
class TablaContactos
{
    // database connection and table name
    private $conn;
    private $table_name = "tabla_contactos";
 
    // object properties
    public $usu;
    public $tel;
    public $ema;
    public $emp;
    public $pais = "VE";
    public $est;
    public $ciu;
    public $asu;
    public $com;
	public $dir;
	public $web;
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }
	
	function leerContactoId ($id, $tipoHive)
    {
		 try {
			if($tipoHive == 3 || $tipoHive == 4){
			$query = "SELECT b.id as idEmpresa, c.id as idProveedor, 
			if(b.id>0, '3',if(c.id>0, '4','1')) as tipoDestino,
			if(b.id>0, b.razon_social,if(c.id>0, c.razon_social, a.empresa)) as nombreEmpresa,  
			if(b.id>0, b.telefono_empresa, if(c.id>0, c.telefono_empresa, a.telefono)) as telefonoEmpresa, 
			if(b.id>0, b.email_empresa,if(c.id>0, c.email_empresa, a.email)) as emailEmpresa, 
			if(b.id>0, b.direccion_empresa,if(c.id>0, c.direccion_empresa, a.direccion)) as direccionEmpresa, 
			if(b.id>0, b.state,if(c.id>0, c.state, a.estado)) as estadoEmpresa,
      		if(b.id>0, b.ciudad, if(c.id>0, c.ciudad, a.ciudad)) as ciudadEmpresa, a.*
			FROM tabla_contactos a left join empresas b on (a.companyDestino = b.id) left join proveedores c on (a.companyDestino = c.id)
			WHERE a.id=". $id;
			}
			else{
				$query = "SELECT *, 1 as tipoHive, estado as estadoEmpresa, ciudad as ciudadEmpresa, email as emailEmpresa, 
				telefono as telefonoEmpresa, direccion as direccionEmpresa, empresa as nombreEmpresa 
				FROM tabla_contactos where companyDestino <=1";
			}
			
			$stmt = $this->conn->prepare ( $query );
			$id = htmlspecialchars ( strip_tags ( $id ) );
			//echo "<br>" . $query;
			$stmt->execute ();
			return $stmt;
		} catch(PDOException $e) {
			return false; // <== CAMBIAR AQUI
		}
    }
	function deleteContacto ($id){
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

	function readContactanos($year, $tipoHive, $companyHive){
		if( $year==''){
			$year = date('Y');
		}
		
		if($tipoHive == 3 || $tipoHive == 4){
			$query = "SELECT b.id as idEmpresa, c.id as idProveedor, 
			if(b.id>0, '3',if(c.id>0, '4','1')) as tipoDestino,
			if(b.id>0, b.razon_social,if(c.id>0, c.razon_social, a.empresa)) as nombreEmpresa,  
			if(b.id>0, b.telefono_empresa, if(c.id>0, c.telefono_empresa, a.telefono)) as telefonoEmpresa, 
			if(b.id>0, b.email_empresa,if(c.id>0, c.email_empresa, a.email)) as emailEmpresa, 
			if(b.id>0, b.direccion_empresa,if(c.id>0, c.direccion_empresa, a.direccion)) as direccionEmpresa,
      		if(b.id>0, b.state,if(c.id>0, c.state, a.estado)) as estadoEmpresa,
      		if(b.id>0, b.ciudad, if(c.id>0, c.ciudad, a.ciudad)) as ciudadEmpresa, a.*
			FROM tabla_contactos a left join empresas b on (a.companyDestino = b.id) left join proveedores c on (a.companyDestino = c.id)
			where b.id = ".$companyHive." or c.id=".$companyHive." order by a.id desc";
		}else{
			$query = "SELECT *, 1 as tipoHive, estado as estadoEmpresa, ciudad as ciudadEmpresa, email as emailEmpresa, 
			telefono as telefonoEmpresa, direccion as direccionEmpresa, empresa as nombreEmpresa 
			FROM tabla_contactos where companyDestino <=1  order by id desc";
		}
		//echo $query;
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		
        return $stmt;	
	}

	
	function crearContacto ()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
		usuario='$this->usuario', 
		empresa='$this->empresa', 
		telefono='$this->telefono', 
		email='$this->email', 
		estado=$this->estado,  
		ciudad=$this->ciudad, 
		asunto = $this->asunto, 
		comentario='$this->comentario', 
		direccion='$this->direccion', 
		website='$this->website'";
        
		$stmt = $this->conn->prepare ( $query );
		$this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
		$this->empresa 	= htmlspecialchars ( strip_tags ( strtolower ( $this->empresa ) ) );
		$this->telefono = htmlspecialchars ( strip_tags ( strtolower ( $this->telefono ) ) );
		$this->email 	= htmlspecialchars ( strip_tags ( strtolower ( $this->email ) ) );
		$this->estado 	= htmlspecialchars ( strip_tags ( $this->estado ) );	
		$this->ciudad 	= htmlspecialchars ( strip_tags ( $this->ciudad ) );
        $this->asunto 	= htmlspecialchars ( strip_tags ( $this->asunto ) ); 
		$this->comentario = htmlspecialchars ( strip_tags ( strtolower ( $this->comentario ) ) );
		$this->direccion  = htmlspecialchars ( strip_tags ( strtolower ( $this->direccion ) ) );
		$this->website 	= htmlspecialchars ( strip_tags ( strtolower ( $this->website ) ) );
		
		//echo "usuario= " . $this->usuario . " " . $query;
				
        // execute.sql and detect any error, ok return true, else return false 		
		if($stmt->execute () )
		{
			echo "con exito";
			return true;
			/*$query = "SELECT customer_id FROM " . $this->table_name . " WHERE email = '$this->email' AND (company_padre = ".$_SESSION['company_padre'] . ") AND (company_id = ".$_SESSION['company_id'] . ") LIMIT 0,1";
			echo $query;
			$stmt = $this->conn->prepare ( $query );
			$stmt->execute ();
			$row = $stmt->fetch ( PDO::FETCH_ASSOC );
			return $row['customer_id'];*/
		}
		return false; 
	}
	
	function crearContactoAproveedor ($companyHive, $solicitud_categoria, $idProveedor )
    {
		//$tablaContactos->companyEnvia = $companyHive;
		//$tablaContactos->companyDestino = $idProveedor;
		$asunto = 11; 
		$comentario = "Respuesta por evaluación de solicitud de recomendacion #". $solicitud_categoria ." del proveedor #".$this->rifEnvia ;	
		
        $query = "INSERT INTO " . $this->table_name . " SET 
		usuario='$this->usuario', 
		empresa='$this->empresa', 
		comentario='$comentario',
		rifEnvia='$this->rifEnvia', 
		companyEnvia=$companyHive, 
		companyDestino=$idProveedor,  
		asunto = $asunto,
		solicitud_categoria = $solicitud_categoria";
		
		$stmt = $this->conn->prepare ( $query );
		$this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
		$this->empresa 	= htmlspecialchars ( strip_tags ( strtolower ( $this->empresa ) ) );
		$this->rifEnvia 	= htmlspecialchars ( strip_tags ( strtolower ( $this->rifEnvia ) ) );
		$this->companyEnvia 	= htmlspecialchars ( strip_tags ( $companyHive ) );	
		$this->companyDestino	= htmlspecialchars ( strip_tags ( $idProveedor ) );
		$this->asunto 	= htmlspecialchars ( strip_tags ( $asunto ) ); 
		$this->comentario = htmlspecialchars ( strip_tags ( strtolower ( $this->comentario ) ) );
		$this->solicitud_categoria = htmlspecialchars ( strip_tags ( ( $solicitud_categoria ) ) );
		
		if($stmt->execute () )
		{
			echo "con exito";
			return true;
		}
		return false; 
	}
	
	//$_SESSION['consulta_rif'], $_POST['solicitar_categoria'], $_SESSION['companyHive'], $_SESSION['rifHive']
	
	function crearContactoAempresa ($rifDestino, $solicitud_categoria, $idProveedor, $rifEnvia )
    {
		//$tablaContactos->companyEnvia = $companyHive;
		//$tablaContactos->companyDestino = $idProveedor;
		$asunto = 12; 
		$comentario = "Solicitud de recomendacion a empresa #". $solicitud_categoria ." de Proveedor #". $idProveedor;	
		
        $query = "INSERT INTO " . $this->table_name . " SET 
		usuario='$this->usuario', 
		empresa='$this->empresa', 
		comentario='$comentario',
		rifEnvia='$this->rifEnvia', 
		rifDestino='$rifDestino',
		companyEnvia=$idProveedor, 
		companyDestino=$this->companyDestino,  
		asunto = $asunto,
		solicitud_categoria = $solicitud_categoria";
		
		//echo $query;
		
		$stmt = $this->conn->prepare ( $query );
		$this->usuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->usuario ) ) );
		$this->empresa 	= htmlspecialchars ( strip_tags ( strtolower ( $this->empresa ) ) );
		$this->rifEnvia 	= htmlspecialchars ( strip_tags ( strtolower ( $this->rifEnvia ) ) );
		$this->rifDestino 	= htmlspecialchars ( strip_tags ( strtolower ( $this->rifDestino ) ) );
		$this->companyEnvia 	= htmlspecialchars ( strip_tags ( $idProveedor ) );	
		$this->companyDestino	= htmlspecialchars ( strip_tags ( strtolower ( $this->companyDestino ) ) );
		$this->asunto 	= htmlspecialchars ( strip_tags ( $asunto ) ); 
		$this->comentario = htmlspecialchars ( strip_tags ( strtolower ( $this->comentario ) ) );
		$this->solicitud_categoria = htmlspecialchars ( strip_tags ( ( $solicitud_categoria ) ) );
		
		if($stmt->execute () )
		{
			echo "con exito";
			return true;
		}
		return false; 
	}
	
}
?>