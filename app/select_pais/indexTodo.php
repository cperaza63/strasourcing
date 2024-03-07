<?php 
$connect = new PDO("mysql:host=localhost;dbname=spa", "root", "");
$query = "SELECT country_code, country_name FROM tbl_paises ORDER BY country_name ASC";
$result = $connect->query($query);
?>
<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="http://localhost/STRASOURCING/bootstrap/css/bootstrap.min.css">

        <title>Seleccione un pais de la lista</title>
    </head>
    <body>
        <form action="../tablas.php" method="post" target="_parent">
        <input name="index_item" type="hidden" value="<?php echo $_GET["index_item"]?>" />
        <table class="table table-striped table-bordered" width="400">
          <tr>
            <td width="80%">
            <select name="select_box" class="form-control" id="select_box">
                <option value="">Pais de origen: <?php echo $_GET["nombre_pais"] ?></option>
                <?php 
                foreach($result as $row)
                {
					$seleccion = "";
					if ($_GET["country"] == $row["country_code"] ) { 
						$seleccion = " selected";
					}
	                ?>
					<option value="<?php echo strtoupper($row["country_code"]).$seleccion;?>"> 
					<?php echo strtoupper($row["country_name"]);?>
                    </option>';
                   	<?php
                }
                ?>  
             </select>
             </td>
            <td width="20%">
            <button name="select_pais" class="btn btn-secondary" type="submit"><i class="fas fa-edit"></i> Asignar</button>
            </td>
          </tr>
        </table>
        </form>
    </body>
</html>

<script>

    var select_box_element = document.querySelector('#select_box');

    dselect(select_box_element, {
        search: true
    });

</script>