<script type="text/javascript" src="js/validacion_comentario.js"></script>

<h2>Inserte su comentario: </h2>
<br>
<div id="divFormComentario" name="divFormComentario">
	<form id="formComentario" action='php/controladores/insert.php' name="formComentario" method="post" onSubmit="return validationForm()">
		<input type="text" id="idUsuarioHidden" name="idUsuarioHidden" value="">
		<input type="text" id="idObjetoHidden" name="idObjetoHidden" value="">
		<input type="text" id="tipoObjetoHidden" name="tipoObjetoHidden" value="">
		<input type="date" id="fechaHidden" name="fechaHidden" value="">
		<input type="text" id="textoComentario" name="textoComentario" value="">
		<button type="submit" id="botonSubirComentario" name="botonSubirComentario">Enviar</button>
	</form>
</div>