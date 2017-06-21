<?php 
session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}
if (isset($_SESSION["paginacion_trabajadores"])) {
	$paginacion_trabajadores = $_SESSION["paginacion_trabajadores"];
}
if (isset($_SESSION["paginacion_colaboradoresAU"])) {
	$paginacion_colaboradoresAU = $_SESSION["paginacion_colaboradoresAU"];
}
	
$pagina_seleccionada_trabajadores = isset($_GET["PAG_NUM_TRABAJADORES"]) ? (int)$_GET["PAG_NUM_TRABAJADORES"] : 1;
$pagina_seleccionada_colaboradoresAU = isset($_GET["PAG_NUM_COLABORADORES_AUDIOVISUAL"]) ? (int)$_GET["PAG_NUM_COLABORADORES_AUDIOVISUAL"] : 1;

$pag_tam_trabajadores = isset($_GET["PAG_TAM_TRABAJADORES"]) ? (int)$_GET["PAG_TAM_TRABAJADORES"] : (isset($paginacion_trabajadores) ? (int)$paginacion_trabajadores["PAG_TAM_TRABAJADORES"] : 5);
$pag_tam_colaboradoresAU = isset($_GET["PAG_TAM_COLABORADORES_AUDIOVISUAL"]) ? (int)$_GET["PAG_TAM_COLABORADORES_AUDIOVISUAL"] : (isset($paginacion_colaboradoresAU) ? (int)$paginacion_colaboradoresAU["PAG_TAM_COLABORADORES_AUDIOVISUAL"] : 5);

if ($pagina_seleccionada_trabajadores < 1) $pagina_seleccionada_trabajadores = 1;
if ($pagina_seleccionada_colaboradoresAU < 1) $pagina_seleccionada_colaboradoresAU = 1;

if ($pag_tam_trabajadores < 1) $pag_tam_trabajadores = 5;
if ($pag_tam_colaboradoresAU < 1) $pag_tam_colaboradoresAU = 5;

unset($_SESSION["paginacion_trabajadores"]);
unset($_SESSION["paginacion_colaboradoresAU"]);


require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarTrabajadores.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$filas = consultaTrabajadores($conexion, $pagina_seleccionada_trabajadores, $pag_tam_trabajadores);
$colaboradores = consultaColaboradoresAudiovisual($conexion, $pagina_seleccionada_colaboradoresAU, $pag_tam_colaboradoresAU);
cerrarConexionBD($conexion);

$total_paginas_trabajadores = contarTrabajadores($conexion)/$pag_tam_trabajadores;
$total_paginas_colaboradorAU = contarColaboradoresAU($conexion)/$pag_tam_colaboradoresAU;

if(contarTrabajadores($conexion)%$pag_tam_trabajadores>0){$total_paginas_trabajadores++;}
if ($pagina_seleccionada_trabajadores > $total_paginas_trabajadores) $pagina_seleccionada_trabajadores = $total_paginas_trabajadores;

if(contarColaboradoresAU($conexion)%$pag_tam_colaboradoresAU>0){$total_paginas_colaboradorAU++;}
if ($pagina_seleccionada_colaboradoresAU > $total_paginas_colaboradorAU) $pagina_seleccionada_colaboradoresAU = $total_paginas_colaboradorAU;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion_trabajadores["PAG_NUM_TRABAJADORES"] = $pagina_seleccionada_trabajadores;
$paginacion_trabajadores["PAG_TAM_TRABAJADORES"] = $pag_tam_trabajadores;
$_SESSION["paginacion_trabajadores"] = $paginacion_trabajadores;

$paginacion_colaboradoresAU["PAG_NUM_COLABORADORES_AUDIOVISUAL"] = $pagina_seleccionada_colaboradoresAU;
$paginacion_colaboradoresAU["PAG_TAM_COLABORADORES_AUDIOVISUAL"] = $pag_tam_colaboradoresAU;
$_SESSION["paginacion_colaboradoresAU"] = $paginacion_colaboradoresAU;
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
			<h2> Trabajadores </h2>
			<article>
				<h2> Trabajadores: </h2>
				<?php foreach($filas as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=trabajador&id=<?php echo $fila["IDTRABAJADOR"];?>&nombre=<?php echo $fila["NOMBRETRABAJADOR"];?>&esDirector=<?php echo $fila["ESDIRECTOR"];?>&valoracion=<?php echo $fila["VALORACION"];?>&usuario=<?php echo $fila["USUARIO"];?>">
							<?php echo $fila["NOMBRETRABAJADOR"];?>
						</a><br>
						¿Es director?: <?php echo ($fila["ESDIRECTOR"]==0) ? "No" : "Si";?><br>
						Valoración: <?php echo $fila["VALORACION"];?><br>
						Nombre de usuario: <?php echo $fila["USUARIO"];?><br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idTrabajador" id="idTrabajador" value="<?php echo $fila["IDTRABAJADOR"];?>">
							<button name="borrarTrabajador" id="borrarTrabajador" type="submit">Borrar trabajador </button>
						</form>
						<br>
					</div>
					<br>
				<?php }?>
			</article>
			<!-- PAGINACION TRABAJADOR -->
            <article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas_trabajadores; $pagina++)
					if ($pagina == $pagina_seleccionada_trabajadores) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="trabajadores.php?PAG_NUM_TRABAJADORES=<?php echo $pagina; ?>&PAG_TAM_TRABAJADORES=<?php echo $pag_tam_trabajadores; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="trabajadores.php">
					Mostrando <input id="PAG_TAM_TRABAJADORES" name="PAG_TAM_TRABAJADORES" type="number" min="1" max="<?php echo contarTrabajadores($conexion)?>" value="<?php echo $pag_tam_trabajadores?>"> entradas de <?php echo contarTrabajadores($conexion)?> <input type="submit" value="Cambiar">
                </form>
            </article>
			
			<article>
				<h2> Colaboradores: </h2>
				<?php foreach($colaboradores as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBRECOLABORADORAUDIOVISUAL"];?><br>
						Calificación: <?php echo $fila["CALIFICACION"];?><br>
						<form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idColaborador" id="idColaborador" value="<?php echo $fila["IDCOLABORADORAUDIOVISUAL"];?>">
							<button name="borrarColaborador" id="borrarColaborador" type="submit"> Borrar colaborador </button>
						</form>
						<br>
					</div>
					<br>
				<?php }?>
			</article>
			<!-- PAGINACION COLABORADOR AUDIOVISUAL -->
			<article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas_colaboradorAU; $pagina++)
					if ($pagina == $pagina_seleccionada_colaboradoresAU) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="trabajadores.php?PAG_NUM_COLABORADORES_AUDIOVISUAL=<?php echo $pagina; ?>&PAG_TAM_COLABORADORES_AUDIOVISUAL=<?php echo $pag_tam_colaboradoresAU; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="trabajadores.php">
					Mostrando <input id="PAG_TAM_COLABORADORES_AUDIOVISUAL" name="PAG_TAM_COLABORADORES_AUDIOVISUAL" type="number" min="1" max="<?php echo contarColaboradoresAU($conexion)?>" value="<?php echo $pag_tam_colaboradoresAU?>"> entradas de <?php echo contarColaboradoresAU($conexion)?> <input type="submit" value="Cambiar">
                </form>
            </article>
		</section>
		<!-- ASIDE -->
		<aside id="columna">
			<h2>Acciones:</h2>
			<div id="rackBotones">
				<form action="altas.php" method="get">
					<div id="botonesAside">
						<button id="botonAnyadirTrabajador" name="botonAnyadirTrabajador" type="submit" value="anyadirTrabajador">Añadir Trabajador</button>
					</div>
					<div id="botonesAside">
						<button id="botonAnyadirColaboradorAV" name="botonAnyadirColaboradorAV" type="submit" value="anyadirColaboradorAV">Añadir Colaborador Audiovisual</button>
					</div>
				</form>
			</div>			
		</aside> 
		<!-- FOOTER -->
		<?php include_once('php/_/pie.php');?>
	</div>
	</body>
</html>
