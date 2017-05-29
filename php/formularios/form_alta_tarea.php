<?php 
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarProyectoAudiovisual.php");

$conexion = crearConexionBD();
$proyecto = consultaProyectoAudiovisual($conexion, 1, 200);
cerrarConexionBD($conexion);
?>
			<h2> Introduce los datos de la tarea: </h2>
			<div id="divFormAltaTemporada">
				<form id="formAltaTemporada" action='php/controladores/insert.php' method="post">
					<label> Nombre: </label><br>
						<input type="text" name="nombreTarea" id="nombreTarea" /><br>
					<label> Tiempo estimado en minutos: </label><br>
						<input type="number" name="tiempoEstimado" id="tiempoEstimado" /><br>
					<label> ¿Compartes con alguien esta tarea? </label><br>
						<select>
							<option value="null">No</option>
							
						</select><br>
					<label> ¿Pertenece a algún proyectoAudiovisual? </label><br>
						<select>
							<option value="null">No</option>
							<?php foreach($proyecto as $fila){?>
							<option value="<?php echo $fila["NOMBREPROYECTOAUDIOVISUAL"]; ?>">
							<?php echo $fila["NOMBREPROYECTOAUDIOVISUAL"]; ?> </option>
							<?php }?>
						</select><br>
					<button type="submit" id="botonSubirTarea" name="botonSubirTarea">Enviar</button>
				</form>
			</div>

