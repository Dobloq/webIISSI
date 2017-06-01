// Funciones de validación
	function validateForm() {		
        
		var error1 = usernameValidation();
		
		var error2 = passwordConfirmation();
        
		return (error1.length==0) && (error2.length==0);
	}

	function usernameValidation(){
		var username = document.getElementById("nombreUsr");
		var valid = true;

		valid = valid && (username.value.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un usuario correcto";
		}else{
			var error = "";
		}
		username.setCustomValidity(error);
		
		return error;
	}
	
	function passwordConfirmation(){
        var password = document.getElementById("passUsr");
		var pwd = password.value;

		if (pwd.length <= 0) {
			var error = "Introduzca una contraseña valida";
		}else{
			var error = "";
		}

		password.setCustomValidity(error);

		return error;
	}