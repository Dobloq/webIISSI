<?php 
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarPrendas.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, 1, 200);
cerrarConexionBD($conexion);
?>
<!--falta: <script type="text/javascript" src="js/validacion_alta_compra.js"></script>-->

<h2> Introduce los datos de la compra: </h2>
<div id="divFormAltaCompra"><br>
	<form id="formAltaCompra" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Cliente:</label><br>
			<select name="selectClienteCompra" id="selectClienteCompra" required>
				<?php foreach($clientes as $fila){?>
				<option value="<?php echo $fila["IDCLIENTE"]; ?>"><?php echo $fila["NOMBRECLIENTE"]; ?> </option>
				<?php }?>
			</select><br>
            <input type="date" id="fechaCompra" name="fechaCompra" required>
			<?php cerrarConexionBD($conexion); ?>
         	<br>
         <button type="submit" id="botonSubirCompra" name="botonSubirCompra">Enviar</button>
	</form>
</div>
