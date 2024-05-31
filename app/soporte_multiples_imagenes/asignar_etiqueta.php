<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.111.3">
        <title>SISTEMA SPA | registrate gratis</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
            <!-- Favicons -->
        <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico">

</head>

<body>
    <div class="content">
      <div class="container" style="text-align:center;">

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">SPA - Procura y Abastecimiento</h5>

                <p class="card-text">
                <h4>Etiqueta de la imagen</h4> 
                    <?php
                    session_start();
                    $etiqueta = "";
                    $image_id = "";
                    
                    if( isset( $_POST['etiqueta']) && isset($_POST['image_id']) ){
                        $etiqueta = $_POST['etiqueta'];
                        $image_id = $_POST['image_id'];
                        
                        echo "<br>Etiqueta " . $etiqueta . " asignada a la imagen Codigo #" . $image_id . "<br>";
                        require_once('dbConnection.php');
                        $update = "UPDATE table_soportes SET idCompany=" . $_SESSION['companyHive'] . " ,etiqueta= '" . $etiqueta . "' WHERE id = '". $image_id."'";
                        //echo "===". $update;
                        mysqli_query($con, $update);
                        $_GET['id'] = $image_id;
                    }
                    ?>        
                <form method="post" action="asignar_etiqueta.php">
                        <input type="hidden" name="image_id" value="<?php echo isset($_GET['id']) ? $_GET['id']: 0; ?>">
                        <br><br>
                        <div class="container col-md-6">
                            <p>
                              <select name="etiqueta" class="form-control">
                                <option value="IMAGENES Y FOTOS"> IMAGENES Y FOTOS</option>
                                <option value="CERTIFICACIONES"> CERTIFICACIONES</option>
                                <option value="CATALOGOS"> CATALOGOS</option>
                                <option value="NOTICIAS"> NOTICIAS</option>
                                <option value="VIDEOS"> VIDEOS</option>
                                <option value="REFERENCIAS"> REFERENCIAS</option>
                              </select>
                            </p>
                            <p><br>
                            </p>
                            <button type="submit" name="accion" class="btn btn-secondary" value="asignar_etiqueta" style="background-color:#5B00B7;color:white;">Asignar Etiqueta</button>
                            <a target="_parent" href="http://localhost/STRASOURCING/app/registrate_gratis/proveedor_spa_paso4.php" class="btn btn-outline-secondary"> Volver</a>
                        </div>        
                      </form>
                </p>
              </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	

</body>
</html>