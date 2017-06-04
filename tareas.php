<?php session_start();
if (!isset($_SESSION["datosUsuario"])){
	header("Location: index.php");
	exit();
}
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarTareas.php");
require_once("php/controladores/gestionarProyectoAudiovisual.php");
		
$trabajador = $_SESSION["datosUsuario"][0];
$conexion = crearConexionBD();

$resultado = consultaTareasDeUnTrabajador($conexion, 1, 20, $trabajador);
$proyecto = consultaProyectoAudiovisual($conexion, 1, 20);
cerrarConexionBD($conexion);
?>
<!DOCTYPE html>

<html lang="es">
<?php include_once('php/_/cabecera.php');?>
<body>
	<div id="agrupar">
		<!-- HEADER -->
		<header id="cabecera">
			<h1> THREEW CLOTH. CO. </h1>
		</header>
		<!-- NAV -->
		<?php include_once('php/_/nav.php');?>
		<!-- SECTION -->
		<section id="seccion">
			<h2> Tareas </h2>
			<article>
				<h2> Mis tareas: </h2>
                <?php foreach($resultado as $fila){ ?>
					<div id="divListado" name="divListado">
						Nombre de la tarea: <?php echo $fila["NOMBRETAREA"];?><br>
						Tiempo estimado (en minutos): <?php echo $fila["TIEMPOESTIMADO"];?><br>
						Tiempo real (en minutos): <?php echo $fila["TIEMPOREAL"];?>
                        <br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php">
							<input type="hidden" name="idTarea" id="idTarea" value="<?php echo $fila["IDTAREA"];?>">
							<button name="borrarTarea" id="borrarTarea" type="submit" onClick="confirm('¿Está seguro de que desea borrar?')"></button>
						</form><br>
					</div>
					<br>
				<?php }?>
			</article>
			<article>
				<h2> Proyectos: </h2>
				<?php foreach($proyecto as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBREPROYECTOAUDIOVISUAL"];?><br>
						<form id="formListado" method="post" action="php/controladores/eliminar.php">
							<input type="hidden" name="idProyecto" id="idProyecto" value="<?php echo $fila["IDPROYECTOAUDIOVISUAL"];?>">
							<button name="borrarProyecto" id="borrarProyecto" type="submit" onClick="confirm('¿Está seguro de que desea borrar?')">Borrar proyecto </button>
						</form>
						<br>
					</div>
					<br>
				<?php }?>
			</article>				
		</section>
		<!-- ASIDE -->
		<aside id="columna">
			<h2>Acciones:</h2>
			<div id="rackBotones">
				<form action="altas.php" method="get">
					<div id="botonesAside">
						<button id="botonAnyadirTarea" name="botonAnyadirTarea" type="submit" value="anyadirTarea"> Añadir Tarea </button>
					</div>
					<div id="botonesAside">
						<button id="botonAnyadirProyectoAV" name="botonAnyadirProyectoAV" type="submit" value="anyadirProyectoAV"> Añadir Proyecto </button>
					</div>
				</form>
			</div>			
		</aside> 
		<!-- FOOTER -->
		<?php include_once('php/_/pie.php');?>
	</div>
	</body>
</html>
