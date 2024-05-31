<?php
	session_start();
	$imagenes = "../../assets/documentos/soportes/imagenes/";
	$archivos = "../../assets/documentos/soportes/archivos/";
	// Database connection 
	$allowImg = array('png','jpeg','jpg','gif');				
	$allowFile = array('doc','docx','pdf','rtf', 'txt', 'xls', 'xlsx', 'jar', 'rar', 'zip', 'htm', '7z');

	require_once('../soporte_multiples_imagenes/dbConnection.php');
	
	$verEtiqueta = "";
	
	$query = "SELECT * FROM table_soportes WHERE etiqueta<>'' and idCompany = '" . $_SESSION['idCompanyView'] . "' order by etiqueta";
	
	$result = mysqli_query($con, $query);
	
	$output = "";

	if (mysqli_num_rows($result) > 0) {
		$output .= "<table class='table table-striped'>";
		$output .= "<thead>
			        <tr>
						<th>Etiquetar</th>
			          	<th>Archivo</th>
					  	<th>Nombre</th>
			        </tr>
			      </thead>";
		while ($row = mysqli_fetch_assoc($result)) {
		
		//s = "Hello, World!"
		//Msgbox Left(s, 3) ' Hel
		//Msgbox Right(s, 3)  'ld!

		if( substr( $row['folder'], -9 ) == "imagenes/" ){
			$icono = $row['folder'] . $row['images'];	
			$images = $row['folder'] . $row['images'];	
			$tamano = 80;
		}else{
			$icono = "../../assets/img/documento-archivo.png";
			$images = $row['folder'] . $row['images'];	
			$tamano = 60;
		}
		
		$output .=  "<tr>
			          <td><strong>".$row["etiqueta"]."</strong></td>
			          <td><a href='".$images."' dowload='".$images."'><img src='".$icono."' class='img-thumbnail' width='$tamano'px height='$tamano'px' /></td>
					  <td>".$row["images"]."</td>
			          
			        </tr>";
		}
		$output .="</tbody>
    			</table>";
    	echo $output;
	}else{
		echo "<hr><h5 style='text-align:center'>No se ha encontrado ningún soporte</h5>";
	}

?>