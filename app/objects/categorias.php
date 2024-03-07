<?php
class Categorias
{
    // database connection and table name
    private $conn;
    private $table_name = "spa.tabla_control";
 
    // object properties
 
    // applying database conexion
    public function __construct ( $db )
    {
        $this->conn = $db;
    }
	
	// retrieve records for listing
	
	function readCategorias(){
 	    $query = "SELECT a.*, b.image_id, c.folder, c.images, a.status FROM " . $this->table_name . " b 
		inner join php_combo.continente a on (a.name = b.nombre) 
		inner join spa.table_images c on (b.image_id = c.id) 
		order by a.status desc, a.id;";
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		echo $query;
        return $stmt;	
	}	
	
	function readCategoriasActivas($idcategoria){		
		$query = "SELECT a.*, b.image_id, c.folder, c.images, a.status FROM " . $this->table_name . " b 
		inner join php_combo.continente a on (a.name = b.nombre) 
		inner join spa.table_images c on (b.image_id = c.id) where status=1
		order by a.status desc, a.id;";
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		echo $query;
        return $stmt;	
	}	
	
	function readCatSubcat(){
		$query = "SELECT a.*, d.id as idsub, d.name as subcategoria, b.image_id, c.folder, c.images, a.status 
		FROM " . $this->table_name . " b inner join php_combo.continente a on (a.name = b.nombre) inner join 
		php_combo.pais d on (d.continente_id = a.id) inner join spa.table_images c on (b.image_id = c.id) 
		where status=1 order by a.status desc, a.id";
		$stmt = $this->conn->prepare ( $query );
        $stmt->execute ();
		echo $query;
        return $stmt;	
	}	
	
	
	
}
?>