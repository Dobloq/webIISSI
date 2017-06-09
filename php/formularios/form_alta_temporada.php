<?php 
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarPrendas.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, 1, contarClientes($conexion));
$prendas = consultaPrendas($conexion, 1, contarPrendas($conexion));
?>
<script src="js/validacion_alta_temporada.js" type="text/javascript" ></script>
<script type="text/javascript">
var x = $(document);
var nextInput = 1;
var a = [];
var prendas = false;
x.ready(function() {
	// para mostrar los controles para asociar prendas a la nueva temporada
	$("#masArticulos").on("click",function(){
		$("#articulos").fadeTo("slow",1);
		$("#nuevoArticulo").fadeTo("slow",1);
		prendas = true;
		});
	// para que al hacer click en el boton de nuevo articulo se añada otro select con todas las prendas
	$("#nuevoArticulo").on("click",function(){
		// crea un select con nombre e id selectPrendaTemporada con un indice que se incrementa
		var sel = $('<select id="selectPrendaTemporada'+nextInput+'" name="selectPrendaTemporada'+nextInput+'">');
		// recoge las prendas del select fijo
		var items = document.getElementById("selectPrendaCompra0").options;
		// por cada prenda del select fijo se le añade al select creado un option con los mismos valores
		$(items).each(function() {
            sel.append($("<option>").attr('value',this.value).text(this.text));
        });
		// se añade el select creado al div y se añade un br
		$("#articulos").append(sel);
		$("#articulos").append(('<br>'));
		// se aumenta para que el nombre no se repita
		nextInput++;
		});
		
	// para cuando se envie el form, reemplaza al onsubmit del form
	$("#formAltaTemporada").on("submit", function(){
		// si valida bien hace lo siguiente, en caso contrario no hace nada y se muestran los mensajes correspondientes
		if(validationForm()==true){
			if(prendas==true){
				// se hace un post para crear la temporada y recibir el id de la temporada creada, data, que se envia a la funcion actualizaPrenda
				$.post("../ThreewGestion/php/controladores/insert.php", {botonSubirTemporada: "Enviar", nombreTemporada: $("#nombreTemporada").val(), 
			fechaTemporada: $("#fechaTemporada").val(), mostrar: "no"},
			function(data){if(prendas){actualizaPrenda(data)} else {window.location.replace("../ThreewGestion/productos.php")}});}}
			else {
				alert("hace if");
				$.post("../ThreewGestion/php/controladores/insert.php", {botonSubirTemporada: "Enviar", nombreTemporada: $("#nombreTemporada").val(), 
			fechaTemporada: $("#fechaTemporada").val()},window.location.replace("../ThreewGestion/productos.php"));	
			
			}
	});
	
	// para cambiar la temporada de cada prenda a la que se ha creado
	function actualizaPrenda(data){
		var ind = 0;
		// por cada select existente se itera siendo index un indice desde cero hasta el nº de selects-1 y element el select nº index
		$("select").each(function(index, element) {
			// se obtiene el id de la prenda que se escoge en el select
			a[ind] = document.getElementById(element.id).options[document.getElementById(element.id).selectedIndex].value;
			// se manda a un metodo que actualiza la prenda con sus nuevos datos
			$.post("../ThreewGestion/php/controladores/gestionarPrendas.php", {idPrendaAct: a[ind], id: data});
			ind++;
        });	
		// se devuelve tras la creacion a productos.php
		window.location.replace("../ThreewGestion/productos.php");
	}
});

</script>
<h2>Introduce los datos de la temporada:</h2>
<div id="divFormAltaTemporada">
	<form id="formAltaTemporada" class="altas-form" action='php/controladores/insert.php' method="post">
		<label>Nombre:</label><br>
			<input type="text" name="nombreTemporada" id="nombreTemporada" required onBlur="nombreValidation()"><br>
		<label>Fecha:</label><br>
			<input type="date" name="fechaTemporada" id="fechaTemporada" value="<?php echo date("Y-m-d");?>" required onBlur="fechaValidation()"><br>
        <button type="button" id="masArticulos" name="masArticulos">Asociar prendas</button>
        <div id="articulos" hidden>
        	<label>Prendas de la temporada:</label><br>
			<select name="selectPrendaCompra0" id="selectPrendaCompra0">
				<?php foreach($prendas as $fila){?>
							<option value="<?php echo $fila["IDPRENDA"]; ?>">
							<?php echo $fila["URLIMAGEN"]; ?> </option>
							<?php }?>
			</select>
            <br>
        </div>
        <button type="button" name="nuevoArticulo" id="nuevoArticulo" hidden>Nuevo articulo</button>
        <br>
        <br>
        <button type="submit" id="botonSubirTemporada" name="botonSubirTemporada">Enviar</button>
	</form>
</div>