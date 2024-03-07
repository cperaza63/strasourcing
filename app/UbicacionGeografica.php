<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        /*
 * Globals
 */

/* Links */
a,
a:focus,
a:hover {
  color: #fff;
}

/* Custom default button */
.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus {
  color: #333;
  text-shadow: none; /* Prevent inheritance from `body` */
  background-color: #fff;
  border: .05rem solid #fff;
}


/*
 * Base structure
 */

html,
body {
  height: 100%;
  background-color: #333;
}

body {
  display: -ms-flexbox;
  display: flex;
  color: #fff;
  text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
  box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
}

.cover-container {
  max-width: 42em;
}


/*
 * Header
 */
.masthead {
  margin-bottom: 1rem;
}

.masthead-brand {
  margin-bottom: 0;
}

.nav-masthead .nav-link {
  padding: .15rem 0;
  font-weight: 700;
  color: rgba(255, 255, 255, .5);
  background-color: transparent;
  border-bottom: .15rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(255, 255, 255, .25);
}

.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-masthead .active {
  color: #fff;
  border-bottom-color: #fff;
}

@media (min-width: 48em) {
  .masthead-brand {
    float: left;
  }
  .nav-masthead {
    float: right;
  }
}


/*
 * Cover
 */
.cover {
  padding: 0 1.5rem;
}
.cover .btn-lg {
  padding: .75rem 1.25rem;
  font-weight: 700;
}


/*
 * Footer
 */
.mastfoot {
  color: rgba(255, 255, 255, .5);
}

    </style>
</head>
<body>
	<?php 
	if( isset($_GET['tipo'] ) && $_GET['tipo'] = "empresa" ){
		$retorno = "http://localhost/strasourcing/app/registrate_gratis/comprador_spa.php?&accion=spa&titulo_pagina=Actualización de datos de la empresa";
	}else{
		if( isset($_GET['tipo'] ) && $_GET['tipo'] = "proveedor" ){
			$retorno = "http://localhost/strasourcing/app/registrate_gratis/proveedor_spa.php?&accion=spa&titulo_pagina=Actualización de datos del Proveedor";
		}
	}
	?>
    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column justify-content-center">
        <header class="masthead mb-auto">
            <div class="inner">
              <div class="nav nav-masthead justify-content-center">
              	<form method="POST" target="_parent" action="<?php echo $retorno;?>">
                  <div class="row">
                      <div class="col-md-4">
                        <input name="txtDireccion" type="text" id="txtDireccion" class="form-control" placeholder="direccion">
                        
                      </div>
                      <div class="col-md-4">
                        <input name="txtCiudad" type="text" id="txtCiudad" class="form-control" placeholder="ciudad">
                    </div>
                    <div class="col-md-4">
                        <input name="txtEstado" type="text" id="txtEstado" class="form-control" placeholder="estado">
                    </div>
                  </div>
				  <input name type="hidden" value ="" />
              <div class="row">
                <div class="col-md-4">
                    <input name="latitude" type="text" id="txtLat" class="form-control" placeholder="latitude">
                    
                  </div>
                  <div class="col-md-4">
                    <input name="longitude" type="text" id="txtLng" class="form-control" placeholder="longitud">
                  </div>
                  
                  <div class="col-md-4">
                    <input name="grabar_direccion" type="submit" class="brn btn-success form-control" value="Grabar Dirección" id="txtLng" placeholder="grabar"> 
                   
                  </div>       
              </div>
              </div>
            </div>
      	</header>
          <main role="main" class="inner cover">
            <div id="map_canvas" width="100%" style="height:300px">
            </div>
          </main>
        
          
    </div>
    
    <p>
    <span class="col-md-2">
    <input type="submit" class="brn btn-outline-secondary form-control" value="Salir" id="salir" placeholder="salir">
    </span>
      </p>
      
    </form>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxb8yRixOynQF18jgHtmgImmQwYMEBvGo"></script>
    <script>
        var vMarker
        var map
            map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 14,
                center: new google.maps.LatLng(10.199915, -68.0104358),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(10.199915, -68.0104358),
                draggable: true
            });
            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(6));
                $("#txtLng").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });
            map.setCenter(vMarker.position);
            vMarker.setMap(map);

            $("#txtCiudad, #txtEstado, #txtDireccion").change(function () {
                movePin();
            });

            function movePin() {
            var geocoder = new google.maps.Geocoder();
            var textSelectM = $("#txtCiudad").text();
            var textSelectE = $("#txtEstado").val();
            var inputAddress = $("#txtDireccion").val() + ' ' + textSelectM + ' ' + textSelectE;
            geocoder.geocode({
                "address": inputAddress
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    vMarker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    map.panTo(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    $("#txtLat").val(results[0].geometry.location.lat());
                    $("#txtLng").val(results[0].geometry.location.lng());
                }

            });
        }
        </script>
</body>
</html>