<?php

	// Database connection 
	
	require_once('dbConnection.php');

	if (isset($_POST['editId'])) {
		
		$editId = $_POST['editId'];
	}

	if (!empty($editId)) {
		
		$query  = "SELECT * FROM table_images WHERE id = $editId";

		$result = mysqli_query($con, $query);

	if (mysqli_num_rows($result) > 0) {
				
		$output = "";
				
		while($row = mysqli_fetch_assoc($result)) {

		$image = 'uploads/'.$row['images'];
			
		$output.="<form id='editForm'>
						<div class='modal-body' style='height: 200px;'>
							<input type='hidden' name='image_id' id='image_id' value='".$row['id']."'/>
			            	<div class='form-group'>
				              	<div class='custom-file mb-3'>
				               <input type='file' class='custom-file-input' name='file_name' id='file_name'>
				               <label class='custom-file-label'>Elija la imágen que desea cargar</label>
				               <img src='".$image."' class='img-thumbnail' width='120px' height='120px'/>
				            </div>
			            </div>
			         </div>
			         <div class='modal-footer'>
			           	<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
			            <button type='submit' class='btn btn-success'>Actualizar</button>
			         </div>
				</form>";
		}
		echo $output;	
	}
}

?>