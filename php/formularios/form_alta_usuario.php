<script type="text/javascript" src="js/validacion_alta_usuario.js"></script>
<?php if($_SESSION["datosUsuario"]["ESDIRECTOR"]==0){header("Location: trabajadores.php");} ?>
<h2> Introduce los datos del trabajador: </h2>
<div id="divFormAltaUsr">
	<form id="formAltaUsr" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreUsr" id="nombreUsr" required onBlur="nameValidation()"><br>
		<label>Usuario:</label><br>
			<input type="text" name="user" id="user" required onBlur="usernameValidation()"><br>
		<label>Contraseña:</label><br>
			<input type="password" name="userPass" id="userPass" required onBlur="passwordValidation()"><br>
		<label>Repita la contraseña:</label><br>
			<input type="password" name="userPassConfirm" id="userPassConfirm" required onBlur="passwordConfirmation()"><br>
		<label>¿Es director?</label><br>
			<input type="checkbox" name="esDirector" id="esDirector" value=1 required><br>
		<button type="submit" id="botonSubirTrabajador" name="botonSubirTrabajador">Enviar</button>		
	</form>
</div>

