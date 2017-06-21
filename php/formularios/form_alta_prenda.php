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
	<form id="formAltaPrenda" class="altas-form" enctype="multipart/form-data" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Color:</label><br>
			<input type="text" name="colorPrenda" id="colorPrenda" onBlur="colorValidation()" required><br>
		<label>Tipo:</label><br>
			<div id="divRadio" name="divRadio">
				<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Camiseta" checked required>Camiseta<br>
				<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Sudadera" required> Sudadera<br>
				<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Headwear" required> Headwear
			</div>
		<label>Calidad: </label><br>
			<input type="number" min="0" max="10" name="calidadPrenda" id="calidadPrenda" onBlur="calidadValidation()" required><br>
		<label>Talla: </label><br>
			<div id="divRadio" name="divRadio">
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S" required> S<br>
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M" required> M<br>
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" checked required> L<br>
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL" required> XL<br>
				<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL" required> XXL	
			</div>
		<label>Precio (&euro;): </label><br>
			<input type="number" step="0.5" min="0" name="precioPrenda" id="precioPrenda" onBlur="precioValidation()"><br>
		<label>Añade una imagen: </label><br>
        	<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
			<input type="file" name="imagenPrenda" id="imagenPrenda" accept="image/*" required><br>
		<label>Cantidad: </label><br>
			<input type="number" min="0" name="cantidadPrenda" id="cantidadPrenda" onBlur="cantidadValidation()"><br>
		<label>¿Pertenece a alguna de éstas temporadas? </label><br>
			<select name="selectTemporadaPrenda" id="selectTemporadaPrenda" required>
				<option value="null">No</option>
				<?php foreach($temporada as $fila){?>
				<option value="<?php echo $fila["IDTEMPORADA"]; ?>"><?php echo $fila["NOMBRETEMPORADA"]; ?> </option>
				<?php }?>
			</select><br>
		<label>¿Es de alguno de éstos proveedores? </label><br>
			<select name="selectProveedorPrenda" id="selectProveedorPrenda" required>
				<?php foreach($proveedores as $fila){?>
				<option value="<?php echo $fila["IDPROVEEDOR"]; ?>"><?php echo $fila["NOMBREPROVEEDOR"]; ?> </option>
				<?php }?>
			</select><br>
		<label>¿Es una colaboración textil? </label><br>
			<select name="selectColaboradorPrenda" id="selectColaboradorPrenda" required>
				<option value="null">No</option>
				<?php foreach($colaboradores as $fila){?>
				<option value="<?php echo $fila["IDCOLABORADORTEXTIL"]; ?>"><?php echo $fila["NOMBRECOLABORADORTEXTIL"]; ?> </option>
				<?php }?>
			</select><br><br>
		<button type="submit" id="botonSubirPrenda" name="botonSubirPrenda">Enviar</button>
	</form>
</div>
