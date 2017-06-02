<script type="text/javascript" src="js/validacion_alta_usuario.js"></script>

<h2> Introduce los datos del trabajador: </h2>
<div id="divFormAltaUsr">
	<form id="formAltaUsr" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label> Nombre: </label><br>
			<input type="text" name="nombreUsr" id="nombreUsr" /><br>
		<label> Usuario: </label><br>
			<input type="text" name="user" id="user" /><br>
		<label> Contraseña: </label><br>
			<input type="password" name="userPass" id="userPass"/><br>
		<label> Repita la contraseña: </label><br>
			<input type="password" name="userPassConfirm" id="userPassConfirm"/><br>
		<label> ¿Es director? </label><br>
			<input type="checkbox" name="esDirector" id="esDirector" value=1/><br>
		<button type="submit" id="botonSubirTrabajador" name="botonSubirTrabajador">Enviar</button>		
	</form>
</div>

