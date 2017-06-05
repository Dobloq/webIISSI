<?php 
session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
}
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarTrabajadores.php");
require_once("php/controladores/gestionarColaboradores.php");
$conexion = crearConexionBD();
$filas = consultaTrabajadores($conexion, 1, 20);
$colaboradores = consultaColaboradoresAudiovisual($conexion, 1, 20);
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
			<h2> Trabajadores </h2>
			<article>
				<h2> Trabajadores: </h2>
				<?php foreach($filas as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBRETRABAJADOR"];?><br>
						¿Es director? (1 sí, 0 no): <?php echo $fila["ESDIRECTOR"];?><br>
						Valoración: <?php echo $fila["VALORACION"];?><br>
						Nombre de usuario: <?php echo $fila["USUARIO"];?><br>
                        <form id="formListado" method="post">
							<input type="hidden" name="idTrabajador" id="idTrabajador" value="<?php echo $fila["IDTRABAJADOR"];?>">
							<button name="borrarTrabajador" id="borrarTrabajador" type="submit">Borrar trabajador </button>
						</form>
						<br>
					</div>
					<br>
				<?php }?>
			</article>
			<article>
				<h2> Colaboradores: </h2>
				<?php foreach($colaboradores as $fila){?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila["NOMBRECOLABORADORAUDIOVISUAL"];?><br>
						Calificación: <?php echo $fila["CALIFICACION"];?><br>
						<form id="formListado" method="post">
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
