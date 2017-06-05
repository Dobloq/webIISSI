<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarCompras.php");
$conexion = crearConexionBD();
$clientes = consultaClientes($conexion, 1, 200);
$compras = consultaCompras($conexion, 1, 20);
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
                            <form id="formListado" method="post" action="php/controladores/eliminar.php">
								<input type="hidden" name="idCliente" id="idCliente" value="<?php echo $fila["IDCLIENTE"];?>">
								<button name="borrarCliente" id="borrarCliente" type="submit" onClick="confirm('¿Está seguro de que desea borrar?')">Borrar cliente </button>
							</form>
							<br>
						</div>
                      	<br>
					<?php }?>
				</article>
                	
				<article>
					<h2> Compras: </h2>
					<?php foreach($compras as $fila){?>
						<div id="divListado" name="divListado">
							Nombre del cliente: <?php echo $fila["NOMBRECLIENTE"];?><br>
							Fecha de la compra: <?php echo $fila["FECHACOMPRA"];?><br>
                            <form id="formListado" method="post" action="php/controladores/eliminar.php">
								<input type="hidden" name="idCompra" id="idCompra" value="<?php echo $fila["IDCOMPRA"];?>">
								<button name="borrarCompra" id="borrarCompra" type="submit" onClick="confirm('¿Está seguro de que desea borrar?')">Borrar compra </button>
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
