$(document).ready(function(){
    filterSearch();	
    $('.productDetail').click(function(){
        filterSearch();
    });	
	
	$('#priceSlider').slider({		
	}).on('change', priceRange);
	
	$('#formulas').change(function(){	
	 	filterSearch();	
	});
	
});

function getMarca(e){
	// aqui no se prepara nada porque es un solo parametro
	filterSearch();	
}

function priceRange(e){
	$('.priceRange').html($(this).val() + " - 65000");
	$('#minPrice').val($(this).val());
	filterSearch();	
}
function filterSearch() {
	$('.searchResult').html('<div id="loading">Cargando .....</div>');
	var action = $('#accion_menu').val();
	var categoria = $('#categoria').val();
	var idCategoria = $('#idCategoria').val();
	var subcategoria = $('#subcategoria').val();
	var grupo = $('#grupo').val();
	var preferencia = $('#preferencia').val();
	var estado = $('#listaEstados').val();
	var ciudad = $('#listaCiudades').val();
	var tipo = $('#tipo_empresa').val();
	var sector = $('#listaSectores').val();
	var soporte = $('#soporte_internet').val();
	var verificado = $('#verificacion_proveedor').val(); 
	var formulas = $('#formulas').val();
	
	console.log("action", action);
	console.log("categoria", categoria);
	console.log("idCategoria", idCategoria);
	console.log("subcategoria", subcategoria);
	console.log("grupo", grupo);
	console.log("preferencia", preferencia);
	console.log("estado", estado);
	console.log("ciudad", ciudad);
	
	console.log("tipo", tipo);
	console.log("sector", sector);
	console.log("soporte", soporte);
	console.log("verificado", verificado);
	console.log("formulas", formulas);
	
	if( preferencia == "marca" ){
		var marca_producto	= $('#marca_producto').val();
		console.log("marca", marca_producto);
		var pais_origen	= "";
	}else{
		if( preferencia == "origen" ){
			var pais_origen	= $('#pais_origen').val();
			console.log("pais_origen", pais_origen);
			var marca_producto = "";
		}
	}
	// rutina que manda los parametros de busqueda y retorna el resultado de empresas proveedoras
	$.ajax({
		url:"actionDirectorio.php",
		method:"POST",
		dataType: "json",		
		data:{action:action, 
		categoria:idCategoria, 
		subcategoria:subcategoria, 
		grupo:grupo, 
		preferencia:preferencia, 
		marca: marca_producto,
		origen: pais_origen,
		estado:estado, 
		ciudad:ciudad,
		tipo:tipo,
		sector:sector,
		soporte:soporte,
		verificado:verificado,
		formula:formulas
		},
		success:function(data){
			$('.searchResult').html(data.html);
		}
	});
	
	// estas variables no cuentan
	var minPrice = $('#minPrice').val();
	var maxPrice = $('#maxPrice').val();
	var brand = getFilterData('brand');
	var ram = getFilterData('ram');
	var storage = getFilterData('storage');
	/* rutina que manda los parametros de busqueda y retorna el resultado de empresas proveedoras
	$.ajax({
		url:"action.php",
		method:"POST",
		dataType: "json",		
		data:{action:action, 
		minPrice:minPrice, 
		maxPrice:maxPrice, 
		brand:brand, 
		ram:ram, 
		storage:storage, 
		marca:marca
		},
		success:function(data){
			$('.searchResult').html(data.html);
		}
	});*/
}
function getFilterData(className) {
	var filter = [];
	$('.'+className+':checked').each(function(){
		filter.push($(this).val());
	});
	return filter;
}