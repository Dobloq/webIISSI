<script type="text/javascript">
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
		document.getElementById("error").innerHTML = error;
		return error;
}
</script>


			<h2> Introduce los datos del almacén: </h2>
			<div id="divFormAltaAlmacen">
				<form id="formAltaAlmacen" action='php/controladores/insert.php' method="post">
					<label> Nombre: </label><br>
						<input type="text" name="nombreAlmacen" id="nombreAlmacen" onblur="nombreValidation()"><br>
					<button type="submit" id="botonSubirAlmacen" name="botonSubirAlmacen">Enviar</button>
				</form>
				<p id="error"></p>
			</div>
