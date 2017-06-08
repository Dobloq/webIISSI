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
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarCompras.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, $pagina_seleccionada, $pag_tam);
$compras = consultaCompras($conexion, $pagina_seleccionada, $pag_tam);
cerrarConexionBD($conexion);

$total_paginas = contarClientes($conexion)/$pag_tam ;
if(contarClientes($conexion)%$pag_tam>0){$total_paginas++;}
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
			<h2> Datos: </h2>
			<div id="gridDatos">
				<article>
					<h2> Clientes: </h2>
					<?php foreach($clientes as $fila){?>
						<div id="divListado" name="divListado">
							Nombre: <?php echo $fila["NOMBRECLIENTE"];?> <br>
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
               	<article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas; $pagina++)
					if ($pagina == $pagina_seleccionada) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="datos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="datos.php">
					Mostrando <input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo contarClientes($conexion)?>" value="<?php echo $pag_tam?>"> entradas de <?php echo contarClientes($conexion)?> <input type="submit" value="Cambiar">
                </form>
            </article>
				<article>
					<h2> Compras: </h2>
					<?php foreach($compras as $fila){?>
						<div id="divListado" name="divListado">
							Nombre del cliente: <?php echo $fila["NOMBRECLIENTE"];?><br>
							Fecha de la compra: <?php echo $fila["FECHACOMPRA"];?><br>
                            <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
								<input type="hidden" name="idCompra" id="idCompra" value="<?php echo $fila["IDCOMPRA"];?>">
								<button name="borrarCompra" id="borrarCompra" type="submit">Borrar compra </button>
							</form><br>
						</div>
                        <br>
					<?php }?>
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
