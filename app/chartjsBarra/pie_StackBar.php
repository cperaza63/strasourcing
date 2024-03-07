<!DOCTYPE html>
<html>
    <head>
		<?php
		session_start();
		$programa = "";
    	if ($_SESSION['tipoHive'] == 4) {
			$programa = "getDataProveedores.php";	
		}else{
			$programa = "getData.php";	
		}  
		
        ?>
		<title>Crear un gráfico circular con Google Chart usando PHP y MySQL </title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            function drawChart() {
                // call ajax function to get sports data
                var jsonData = $.ajax({
                    url: "<?php echo $programa; ?>",
                    dataType: "json",
                    async: false
                }).responseText;
                //The DataTable object is used to hold the data passed into a visualization.
                var data = new google.visualization.DataTable(jsonData);

                // To render the pie chart.
                var chart = new google.visualization.PieChart(document.getElementById('chart_container'));
                chart.draw(data, {width: 400, height: 350});
            }
            // load the visualization api
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
        </script>
		
    </head>
    <body>
           <div id="chart_container"></div>
    </body>
</html>