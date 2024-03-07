<?php 
$connect = new PDO("mysql:host=localhost;dbname=spa", "root", "");
$query = "SELECT country_code, country_name FROM tbl_paises where country_code='VE' ORDER BY country_name ASC";
$result = $connect->query($query);

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="http://localhost/STRASOURCING/select_pais/library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
        <script src="http://localhost/STRASOURCING/select_pais/library/bootstrap-5/bootstrap.bundle.min.js"></script>
        <script src="http://localhost/STRASOURCING/select_pais/library/dselect.js"></script>

        <title>Seleccione un pais de la lista</title>
    </head>
    <body>

        <!--<div class="container">
            <h1 class="mt-2 mb-3 text-center text-primary">Paises</h1>-->
            <div class="row">    
                <div class="col-md-6">
                    <select name="select_box" class="form-control" id="select_box">
                        <!--<option value="">Seleccione Pais</option>-->
                        <?php 
                        foreach($result as $row)
                        {
                            echo '<option value="'. strtoupper($row["country_code"]).'">'.strtoupper($row["country_name"]).'</option>';
                        }
                        ?>  
                    </select>
                </div>
                
            </div><!--
            <br />
            <br />
        </div>-->
    </body>
</html>

<script>

    var select_box_element = document.querySelector('#select_box');

    dselect(select_box_element, {
        search: true
    });

</script>