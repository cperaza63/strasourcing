<?php
	// Conexión con MySQL
	$imagenes = "../../assets/documentos/soportes/imagenes/";
	$archivos = "../../assets/documentos/soportes/archivos/";
	require_once('../soporte_multiples_imagenes/dbConnection.php');
	
	$allowImg = array('png','jpeg','jpg','gif');	
	$allowFile = array('doc','docx','pdf','rtf', 'txt', 'xls', 'xlsx', 'jar', 'rar', 'zip', 'htm', '7z');

	if (isset($_POST['deleteId'])) {
		
		$deleteId = $_POST['deleteId'];

		$sql = "SELECT * FROM table_soportes WHERE id = $deleteId";

		$result = mysqli_query($con, $sql);

		$row = mysqli_fetch_assoc($result);

		$fileExnt = explode('.', $row['images']);
				
		if( substr( $row['folder'], -9 ) == "imagenes/" ){
			$filePath = $imagenes.$row['images'];
		}else{
			$filePath = $archivos.$row['images'];		}
		
		$query = "DELETE FROM table_soportes WHERE id = $deleteId";
		
		
		if (mysqli_query($con, $query)) {
			unlink($filePath);
		}
	}

?>