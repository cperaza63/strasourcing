<html>
   <head>
      <title>Categorias por Trimestre</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
   </head>
   
   <body>
      <div id = "container" style = "width: 100%; height: 100%; margin: 0 auto">
	    <?php
		$mesActual = array();
		$anoActual = array();
		
		$mesActual[3] = date("m");
		$anoActual[3] = date("Y");
		
		if($mesActual[3] - 1 == 0){ 
			$mesActual[2] = 12;
			$anoActual[2] = $anoActual[3];	
		}else{
			$mesActual[2] = $mesActual[3] -1;
			$anoActual[2] = $anoActual[3];	
		}
		
		if($mesActual[2] - 1 == 0){ 
			$mesActual[1] = 12;
			$anoActual[1] = $anoActual[2] - 1;	
		}else{
			$mesActual[1] = $mesActual[2] -1;
			$anoActual[1] = $anoActual[2];	
		}
		
		if($mesActual[1] - 1 == 0){ 
			$mesActual[0] = 12;
			$anoActual[0] = $anoActual[1] - 1;	
		}else{
			$mesActual[0] = $mesActual[1] - 1;
			$anoActual[0] = $anoActual[1];	
		}
		$trim4 = 0; $trim3 = 0; $trim2 = 0; $trim1 = 0;
		$nomb4 = ""; $nomb3 = ""; $nomb2 = ""; $nomb1 = "";
		$cat11 = 0; $cat12 = 0; $cat13 = 0; $cat14 = 0;
		$cat21 = 0; $cat22 = 0; $cat23 = 0; $cat24 = 0;
		$cat31 = 0; $cat32 = 0; $cat33 = 0; $cat34 = 0;
		$cat41 = 0; $cat42 = 0; $cat43 = 0; $cat44 = 0;
		
		$cat_name = array();
		$cat_cant = array();
		include_once '../config/conexion.php';
		
		$k=0;$sql = "SELECT * FROM php_combo.continente where status=1";
		$result = mysqli_query($conexion, $sql) or die("Error in Selecting " . mysqli_error($connection));
		//create an array
		$j=0;
		while($row = mysqli_fetch_assoc($result))
		{  
			$j++;
			for($k = 0; $k <= 3; $k++){
				echo "<br>cta: " . $row['id']. " " . $row['name'];
				$sql = "SELECT year(datetime), month(datetime), a.idcategoria, b.name, count(a.idcategoria) as cuantos , a.*
				FROM bigdata_in a inner join php_combo.continente b on (a.idcategoria = b.id) 
				where a.idcategoria>0 and datetime<>'' and name<>'' and idcategoria = " . $row['id'] . " and year(datetime) = " . $anoActual[$k] . " 
				and month(datetime) = " . $mesActual[$k] . " and tipo=3 and programa='fichaTecnica' and consultar=1 
				group by a.idcategoria, year(datetime) desc, month(datetime)desc ";
				
				$result2 = mysqli_query($conexion, $sql) or die("Error in Selecting " . mysqli_error($connection));
				$vector[$k] = array();
				$cat[$k] = array();
				$name[$k] = array();
				$cuantos[$k] = array();
				while($row2 = mysqli_fetch_assoc($result2))
					{  
					if ($row2['idcategoria']>0){
						echo "<br>k=" . $k . "<br>";
						$y = substr( $row2['datetime'], 4, 3 );
						$m = substr( $row2['datetime'], 2, 2 );
						$vector[$k][$j] = $m . $y;
						$cat[$k][$j] = $row2['idcategoria'];
						$name[$k][$j]= $row2['name'];
						$cuantos[$k][$j]= $row2['cuantos'];
						
						if($k == 0){
							//$cat11 = 190; $cat12 = 390; $cat13 = 180; $cat14 = 180;
							if ($j == 1) {
								$cat11 = $cuantos[$k][$j];
							}else if($j == 2){
								$cat12 = $cuantos[$k][$j];
							}else if($j == 3){
								$cat13 = $cuantos[$k][$j];
							}else if($j == 4){
								$cat14 = $cuantos[$k][$j];
							}
							$trim1 = $vector[$k][$j];
							$nomb1 = $cat[$k][$j];
							echo "<br>mes " . $trim1 . " cat " . $nomb1 . " " . $cat11." " . $cat12." " . $cat13." " . $cat14."<br>";
						}else{
							if($k == 1){
								//$cat21 = 1000; $cat22 = 400; $cat23 = 180; $cat24 = 180;
								if ($k == 1) {
									$cat21 = $cuantos[$k][$j];
								}else if($j == 2){
									$cat22 = $cuantos[$k][$j];
								}else if($j == 3){
									$cat23 = $cuantos[$k][$j];
								}else if($j == 4){
									$cat24 = $cuantos[$k][$j];
								}
								$trim2 = $vector[$k][$j];
								$nomb2 = $cat[$k][$j];
								echo "<br>mes " . $trim2 . " cat " . $nomb2 . " " . $cat21." " . $cat22." " . $cat23." " . $cat24."<br>";
							}else{
								if($k == 2){
									//$cat21 = 1000; $cat22 = 400; $cat23 = 180; $cat24 = 180;
									if ($k == 1) {
										$cat31 = $cuantos[$k][$j];
									}else if($k == 2){
										$cat32 = $cuantos[$k][$j];
									}else if($k == 3){
										$cat33 = $cuantos[$k][$j];
									}else if($k == 4){
										$cat34 = $cuantos[$k][$j];
									}
									$trim3 = $vector[$k][$j];
									$nomb3 = $name[$k][$j];
									echo "<br>mes " . $trim3 . " cat " . $nomb3 . " " . $cat31." " . $cat32." " . $cat33." " . $cat34."<br>";
								}else{
									if($k == 3){
										//$cat21 = 1000; $cat22 = 400; $cat23 = 180; $cat24 = 180;
										if ($j == 1) {
											$cat41 = $cuantos[$k][$j];
										}else if($k == 2){
											$cat42 = $cuantos[$k][$j];
										}else if($k == 3){
											$cat43 = $cuantos[$k][$j];
										}else if($k == 4){
											$cat44 = $cuantos[$k][$j];
										}
									}
									$trim4 = $vector[$k][$j];
									$nomb4 = $name[$k][$j];
									echo "<br>mes " . $trim4 . " cat " . $nomb4 . " " . $cat41." " . $cat42." " . $cat43." " . $cat44."<br>";
								}	
							}
						
						}	
						//echo "<br>" . $vector[$k]. " " . $cat[$k]. " " . $name[$k]. " " . $cuantos[$k];	
					}
				}
			}
		}
		/*$vec11 = 
		$cat11 = 900; $cat12 = 390; $cat13 = 180; $cat14 = 180;
		$cat21 = 1000; $cat22 = 400; $cat23 = 180; $cat24 = 180;
		$cat31 = 1170; $cat32 = 440; $cat33 = 180; $cat34 = 180;
		$cat41 = 500; $cat42 = 600; $cat43 = 700; $cat44 = 800;*/
		?>
      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['Trimestre', '<?php echo $nomb4; ?>', '<?php echo $nomb3; ?>', '<?php echo $nomb2; ?>', '<?php echo $nomb1; ?>'],
               ['<?php $trim4; ?>',  <?php echo $cat41?>, <?php echo $cat42 ?>, <?php echo $cat43?>, <?php echo $cat44 ?>],
               ['<?php $trim3; ?>',  <?php echo $cat31?>, <?php echo $cat32 ?>, <?php echo $cat33?>, <?php echo $cat34 ?>],
               ['<?php $trim2; ?>',  <?php echo $cat21?>, <?php echo $cat22 ?>, <?php echo $cat23?>, <?php echo $cat24 ?>],
			   ['<?php $trim1; ?>',  <?php echo $cat11?>, <?php echo $cat12 ?>, <?php echo $cat13?>, <?php echo $cat14 ?>],
			   
            ]);

            var options = {title: 'Categorias (consultas)'};  

            // Instantiate and draw the chart.
            var chart = new google.visualization.BarChart(document.getElementById('container'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>
   </body>
</html>