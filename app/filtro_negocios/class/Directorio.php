<?php
/*
tipo:tipo,
sector:sector,
soporte:soporte,
verificado:verificado
*/

class Product {
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "spa";   
	private $productTable = 'proveedores';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error al conectar con MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
		if ( !isset( $_SESSION['dir_categoria'] )) {$_SESSION['dir_categoria'] = 0;}
		if ( !isset( $_SESSION['dir_subcategoria'])){$_SESSION['dir_subcategoria'] = 0;}
		if ( !isset( $_SESSION['dir_grupo'] )) {$_SESSION['dir_grupo'] = 0;}
		
		if ( !isset( $_SESSION['dir_preferencia'] )) {$_SESSION['dir_preferencia'] = 0;}
		if ( !isset( $_SESSION['dir_marca'] )) {$_SESSION['dir_marca'] = 0;}
		if ( !isset( $_SESSION['dir_origen'] )) {$_SESSION['dir_origen'] = "";}
		
		if ( !isset( $_SESSION['dir_tipo'] )) {$_SESSION['dir_tipo'] = 0;}
		if ( !isset( $_SESSION['dir_internet'] )) {$_SESSION['dir_internet'] = 0;}
		
		if ( !isset( $_SESSION['dir_sector'] )) {$_SESSION['dir_sector'] = 0;}
		if ( !isset( $_SESSION['dir_verifica'] )) {$_SESSION['dir_verifica'] = 0;}
		
		if ( !isset( $_SESSION['dir_estado'] )) {$_SESSION['dir_estado'] = 0;}
		if ( !isset( $_SESSION['dir_ciudad'] )) {$_SESSION['dir_ciudad'] = 0;}
		
		if ( !isset( $_SESSION['dir_internet'] )) {$_SESSION['dir_internet'] = 0;}
    }

	public function searchProducts(){
		$accion_menu="";
		$categoria = "";
		$subcategoria = "";
		$grupo = "";
		$preferencia = "";
		$marca = "";
		$origen = "";
		$tipo = "";
		$estado = "";
		$ciudad = "";
		$sector = "";
		$soporte = "";
		$verificado = "";
		$internet="";
		$accion_menu = "";
		$sql4="";
		$sql5="";
		if ( isset( $_POST['action'] ) ) {
			if ($_POST['action'] == "fetch_data" ){
				$accion_menu = "favoritos";
				// leemos solo los registros relacio con marcas y categorias
				$sql4 = "SELECT * FROM proveedor_favoritos where favorito=1 and idCompany = 0";
				$result4 = mysqli_query($this->dbConnect, $sql4);
				if(mysqli_num_rows($result4) > 0 ){
					$sql5 = "SELECT a.*, e.state as nombreEstado FROM proveedores a 
					inner join estados e on (a.state = e.id )
					inner join proveedor_favoritos c on ( a.id = c.idProveedor )
					where a.estado = 1 and a.logo_imagen<>'0' order By a.razon_social";	
					echo $sql5;
				}else{
					$searchResultHTML = '<h3>No se ha encontrado ningún proveedor..</h3>';
					return $searchResultHTML;
				}
			}else{
				$accion_menu = "categoria";
				$sql5 = "SELECT a.*, e.state as nombreEstado FROM proveedores a inner join estados e on (a.state = e.id ) 
				where estado = 1 and logo_imagen<>'0' order By a.razon_social";	
			}
		}

		$resultSQL="";
		// leemos solo provedores activos
		$result = mysqli_query($this->dbConnect, $sql5);
		$totalResult = mysqli_num_rows($result);
		$searchResultHTML = '';
		if($totalResult > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				// analizamos las variables filtros
				$company_id = $row['id'];
				$pasa = 1;
				
				if ( isset( $_POST['estado'] ) && $_POST['estado'] !="" ){
					$_SESSION['dir_estado'] = $_POST['estado'];
					if (  $_POST['estado'] != $row['state']){
						$pasa=0;
					}
				}
				
				if ( isset( $_POST['ciudad'] ) && $_POST['ciudad'] !="" ){
					$_SESSION['dir_ciudad'] = $_POST['ciudad'];
					if (  $_POST['ciudad'] != $row['ciudad']){
						$pasa=0;
					}
				}
				
				$val=0;
				if ( isset( $_POST['soporte'] ) && $_POST['soporte'] !="" ){
					if ( $_POST['soporte'] == "web" && $row['proveedor_web'] != "http://" ){
						$val = 1;
					}else{
						if ( $_POST['soporte'] == "redes"   && 
							($row['instagram'] != "http://" && 
							 $row['facebook']  != "http://" && 
							 $row['youtube']   != "http://" && 
							 $row['twitter']   != "http://" && 
							 $row['linkedin']  != "http://" &&
							 $row['tiktok']    != "http://" )){
							 $val = 2;	  
						}
					}
					if ( $val == 0 ){
						$pasa=0;
					}
				}
				
				if( $pasa == 1 ){
					// leemos solo los registros relacio con marcas y categorias
					$sql2 = "SELECT * FROM proveedor_marcas where idCompany = $company_id order by categoria, 
					subcategoria, grupo, marca, tipo_empresa;";
					$result2 = mysqli_query($this->dbConnect, $sql2);
					$totalResult2 = mysqli_num_rows($result2);
					
					$hayCat=0;
					$haySubcat=0;
					$hayGrupo=0;
					$hayMarca=0;
					$hayOrigen=0;
					$hayTipo=0;
					$haySector=0;
					$hayVerifica=0;
					$hayInternet=0;
					
					if($totalResult2 > 0) {
						while ($row2 = mysqli_fetch_assoc($result2)) {
							// ahora por cada indicador debo preguntar si pasa o no....					
							if ( isset( $_POST['categoria'] ) && $_POST['categoria'] !="" ){
								if (  $_POST['categoria'] == $row2['categoria']){
									$hayCat =  1;
									$_SESSION['dir_categoria'] = $_POST['categoria'];
								}
							}
							if ( isset( $_POST['subcategoria'] ) && $_POST['subcategoria'] !="" ){
								if (  $_POST['subcategoria'] == $row2['subcategoria']){
									$haySubcat =  1;
									$_SESSION['dir_subcategoria'] = $_POST['subcategoria'];
								}
							}
							if ( isset( $_POST['grupo'] ) && $_POST['grupo'] !="" ){
								
									$hayGrupo =  1;
									$_SESSION['dir_grupo'] = $row2['grupo'];

							}
							
							if ( isset( $_POST['preferencia'] ) && $_POST['preferencia'] !="" ){
								if ($_POST['preferencia'] == "origen"){
									$_SESSION['dir_preferencia'] = 2;
									$_SESSION['dir_origen'] = "US";
								}else{
									if ( $_POST['preferencia'] == "marca"){
										$_SESSION['dir_origen'] = "0";
										$_SESSION['dir_preferencia'] = 1;
									}else{
										$_SESSION['dir_preferencia'] =0;	
										$_SESSION['dir_origen'] = "0";
									}
								}
							}
							
							
							if ( isset( $_POST['internet'] ) && $_POST['internet'] !="" ){
								if ($_POST['internet'] == "web"){
									$_SESSION['dir_internet'] = 1;
								}else{
									if ( $_POST['internet'] == "redes"){
										$_SESSION['dir_internet'] = 2;
									}else{
										$_SESSION['dir_internet'] =0;	
									}
								}
							}
							
							if ( isset( $_POST['marca'] ) && $_POST['marca'] !="" ){
								if (  $_POST['marca'] == $row2['marca']){
									$hayMarca =  1;
									$_SESSION['dir_marca'] = $_POST['marca'];
								}
							}
							if ( isset( $_POST['tipo'] ) && $_POST['tipo'] !="" ){
									$hayTipo =  1;
									$_SESSION['dir_tipo'] = $_POST['tipo'];
							}
						}
						// preguntamos a ver si pasa o no
						if ( isset( $_POST['categoria'] ) && $_POST['categoria'] !="" && $hayCat == 0){
							$pasa=0;
						}
						if ( isset( $_POST['subcategoria'] ) && $_POST['subcategoria'] !="" && $haySubcat == 0){
							$pasa=0;
						}
						if ( isset( $_POST['grupo'] ) && $_POST['grupo'] !="" && $hayGrupo == 0){
							$pasa=0;
						}
						if ( isset( $_POST['marca'] ) && $_POST['marca'] !="" && $hayMarca == 0){
							$pasa=0;
						}
						
						if ( isset( $_POST['pais_origen'] ) && $_POST['pais_origen'] !="" && $hayOrigen == 0){
							$pasa=0;
						}
						
						if ( isset( $_POST['tipo'] ) && $_POST['tipo'] !="" && $hayTipo == 0){
							$pasa=0;
						}
						
						if ( isset( $_POST['internet'] ) && $_POST['internet'] !="" && $hayInternet == 0){
							$pasa=0;
						}
					}	
				}
				
				// Quede aqui para los sectores
				if( $pasa == 1 ){
					if ( isset( $_POST['sector'] ) && $_POST['sector'] !="" ){
						// leemos solo los registros relacio con marcas y categorias
						$sql = "SELECT * FROM proveedor_sectores where idProveedor= $company_id and sector=".$_POST['sector'];
						$result2 = mysqli_query($this->dbConnect, $sql);
						if(mysqli_num_rows($result2) == 0 ){
							$pasa=0;
						}else{
							$_SESSION['dir_sector'] = $_POST['sector'];	
						}
					}
				}
				
				$verificado=0;
				// Quede aqui para las revisiones
				if( $pasa == 1 ){
					if ( isset( $_POST['verificado'] ) && $_POST['verificado'] !="" ){
						// leemos solo los registros relacio con marcas y categorias						
						$pasa == 0;
						$sql3 = "SELECT * FROM proveedor_revisiones where idProveedor= $company_id";
						$result3 = mysqli_query($this->dbConnect, $sql3);
						if(mysqli_num_rows($result3) > 0 ){
							while ($row3 = mysqli_fetch_assoc($result3)) {
								// analizamos las variables filtros
								if( $row3['revisor'] == "mg" && $_POST['verificado']="mg"){
									$verificado = 1;
									$_SESSION['dir_verifica'] = $verificado;
									$pasa = 1;
									break;
								}else{
									if($_POST['verificado'] == "pendiente" && $row3['tipo'] != "A"){
										$verificado = 2;
										$_SESSION['dir_verifica'] = $verificado;
										$pasa = 1;
										break;
									}else{
										if( $_POST['verificado'] == "tercero" && $row3['tipo'] == "A"){
											$verificado = 3;
											$_SESSION['dir_verifica'] = $verificado;
											$pasa = 1;
											break;
										}
									}									
								}
							}
						}
						if( $verificado == 0){
							$pasa = 0;	
						}
					}
				}
				
				//
				// SI PASA AGREGAMOS EL REGISTRO
				//
				if( $pasa == 1 ) {
					$searchResultHTML .= '
					<div class="col-sm-4 col-lg-4 col-md-4">
						<div style="border:3px solid #ccc; border-radius:0px 10px 0px 10px; border-style:dashed; padding:10px; margin-bottom:10px; height:350px;">
							<div align="center">
								<a href="../fichaTecnica.php?id='. $row['id'] .'">
								<img width="170px" height: "50px" src="http://localhost/STRASOURCING/assets/documentos/imagenes/logos/'. $row['logo_imagen'] .'"  alt=""  >
								</a>
								</div>
								<p align="center"><strong><a href="../fichaTecnica.php?id='. $row['id'] .'">'. $row['razon_social'] .'</a></p>
								<h5 style="text-align:center;" class="text-danger">id: '. $row['id'] . '</h5>
								<h6 style="text-align:center;" class="text-danger">'. $row['telefono_empresa'] .'</h6>
								<h6 style="text-align:center;" class="text-danger">'. $row['admin_nombre'] .'</h6>
								<h6 style="text-align:center;" class="text-danger">'. $row['email_empresa'] .'</h6>
								<h6 style="text-align:center;" class="text-danger">'. $row['nombreEstado'] .'</h6>
								<h6 style="text-align:center;" class="text-danger">'. $row['numero_rif'] . '</h6>
								</strong>
							</div>
						</div>
					</div>
					';
				}
			}	
			 // fin de while de proveedores 
		// fin resulato>0   
		}else {
			$searchResultHTML = '<h3>No se ha encontrado ningún proveedor..</h3>';
		}
		
		return $searchResultHTML; 	
	}	
}
?>
