<script type="text/javascript" src="js/validacion_alta_temporada.js"></script>

<h2> Introduce los datos de la temporada: </h2>
<div id="divFormAltaTemporada">
	<form id="formAltaTemporada" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreTemporada" id="nombreTemporada"><br>
		<label>Fecha:</label><br>
			<input type="date" name="fechaTemporada" id="fechaTemporada"><br>
		<button type="submit" id="botonSubirTemporada" name="botonSubirTemporada">Enviar</button>
	</form>
</div>

