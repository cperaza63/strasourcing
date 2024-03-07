</head>
<body class="">
<!--<div role="navigation" class="navbar navbar-default navbar-static-top">-->
<div role="navigation" class="navbar navbar-inverse navbar-static-top" style="background-color:#5B00B7; color:white;">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button" >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <?php 
			
		  	if(isset($_GET['accion'] ) ) {
				if( $_GET['accion'] == "favoritos") {
				  $_SESSION['accion_dir'] = "favoritos";
				}else{
					if( $_GET['accion'] == "formulas") {
					  $_SESSION['accion_dir'] = "formulas";
					}else{
						echo "hay accion1";
						$_SESSION['accion_dir'] = "categoria";
					}	
				}	
			}else{
				if ($_SESSION['formula_id'] >0 ){
					$_SESSION['accion_dir'] = "formulas";	
				}else{
					$_SESSION['accion_dir'] = "categoria";
				}
				
			}
			if(isset($_GET['cat'] ) && $_GET['cat'] != "") {
				if ($_SESSION['formula_id'] >0 ){
					$_SESSION['accion_dir'] = "formulas";	
				}else{
					$_SESSION['accion_dir'] = "categoria";
				}
			}
			
			?>
            <li class="<?php if( $_SESSION['accion_dir'] == "categoria" ){ echo "active"; } ?>"><a target="_parent" href="http://localhost/STRASOURCING/app/directorioCategorias.php?accion=categorias">Categorias</a></li>
            <li class="<?php if( $_SESSION['accion_dir'] == "favoritos" ){ echo "active"; } ?>"><a href="http://localhost/strasourcing/app/filtro_negocios/index.php?accion=favoritos">Favoritos</a></li>
            <li class="<?php if( $_SESSION['accion_dir'] == "formulas" ) { echo "active"; } ?>"><a href="http://localhost/strasourcing/app/filtro_negocios/index.php?accion=formulas">Mis Búsquedas</a> </li>
          	
            <?php
                if (  $_SESSION['accion_dir'] == "formulas" ){
				?>
                    <li>
                        <?php	
                        $query=$dbSPA->query( "select * from formulas where idCompany = " . $_SESSION['companyHive']);
                        $states = array();
                        ?>
                		<form method="post" action="index.php">        
                        <select id="formulas" name="formulas" class="form-control" onchange="this.form.submit()">
                        <?php
                        while($r=$query->fetch_object()){ $states[]=$r; }
                        if(count($states)>0){
                            print "<option value=''>Todas las busquedas </option>";
							
                            foreach ($states as $s) {
								if (isset( $_SESSION['formula_id'] ) && $_SESSION['formula_id'] == $s->id ) {
									$seleccion= "selected";	
								}else{
									$seleccion= "";
								}
                                print "<option value='$s->id' $seleccion > $s->etiqueta - $s->id </option>";
                            }
                        }else{
                            print "<option value=''>-- NO HAY BUSQUEDAS --</option>";
                        }
                        ?>
                        </select>
                        </form>
                    </li>
				<?php
             	}else{
					$_SESSION['formula_id'] ="";	
				}
             	?>
          </ul>
         
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container" style="min-height:500px;">
	<div class=''>
	</div>