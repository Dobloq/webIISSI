<?php 
require_once("php/controladores/gestionarProyectoAudiovisual.php");
require_once("php/controladores/gestionarTrabajadores.php");
require_once("php/controladores/gestionarTareas.php");
$conexion = crearConexionBD();
$proyecto = consultaProyectoAudiovisual($conexion, 1, 200);
$filas = consultaTrabajadores($conexion, 1, 200);
cerrarConexionBD($conexion);
?>
<script type="text/javascript" src="js/validacion_alta_tarea.js"></script>
<script type="text/javascript">
var x = $(document);
var nextInput = 1;
var a = [];
var prendas = false;
function actualizaTrabajadorTarea(data){
		var ind = 0;
		$("[name^=selectCompartir]").each(function(index, element) {
			// se obtiene el id de la prenda que se escoge en el select
			a[ind] = document.getElementById(element.id).options[document.getElementById(element.id).selectedIndex].value;
			alert("idT: "+a[ind]+"idTarea: "+data);
			// se manda a un metodo que actualiza la prenda con sus nuevos datos
			$.get("../ThreewGestion/php/controladores/prueba.php", {idTrabajador: parseInt(a[ind]), idTarea: parseInt(data)}, function(res){console.log(res)});
			ind++;
        });	
		// se devuelve tras la creacion a productos.php
		window.location.replace("../ThreewGestion/tareas.php");
	}
x.ready(function() {
	$("#formAltaTarea").on("submit", function(){
		// si valida bien hace lo siguiente, en caso contrario no hace nada y se muestran los mensajes correspondientes
		if(validationForm()==true){
			var proy = document.getElementById("selectProyectTarea").options[document.getElementById("selectProyectTarea").selectedIndex].value;
				// se hace un post para crear la temporada y recibir el id de la temporada creada, data, que se envia a la funcion actualizaPrenda
				$.post("../ThreewGestion/php/controladores/insert.php", {botonSubirTarea: "Enviar", nombreTarea: $("#nombreTarea").val(), 
				tiempoEstimado: $("#tiempoEstimado").val(), selectProyecto: parseInt(proy)}, function(data){actualizaTrabajadorTarea(parseInt(data))});
		}
	});
	
	
});

</script>
<h2> Introduce los datos de la tarea: </h2>
<div id="divFormAltaTarea">
	<form id="formAltaTarea" method="post">
		<label>Nombre:</label><br>
			<input type="text" name="nombreTarea" id="nombreTarea" required onBlur="nombreValidation()"><br>
		<label>Tiempo estimado en minutos:</label><br>
			<input type="number" name="tiempoEstimado" min="1" id="tiempoEstimado" required onBlur="tiempoValidation()"><br>
		<label>¿Compartes con alguien esta tarea?</label><br>
			<select name="selectCompartir" id="selectCompartir">
				<option value="null">No</option>
                <?php foreach($filas as $fila){?>
				<option value="<?php echo $fila["IDTRABAJADOR"]; ?>"><?php echo $fila["NOMBRETRABAJADOR"]; ?> </option>
							<?php }?>
			</select><br>
		<label>¿Pertenece a algún proyectoAudiovisual?</label><br>
			<select name="selectProyectTarea" id="selectProyectTarea">
				<option value="null">No</option>
				<?php foreach($proyecto as $fila){?>
				<option value="<?php echo $fila["IDPROYECTOAUDIOVISUAL"]; ?>"><?php echo $fila["NOMBREPROYECTOAUDIOVISUAL"]; ?> </option>
							<?php }?>
			</select><br>
		<button type="submit" id="botonSubirTarea" name="botonSubirTarea">Enviar</button>
	</form>
</div>

