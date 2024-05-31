<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>Subir imagenes - SPA</title>

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript">

<?php
if (isset($_GET['tipoTabla'])){
	$tipoTabla = $_GET['tipoTabla'];
	if( $tipoTabla == 13 ){
		$tipoTabla = $_GET['tipoTabla'];
		$folder = $_GET['folder'];
		$idUsuario = $_GET['idUsuario'];	
		$cadena = "tipoTabla=$tipoTabla&idUsuario=$idUsuario&folder=$folder";
	}else{
		if( $tipoTabla == 12 || $tipoTabla == 14){
			$idCompany = $_GET['idCompany'];
			$tipoEmpresa = $_GET['tipoEmpresa'];
			$cadena = "tipoEmpresa=$tipoEmpresa&tipoTabla=$tipoTabla&idCompany=$idCompany";
		}else{
			if( $tipoTabla == 15 ){
				$marca = $_GET['marca'];
				$rifCompany = $_GET['rifCompany'];
				$tipoEmpresa = $_GET['tipoEmpresa'];
				$cadena = "marca=$marca&tipoEmpresa=$tipoEmpresa&tipoTabla=$tipoTabla&rifCompany=$rifCompany";
			}	
		}
		
	}	
}

?>

$(document).ready(function () {
    $('#submitButton').click(function () {
    	    $('#uploadForm').ajaxForm({
    	        target: '#salidaImagen',
    	        url: 'CargarArchivos.php?<?php echo $cadena;?>',
    	        beforeSubmit: function () {
    	        	  $("#salidaImagen").hide();
    	        	   if($("#uploadImage").val() == "") {
    	        		   $("#salidaImagen").show();
    	        		   $("#salidaImagen").html("<div class='error'>Elige un archivo para subir.</div>");
                    return false; 
                }
    	            $("#progressDivId").css("display", "block");
    	            var percentValue = '0%';

    	            $('#progressBar').width(percentValue);
    	            $('#percent').html(percentValue);
    	        },
    	        uploadProgress: function (event, position, total, percentComplete) {

    	            var percentValue = percentComplete + '%';
    	            $("#progressBar").animate({
    	                width: '' + percentValue + ''
    	            }, {
    	                duration: 100,
    	                easing: "linear",
    	                step: function (x) {
                        percentText = Math.round(x * 100 / percentComplete);
    	                    $("#percent").text(percentText + "%");
                        if(percentText == "100") {
                        	   $("#salidaImagen").show();
                        }
    	                }
    	            });
    	        },
    	        error: function (response, status, e) {
    	            alert('Oops something went.');
    	        },
    	        
    	        complete: function (xhr) {
    	            if (xhr.responseText && xhr.responseText != "error")
    	            {
    	            	  $("#salidaImagen").html(xhr.responseText);
    	            }
    	            else{  
    	               	$("#salidaImagen").show();
        	            	$("#salidaImagen").html("<div class='error'>Problema al cargar el archivo.</div>");
        	            	$("#progressBar").stop();
    	            }
    	        }
    	    });
    });
});
</script>
</head>

<body>
<!-- Begin page content -->
<div class="container">
	<div class="col-12 col-md-12"> 
	<!-- Contenido -->
		<div class="form-container"> 
			<form class="form-inline" action="CargarArchivos.php" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="file" id="uploadImage" name="uploadImage" />
                </div>
                <button id="submitButton" type="submit" class="btn btn-secondary mb-2" style="background-color:#5B00B7; color:white;" name='btnSubmit'>Cargar imagen</button>
			</form>
            <div class='progress' id="progressDivId">
            <div class='progress-bar' id='progressBar'></div>
            <div class='percent' id='percent'>0%</div>
		</div>
		<div style="height: 10px;"></div>
	<div id='salidaImagen'></div>
</div> 
<!-- Fin Form-container -->     
<!-- Fin Contenido --> 
</div>
</div>
<!-- Fin row -->   

<!-- Fin container -->
<footer class="footer">
  <div class="container"> <span class="text-muted">
    <p>Desaarrollado por <a href="https://www.strasourcing.com/" target="_blank">CP&JCL</a></p>
    </span> </div>
</footer>
<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>