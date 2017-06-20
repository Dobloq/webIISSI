<?php session_start();
if (!isset($_SESSION["datosUsuario"])){
	header("Location: index.php");
	exit();
}

if (isset($_SESSION["paginacion_tareas"])) {
	$paginacion_tareas = $_SESSION["paginacion_tareas"];
}
if (isset($_SESSION["paginacion_proyectos"])) {
	$paginacion_proyectos = $_SESSION["paginacion_proyectos"];
}
		
$pagina_seleccionada_tareas = isset($_GET["PAG_NUM_TAREAS"]) ? (int)$_GET["PAG_NUM_TAREAS"] : 1;
$pagina_seleccionada_proyectos = isset($_GET["PAG_NUM_PROYECTOS"]) ? (int)$_GET["PAG_NUM_PROYECTOS"] : 1;

$pag_tam_tareas = isset($_GET["PAG_TAM_TAREAS"]) ? (int)$_GET["PAG_TAM_TAREAS"] : (isset($paginacion_tareas) ? (int)$paginacion_tareas["PAG_TAM_TAREAS"] : 5);
$pag_tam_proyectos = isset($_GET["PAG_TAM_PROYECTOS"]) ? (int)$_GET["PAG_TAM_PROYECTOS"] : (isset($paginacion_proyectos) ? (int)$paginacion_proyectos["PAG_TAM_PROYECTOS"] : 5);

if ($pagina_seleccionada_tareas < 1) $pagina_seleccionada_tareas = 1;
if ($pagina_seleccionada_proyectos < 1) $pagina_seleccionada_proyectos = 1;

if ($pag_tam_tareas < 1) $pag_tam_tareas = 5;
if ($pag_tam_proyectos < 1) $pag_tam_proyectos = 5;
	
unset($_SESSION["paginacion_tareas"]);
unset($_SESSION["paginacion_proyectos"]);

require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarTareas.php");
require_once("php/controladores/gestionarProyectoAudiovisual.php");
		
$trabajador = $_SESSION["datosUsuario"][0];
$conexion = crearConexionBD();

//falta cambiar total paginas 

if($_SESSION["datosUsuario"]["ESDIRECTOR"]==1){
	$resultado = consultaTareasTotales($conexion, $pagina_seleccionada_tareas, $pag_tam_tareas);
	$nTareas = contarTareas($conexion);
	$total_paginas = $nTareas/$pag_tam_tareas;
} else {
	$resultado = consultaTareasDeUnTrabajador($conexion, $pagina_seleccionada_tareas, $pag_tam_tareas, $trabajador);
	$nTareas = contarTareasTrabaj($conexion, $trabajador);
	$total_paginas = $nTareas/$pag_tam_tareas;
}
$nProyectos = contarProyectos($conexion);
$proyecto = consultaProyectoAudiovisual($conexion, $pagina_seleccionada_proyectos, $pag_tam_proyectos);
cerrarConexionBD($conexion);

$total_paginas_proyectos = $nProyectos/$pag_tam_proyectos;
if($nTareas%$pag_tam_tareas>0){$total_paginas++;}
if ($pagina_seleccionada_tareas > $total_paginas) $pagina_seleccionada_tareas = $total_paginas;

if($nProyectos%$pag_tam_proyectos>0){$total_paginas_proyectos++;}
if ($pagina_seleccionada_proyectos > $total_paginas_proyectos) $pagina_seleccionada_proyectos = $total_paginas_proyectos;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion_tareas["PAG_NUM_TAREAS"] = $pagina_seleccionada_tareas;
$paginacion_tareas["PAG_TAM_TAREAS"] = $pag_tam_tareas;
$_SESSION["paginacion_tareas"] = $paginacion_tareas;

$paginacion_proyectos["PAG_NUM_PROYECTOS"] = $pagina_seleccionada_proyectos;
$paginacion_proyectos["PAG_TAM_PROYECTOS"] = $pag_tam_proyectos;
$_SESSION["paginacion_proyectos"] = $paginacion_proyectos;

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
                <?php foreach($resultado as $fila){ 
				$tiempoReal = "";
				$proyectoTarea = "";
				$colaborador = "";?>
					<div id="divListado" name="divListado">
						Nombre de la tarea: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=tarea&id=<?php echo $fila['IDTAREA']; ?>&nombre=<?php echo $fila["NOMBRETAREA"];?>&tiempoEstimado=<?php echo $fila["TIEMPOESTIMADO"];?><?php echo $tiempoReal; ?><?php echo $proyectoTarea; ?> <?php echo $colaborador; ?>">
							<?php echo $fila["NOMBRETAREA"];?>
						</a><br>
						Tiempo estimado (en minutos): <?php echo $fila["TIEMPOESTIMADO"];?><br>
						<?php if(isset($fila["TIEMPOREAL"])){
							$tiempoReal = "&tiempoReal=". $fila["TIEMPOREAL"];?>
							Tiempo real (en minutos): <?php echo $fila["TIEMPOREAL"];?> <br>
						<?php } ?>
						
						<?php if(isset($fila["PROYECTOAUDIOVISUAL"])){
							$proyectoTarea = "&proyecto=". $fila["PROYECTOAUDIOVISUAL"];?>
							Proyecto: <?php echo $fila["PROYECTOAUDIOVISUAL"];?> <br>
						<?php } ?>
						
						<?php if(isset($fila["COLABORADORAUDIOVISUAL"])){
							$colaborador = "&colaborador=". $fila["COLABORADORAUDIOVISUAL"];?>
							Colaborador: <?php echo $fila["COLABORADORAUDIOVISUAL"];?> <br>
						<?php } ?>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idTarea" id="idTarea" value="<?php echo $fila["IDTAREA"];?>">
							<button name="borrarTarea" id="borrarTarea" type="submit">Borrar tarea</button>
						</form>
                        <br>
					</div>
					<br>
				<?php }?>
			</article>
			<!-- PAGINACION DE TAREAS -->
            <article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas; $pagina++)
					if ($pagina == $pagina_seleccionada_tareas) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="tareas.php?PAG_NUM_TAREAS=<?php echo $pagina; ?>&PAG_TAM_TAREAS=<?php echo $pag_tam_tareas; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="tareas.php">
					Mostrando <input id="PAG_TAM_TAREAS" name="PAG_TAM_TAREAS" type="number" min="1" max="<?php echo $nTareas?>" value="<?php echo $pag_tam_tareas?>"> entradas de <?php echo $nTareas?> <input type="submit" value="Cambiar">
                </form>
            </article>
			<article>
				<h2> Proyectos: </h2>
				<?php foreach($proyecto as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBREPROYECTOAUDIOVISUAL"];?> <br>
						<form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idProyecto" id="idProyecto" value="<?php echo $fila["IDPROYECTOAUDIOVISUAL"];?>">
							<button name="borrarProyecto" id="borrarProyecto" type="submit">Borrar proyecto </button>
						</form>
						<br>
					</div>
					<br>
				<?php }?>
			</article>
			<!-- PAGINACION DE PROYECTOS hace falta diferenciar entre si está seteao el formulario de arriba o no  -->
			<article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas_proyectos; $pagina++)
					if ($pagina == $pagina_seleccionada_proyectos) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="tareas.php?PAG_NUM_PROYECTOS=<?php echo $pagina; ?>&PAG_TAM_PROYECTOS=<?php echo $pag_tam_proyectos; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="tareas.php">
					Mostrando <input id="PAG_TAM_PROYECTOS" name="PAG_TAM_PROYECTOS" type="number" min="1" max="<?php echo $nProyectos?>" value="<?php echo $pag_tam_proyectos?>"> entradas de <?php echo $nProyectos?> <input type="submit" value="Cambiar">
                </form>
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
