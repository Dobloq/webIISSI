

	function validationForm(){
		
		var error1 = nombreValidation();
		
		return (error1.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreProyAudiovisual");
		var name = nombre.value;
		var valid = true;

		valid = valid && (name.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre de proyecto audiovisual correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		
		return error;
	}