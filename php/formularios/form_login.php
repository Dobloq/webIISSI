<script type="text/javascript" src="../../js/validacion_login.js">
// Funciones de validación

</script>
	
<form id='formLogin' action='php/controladores/controlador.php' method='post' onSubmit="return validateForm()">
	<label>Nombre:</label>
		<input type='text' id='nombreUsr' name='nombreUsr' placeholder='PericoPalotes'">
		<br>
	<label>Contraseña:</label>
		<input type='password' id='passUsr' name='passUsr' placeholder='*****'">
		<br>
	<button type='submit' id='botonFormulario'>Enviar</button>
</form> 
