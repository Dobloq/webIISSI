<?php 
require_once("php/controladores/gestionarProyectoAudiovisual.php");
require_once("php/controladores/gestionarProveedor.php");
require_once("php/controladores/gestionarTemporadas.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$temporada = consultaTemporada($conexion, 1, 200);
$proveedores = consultaProveedor($conexion, 1, 200);
$colaboradores = consultaColaboradoresTextil($conexion, 1, 20);
cerrarConexionBD($conexion);
?>
<script type="text/javascript" src="js/validacion_alta_prenda.js"></script>

<h2> Introduce los datos de la prenda: </h2>
<div id="divFormAltaPrenda">
	<form id="formAltaPrenda" enctype="multipart/form-data" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label> Color: </label><br>
			<input type="text" name="colorPrenda" id="colorPrenda" onBlur="colorValidation()"><br>
		<label> Tipo: </label><br>
			<div id="divRadio" name="divRadio">
				<p> Camiseta - Sudadera - HeadWear </p><br>
				<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Camiseta" checked>
				<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Sudadera">
				<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Headwear">
			</div>
		<label> Calidad: </label><br>
			<input type="number" name="calidadPrenda" id="calidadPrenda" onBlur="calidadValidation()"><br>
		<label> Talla: </label><br>
			<div id="divRadio" name="divRadio">
				<p> XXL - XL - L - M - S </p><br>
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL">
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL">
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" checked>
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M">
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S">
			</div>
		<label> Precio: </label><br>
			<input type="number" name="precioPrenda" id="precioPrenda" onBlur="precioValidation()"><br>
		<label> Añade una imagen: </label><br>
			<input type="file" name="imagenPrenda" id="imagenPrenda" accept="image/*"><br>
		<label> Cantidad: </label><br>
			<input type="number" name="cantidadPrenda" id="cantidadPrenda" onBlur="cantidadValidation()"><br>
		<label> ¿Pertenece a alguna de éstas temporadas? </label><br>
			<select name="selectTemporadaPrenda" id="selectTemporadaPrenda"><br>
				<option value="null">No</option>
				<?php foreach($temporada as $fila){?>
				<option value="<?php echo $fila["NOMBRETEMPORADA"]; ?>"><?php echo $fila["NOMBRETEMPORADA"]; ?> </option>
				<?php }?>
			</select>
		<label> ¿Es de alguno de éstos proveedores? </label><br>
			<select name="selectProveedorPrenda" id="selectProveedorPrenda"><br>
				<option value="null">No</option>
				<?php foreach($proveedores as $fila){?>
				<option value="<?php echo $fila["NOMBREPROVEEDOR"]; ?>"><?php echo $fila["NOMBREPROVEEDOR"]; ?> </option>
				<?php }?>
			</select><br>
		<label> ¿Es una colaboración textil? </label><br>
			<select name="selectColaboradorPrenda" id="selectColaboradorPrenda">
				<option value="null">No</option>
				<?php foreach($colaboradores as $fila){?>
				<option value="<?php echo $fila["NOMBRECOLABORADORTEXTIL"]; ?>"><?php echo $fila["NOMBRECOLABORADORTEXTIL"]; ?> </option>
				<?php }?>
			</select><br>
		<button type="submit" id="botonSubirPrenda" name="botonSubirPrenda">Enviar</button>
	</form>
</div>
