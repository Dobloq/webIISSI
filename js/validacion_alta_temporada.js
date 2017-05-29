

	function validationForm(){
		
		var error1 = nombreValidation();
		
		var error2 = fechaValidation();
		
		
		return (error1.length == 0) && (error2.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreTemporada");
		var name = nombre.value;
		var valid = true;

		valid = valid && (name.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre de temporada correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		
		return error;
	}
	
	function fechaValidation(){
		var fecha = document.getElementById("fechaTemporada");
		var date = fecha.value;
		var valid = true;
		
		valid = valid && (date.length > 0);
		
		if(!valid){
			var error = "Introduzca una fecha de temporada correcta";
		}else{
			var error = "";
		}
		fecha.setCustomValidity(error);
		return error;
	}