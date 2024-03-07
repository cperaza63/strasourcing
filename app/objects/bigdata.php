<?php
class Bigdata
{
    // database connection and table name
    private $conn;
    private $table_name = "bigdata_in";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }

	
	function crearBigdata ()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
		idusuario=$this->idusuario, 
		datetime='$this->datetime', 
		programa='$this->programa', 
		agregar=$this->agregar, 
		modificar=$this->modificar,  
		eliminar=$this->eliminar, 
		consultar = $this->consultar, 
		idempresa=$this->idempresa, 
		tipo=$this->tipo,
		idmarca=$this->idmarca, 
		idcategoria=$this->idcategoria,
		idsubcategoria=$this->idsubcategoria,
		idgrupo=$this->idgrupo,
		preferencia=$this->preferencia,
		nombre_filtro='$this->nombre_filtro',
		estado=$this->estado,
		ciudad=$this->ciudad,
		tipo_empresa=$this->tipo_empresa,
		sector=$this->sector,
		internet=$this->internet,
		idorigen = $this->idorigen,
		verificacion=$this->verificacion";
		
        
		$stmt = $this->conn->prepare ( $query );
		$this->idusuario	= htmlspecialchars ( strip_tags ( strtolower ( $this->idusuario ) ) );
		$this->datetime 	= htmlspecialchars ( strip_tags ( strtolower ( $this->datetime ) ) );
		$this->programa = htmlspecialchars ( strip_tags ( strtolower ( $this->programa ) ) );
		$this->agregar 	= htmlspecialchars ( strip_tags ( strtolower ( $this->agregar ) ) );
		$this->modificar 	= htmlspecialchars ( strip_tags ( $this->modificar ) );	
		$this->eliminar 	= htmlspecialchars ( strip_tags ( $this->eliminar ) );
        $this->consultar 	= htmlspecialchars ( strip_tags ( $this->consultar ) ); 
		$this->idempresa = htmlspecialchars ( strip_tags ( strtolower ( $this->idempresa ) ) );
		$this->tipo  = htmlspecialchars ( strip_tags ( strtolower ( $this->tipo ) ) );
		$this->idmarca 	= htmlspecialchars ( strip_tags ( strtolower ( $this->idmarca ) ) );
		$this->idorigen 	= htmlspecialchars ( strip_tags ( strtolower ( $this->idorigen ) ) );
		$this->idcategoria 	= htmlspecialchars ( strip_tags ( strtolower ( $this->idcategoria ) ) );
		$this->idsubcategoria 	= htmlspecialchars ( strip_tags ( strtolower ( $this->idsubcategoria ) ) );
		$this->idgrupo 	= htmlspecialchars ( strip_tags ( strtolower ( $this->idgrupo ) ) );
		$this->preferencia 	= htmlspecialchars ( strip_tags ( strtolower ( $this->preferencia ) ) );
		$this->nombre_filtro 	= htmlspecialchars ( strip_tags ( strtolower ( $this->nombre_filtro ) ) );
		$this->estado 	= htmlspecialchars ( strip_tags ( strtolower ( $this->estado ) ) );
		$this->ciudad 	= htmlspecialchars ( strip_tags ( strtolower ( $this->ciudad ) ) );
		$this->tipo_empresa 	= htmlspecialchars ( strip_tags ( strtolower ( $this->tipo_empresa ) ) );
		$this->sector 	= htmlspecialchars ( strip_tags ( strtolower ( $this->sector ) ) );
		$this->internet 	= htmlspecialchars ( strip_tags ( strtolower ( $this->internet ) ) );
		$this->verificacion 	= htmlspecialchars ( strip_tags ( strtolower ( $this->verificacion ) ) );
        
		//echo "con exito = " . $query;
		
		if($stmt->execute () )
		{
			//echo "con exito = " . $query;
			return true;
		}
		return false; 
	}
	
}
?>