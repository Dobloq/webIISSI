<script type="text/javascript" src="js/validacion_login.js"></script>
<?php if(isset($_SESSION["excepcion"])){unset($_SESSION["excepcion"]);?>
	<script type="text/javascript">
		alert("Datos de login erroneos");
	</script>
<?php } ?>
<form id='formLogin' action='php/controladores/controlador.php' method='post' onSubmit="return validationForm()">
	<label>Nombre:</label>
		<input type='text' id='nombreUsr' name='nombreUsr' placeholder='PericoPalotes'" required onBlur="usernameValidation()"><br>
	<label>Contraseña:</label>
		<input type='password' id='passUsr' name='passUsr' placeholder='*****'" required onBlur="passwordConfirmation() "><br>
	<button type='submit' id='botonFormulario'>Enviar</button>
</form> 
