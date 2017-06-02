<?php 
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarPrendas.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, 1, 200);
cerrarConexionBD($conexion);
?>
<script type="text/javascript" src="js/validacion_alta_compra.js"></script>

<h2> Introduce los datos de la compra: </h2>
<div id="divFormAltaCompra"><br>
	<form id="formAltaCompra" action='php/controladores/insert.php' method="post" onSubmit="return validateForm()">
		<label> Cliente: </label><br>
			<select name="selectClienteCompra" id="selectClienteCompra">
				<?php foreach($clientes as $fila){?>
				<option value="<?php echo $fila["IDCLIENTE"]; ?>"><?php echo $fila["NOMBRECLIENTE"]; ?> </option>
				<?php }?>
			</select><br>
            <input type="date" id="fechaCompra" name="fechaCompra">
			<?php cerrarConexionBD($conexion); ?>
         	<br>
         <button type="submit" id="botonSubirCompra" name="botonSubirCompra">Enviar</button>
	</form>
</div>
