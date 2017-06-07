	function validationForm(){
		
		var error1 = precioValidation();
		
		return (error1.length == 0);
	}
	
	function precioValidation(){
		var precio = document.getElementById("precioOfertado");
		var oferta = precio.value;
		var valid = true;
		
		valid = valid && (oferta.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un precio de oferta válido";
		}else{
			var error = "";
		}
		precio.setCustomValidity(error);
		
		return error;
	}