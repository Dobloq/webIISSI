<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}

require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarProveedor.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$proveedores = consultaProveedor($conexion, 1, 20);
$colaboradores = consultaColaboradoresTextil($conexion, 1, 20);
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
			<h2> Proveedores </h2>
			<article>
				<h2> Proveedores </h2>
				<?php foreach($proveedores as $fila){?> 
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBREPROVEEDOR"];?><br>
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
