

	function validateForm(){
		
		var error1 = comentarioValidation();
		
		return (error1.length == 0);
		
	}
	
	function comentarioValidation(){
		
		var texto = document.getElementById("textoComentario");
		var comentario = texto.value;
		var valid = true;
		
		valid = valid && (comentario.length>0);
		
		if(!valid){
			var error = "Introduzca un comentario";
		}else{
			var error = "";
		}
		
		texto.setCustomValidity(error);
		
		return error;
	}
	