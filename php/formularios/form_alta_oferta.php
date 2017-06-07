<?php 
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarPrendas.php");
$conexion = crearConexionBD();
$prendas = consultaPrendas($conexion, 1, 200);
$prendas1 = consultaPrendas($conexion, 1, 200);
$clientes = consultaClientes($conexion, 1, 20);
cerrarConexionBD($conexion);
?>
<script type="text/javascript" src="js/validacion_alta_oferta.js"></script>

<h2> Introduce los datos de la oferta: </h2>
<div id="divFormAltaOferta">
	<form id="formAltaOferta" class="altas-form" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label> Precio ofertado (&euro;): </label><br>
			<input type="number" step="0.01" min="0" name="precioOfertado" id="precioOfertado" onBlur="precioValidation()"><br>
		<label> Articulo 1:</label><br>
			<select name="selectPrendaCompra" id="selectPrendaCompra">
				<?php foreach($prendas as $fila){?>
				<option value="<?php echo $fila["IDPRENDA"]; ?>"><?php echo $fila["URLIMAGEN"]; ?> </option>
				<?php }?>
			</select><br>
		<label> Articulo 2:</label><br>
			<select name="selectPrendaCompra2" id="selectPrendaCompra2">
				<?php foreach($prendas1 as $fila){?>
				<option value="<?php echo $fila["IDPRENDA"]; ?>"><?php echo $fila["URLIMAGEN"]; ?> </option>
				<?php }?>
			</select><br><br>
		<button type="submit" id="botonSubirOferta" name="botonSubirOferta">Enviar</button>
	</form>
</div>
