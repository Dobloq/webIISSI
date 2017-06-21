<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}if (isset($_SESSION["paginacion"])) {
	$paginacion = $_SESSION["paginacion"];
}
		
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : 1;
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;

if ($pag_tam < 1) $pag_tam = 5;
	
unset($_SESSION["paginacion"]);


require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarProveedor.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$proveedores = consultaProveedor($conexion, $pagina_seleccionada, $pag_tam);
$colaboradores = consultaColaboradoresTextil($conexion, $pagina_seleccionada, $pag_tam);
cerrarConexionBD($conexion);

$total_paginas = contarProveedores($conexion)/$pag_tam;
if(contarProveedores($conexion)%$pag_tam>0){$total_paginas++;}
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
			<h2> Proveedores </h2>
			<article>
				<h2> Proveedores </h2>
				<?php foreach($proveedores as $fila){?> 
					<div id="divListado" name="divListado">
						Nombre: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=proveedor&id=<?php echo $fila["IDPROVEEDOR"]?>&nombre=<?php echo $fila["NOMBREPROVEEDOR"];?>&calificacion=<?php echo $fila["CALIFICACION"];?>&serigrafia=<?php echo $fila["SERIGRAFIA"];?>&ciudad=<?php echo $fila["CIUDAD"];?>&tecnicas=<?php echo $fila["TECNICAS"];?>">
							<?php echo $fila["NOMBREPROVEEDOR"];?>
						</a><br>
						Calificación: <?php echo $fila["CALIFICACION"];?><br>
						Ciudad: <?php echo $fila["CIUDAD"];?><br>
						Serigrafía (1 sí, 0 no): <?php echo $fila["SERIGRAFIA"];?><br>
						Técnicas: <?php echo $fila["TECNICAS"];?><br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idProveedor" id="idProveedor" value="<?php echo $fila["IDPROVEEDOR"];?>">
							<button name="borrarProveedor" id="borrarProveedor" type="submit"> Borrar proveedor </button>
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
						<a href="proveedores.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="proveedores.php">
					Mostrando <input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo contarProveedores($conexion)?>" value="<?php echo $pag_tam?>"> entradas de <?php echo contarProveedores($conexion)?> <input type="submit" value="Cambiar">
                </form>
            </article>
			<article>
				<h2> Colaboradores Textiles: </h2>
				<?php foreach($colaboradores as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBRECOLABORADORTEXTIL"];?><br>
						Calificación: <?php echo $fila["CALIFICACION"];?><br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idColaboradorTextil" id="idColaboradorTextil" value="<?php echo $fila["IDCOLABORADORTEXTIL"];?>">
							<button name="borrarColaboradorTextil" id="borrarColaboradorTextil" type="submit"> Borrar colaborador textil </button>
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
						<button id="botonAnyadirProveedor" name="botonAnyadirProveedor" type="submit" value="anyadirProveedor">Añadir Proveedor</button>
					</div>
					<div id="botonesAside">
						<button id="botonAnyadirColaboradorTextil" name="botonAnyadirColaboradorTextil" type="submit" value="AnyadirColaboradorTextil">Añadir Colaborador Textil</button>
					</div>
				</form>
			</div>			
		</aside> 
		<!-- FOOTER -->
		<?php include_once('php/_/pie.php');?>
	</div>
</body>
</html>
