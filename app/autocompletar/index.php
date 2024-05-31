<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<title>programa de rif</title>

<!--<style type="text/css">
*{ font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif}
.main{ margin:auto; border:1px solid #7C7A7A; width:40%; text-align:left; padding:30px; background:#85c587}
input[type=submit]{ background:#6ca16e; width:100%;
    padding:5px 15px; 
    background:#ccc; 
    cursor:pointer;
    font-size:16px;
   
}
input[type=text]{ margin: 5px;
   
}
</style>-->
</head>
<body bgcolor="#bed7c0">
<container>
    <form action="http://localhost/strasourcing/app/recomendaciones.php" method="post" target="_parent">
        <div class="etiqueta">Ingrese nombre de empresa: </div>
        <div class="input_container">
            <input name="rif" type="text" required="required" class="form-control" id="rif" autocomplete="off" onkeyup="autocompletar()" value="J">
            <ul id="lista_id"></ul>
      </div>
        <div class="input_container">
          <button type="submit" id="enter" class="btn btn-success" name="accion" value="modalSolicitar">Solicitar recomendación</button>
        </div>
        <div class="inv-detail">                                        
        <h6>
        Si no hay resultado de busqueda entonces haga click en Continuar sin empresa...
        </h6>
        </div>                
    </form>  

<container>
<!-- footer -->
</div>
</body>
</html>