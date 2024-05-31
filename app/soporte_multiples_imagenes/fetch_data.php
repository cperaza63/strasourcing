<?php
	
	$imagenes = "../../assets/documentos/soportes/imagenes/";
	$archivos = "../../assets/documentos/soportes/archivos/";
	// Database connection 
	$allowImg = array('png','jpeg','jpg','gif');				
	$allowFile = array('doc','docx','pdf','rtf', 'txt', 'xls', 'xlsx', 'jar', 'rar', 'zip', 'htm', '7z');

	require_once('../soporte_multiples_imagenes/dbConnection.php');
	
	$verEtiqueta = "";
	
	if( isset($_GET['etiqueta'] ) ) {
		if ( $_GET['etiqueta'] != "TODOS LOS SOPORTES" ) {
			$verEtiqueta = " WHERE etiqueta = '" . $_GET['etiqueta'] . "' ";
		}	
	}
	
	$query = "SELECT * FROM table_soportes " . $verEtiqueta . " ORDER BY id DESC";
	
	$result = mysqli_query($con, $query);
	
	$output = "";

	if (mysqli_num_rows($result) > 0) {
		$output .= "<table class='table table-striped'>";
		$output .= "<thead>
			        <tr>
			          <th>Nro.</th>
			          <th>Archivo</th>
					  <th>Nombre</th>
					  <th>Etiquetar</th>
			          <th>Editar</th>
			          <th>Borrar</th>
			        </tr>
			      </thead>";
		while ($row = mysqli_fetch_assoc($result)) {
		
		//s = "Hello, World!"
		//Msgbox Left(s, 3) ' Hel
		//Msgbox Right(s, 3)  'ld!

		if( substr( $row['folder'], -9 ) == "imagenes/" ){
			$icono = $row['folder'] . $row['images'];	
			$images = $row['folder'] . $row['images'];	
			$tamano = 120;
		}else{
			$icono = "../../assets/img/documento-archivo.png";
			$images = $row['folder'] . $row['images'];	
			$tamano = 60;
		}
		
		$output .=  "<tr>
			          <td>".$row["id"]."</td>
			          <td><a href='".$images."' dowload='".$images."'><img src='".$icono."' class='img-thumbnail' width='$tamano'px height='$tamano'px' /></td>
					  <td>".$row["images"]."</td>
					  <td>".$row["etiqueta"]."</td>
			          <td>
					  <a href='http://localhost/STRASOURCING/app/soporte_multiples_imagenes/asignar_etiqueta.php?id=".$row["id"]."' class='btn btn-outline-warning btn-sm'>Etiqueta</button>
					  </td>
					  <td>
					  <button type='button' class='btn btn-outline-success btn-sm' data-toggle='modal' data-target='#exampleModal' data-id='".$row["id"]."'>Editar</button></td>
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