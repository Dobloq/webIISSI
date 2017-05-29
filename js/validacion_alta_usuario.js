// Funciones de validación
	function validateForm() {		
        
		var error1 = nameValidation();
		
		var error2 = usernameValidation();
		
		var error3 = passwordValidation();
		
		var error4 = passwordConfirmation();
        
		return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0);
	}
	
	function nameValidation(){
		var name = document.getElementById("nombreUsr");
		var nombre = name.value;
		var valid = true;

		valid = valid && (nombre.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre correcto";
		}else{
			var error = "";
		}
		name.setCustomValidity(error);
		
		return error;
	}

	function usernameValidation(){
		var username = document.getElementById("user");
		var user = username.value;
		var valid = true;

		valid = valid && (user.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un usuario correcto";
		}else{
			var error = "";
		}
		username.setCustomValidity(error);
		
		return error;
	}
	
	function passwordValidation(){
		var password = document.getElementById("userPass");
		var pwd = password.value;
		var valid = true;
		
		valid = valid && (pwd.length>0);
		
		if(!valid){
			var error = "Por favor introduzca una contraseña válida";
		}else{
			var error = "";
		}
		
		return error;
		
	}
	
	function passwordConfirmation(){
        var password = document.getElementById("userPass");
		var pwd = password.value;
		
		var passconfirm = document.getElementById("userPassConfirm");
		var confirmation = passconfirm.value;

		if (pwd.length != confirmation) {
			var error = "Introduzca una contraseña valida";
		}else{
			var error = "";
		}

		passconfirm.setCustomValidity(error);

		return error;
	}
	
	