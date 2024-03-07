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
<div class="container" id="gallery">
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
      url  : "fetch_dataView.php",
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


