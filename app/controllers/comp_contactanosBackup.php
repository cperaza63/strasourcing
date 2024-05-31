<?php 
include "../components/config.php";

if( isset( $_POST['enviar'] ) ){
    // validamos los campos
    if( empty($_POST['usuario'])  || empty($_POST['empresa']) || empty($_POST['email'])  || 
        empty($_POST['telefono']) || $_POST['estados'] == "0"  || $_POST['ciudades'] == "0" || 
        empty($_POST['asunto'])   || empty($_POST['comentario'] ) ){
        ?>
            <script>
                alert("Existe(n) campos que estan vacios, por favor revise...");
                history.go(-1);
            </script>
        <?php
    }else{
        $sql ="INSERT INTO tabla_contactos SET 
        usuario = '". strtoupper($_POST['usuario'])."',  
        empresa = '". $_POST['empresa'] ."', 
        telefono = '". $_POST['telefono'] ."', 
        email= '".strtolower( $_POST['email'] ) ."',
        pais = 'VE', 
        estado = '" . $_POST['estados'] . "', 
        ciudad = '" . $_POST['ciudades'] . "',
        asunto = " . strtoupper($_POST['asunto']) . ",   
        comentario = '" . strtoupper($_POST['comentario']) ."'";
        echo $sql;

        $query_insert = mysqli_query($con, $sql);
        ?>
        <script>
        alert('Su información ha sido enviada a nuestra oficina, estaremos pendiente de responderle a la brevedad posible Gracias!');
        window.location="http://localhost/spa_admin/";
        </script>
        <?php
    }
}
?>

<script type="text/javascript">
	$(document).ready(function(){

		$("#sel_depart").change(function(){
			var deptid = $(this).val();

			$.ajax({
				url: './getUsers.php',
				type: 'post',
				data: {depart:deptid},
				dataType: 'json',
				success:function(response){

					var len = response.length;

					$("#sel_user").empty();
					for( var i = 0; i<len; i++){
						var id = response[i]['id'];
						var name = response[i]['name'];

						$("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

					}
				}
			});
		});

	});
</script>