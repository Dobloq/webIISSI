<?php 
require_once("php/controladores/gestionarProyectoAudiovisual.php");
require_once("php/controladores/gestionarColaboradores.php");
require_once("php/controladores/gestionarTareas.php");
$conexion = crearConexionBD();
$proyecto = consultaProyectoAudiovisual($conexion, 1, 200);
$filas = consultaColaboradoresAudiovisual($conexion, 1, 200);
cerrarConexionBD($conexion);
?>
<script type="text/javascript" src="js/validacion_alta_tarea.js"></script>
<script type="text/javascript">
/*
var x = $(document);
var nextInput = 1;
var a = [];
var prendas = false;

x.ready(function() {
	$("#formAltaTarea").on("submit", function(){
		// si valida bien hace lo siguiente, en caso contrario no hace nada y se muestran los mensajes correspondientes
		if(validationForm()==true){
			var proy = document.getElementById("selectProyectTarea").options[document.getElementById("selectProyectTarea").selectedIndex].value;
			alert(proy);
				// se hace un post para crear la temporada y recibir el id de la temporada creada, data, que se envia a la funcion actualizaPrenda
				$.post("../ThreewGestion/php/controladores/insert.php", {botonSubirTarea: "Enviar", nombreTarea: $("#nombreTarea").val(), 
				tiempoEstimado: $("#tiempoEstimado").val(), selectProyecto: proy}, function(data){
					var ind = 0;
					$("[name^=selectCompartir]").each(function(index, element) {
					// se obtiene el id de la prenda que se escoge en el select
					a[ind] = document.getElementById(element.id).options[document.getElementById(element.id).selectedIndex].value;
					alert("idT: "+a[ind]+"idTarea: "+data);
				// se manda a un metodo que actualiza la prenda con sus nuevos datos
				alert($.post("../ThreewGestion/php/controladores/gestionarTrabajadores.php", 
				{idTrabajador: parseInt(a[ind]), idTarea: parseInt(data)}, 
				function(res){alert(res)}).fail(function(respuesta){alert(respuesta)}));
				
				$.ajax({
							  async:true,
							  type: "POST",
							  dataType: "html",
							  contentType: "application/x-www-form-urlencoded",
							  url:"../ThreewGestion/php/controladores/gestionarTrabajadores.php",
							  data:"idT="+a[ind]+"&idTarea="+data,
							  success:function(datos){alert(datos)},
							  fail: function(datos){alert(datos)}
							}); 
				ind++;});	
				
				
					
					}).fail(alert("falla el primer post"+data));
		}
	});
	
	function actualizaTrabajadorTarea(data){
	
}
});
*/
</script>
<h2> Introduce los datos de la tarea: </h2>
<div id="divFormAltaTarea">
	<form id="formAltaTarea" method="post" action="../ThreewGestion/php/controladores/insert.php" onSubmit="validationForm()">
		<label>Nombre:</label><br>
			<input type="text" name="nombreTarea" id="nombreTarea" required onBlur="nombreValidation()"><br>
		<label>Tiempo estimado en minutos:</label><br>
			<input type="number" name="tiempoEstimado" min="1" id="tiempoEstimado" required onBlur="tiempoValidation()"><br>
		<label>¿Compartes con alguien esta tarea?</label><br>
			<select name="selectCompartir" id="selectCompartir">
				<option value="null">No</option>
                <?php foreach($filas as $fila){?>
				<option value="<?php echo $fila["IDCOLABORADORAUDIOVISUAL"]; ?>"><?php echo $fila["NOMBRECOLABORADORAUDIOVISUAL"]; ?> </option>
							<?php }?>
			</select><br>
		<label>¿Pertenece a algún proyectoAudiovisual?</label><br>
			<select name="selectProyecto" id="selectProyecto">
				<option value="null">No</option>
				<?php foreach($proyecto as $fila){?>
				<option value="<?php echo $fila["IDPROYECTOAUDIOVISUAL"]; ?>"><?php echo $fila["NOMBREPROYECTOAUDIOVISUAL"]; ?> </option>
							<?php }?>
			</select><br>
		<button type="submit" id="botonSubirTarea" name="botonSubirTarea">Enviar</button>
	</form>
</div>

