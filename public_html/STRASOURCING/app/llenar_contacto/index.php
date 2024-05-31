<?php 
include "config.php";

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
<!doctype html>
<html>
    <head>
    <title>INDIQUE LA UBICACION DE SU EMPRESA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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
    </head>
    <body style="background-color:#E6E6E6	;">
    <br>
    <div class="container" style="background-color:white;" >
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header text-center">
                                <a href="http://localhost/strasourcing/app/llenar_contacto/">
                                <img class="img-thumbnail" src="../../assets/img/logo.png" width="225">
                                </a>
                                <h3 class="font-weight-light my-4">Area de contacto - Procura y Abastecimiento</h3>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div align="center">
        <div align="left" class="col-lg-9">
        <form method="POST" action="">
            <div class="form-group">
                <label class="small mb-1" for="usuario"><i class="fas fa-user"></i> <strong>Nombre y Apelido</strong></label>
                <input class="form-control py-4" id="usuario" name="usuario" type="text" placeholder="Ingrese nombre completo" />
            </div>
            <div class="form-group">
                <label class="small mb-1" for="empresa"><i class="fas fa-industry"></i> <strong>Nombre de la empresa que representa</strong></label>
                <input class="form-control py-4" id="empresa" name="empresa" type="text" placeholder="Ingrese nombre razon social" />
            </div>
            <div class="alert alert-danger text-center d-none" id="alerta" role="alert">

            </div>

            <div class="form-group">
                <label class="small mb-1" for="email"><i class="fas fa-industry"></i> <strong>e-mail de contacto</strong></label>
                <input class="form-control py-4" id="email" name="email" type="text" placeholder="Ingrese su correo electronico" />
            </div>
            <div class="alert alert-danger text-center d-none" id="alerta2" role="alert">

            </div>

            <div class="form-group">
                <label class="small mb-1" for="telefono"><i class="fas fa-industry"></i> <strong>Telefono contacto</strong></label>
                <input class="form-control py-4" id="telefono" name="telefono" type="text" placeholder="Ingrese su telefono celular de contacto" />
            </div>
            <div class="alert alert-danger text-center d-none" id="alerta3" role="alert">

            </div>

            
            <div class="card">
                <div class="card-header text-white" style="background-color: #00AA9E;"><strong>Establezca su ubcación</strong> </div>
                <div class="card-body" style=" border:1px solid #00AA9E">

                <div class="form-group">
                    <label class="small mb-1" for="pais_edo_city"><i class="fas fa-building"></i> <strong>Direccion de su negocio</strong></label>
                    <?php
                        require_once "../select_pais/index.php";
                    ?>
                </div>
                <div><strong>Estados </strong></div>
                <select class="form-control" id="sel_depart" name="estados">
                    <option value="0">- Seleccione -</option>
                    <?php 
                    // llamamos a los registros
                    $sql_department = "SELECT * FROM estados";
                    $department_data = mysqli_query($con,$sql_department);
                    while($row = mysqli_fetch_assoc($department_data) ){
                        $departid = $row['codigo'];
                        $depart_name = $row['state'];
                    
                        // Opciones con registros
                        echo "<option value='".$departid."' >".$depart_name."</option>";
                    }
                    ?>
                </select>
                <div class="clear"></div>
                <hr>
                <div><strong>Ciudades</strong> </div>
                <select class="form-control" id="sel_user" name="ciudades">
                    <option value="0">- Seleccione -</option>
                </select>
                </div>
            </div>

            <div class="form-group">
                <label for="asunto"><strong>Asunto</strong></label>
                <select name="asunto" class="form-control">
                    <option value="0">Quiero saber mas acerca del sistema</option>
                    <option value="1">Me interesa registrarme de una vez</option>
                    <option value="2">Me gustaria contactarlos personalmente</option>
                    <option value="4">Pertenezco a una camara/organizacion </option>
                    <option value="5">Quiero saber mas acerca de los costos corporativos </option>
                    <option value="6">Donde puedo obtener mas informacion/bibliografia </option>
                    <option value="7">Quiero ser aliado de Ustedes</option>
                    <option value="8">Otro distinto a estas opciones</option>
                </select>
            </div>

            <div class="form-group">
                <label class="small mb-1" for="comentario"><i class="fas fa-industry"></i> <strong>Comentario</strong></label>
                <br>
                <textarea class="form-control" name="comentario" cols="65" rows="5"></textarea>
            </div>
            <div align="center" class="form-group">
                <input value="Enviar" type="submit" class="btn btn-success" id="boton" name="enviar" placeholder="Ingrese su telefono celular de contacto" />
                <a class="btn btn-danger" href="../index.php"> Regresar</a>
            </div>
            <br><br>
            </div>
        </form>    
        </div>
        </div>
    <br>
    

</body>
</html>
