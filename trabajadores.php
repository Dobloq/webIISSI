<?php 
session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}
if (isset($_SESSION["paginacion"])) {
	$paginacion = $_SESSION["paginacion"];
}
		
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : 1;
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;

if ($pag_tam < 1) $pag_tam = 5;
	
unset($_SESSION["paginacion"]);



require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarTrabajadores.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$filas = consultaTrabajadores($conexion, $pagina_seleccionada, $pag_tam);
$colaboradores = consultaColaboradoresAudiovisual($conexion, $pagina_seleccionada, $pag_tam);
cerrarConexionBD($conexion);

$total_paginas = contarTrabajadores($conexion)/$pag_tam;
if(contarTrabajadores($conexion)%$pag_tam>0){$total_paginas++;}
if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;
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
						Nombre: <?php echo $fila["NOMBRETRABAJADOR"];?><br>
						¿Es director? (1 sí, 0 no): <?php echo $fila["ESDIRECTOR"];?><br>
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
            <article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas; $pagina++)
					if ($pagina == $pagina_seleccionada) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="trabajadores.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="trabajadores.php">
					Mostrando <input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo contarTrabajadores($conexion)?>" value="<?php echo $pag_tam?>"> entradas de <?php echo contarTrabajadores($conexion)?> <input type="submit" value="Cambiar">
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
