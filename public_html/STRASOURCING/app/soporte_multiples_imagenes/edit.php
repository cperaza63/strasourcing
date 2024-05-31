<?php
	session_start();
	// Database connection 
	$imagenes = "../../assets/documentos/soportes/imagenes/";
	$archivos = "../../assets/documentos/soportes/archivos/";
	require_once('../soporte_multiples_imagenes/dbConnection.php');
	
	$allowImg = array('png','jpeg','jpg','gif');	
	$allowFile = array('doc','docx','pdf','rtf', 'txt', 'xls', 'xlsx', 'jar', 'rar', 'zip', 'htm', '7z');

	if (isset($_POST['editId'])) {
		
		$editId = $_POST['editId'];
	}

	if (!empty($editId)) {
		
		$query  = "SELECT * FROM table_soportes WHERE id = $editId";

		$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) > 0) {
				
		$output = "";
				
		while($row = mysqli_fetch_assoc($result)) {
		
		if( substr( $row['folder'], -9 ) == "imagenes/" ){
			$icono = $row['folder'] . $row['images'];	
			$image = $imagenes.$row['images'];
		}else{
			$icono = "../../assets/img/documento-archivo.png";
			$image = $archivos.$row['images'];
		}
		
		$_SESSION['image_id'] = $row['id'];
		$output.="<form id='editForm'>
						<div class='modal-body' style='height: 200px;'>
							<input type='hidden' name='image_id' id='image_id' value='".$row['id']."'/>
			            	<div class='form-group'>
				              	<div class='custom-file mb-3'>
				               <input type='file' class='custom-file-input' name='file_name' id='file_name'>
				               <label class='custom-file-label'>Elija la imágen que desea cargar</label>
				               <img src='".$icono."' class='img-thumbnail' width='120px' height='120px'/>
				            </div>
			            </div>
			         </div>
			         <div class='modal-footer'>
			           	<button type='button' class='btn btn-outline-secondary' data-dismiss='modal' style='color:#5B00B7;'>Cerrar</button>
			            <button type='submit' class='btn btn-outline-secondary' style='color:#5B00B7;'>Actualizar</button>
			         </div>
				</form>";
		}
       	echo $output; 
	}
}

?>