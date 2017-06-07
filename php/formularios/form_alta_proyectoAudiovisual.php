<script type="text/javascript" src="js/validacion_alta_proyectoAudiovisual.js"></script>

<h2> Introduce los datos del proyecto audiovisual: </h2>
<div id="divFormAltaProveedor"><br>
	<form id="formAltaProveedor" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()"><br>
		<label>Nombre:</label><br>
			<input type="text" name="nombreProyAudiovisual" id="nombreProyAudiovisual" required><br>
		<button type="submit" id="botonSubirPAV" name="botonSubirPAV">Enviar</button>
	</form>
</div>
