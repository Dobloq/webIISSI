<script type="text/javascript" src="js/validacion_alta_colaboradorAudiovisual.js"></script>

<h2> Introduce los datos del colaborador audiovisual: </h2>
<div id="divFormAltaCAV">
	<form id="formAltaCAV" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label> Nombre: </label><br>
			<input type="text" name="nombreCAV" id="nombreCAV"><br>
		<label> Calificación: </label><br>
			<input type="number" step="1" name="calificacionCAV" id="calificacionCAV"><br>
		<button type="submit" id="botonSubirCAV" name="botonSubirCAV" onClick="validationForm()">Enviar</button>
	</form>
</div>
