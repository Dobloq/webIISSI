<script type="text/javascript">
function validationForm(){
		
		var error1 = nombreValidation();
		
		var error2 = calificacionValidation();
		
		return (error1.length == 0) && (error2.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreCAV");
		var name = nombre.value;
		var valid = true;

		valid = valid && (name.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre de colaborador audiovisual correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		document.getElementById("error") += error . "<br>";
		return error;
	}
	
	function calificacionValidation(){
		var calificacion = document.getElementById("calificacionCAV");
		var cav = calificacion.value;
		var valid = true;
		
		valid = valid && (cav.length <=10) && (cav.length >= 0);
		
		if(!valid){
			var error = "La calificación debe estar comprendida entre 0 y 10";
		}else{
			var error = "";
		}
		calificacion.setCustomValidity(error);
		document.getElementById("error") += error . "<br>";
		
		return error;
	}


</script>
			<h2> Introduce los datos del colaborador audiovisual: </h2>
			<div id="divFormAltaCAV">
				<form id="formAltaCAV" action='php/controladores/insert.php' method="post">
					<label> Nombre: </label><br>
						<input type="text" name="nombreCAV" id="nombreCAV" onBlur="nombreValidation()"><br>
					<label> Calificación: </label><br>
						<input type="number" name="calificacionCAV" id="calificacionCAV" onBlur="calificacionValidation()"><br>
					<button type="submit" id="botonSubirCAV" name="botonSubirCAV">Enviar</button>
				</form>
				<p id="error"></p>
			</div>
