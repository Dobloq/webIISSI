

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
		
		return error;
	}
	
	function telefonoValidation(){
		var telefono = document.getElementById("telefonoCliente");
		var tel = telefono.value;
		var valid = true;
		
		var longitud = new RegExp(/^\+\d{2,3}\d{9,10}$/);
		
		valid = valid && (tel.length == 12) && (longitud.test(tel));
		
		if(!valid){
			var error = "Introduzca un número de teléfono del tipo +34NNNNNNNNN";
		}else{
			var error = "";
		}
		telefono.setCustomValidity(error);
		return error;
	}
	
	function mailValidation(){
		var email = document.getElementById("mailCliente");
		var correo = email.value;
		var valid = true;
		
		valid = valid && (correo.indexOf("@") != -1) && (correo.indexOf(".") != -1) && (correo.indexOf("com") != -1 || correo.indexOf("es") != -1);
		
		if(!valid){
			var error = "Introduzca un correo válido";
		}else{
			var error = "";
		}
		
		email.setCustomValidity(error);
		return error;
	}
		
		
			