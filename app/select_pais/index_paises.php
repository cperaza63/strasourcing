<?php 

$connect = new PDO("mysql:host=localhost;dbname=spa", "root", "");

$query = "
    SELECT country_code, country_name FROM tbl_paises ORDER BY country_name ASC";

$result = $connect->query($query);



?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
        <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
        <script src="library/dselect.js"></script>

        <title>Seleccione un pais de la lista</title>
    </head>
    <body>

        <!--<div class="container">
            <h1 class="mt-2 mb-3 text-center text-primary">Paises</h1>-->
            <div class="row">    
                <div class="col-md-6">
                    <select name="select_pais" class="form-control" id="select_pais">
                        <!--<option value="">Seleccione Pais</option>-->
                        <?php 
						if( $_SESSION['pais'] == $row["country_code"]){
							$seleccion = "selected";
						}
                        foreach($result as $row)
                        {
                            echo '<option value="'. strtoupper($row["country_code	"]).'"
							
							
							>'.strtoupper($row["country_name"]).'</option>';
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

    var select_pais_element = document.querySelector('#select_pais');

    dselect(select_pais_element, {
        search: true
    });

</script>