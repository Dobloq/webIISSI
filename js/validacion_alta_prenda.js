

	function validationForm(){
		
		var error1 = colorValidation();
		
		var error2 = calidadValidation();
		
		var error3 = precioValidation();
		
		var error4 = cantidadValidation();
		
		
		return (error1.length == 0) && (error2.length == 0) && (error3.length == 0) && (error4.length == 0);
	}
	
	function colorValidation(){
		var color = document.getElementById("colorPrenda");
		var colour = color.value;
		var valid = true;

		valid = valid && (colour.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca un color correcto";
		}else{
			var error = "";
		}
		color.setCustomValidity(error);
		
		return error;
	}
	
	function calidadValidation(){
		var calidad = document.getElementById("calidadPrenda");
		var calp = calidad.value;
		var valid = true;
		valid = valid && (calp <=10) && (calp >= 0) && calp != "";
		
		if(!valid){
			var error1 = "La calidad debe estar comprendida entre 0 y 10";
		}else{
			var error1 = "";
		}
		calidad.setCustomValidity(error1);
		
		return error1;
	}

	
	function precioValidation(){
		var precio = document.getElementById("precioPrenda");
		var prize = precio.value;
		var valid = true;
		
		valid = valid && (prize.length > 0) && prize > 0;
		
		if(!valid){
			var error = "Por favor introduzca un precio de prenda válido";
		}else{
			var error = "";
		}
		precio.setCustomValidity(error);
		
		return error;
	} 
	
	function cantidadValidation(){
		var cantidad = document.getElementById("cantidadPrenda");
		var cp = cantidad.value;
		var valid = true;
		
		valid = valid && (cp.length > 0);
		
		if(!valid){
			var error = "Por favor introduzca una cantidad válida";
		}else{
			var error = "";
		}
		cantidad.setCustomValidity(error);
		
		return error;
	}