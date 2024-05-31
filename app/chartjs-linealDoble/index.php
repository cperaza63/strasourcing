<!DOCTYPE html>
<html>
<head>
	<title>Gráfico de líneas usando Chart.js con PHP - BaulPHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- ChartJS -->
	<script src="chart.js/Chart.js"></script>
</head>
<body>
<div class="container">
	<!--<h1 class="page-header text-left">Comparativo de Instrumentacion y Control</h1>-->

	<div class="row">

		<div class="col-md-10">
			<div class="box box-success">
            <div class="box-header with-border">
            	<?php
					       $year = date('Y');
            	?>
              <!--<h5 class="box-title">Consultas (<?php echo "Despliegue"; ?> vs <?php echo "Consulta al Cliente"; ?>)</h5>-->

            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
        </div>
		</div>
	</div>
</div>
<?php include('proceso.php'); ?>
<script>
  $(function () {
    var lineChartData = {
      labels  : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
      datasets: [
        {
          label               : 'Año Previo',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [ "<?php echo $d1; ?>",
                                  "<?php echo $d2; ?>",
                                  "<?php echo $d3; ?>",
                                  "<?php echo $d4; ?>",
                                  "<?php echo $d5; ?>",
                                  "<?php echo $d6; ?>",
                                  "<?php echo $d7; ?>",
                                  "<?php echo $d8; ?>",
                                  "<?php echo $d9; ?>",
                                  "<?php echo $d10; ?>",
                                  "<?php echo $d11; ?>",
                                  "<?php echo $d12; ?>", 
								  "<?php echo $d13; ?>",
                                  "<?php echo $d14; ?>",
								  "<?php echo $d15; ?>",
                                  "<?php echo $d16; ?>",
								  "<?php echo $d17; ?>",
                                  "<?php echo $d18; ?>",
								  "<?php echo $d19; ?>",
                                  "<?php echo $d20; ?>",
                                  "<?php echo $d21; ?>", 
								  "<?php echo $d22; ?>",
                                  "<?php echo $d23; ?>",
								  "<?php echo $d24; ?>",
                                  "<?php echo $d25; ?>",
								  "<?php echo $d26; ?>",
                                  "<?php echo $d27; ?>",
								  "<?php echo $d28; ?>",
                                  "<?php echo $d29; ?>",
                                  "<?php echo $d30; ?>",
								  "<?php echo $d31; ?>"
                                ]
        },
        {
          label               : 'Este año',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [ "<?php echo $p1; ?>",
                                  "<?php echo $p2; ?>",
                                  "<?php echo $p3; ?>",
                                  "<?php echo $p4; ?>",
                                  "<?php echo $p5; ?>",
                                  "<?php echo $p6; ?>",
                                  "<?php echo $p7; ?>",
                                  "<?php echo $p8; ?>",
                                  "<?php echo $p9; ?>",
                                  "<?php echo $p10; ?>",
                                  "<?php echo $p11; ?>",
                                  "<?php echo $p12; ?>", 
								  "<?php echo $p13; ?>",
                                  "<?php echo $p14; ?>",
								  "<?php echo $p15; ?>",
                                  "<?php echo $p16; ?>",
								  "<?php echo $p17; ?>",
                                  "<?php echo $p18; ?>",
								  "<?php echo $p19; ?>",
                                  "<?php echo $p20; ?>",
                                  "<?php echo $p21; ?>", 
								  "<?php echo $p22; ?>",
                                  "<?php echo $p23; ?>",
								  "<?php echo $p24; ?>",
                                  "<?php echo $p25; ?>",
								  "<?php echo $p26; ?>",
                                  "<?php echo $p27; ?>",
								  "<?php echo $p28; ?>",
                                  "<?php echo $p29; ?>",
                                  "<?php echo $p30; ?>"
                                ]
        }
      ]
    }
  
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : true,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }
    
    lineChartOptions.datasetFill = true
    lineChart.Line(lineChartData, lineChartOptions)

  })
</script>
</body>
</html>