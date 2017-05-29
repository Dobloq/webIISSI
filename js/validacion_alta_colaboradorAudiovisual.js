

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
		
		return error;
	}
	
			
			