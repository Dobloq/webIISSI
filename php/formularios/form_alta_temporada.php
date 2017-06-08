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
x.ready(function() {
	$("#nuevoArticulo").on("click",function(){
		var sel = $('<select id="selectClienteCompra'+nextInput+'" name="selectClienteCompra'+nextInput+'">');
		var items = document.getElementById("selectPrendaCompra0").options;
		$(items).each(function() {
            sel.append($("<option>").attr('value',this.value).text(this.text));
        });
		$("#articulos").append(sel);
		$("#articulos").append(('<br>'));
		nextInput++;
		});
	$("#prueba").on("click", function(){
		var ind = 0;
		$("select").each(function(index, element) {
            a[ind] = document.getElementById(element.id).options[document.getElementById(element.id).selectedIndex].value;
			ind++;
        });	
		alert(a);
	});
});

</script>
<h2>Introduce los datos de la temporada:</h2>
<div id="divFormAltaTemporada">
	<form id="formAltaTemporada" class="altas-form" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreTemporada" id="nombreTemporada" required onBlur="nombreValidation()"><br>
		<label>Fecha:</label><br>
			<input type="date" name="fechaTemporada" id="fechaTemporada" value="<?php echo date("Y-m-d");?>" required onBlur="fechaValidation()"><br>
        <label>Prendas de la temporada:</label><br>
        <div id="articulos">
					<select name="selectPrendaCompra0" id="selectPrendaCompra0">
						<?php foreach($prendas as $fila){?>
							<option value="<?php echo $fila["IDPRENDA"]; ?>">
							<?php echo $fila["URLIMAGEN"]; ?> </option>
							<?php }?>
					</select>
                    <br>
        </div>
        <button type="button" name="nuevoArticulo" id="nuevoArticulo">Nuevo articulo</button>
        <br>
        <br>
        <button type="submit" id="botonSubirTemporada" name="botonSubirTemporada">Enviar</button>
        <button type="button" id="prueba">Prueba</button>
	</form>
</div>