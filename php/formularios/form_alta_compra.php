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
	$("#botonSubirCompra").on("click",function(){
		var cliente = document.getElementById("selectClienteCompra").options[document.getElementById("selectClienteCompra").selectedIndex].value;
		$.post("php/controladores/insert.php", {botonSubirCompra : true, selectClienteCompra: cliente, fechaCompra: $("#fechaCompra").val()},
		function(data){
			$("[id^=ctdPrenda]").each(function(index, element) {
				var n = element.id.charAt(element.id.length-1);
				var idP = document.getElementById("selectPrendaCompra"+n).options[document.getElementById("selectPrendaCompra"+n).selectedIndex].value;
                if(element.value!=0){
					$.post("php/controladores/insert.php", {itemCompra: true, ctd: element.value, importe: $("#precio"+n).val(), idC: data, idPr: idP},window.location.replace("datos.php"));
				}
            });
		});
		
	});
	$("#nuevoArticulo").on("click",function(){
		var sel = $('<select id="selectPrendaCompra'+nextInput+'" name="selectClienteCompra'+nextInput+'">');
		var items = document.getElementById("selectPrendaCompra1").options;
		$(items).each(function() {
            sel.append($("<option>").attr('value',this.value).text(this.text));
        });
		sel.on("change", cambioSel);
		var ctd = $('<input type="number" min="0" name="ctdPrenda'+nextInput+'" id="ctdPrenda'+nextInput+'" placeholder="0">');
		var label = $('<label> Cantidad: </label>');
		var pr = $('<label> Precio: </label><input type="number" disabled name="precio'+nextInput+'" id="precio'+nextInput+'" value="0"><br>');
		var val = $('<input type="hidden" id="value'+nextInput+'" name="value'+nextInput+'">');
		ctd.on("change", function(){
			var n = this.id.charAt(this.id.length-1);
			$("#precio"+n).val($("#value"+n).val()*$(this).val());
		});
		$("#articulos").append(sel);
		$("#articulos").append(label);
		$("#articulos").append(ctd);
		$("#articulos").append(pr);
		$("#articulos").append(val);
		nextInput++;
		});
	$("[id^=selectPrendaCompra]").on("change", function(){
			var n = this.id.charAt(this.id.length-1);
			$.get("php/controladores/gestionarPrendas.php", {idPrenda: $("#selectPrendaCompra"+n+" option:selected").val()},
			function(data){
				$("#precio"+n).val(data);
				$("#value"+n).val(data);
				$("#ctdPrenda"+n).val(1);
			});
   	 	});
	$("#ctdPrenda1").on("change", function(){
		$("#precio1").val($("#value1").val()*$(this).val());
		});
	function cambioSel(){
		var n = this.id.charAt(this.id.length-1);
		$.get("php/controladores/gestionarPrendas.php", {idPrenda: this.options[document.getElementById("selectPrendaCompra"+n).selectedIndex].value},
		function(data){
			$("#precio"+n).val(data);
			$("#value"+n).val(data);
			$("#ctdPrenda"+n).val(1);
		});
	}
});

</script>
<h2> Introduce los datos de la compra: </h2>
<div id="divFormAltaCompra"><br>
	<form id="formAltaCompra" method="post">
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
                    <input type="number" disabled name="precio1" id="precio1" value="0">
                    <input type="hidden" id="value1" name="value1">
                    <br>
            </div>
            <button type="button" name="nuevoArticulo" id="nuevoArticulo">Nuevo articulo</button>
         <button type="button" id="botonSubirCompra" name="botonSubirCompra">Enviar</button>
	</form>
</div>
<?php cerrarConexionBD($conexion);?>