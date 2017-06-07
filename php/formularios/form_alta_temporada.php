<script src="js/validacion_alta_temporada.js" type="text/javascript" ></script>

<h2>Introduce los datos de la temporada:</h2>
<div id="divFormAltaTemporada">
	<form id="formAltaTemporada" class="altas-form" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreTemporada" id="nombreTemporada" required onBlur="nombreValidation()"><br>
		<label>Fecha:</label><br>
			<input type="date" name="fechaTemporada" id="fechaTemporada" value="<?php echo date("Y-m-d");?>" required onBlur="fechaValidation()"><br><br>
		<button type="submit" id="botonSubirTemporada" name="botonSubirTemporada">Enviar</button>
	</form>
</div>