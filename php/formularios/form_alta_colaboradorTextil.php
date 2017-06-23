<script type="text/javascript" src="js/validacion_form_alta_colaboradorTextil.js"></script>

<h2> Introduce los datos del colaborador textil: </h2>
<div id="divFormAltaCT">
	<form id="formAltaCT" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label> Nombre: </label><br>
			<input type="text" name="nombreCT" id="nombreCT" required onBlur="nombreValidation()"><br>
		<label> Calificación: </label><br>
			<input type="number" step="1" min="0" max="10" name="calificacionCT" id="calificacionCT" required onBlur="calificacionValidation()"><br>
		<button type="submit" id="botonSubirCT" name="botonSubirCT">Enviar</button>
	</form>
</div>
