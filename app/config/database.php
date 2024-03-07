<?php

// used to get mysql database connection
// bdActual es la variable que contiene la base de da datos a abrir

class Database
{
   // CONEXION REMOTA
    /*private $host = "172.28.91.195";
    private $db_name = "spa";
    private $username = "cperaza";
    private $password = "Ceph_7065079";
    public $connSpa;*/

  	//CONEXION LOCAL - DE PRUEBA
    private $host = "127.0.0.1";
    private $db_name = "spa";
    private $username = "root";
    private $password = "";
    public $conn; 
	
    // get the database connection
    public function getConnection()
    {	
        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }
        catch( PDOException $exception )
        {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>