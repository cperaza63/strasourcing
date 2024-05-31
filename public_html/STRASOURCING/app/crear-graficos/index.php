<!DOCTYPE html>
<html lang="es"> 
<?php
include('../config/conexion.php');
$categoria = "";
//echo "id = " . $_GET['id'];
if ( isset($_GET['id']) ){
	$id = $_GET['id'];
	$query = "SELECT idempresa, b.razon_social, date(datetime) as fecha, count(*) as contador, day(datetime) as dia, 
	month(datetime) as mes, year(datetime) as ano 
	FROM bigdata_in a inner join proveedores b on (a.idempresa = b .id) where consultar=1 and tipo=4 
	and programa = 'directorioCategorias' and idempresa = $id 
	group by date(datetime) order by datetime limit 30";
	//echo $query;
	$result = mysqli_query($conexion, $query);
	if ( !$result ) {
		die('Query Failed...');
	}
	$json = array();
	$meses= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
	$etiquetas []= array();
	$datosVentas []= array();
	// ahora el resultado lo convertimos en un objeto json
	$i=-1;
	while( $row = mysqli_fetch_array( $result ) ) {
		$i++;
		array_push($etiquetas, $row['dia']. "/" . $meses[$row['mes']]);
		array_push($datosVentas, $row['contador']);
		/*$json[] = array(
		'idempresa' => $row['idempresa'],
		'razon_social' => $row['razon_social'],
		'fecha' => $row['fecha'],
		'contador' => $row['contador'],
		'dia' => $row['dia'],
		'mes' => $row['mes'],
		'ano' => $row['ano'],
		);*/
	}
}

// $etiquetas = ["01/Ene", "02/Ene", "03/Ene", "04/Ene"];
// $datosVentas = [5000, 1500, 8000, 5102];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas con chart.js StraSourcing</title>
    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <canvas id="grafica"></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
        const etiquetas = <?php echo json_encode($etiquetas) ?>;
        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosVentas2020 = {
            label: "Consultas por dia",
            // Pasar los datos igualmente desde PHP
            data: <?php echo json_encode($datosVentas) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        new Chart($grafica, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: etiquetas,
                datasets: [
                    datosVentas2020,
                    // Aquí más datos...
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
</body>

</html>