<?php
	//  Conexión con MySQL
	$imagenes = "../../assets/documentos/soportes/imagenes/";
	$archivos = "../../assets/documentos/soportes/archivos/";	
	require_once('../soporte_multiples_imagenes/dbConnection.php');
	
	$allowImg = array('png','jpeg','jpg','gif');	
	$allowFile = array('doc','docx','pdf','rtf', 'txt', 'xls', 'xlsx', 'jar', 'rar', 'zip', 'htm', '7z');

	// Upload multiple image in Database using PHP MYSQL

	if (!empty($_FILES['multipleFile']['name'])) {

		$multiplefile = $_FILES['multipleFile']['name'];

		foreach ($multiplefile as $name => $value) {
			
			$fileExnt = explode('.', $multiplefile[$name]);

			$fileTmp = $_FILES['multipleFile']['tmp_name'][$name];
					
			$newFile = 	rand(). '.'. $fileExnt[1];
			
			if (in_array($fileExnt[1], $allowImg)) {
				$target_dir = $imagenes ."/" . $newFile; 
				if ($_FILES['multipleFile']['size'][$name] > 0 && $_FILES['multipleFile']['error'][$name]== 0) {
					
					if (move_uploaded_file($fileTmp, $target_dir)) {
						$query  = "INSERT INTO table_soportes (images, folder) VALUES('$newFile', '$imagenes')";
						mysqli_query($con, $query);
					}
				}
			}else{
				if (in_array($fileExnt[1], $allowFile)) {
					$target_dir = $archivos ."/" . $newFile; 
					if ($_FILES['multipleFile']['size'][$name] > 0 && $_FILES['multipleFile']['error'][$name]== 0) {
						
						if (move_uploaded_file($fileTmp, $target_dir)) {
							$query  = "INSERT INTO table_soportes (images, folder) VALUES('$newFile', '$archivos')";
							mysqli_query($con, $query);
						}
					}
				}	
			}
		}
	}	

?>