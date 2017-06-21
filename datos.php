<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}
if (isset($_SESSION["paginacion_clientes"])) {
	$paginacion_clientes = $_SESSION["paginacion_clientes"];
}
if (isset($_SESSION["paginacion_compras"])) {
	$paginacion_compras = $_SESSION["paginacion_compras"];
}

		
$pagina_seleccionada_clientes = isset($_GET["PAG_NUM_CLIENTES"]) ? (int)$_GET["PAG_NUM_CLIENTES"] : 1;
$pagina_seleccionada_compras = isset($_GET["PAG_NUM_COMPRAS"]) ? (int)$_GET["PAG_NUM_COMPRAS"] : 1;

$pag_tam_clientes = isset($_GET["PAG_TAM_CLIENTES"]) ? (int)$_GET["PAG_TAM_CLIENTES"] : (isset($paginacion_clientes) ? (int)$paginacion_clientes["PAG_TAM_CLIENTES"] : 5);
$pag_tam_compras = isset($_GET["PAG_TAM_COMPRAS"]) ? (int)$_GET["PAG_TAM_COMPRAS"] : (isset($paginacion_compras) ? (int)$paginacion_compras["PAG_TAM_COMPRAS"] : 5);

if ($pagina_seleccionada_clientes < 1) $pagina_seleccionada_clientes = 1;
if ($pagina_seleccionada_compras < 1) $pagina_seleccionada_compras = 1;

if ($pag_tam_clientes < 1) $pag_tam_clientes = 5;
if ($pag_tam_compras < 1) $pag_tam_compras= 5;
	
unset($_SESSION["paginacion_clientes"]);
unset($_SESSION["paginacion_compras"]);

require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarCompras.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, $pagina_seleccionada_clientes, $pag_tam_clientes);
$compras = consultaCompras($conexion, $pagina_seleccionada_compras, $pag_tam_compras);
cerrarConexionBD($conexion);

$total_paginas_clientes = contarClientes($conexion)/$pag_tam_clientes ;
$total_paginas_compras = contarCompras($conexion)/$pag_tam_compras ;

if(contarClientes($conexion)%$pag_tam_clientes>0){$total_paginas_clientes++;}
if ($pagina_seleccionada_clientes > $total_paginas_clientes) $pagina_seleccionada_clientes = $total_paginas_clientes;

if(contarCompras($conexion)%$pag_tam_compras>0){$total_paginas_compras++;}
if ($pagina_seleccionada_compras > $total_paginas_compras) $pagina_seleccionada_compras = $total_paginas_compras;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion_clientes["PAG_NUM_CLIENTES"] = $pagina_seleccionada_clientes;
$paginacion_clientes["PAG_TAM_CLIENTES"] = $pag_tam_clientes;
$_SESSION["paginacion_clientes"] = $paginacion_clientes;

$paginacion_compras["PAG_NUM_COMPRAS"] = $pagina_seleccionada_compras;
$paginacion_compras["PAG_TAM_COMPRAS"] = $pag_tam_compras;
$_SESSION["paginacion_compras"] = $paginacion_compras;

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
			<h2> Datos: </h2>
			<div id="gridDatos">
				<article>
					<h2> Clientes: </h2>
					<?php foreach($clientes as $fila){?>
						<div id="divListado" name="divListado">
							Nombre: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=cliente&id=<?php echo $fila["IDCLIENTE"]; ?>&nombre=<?php echo $fila["NOMBRECLIENTE"];?>&telefono=<?php echo $fila["TELEFONO"];?>&correo=<?php echo $fila["CORREO"];?>&anyoNacimiento=<?php echo $fila["ANYONACIMIENTO"];?>">
								<?php echo $fila["NOMBRECLIENTE"];?> 
							</a> <br>
							Teléfono: <?php echo $fila["TELEFONO"];?> <br>
							Correo: <?php echo $fila["CORREO"];?> <br>
							Año de nacimiento: <?php echo $fila["ANYONACIMIENTO"];?> <br>
                            <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
								<input type="hidden" name="idCliente" id="idCliente" value="<?php echo $fila["IDCLIENTE"];?>">
								<button name="borrarCliente" id="borrarCliente" type="submit">Borrar cliente </button>
							</form>
							<br>
						</div>
                      	<br>
					<?php }?>
				</article>
				<!-- PAGINACION CLIENTES -->
               	<article>
				<?php
				for ($pagina = 1; $pagina <= $total_paginas_clientes; $pagina++)
					if ($pagina == $pagina_seleccionada_clientes) {?>
						<span class="current"><?php echo $pagina; ?></span>
						<?php }	else { ?>
						<a href="datos.php?PAG_NUM_CLIENTES=<?php echo $pagina; ?>&PAG_TAM_CLIENTES=<?php echo $pag_tam_clientes; ?>"><?php echo $pagina; ?></a>
						<?php } ?>
					<form method="get" action="datos.php">
					Mostrando <input id="PAG_TAM_CLIENTES" name="PAG_TAM_CLIENTES" type="number" min="1" max="<?php echo contarClientes($conexion)?>" value="<?php echo $pag_tam_clientes?>"> entradas de <?php echo contarClientes($conexion)?> <input type="submit" value="Cambiar">
					</form>
				</article>
				<article>
					<h2> Compras: </h2>
					<?php foreach($compras as $fila){?>
						<div id="divListado" name="divListado">
							Nombre del cliente: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=cliente&id=<?php echo $fila["IDCLIENTE"]; ?>&nombre=<?php echo $fila["NOMBRECLIENTE"];?>&telefono=<?php echo $fila["TELEFONO"];?>&correo=<?php echo $fila["CORREO"];?>&anyoNacimiento=<?php echo $fila["ANYONACIMIENTO"];?>">
								<?php echo $fila["NOMBRECLIENTE"];?> 
							</a><br>
							Fecha de la compra: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=compra&id=<?php echo $fila["IDCOMPRA"]; ?>&fechaCompra=<?php echo $fila["FECHACOMPRA"]; ?>&idCliente=<?php echo $fila['IDCLIENTE']; ?>&nombreCliente=<?php echo $fila['NOMBRECLIENTE']; ?>">
								<?php echo $fila["FECHACOMPRA"];?>
							</a><br>
                            <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
								<input type="hidden" name="idCompra" id="idCompra" value="<?php echo $fila["IDCOMPRA"];?>">
								<button name="borrarCompra" id="borrarCompra" type="submit">Borrar compra </button>
							</form><br>
						</div>
                        <br>
					<?php }?>
				</article>
				<!-- PAGINACION COMPRAS -->
               	<article>
				<?php
				for ($pagina = 1; $pagina <= $total_paginas_compras; $pagina++)
					if ($pagina == $pagina_seleccionada_compras) {?>
						<span class="current"><?php echo $pagina; ?></span>
						<?php }	else { ?>
						<a href="datos.php?PAG_NUM_COMPRAS=<?php echo $pagina; ?>&PAG_TAM_COMPRAS=<?php echo $pag_tam_compras; ?>"><?php echo $pagina; ?></a>
						<?php } ?>
					<form method="get" action="datos.php">
					Mostrando <input id="PAG_TAM_COMPRAS" name="PAG_TAM_COMPRAS" type="number" min="1" max="<?php echo contarCompras($conexion)?>" value="<?php echo contarCompras($conexion)?>"> entradas de <?php echo contarCompras($conexion)?> <input type="submit" value="Cambiar">
					</form>
				</article>
			</div>
		</section>
		<!-- ASIDE -->
		<aside id="columna">
			<h2>Acciones:</h2>
			<div id="rackBotones">
				<form action="altas.php" method="get">
					<div id="botonesAside">
						<button id="botonAnyadirCompra" name="botonAnyadirCompra" type="submit" value="anyadirCompra">Añadir Compra</button>
					</div>
					<div id="botonesAside">
						<button id="botonAnyadirCliente" name="botonAnyadirCliente" type="submit" value="anyadirCliente">Añadir Cliente</button>
					</div>
				</form>
			</div>			
		</aside> 
		<!-- FOOTER -->
		<?php include_once('php/_/pie.php');?>
	</div>
</body>
</html>
