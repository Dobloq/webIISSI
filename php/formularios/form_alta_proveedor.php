<script type="text/javascript" src="js/validacion_alta_proveedor.js"></script>

<h2> Introduce los datos del proveedor: </h2>
<div id="divFormAltaProveedor">
	<form id="formAltaProveedor" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreProveedor" id="nombreProveedor" onBlur="nombreValidation()" required><br>
		<label>Calificación:</label><br>
			<input type="number" step="1" min="0" max="10" name="calificacionProveedor" id="calificacionProveedor" onBlur="calificacionValidation()" required><br>
		<label>Serigrafía:</label><br>
			<input type="checkbox" name="serigrafiaProveedor" id="serigrafiaProveedor"><br>
		<label>Ciudad:</label><br>
			<input type="text" name="ciudadProveedor" id="ciudadProveedor" onBlur="ciudadValidation()" required><br>
		<label>Técnicas:</label><br>
			<input type="text" name="tecnicasProveedor" id="tecnicasProveedor" onBlur="tecnicasValidation()" required><br>
		<button type="submit" id="botonSubirProveedor" name="botonSubirProveedor">Enviar</button>
	</form>
</div>
