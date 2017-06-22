<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}
if (isset($_SESSION["paginacion_proveedores"])) {
	$paginacion_proveedores = $_SESSION["paginacion_proveedores"];
}
if (isset($_SESSION["paginacion_colaboradoresTextil"])) {
	$paginacion_colaboradoresTextil = $_SESSION["paginacion_colaboradoresTextil"];
}
		
$pagina_seleccionada_proveedores = isset($_GET["PAG_NUM_PROVEEDORES"]) ? (int)$_GET["PAG_NUM_PROVEEDORES"] : 1;
$pagina_seleccionada_colaboradoresTextil = isset($_GET["PAG_NUM_COLABORADORTEXTIL"]) ? (int)$_GET["PAG_NUM_COLABORADORTEXTIL"] : 1;

$pag_tam_proveedores = isset($_GET["PAG_TAM_PROVEEDORES"]) ? (int)$_GET["PAG_TAM_PROVEEDORES"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM_PROVEEDORES"] : 5);
$pag_tam_colaboradoresTextil = isset($_GET["PAG_TAM_COLABORADORTEXTIL"]) ? (int)$_GET["PAG_TAM_COLABORADORTEXTIL"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM_COLABORADORTEXTIL"] : 5);


if ($pagina_seleccionada_proveedores < 1) $pagina_seleccionada_proveedores = 1;
if ($pagina_seleccionada_colaboradoresTextil < 1) $pagina_seleccionada_colaboradoresTextil = 1;

if ($pag_tam_proveedores < 1) $pag_tam_proveedores = 5;
if ($pag_tam_colaboradoresTextil < 1) $pag_tam_colaboradoresTextil = 5;
	
unset($_SESSION["paginacion_proveedores"]);
unset($_SESSION["paginacion_colaboradoresTextil"]);


require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarProveedor.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$proveedores = consultaProveedor($conexion, $pagina_seleccionada_proveedores, $pag_tam_proveedores); //Al autocompletar me salian los valores de pag_tam_* por duplicado
$colaboradores = consultaColaboradoresTextil($conexion, $pagina_seleccionada_colaboradoresTextil, $pag_tam_colaboradoresTextil);
cerrarConexionBD($conexion);

$total_paginas_proveedores = contarProveedores($conexion)/$pag_tam_proveedores;
$total_paginas_colaboradoresTextil = contarColaboradoresT($conexion)/$pag_tam_colaboradoresTextil;

if(contarProveedores($conexion)%$pag_tam_proveedores>0){$total_paginas_proveedores++;}
if ($pagina_seleccionada_proveedores > $total_paginas_proveedores) $pagina_seleccionada_proveedores = $total_paginas_proveedores;

if(contarColaboradoresT($conexion)%$pag_tam_colaboradoresTextil>0){$total_paginas_colaboradoresTextil++;}
if($pagina_seleccionada_colaboradoresTextil > $total_paginas_colaboradoresTextil) $pagina_seleccionada_colaboradoresTextil = $total_paginas_colaboradoresTextil;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion_proveedores["PAG_NUM_PROVEEDORES"] = $pagina_seleccionada_proveedores;
$paginacion_proveedores["PAG_TAM_PROVEEDORES"] = $pag_tam_proveedores;
$_SESSION["paginacion_proveedores"] = $paginacion_proveedores;

$paginacion_colaboradoresTextil["PAG_NUM_COLABORADORTEXTIL"] = $pagina_seleccionada_colaboradoresTextil;
$paginacion_colaboradoresTextil["PAG_TAM_COLABORADORTEXTIL"] = $pag_tam_colaboradoresTextil;
$_SESSION["paginacion_colaboradoresTextil"] = $paginacion_colaboradoresTextil;

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
			<!-- PAGINACION DE PROVEEDORES -->
            <article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas_proveedores; $pagina++)
					if ($pagina == $pagina_seleccionada_proveedores) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="proveedores.php?PAG_NUM_PROVEEDORES=<?php echo $pagina; ?>&PAG_TAM_PROVEEDORES=<?php echo $pag_tam_proveedores; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="proveedores.php">
					Mostrando <input id="PAG_TAM_PROVEEDORES" name="PAG_TAM_PROVEEDORES" type="number" min="1" max="<?php echo contarProveedores($conexion)?>" value="<?php echo $pag_tam_proveedores?>"> entradas de <?php echo contarProveedores($conexion)?> <input type="submit" value="Cambiar">
                </form>
            </article>
			
			<article>
				<h2> Colaboradores Textiles: </h2>
				<?php foreach($colaboradores as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=colaboradorTextil&id=<?php echo $fila['IDCOLABORADORTEXTIL']; ?>&nombre=<?php echo $fila['NOMBRECOLABORADORTEXTIL']; ?>" >
							<?php echo $fila["NOMBRECOLABORADORTEXTIL"];?>
						</a><br>
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
			<!-- PAGINACION DE COLABORADORES TEXTIL -->
			<article>
			<?php
				for ($pagina = 1; $pagina <= $total_paginas_colaboradoresTextil; $pagina++)
					if ($pagina == $pagina_seleccionada_colaboradoresTextil) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="proveedores.php?PAG_NUM_COLABORADORTEXTIL=<?php echo $pagina; ?>&PAG_TAM_COLABORADORTEXTIL=<?php echo $pag_tam_colaboradoresTextil; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="proveedores.php">
					Mostrando <input id="PAG_TAM_COLABORADORTEXTIL" name="PAG_TAM_COLABORADORTEXTIL" type="number" min="1" max="<?php echo contarColaboradoresT($conexion)?>" value="<?php echo $pag_tam_colaboradoresTextil?>"> entradas de <?php echo contarColaboradoresT($conexion)?> <input type="submit" value="Cambiar">
                </form>
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
