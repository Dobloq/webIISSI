<script type="text/javascript" src="js/validacion_alta_almacen.js"></script>

<h2>Introduce los datos del almacén:</h2>
<div id="divFormAltaAlmacen">
	<form id="formAltaAlmacen" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreAlmacen" id="nombreAlmacen"><br>
		<button type="submit" id="botonSubirAlmacen" name="botonSubirAlmacen">Enviar</button>
	</form>
</div>
