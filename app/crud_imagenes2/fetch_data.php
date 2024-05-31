<?php
	session_start();
	// Database connection 
	
	require_once('dbConnection.php');

	$query = "SELECT * FROM table_images ORDER BY id DESC";
	
	$result = mysqli_query($con, $query);
	
	$output = "";

	if (mysqli_num_rows($result) > 0) {
		$output .= "<table class='table table-striped'>";
		$output .= "<thead>
			        <tr>
			          <th>Nro.</th>
			          <th>Imagen</th>
			          <th>Asignar</th> 
					  <th>Editar</th>
			          <th>Borrar</th>
			        </tr>
			      </thead>";
		while ($row = mysqli_fetch_assoc($result)) {
		$images = 'uploads/'. $row['images'];
		$output .=  "<tr>
			          <td>".$row["id"]."</td>
			          <td><img src='".$images."' class='img-thumbnail' width='80px' height='80px' /></td>
			          <td><a target='_parent' href='../vistaTablaControl.php?proceso=update_image&item_id=". $_SESSION["codigo_tabla"] . "&image_id=". $row["id"] ."' class='btn btn-outline-primary btn-sm'>Asignar</a></td>
					  <td><button type='button' class='btn btn-outline-success btn-sm' data-toggle='modal' data-target='#exampleModal' data-id='".$row["id"]."'>Editar</button></td>
			          <td><button type='button' class='btn btn-outline-danger btn-sm delete-btn' data-id='".$row["id"]."'>Borrar</button></td>
			        </tr>";
		}
		$output .="</tbody>
    			</table>";
    	echo $output;
	}else{
		echo "<hr><h5 style='text-align:center'>No se ha encontrado ninguna imagen</h5>";
	}

?>