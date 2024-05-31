<?php
	//  Conexión con MySQL
	$imagenes = "../../assets/documentos/soportes/imagenes/";
	$archivos = "../../assets/documentos/soportes/archivos/";
	require_once('../soporte_multiples_imagenes/dbConnection.php');
	
	$allowImg = array('png','jpeg','jpg','gif');				
	$allowFile = array('doc','docx','pdf','rtf', 'txt', 'xls', 'xlsx', 'jar', 'rar', 'zip', 'htm', '7z');

	if (isset($_POST['image_id'])) {
		
		$image_id = $_POST['image_id'];
		
	}
	
	if (!empty($_FILES['file_name']['name'])) {

		$fileTmp = $_FILES['file_name']['tmp_name'];


		$fileExnt = explode('.', $_FILES['file_name']['name']);

		$fileActExt   = strtolower(end($fileExnt));

		$newFile = 	rand(). '.'. $fileActExt;

		if (in_array($fileActExt, $allowImg)) {
			$image = $newFile;
			$destination = $imagenes.$newFile;
		}else{
			$image = $newFile;
			$destination = $archivos.$newFile;
		}

		if (in_array($fileActExt, $allowImg)) {
			if ($_FILES['file_name']['size'] > 0 && $_FILES['file_name']['error']==0) {

				$query = "SELECT * FROM table_soportes WHERE id = '$image_id'";

				$result = mysqli_query($con, $query);

				$row = mysqli_fetch_assoc($result);

				$filePath = $image;
				
				if (move_uploaded_file($fileTmp, $destination)) {
					$update = "UPDATE table_soportes SET folder= '" . $imagenes . "',images = '$newFile' WHERE id = '$image_id'";
					
					mysqli_query($con, $update);
					unlink($filePath);
				}
			}
		}
	}
		
?>