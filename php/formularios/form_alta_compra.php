<?php 
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarPrendas.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, 1, contarClientes($conexion));
$prendas = consultaPrendas($conexion, 1, contarPrendas($conexion));
?>
<!--falta: <script type="text/javascript" src="js/validacion_alta_compra.js"></script>-->

<script type="text/javascript">
var x = $(document);
var nextInput = 2;
x.ready(function() {
	$("#nuevoArticulo").on("click",function(){
		var sel = $('<select id="selectClienteCompra'+nextInput+'" name="selectClienteCompra'+nextInput+'">');
		var items = document.getElementById("selectPrendaCompra1").options;
		$(items).each(function() {
            sel.append($("<option>").attr('value',this.value).text(this.text));
        });
		var ctd = $('<input type="number" min="0" name="ctdPrenda'+nextInput+'" id="ctdPrenda'+nextInput+'" placeholder="0">');
		var label = $('<label> Cantidad: </label>');
		$("#articulos").append(sel);
		$("#articulos").append(label);
		$("#articulos").append(ctd);
		nextInput++;
		});
	$("#selectPrendaCompra1").on("change", function(){
		$.get("php/controladores/gestionarPrendas.php", {idPrenda: $("#selectPrendaCompra1 option:selected").val()},
		function(data){
			$("#precio1").val(data);
			$("#value1").val(data);
		});
	});
	$("#ctdPrenda1").on("change", function(){
		$("#precio1").val($("#value1").val()*$(this).val());
		});
});

</script>
<h2> Introduce los datos de la compra: </h2>
<div id="divFormAltaCompra"><br>
	<form id="formAltaCompra" action='php/controladores/insert.php' method="post" onSubmit="return validationForm()">
		<label>Cliente:</label><br>
			<select name="selectClienteCompra" id="selectClienteCompra" required>
				<?php foreach($clientes as $fila){?>
				<option value="<?php echo $fila["IDCLIENTE"]; ?>"><?php echo $fila["NOMBRECLIENTE"]; ?> </option>
				<?php }?>
			</select><br>
            <input type="date" id="fechaCompra" name="fechaCompra" required value="<?php echo date("Y-m-d");?>">
         	<br>
            <label> Articulos:</label><br>
            <div id="articulos">
					<select name="selectPrendaCompra1" id="selectPrendaCompra1">
						<?php foreach($prendas as $fila){?>
							<option value="<?php echo $fila["IDPRENDA"]; ?>">
							<?php echo $fila["URLIMAGEN"]; ?> </option>
							<?php }?>
					</select>
                    <label>Cantidad: </label>
                    <input type="number" min="0" name="ctdPrenda1" id="ctdPrenda1" placeholder="0">
                    <label>Precio</label>
                    <input type="number" disabled name="precio1" id="precio1" value="">
                    <input type="hidden" id="value1" name="value1">
                    <br>
            </div>
            <button type="button" name="nuevoArticulo" id="nuevoArticulo">Nuevo articulo</button>
         <button type="submit" id="botonSubirCompra" name="botonSubirCompra">Enviar</button>
	</form>
</div>
<?php cerrarConexionBD($conexion);?>