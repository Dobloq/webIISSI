<?php 
session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
	require_once("php/controladores/gestionBD.php");
	require_once("php/controladores/gestionarTareas.php");
	require_once("php/controladores/gestionarTrabajadores.php");
	$conexion = crearConexionBD();
	$resultado = consultaTareasTotales($conexion, 1, 20);
	$nAlmacenes = contarTrabajadores($conexion);
	//$existe = comprobarTemporada($conexion, 'Veranito');
	cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
	<?php include_once('php/_/cabecera.php')?>
	
	<body>
	<?php
	if (isset($_SESSION['datosUsuario'])){
		$usuario = $_SESSION['datosUsuario'][1];
	}
	else{
		HEADER("Location: index.php");
	}
?>
	<div id="agrupar">
					<!-- HEADER -->
		<header id="cabecera">
			<h1> THREEW CLOTH. CO. </h1>
            <?php print_r($nAlmacenes);
				echo $existe;
			?>
		</header>
					<!-- NAV -->
		<?php include_once('php/_/nav.php')?>
					<!-- SECTION -->
		<section id="seccion">
			<h2> Bienvenido <?php echo $usuario; ?> </h2> 
			<article>
				<h2> Novedades: </h2>
			</article>
			<article>
    <h2> Tareas: </h2>
                <?php
     foreach($resultado as $fila){
    ?>
     <div id="divListado" name="divListado">
      Nombre de la tarea: <?php echo $fila["NOMBRETAREA"];?><br>
      Tiempo estimado (en minutos): <?php echo $fila["TIEMPOESTIMADO"];?><br>
      Tiempo real (en minutos): <?php echo $fila["TIEMPOREAL"];?><br>
      <form id="formListado" method="post" action="php/controladores/eliminar.php">
							<input type="hidden" id="idTarea" name="idTarea" value="<?php echo $fila["IDTAREA"];?>">
							<button id="borrarTarea" name="borrarTarea" type="submit" onClick="confirm('¿Está seguro de que desea borrar?')">Borrar tarea </button>
						</form><br>
     </div>
     <br>
     <?php }?>
   </article>
		</section>
					<!-- ASIDE -->
		<aside id="columna">
			<p> Bienvenido a tu página principal en esta aplicación; <br>
    Utiliza los botones que ves en la superior (navegador) para desplazarte por la página. <br>
    Los botones que encontrarás en esta columna sirven para controlar la página y la base de datos. <br>
   </p>
		</aside>
					<!-- FOOTER -->
		
		<?php include_once('php/_/pie.php')?>

	</div>
	</body>
</html>
