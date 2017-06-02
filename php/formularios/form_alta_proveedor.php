<script type="text/javascript" src="js/validacion_alta_proveedor.js"></script>

<h2> Introduce los datos del proveedor: </h2>
<div id="divFormAltaProveedor">
	<form id="formAltaProveedor" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label> Nombre: </label><br>
			<input type="text" name="nombreProveedor" id="nombreProveedor" onBlur="nombreValidation()"><br>
		<label> Calificación: </label><br>
			<input type="number" name="calificacionProveedor" id="calificacionProveedor" onBlur="calificacionValidation()"><br>
		<label> Serigrafía: </label><br>
			<input type="checkbox" name="serigrafiaProveedor" id="serigrafiaProveedor"><br>
		<label> Ciudad: </label><br>
			<input type="text" name="ciudadProveedor" id="ciudadProveedor" onBlur="ciudadValidation()"><br>
		<label> Técnicas: </label><br>
			<input type="text" name="tecnicasProveedor" id="tecnicasProveedor" onBlur="tecnicasValidation()"><br>
		<button type="submit" id="botonSubirProveedor" name="botonSubirProveedor">Enviar</button>
	</form>
</div>
