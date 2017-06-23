

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
	
	function calificacionValidation() {	
    	var calificacion2 = document.getElementById("calificacionCAV");
    	var cav = calificacion2.value;
    	var valid2 = false;
    	valid2 = (cav <= 10) && (cav >= 0) && calificacion2.textLength != 0;
    	if (valid2==false) {
        	var errorC = "La calificación debe estar comprendida entre 0 y 10";
    	} else {
        	var errorC = "";
    	}
    	calificacion2.setCustomValidity(errorC);
    	return errorC;
	}
	
			
			