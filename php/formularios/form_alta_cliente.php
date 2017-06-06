<script type="text/javascript" src="js/validacion_alta_cliente.js"></script>

<h2> Introduce los datos del cliente: </h2>
<div id="divFormAltaCliente">
	<form id="formAltaCliente" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreCliente" id="nombreCliente" onBlur="nombreValidation()"><br>
		<label>Teléfono:</label><br>
			<input type="tel" name="telefonoCliente" id="telefonoCliente" onBlur="telefonoValidation()"><br>
		<label>Mail:</label><br>
			<input type="mail" name="mailCliente" id="mailCliente" onBlur="mailValidation()"><br>
		<label>Año de nacimiento:</label><br>
			<select name="anyoNacimiento">
				<?php for($i = date("Y"); $i >= 1960; $i--){
					echo '<option value="'.$i.'">'.$i.'</option>';
				}?>
			</select><br>
		<button type="submit" id="botonSubirCliente" name="botonSubirCliente">Enviar</button>
	</form>
</div>
