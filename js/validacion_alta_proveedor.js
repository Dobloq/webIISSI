

	function validationForm(){
		
		var error1 = nombreValidation();
		
		var error2 = calificacionValidation();
		
		var error3 = ciudadValidation();
		
		var error4 = tecnicasValidation();
		
		return (error1.length == 0) && (error2.length == 0) && (error3.length == 0) && (error4.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreProveedor");
		var name = nombre.value;
		var valid = true;

		valid = valid && (name.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre de proveedor correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		
		return error;
	}
	
	function calificacionValidation(){
		var calificacion = document.getElementById("calificacionProveedor");
		var cap = calificacion.value;
		var valid = true;
		
		valid = valid && (cap.length <=10) && (cap.length >= 0);
		
		if(!valid){
			var error = "La calificación debe estar comprendida entre 0 y 10";
		}else{
			var error = "";
		}
		calificacion.setCustomValidity(error);
		
		return error;
	}
	
	function ciudadValidation(){
		var ciudad = document.getElementById("ciudadProveedor");
		var city = ciudad.value;
		var valid = true;

		valid = valid && (city.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca una ciudad de proveedor correcto";
		}else{
			var error = "";
		}
		ciudad.setCustomValidity(error);
		
		return error;
	}
	
	function tecnicasValidation(){
		var tecnicas = document.getElementById("tecnicasProveedor");
		var tecnica = tecnicas.value;
		var valid = true;

		valid = valid && (tecnica.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca una técnica correcta";
		}else{
			var error = "";
		}
		tecnicas.setCustomValidity(error);
		
		return error;
	}
	