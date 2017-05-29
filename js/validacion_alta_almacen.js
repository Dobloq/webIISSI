

	function validationForm(){
		
		var error1 = nombreValidation();
		
		return (error1.length == 0);
	}
	
	function nombreValidation(){
		var nombre = document.getElementById("nombreAlmacen");
		var almacen = nombre.value;
		var valid = true;

		valid = valid && (almacen.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un nombre de almacén correcto";
		}else{
			var error = "";
		}
		nombre.setCustomValidity(error);
		
		return error;
	}