

	function validationForm(){
		
		var error1 = nombreValidation();
		
		var error2 = tiempoValidation();
		
		
		return (error1.length == 0) && (error2.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreTarea");
		var name = nombre.value;
		var valid = true;

		valid = valid && (name.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre de tarea correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		
		return error;
	}
	
	function tiempoValidation(){
		var tiempo = document.getElementById("tiempoEstimado");
		var time = tiempo.value;
		var valid = true;
		
		valid = valid && (time.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un tiempo de tarea correcto";
		}else{
			var error = "";
		}
		tiempo.setCustomValidity(error);
		
		return error;
	}