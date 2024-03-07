<?php
include "conexion.php";
if (isset($_POST['btnSubmit'])) {
    $uploadfile = $_FILES["uploadImage"]["tmp_name"];
	if ( $_GET['tipoTabla'] == 13 ){ 
	    $folderRuta = "../../assets/documentos/imagenes/usuarios/";
	}else{
		if ( $_GET['tipoTabla'] == 12 ){ 
			    $folderRuta = "../../assets/documentos/imagenes/logos/";		
		} else {
			if ( $_GET['tipoTabla'] == 14 ){ 
			    $folderRuta = "../../assets/documentos/imagenes/rif/";
			}else{
				if ( $_GET['tipoTabla'] == 15 ){ 
					$folderRuta = "../../assets/documentos/imagenes/autorizaciones/";
				}
			}
		}
	}
    
    if (! is_writable($folderRuta) || ! is_dir($folderRuta)) {
        echo "error";
        exit();
    }
    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderRuta . $_FILES["uploadImage"]["name"])) {
        echo '<img height="200px" src="' . $folderRuta . "" . $_FILES["uploadImage"]["name"] . '">';
		
		if ( $_GET['tipoTabla'] == 13 ){ 
			$query = "UPDATE usuario SET 
			imagen= '" . $_FILES["uploadImage"]["name"] . "',
			folder= '" . $_GET['folder'] . "'
			 WHERE idUsuario= " . $_GET["idUsuario"];
			 
			$stmt = $conexion->prepare($query);	
			$stmt->execute();	 				 
		 }
		 else
		 {	 
			if ( $_GET['tipoTabla'] == 12 ){ 
				if( $_GET['tipoEmpresa'] == 4 ){
					$query = "UPDATE proveedores SET logo_imagen= '" . $_FILES["uploadImage"]["name"] . "' WHERE id= " . $_GET["idCompany"];
					$stmt = $conexion->prepare($query);	
					$stmt->execute();	 				 	
				}else{
					$query = "UPDATE empresas SET 	 logo_imagen= '" . $_FILES["uploadImage"]["name"] . "' WHERE id = " . $_GET["idCompany"];
					 
					$stmt = $conexion->prepare($query);	
					$stmt->execute();	 				 					
				}
			 }else{
				if ( $_GET['tipoTabla'] == 14 ){ 
					if( $_GET['tipoEmpresa'] == 4 ){
						$query = "UPDATE proveedores SET rif_imagen= '" . $_FILES["uploadImage"]["name"] . "' WHERE id= " . $_GET["idCompany"];
						$stmt = $conexion->prepare($query);	
						$stmt->execute();	 				 	
					}else{
						$query = "UPDATE empresas SET 	 rif_imagen= '" . $_FILES["uploadImage"]["name"] . "' WHERE id = " . $_GET["idCompany"];
						 
						$stmt = $conexion->prepare($query);	
						$stmt->execute();	 				 					
					}
				}else{
					if ( $_GET['tipoTabla'] == 15 ){ 
						if( $_GET['tipoEmpresa'] == 4 ){
							$query = "UPDATE proveedor_marcas SET imagen= '" . $_FILES["uploadImage"]["name"] . "' WHERE marca= " . $_GET["marca"] . " and rif = '" . $_GET["rifCompany"] . "'";
							//echo $query;
							$stmt = $conexion->prepare($query);	
							$stmt->execute();	 				 	
						}	
					}
				}
			} 
		}
		 
        exit();
    }
}
?>