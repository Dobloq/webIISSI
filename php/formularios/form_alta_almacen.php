<script type="text/javascript" src="js/validacion_alta_almacen.js">
$("document").ready(validateForm());
</script>
<script type="text/javascript"></script>

<h2>Introduce los datos del almacén:</h2>
<div id="divFormAltaAlmacen">
	<form id="formAltaAlmacen" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreAlmacen" id="nombreAlmacen"><br>
		<button type="submit" id="botonSubirAlmacen" name="botonSubirAlmacen">Enviar</button>
	</form>
</div>
