<?php
	session_start();
	require_once 'conexion.php';	
	
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "php_combo";
	
	try {
		$dbCAT = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
		$dbCAT->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		die('No se puede conectar a MySQL');
	}
	
	//echo "llegue";

	if(isset($_POST['guardar'])){
				
		$categoria = $_SESSION['continente_id'];
		$subcategoria = $_SESSION['pais_id'];
		$grupo = $_SESSION['ciudad_id'];
		$marcas = $_POST["tabla_marcas"];
		$cuantos = count($marcas);
		
		$sq = "SELECT * FROM catsubcatgrupo where idCat = " . $categoria;
		$stmt = $dbCAT->query($sq);
		
		//echo "===". $cuantos;
		if ( $cuantos > 0 ) {
			while ($row = $stmt->fetch()) {
				for ($x = 0; $x < $cuantos; $x++) {
					//echo "=x=". $x;
					try{
						
						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sq2 = "DELETE FROM marca_catsubcatgrupo where categoria = " . $categoria . " and marca=" . $marcas[$x] . 
						" and subcategoria = " . $row['idsubcat'] . " and grupo = " . $row['idgrupo'];
						$stmt2 = $dbCAT->query($sq2);
						$sql = "INSERT INTO `marca_catsubcatgrupo` (`marca`, `categoria`, `subcategoria`, `grupo`) 
						VALUES (".$marcas[$x].", " . $row['idCat'] . ", " . $row['idsubcat'] . ", " . $row['idgrupo'] .")";						
						//echo $sql;
						$db->exec($sql);
						
					}catch(PDOException $e){
						echo $e->getMessage();
					}
				}
			}	
		}
		$db = null;
		?>
		<script> 
		alert("Relacion ha sido establecida!");
		window.location="http://localhost/STRASOURCING/app/relacion_marca_cat/";
		</script>
        <?php
	}
?>