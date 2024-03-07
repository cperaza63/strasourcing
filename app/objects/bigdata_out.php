<?php
class Bigdata_out
{
    // database connection and table name
    private $conn;
    private $table_name = "bigdata_out";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }

	/*
	$bigdata->server_name = $_SERVER['SERVER_NAME'];			// nombre del servidor
	$bigdata->fecha = date('Y-m-d H:i:s');					// fecha y hora de visita
	$bigdata->php_self = $_SERVER['PHP_SELF'];					// nombre de la pagina web actual
	$bigdata->http_referer = $_SERVER['HTTP_REFERER'];				// de donde viene la pagina
	$bigdata->http_user_agent = $_SERVER['HTTP_USER_AGENT'];	// nombre del navegador
	$bigdata->remote_addr = $_SERVER['REMOTE_ADDR'];
	*/
	function crearBigdata ()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
		server_name='$this->server_name', 
		fecha='$this->fecha', 
		php_self='$this->php_self', 
		http_referer='$this->http_referer', 
		http_user_agent='$this->http_user_agent',  
		remote_addr='$this->remote_addr'";
		
		$stmt = $this->conn->prepare ( $query );
		$this->server_name	= htmlspecialchars ( strip_tags ( strtolower ( $this->server_name ) ) );
		$this->fecha 	= htmlspecialchars ( strip_tags ( strtolower ( $this->fecha ) ) );
		$this->php_self = htmlspecialchars ( strip_tags ( strtolower ( $this->php_self ) ) );
		$this->http_referer 	= htmlspecialchars ( strip_tags ( strtolower ( $this->http_referer ) ) );
		$this->http_user_agent 	= htmlspecialchars ( strip_tags ( $this->http_user_agent ) );	
		$this->remote_addr 	= htmlspecialchars ( strip_tags ( $this->remote_addr ) );
        
		//echo "con exito = " . $query;
		
		if($stmt->execute () )
		{
			//echo "con exito = ";
			return true;
		}
		return false; 
	}
	
}
?>