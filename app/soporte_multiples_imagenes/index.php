 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Soporte de documentos de la Empresa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
?>
<div class="container">
<form id="submitForm">
  <div class="row">
	<strong>
  	<?php echo "TIPO DE SOPORTE: " . $_SESSION['etiqueta'];?>
    </strong>
      <div class="col-md-8">
      <div class="input-group">
 		 <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" name="multipleFile[]" id="multipleFile" required multiple>
            <label class="custom-file-label" for="multipleFile">Elija varias imágenes para cargar</label>
          </div>
	  </div>
      </div>
      <div class="col-md-2">
      <button type="submit" name="upload" class="btn btn-secondary" style="background-color:#5B00B7; color:white;">Cargar Archivos</button>
      </div>
      
    </div>
    </form>
</div>
<div class="container">

<div class="row">
    <div class="col-md-12">
     <div class="alert alert-success alert-dismissible" id="success" style="display: none;">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          El archivo se ha cargado correctamente
        </div>
    </div>
    </div>
    </div>

  <!-- view of uploaded images -->
  <div class="container" id="gallery"></div>

  <!--Edit Multiple image form -->
  <div class='modal' id='exampleModal'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'>Actualizar imagen</h4>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
        </div>
        <div id="editForm">

        </div>
      </div>    
    </div>
  </div>

 


</body>
</html>


<script type="text/javascript">
$(document).ready(function(){
	$("#submitForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url  :"upload.php",
      type :"POST",
      cache:false,
      contentType : false, // you can also use multipart/form-data replace of false
      processData : false,
      data: new FormData(this),
      success:function(response){
        $("#outline-success").show();
        $("#multipleFile").val("");
        fetchData();
      }
    });
	});

  // Fetch Data from Database
  function fetchData(){
    $.ajax({
      url  : "fetch_data.php?etiqueta=<?php echo $_SESSION['etiqueta'];?>",
      type : "POST",
      cache: false,
      success:function(data){
        $("#gallery").html(data);
      }
    });
  }
  fetchData();

  // Edit Data from Database
  $(document).on("click",".btn-outline-success", function(){
    var editId = $(this).data('id');
    $.ajax({
      url : "edit.php",
      type : "POST",
      cache: false,
      data : {editId:editId},
      success:function(data){
        $("#editForm").html(data);
      }
    });
  });

  // Delete Data from database

  $(document).on('click','.delete-btn', function(){
    var deleteId = $(this).data('id');
    if (confirm("¿Está seguro de que desea eliminar esta imagen?")) {
      $.ajax({
        url  : "delete.php",
        type : "POST",
        cache:false,
        data:{deleteId:deleteId},
        success:function(data){
			$("#outline-success").show();
          fetchData();
          //alert("La imagen eliminada correctamente");
        }
      });
    }
  });

  // Update Data from database
  $(document).on("submit", "#editForm", function(e){
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
      url  : "update.php",
      type : "POST",
      cache: false,
      contentType : false, // you can also use multipart/form-data replace of false
      processData : false,
      data: formData,
      success:function(response){
        $("#exampleModal").modal('hide');
        alert("Imagen actualizada correctamente");
        fetchData();
      }
    });
  });
});

</script>


