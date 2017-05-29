<?php 
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarPrendas.php");
$conexion = crearConexionBD();
$prendas = consultaPrendas($conexion, 1, 200);
$prendas1 = consultaPrendas($conexion, 1, 200);
$clientes = consultaClientes($conexion, 1, 20);
cerrarConexionBD($conexion);
?>

<script type="text/javascript">
function validationForm(){
		
		var error2 = precioValidation();
		
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
		document.getElementById("error") += error . "<br>";
		return error;
	}

</script>


			<h2> Introduce los datos de la oferta: </h2>
			<div id="divFormAltaOferta">
				<form id="formAltaOferta" action='php/controladores/insert.php' method="post">
					<label> Precio ofertado: </label>
						<input type="number" name="precioOfertado" id="precioOfertado" onBlur="precioValidation()"><br>
					<label> Articulo 1:</label><br>
					<select name="selectPrendaCompra" id="selectPrendaCompra">
						<?php foreach($prendas as $fila){?>
							<option value="<?php echo $fila["IDPRENDA"]; ?>">
							<?php echo $fila["URLIMAGEN"]; ?> </option>
							<?php }?>
					</select><br>
                    <label> Articulo 2:</label><br>
					<select name="selectPrendaCompra2" id="selectPrendaCompra2">
						<?php foreach($prendas1 as $fila){?>
							<option value="<?php echo $fila["IDPRENDA"]; ?>">
							<?php echo $fila["URLIMAGEN"]; ?> </option>
							<?php }?>
					</select><br>
					<button type="submit" id="botonSubirOferta" name="botonSubirOferta">Enviar</button>
				</form>
				<p id="error"></p>
			</div>
