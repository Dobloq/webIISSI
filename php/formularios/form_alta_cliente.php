<script type="text/javascript">
function validationForm(){
		
		var error1 = nombreValidation();
		
		var error2 = telefonoValidation();
		
		var error3 = mailValidation();
		
		return (error1.length == 0) && (error2.length == 0) && (error3.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreCliente");
		var name = nombre.value;
		var valid = true;

		valid = valid && (name.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		document.getElementById("error") += error;
		return error;
	}
	
	function telefonoValidation(){
		var telefono = document.getElementById("telefonoCliente");
		var tel = telefono.value;
		var valid = true;
		
		var longitud = /+(\d{11})/;
		
		valid = valid && (tel.length == 12) && (longitud.test(tel));
		
		if(!valid){
			var error = "Introduzca un número de teléfono correcto";
		}else{
			var error = "";
		}
		telefono.setCustomValidity(error);
		document.getElementById("error") += error;
		return error;
	}
	
	function mailValidation(){
		var email = document.getElementById("email");
		var correo = email.value;
		var valid = true;
		
		valid = valid && (correo.indexOf("@") != -1) && (correo.indexOf(".") != -1) && (correo.indexOf("com") != -1 || correo.indexOf("es") != -1);
		
		if(!valid){
			var error = "Introduzca un correo válido";
		}else{
			var error = "";
		}
		document.getElementById("error") += error;
		email.setCustomValidity(error);
		return error;
	}

</script>
			<h2> Introduce los datos del cliente: </h2>
			<div id="divFormAltaCliente">
				<form id="formAltaCliente" action='php/controladores/insert.php' method="post">
					<label> Nombre: </label><br>
						<input type="text" name="nombreCliente" id="nombreCliente" onBlur="nombreValidation()"><br>
					<label> Teléfono: </label><br>
						<input type="tel" name="telefonoCliente" id="telefonoCliente" onBlur="telefonoValidation()"><br>
					<label> Mail: </label><br>
						<input type="mail" name="mailCliente" id="mailCliente" onBlur="mailValidation()"><br>
					<label> Año de nacimiento: </label><br>
						<select name="anyoNacimiento">
							<?php for($i = date("Y"); $i >= 1960; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}?>
						</select><br>
					<button type="submit" id="botonSubirCliente" name="botonSubirCliente">Enviar</button>
				</form>
				<p id="error"></p>
			</div>
