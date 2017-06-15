<?php /*Aquí pillamos los datos del objeto y mostramos los detalles*/

session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}

	if(isset($_GET['toDetails'])){
	
		$tipoObjeto = $_GET['tipoObjeto'];
		
		if($tipoObjeto == "prenda") {
			$urlImagen = $_GET['urlImagen'];
			$precio = $_GET['precio'];
			$talla = $_GET['talla'];
			$tipoPrenda = $_GET['tipoPrenda'];
			$id = $_GET['id'];
			$ventas = $_GET['ventas'];
			$cantidad = $_GET['cantidad'];
			$calidad = $_GET['calidad'];
			
			//$almacen = $_GET['almacen'];
			
			if(isset($_GET['temporada'])){
				$temporada = $_GET['temporada'];
			}
			if(isset($_GET['colaboradorTextil'])){
				$colaboradorTextil = $_GET['colaboradorTextil'];
			}
			if(isset($_GET['oferta'])){
				$oferta = $_GET['oferta'];
			}
		}
		if($tipoObjeto == "temporada") {
			$id = $_GET['id'];
			$fecha = $_GET['fecha'];
		}
		if($tipoObjeto == "proveedor") {
			$nombre = $_GET['nombre'];
			$id = $_GET['id'];
			$calificacion = $_GET['calificacion'];
			$serigrafia = $_GET['serigrafia'];
			$cuidad = $_GET['ciudad'];
			$tecnicas = $_GET['tecnicas'];
		}
		if($tipoObjeto == "compra") {
			$id = $_GET['id'];
		}
		if($tipoObjeto == "colaboradorTextil") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
		}
		
		if($tipoObjeto == "colaboradorAudiovisual") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
		}
		
		if($tipoObjeto == "proyectoAudiovisual") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
		}
		
		if($tipoObjeto == "almacen") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
		}
		
		if($tipoObjeto == "cliente") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
			$telefono = $_GET['telefono'];
			$correo = $_GET['correo'];
			$anyoNacimiento = $_GET['anyoNacimiento'];
		}
		
		if($tipoObjeto == "tarea") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
			$tiempoEstimado = $_GET['tiempoEstimado'];
			
			if(isset($_GET['tiempoReal'])){
				$tiempoReal = $_GET['tiempoReal'];
			}
						
			if(isset($_GET['proyecto'])){
				$proyecto = $_GET['proyecto'];
			}
			
			if(isset($_GET['colaborador'])){
				$colaborador = $_GET['colaborador'];
			}
			
		}
		
	} else {
		$_SESSION['excepcion'] = "Parece que no ha seleccionado ningún item para verlo en detalle";
		Header("Location: index.php");
	}
?>

<!DOCTYPE html>

<html lang="es">
	<?php include_once('php/_/cabecera.php')?>
	<body>
	<div id="agrupar">
					<!-- HEADER -->
		<header id="cabecera">
			<h1> THREEW CLOTH. CO. </h1>
		</header>
					<!-- NAV -->
		<?php include_once('php/_/nav.php')?>
					<!-- SECTION -->
		<section id="seccion">
			<div id="divVistaDetalle" name="divVistaDetalle">
				<?php if(tipoObjeto == "prenda") { ?>
					<img src="<?php echo $urlImagen; ?>" id="imgDetalle" name="imgDetalle"/>
					<br>
					Precio: <?php echo $precio; ?> <br>
					Talla: <?php echo $talla; ?> <br>
					Tipo: <?php echo $tipoPrenda; ?> <br>
					Ventas: <?php echo $ventas; ?> <br>
					Cantidad: <?php echo $cantidad; ?> <br>
					Calidad: <?php echo $calidad; ?> <br>
					<?php if(isset($_GET['temporada'])){ ?>
						Temporada: <?php echo $temporada; ?> <br>
					<?php } ?>
					<?php if(isset($_GET['colaboradorTextil'])){ ?>
						Colaborador Textil: <?php echo $colaboradorTextil; ?> <br>
					<?php } ?>
					
					<?php if($tipoObjeto == "colaboradorAudiovisual") { ?>
						Nombre: <?php echo $nombre; ?>
						
						<!-- FALTA LISTAR LAS TAREAS DEL COLABORADOR -->
					<?php } ?>
					
					<?php if(isset($_GET['oferta'])){ ?>
						Oferta: <?php echo $oferta; ?> <br>
					<?php } ?>
				<?php } ?>
				
				<?php if($tipoObjeto == "temporada") { ?>
					Fecha: <?php echo $fecha; ?> <br>
					
					<!-- FALTA AÑADIR AQUÍ LAS PRENDAS DE LA TEMPORADA -->
				<?php } ?>
				
				<?php if($tipoObjeto == "proveedor") { ?>
					Nombre: <?php echo $nombre; ?> <br>
					Calificación: <?php echo $calificacion; ?> <br>
					Serigrafía: <?php echo $serigrafia; ?> <br>
					Ciudad: <?php echo $ciudad; ?> <br>
					Técnicas: <?php echo $tecnicas; ?> <br>
				<?php } ?>
				
				<?php  if($tipoObjeto == "compra") { ?>
					<!-- FALTA AÑADIR DETALLES DE LA COMPRA -->
				
				<?php } ?>
				
				<?php  if($tipoObjeto == "colaboradorTextil") { ?>
					Nombre: <?php echo $nombre; ?> <br>
					<!-- FALTA AÑADIR PRENDAS DEL COLABORADOR -->
				
				<?php } ?>
				
				<?php  if($tipoObjeto == "almacen") { ?>
					Nombre: <?php echo $nombre; ?> <br>
					<!-- FALTA AÑADIR PRENDAS DEL ALMACÉN -->
				
				<?php } ?>
				
				<?php if($tipoObjeto == "cliente") { ?>
					Nombre: <?php  echo $nombre; ?> <br>
					Telefono: <?php  echo $telefono; ?> <br>
					Correo: <?php  echo $correo; ?> <br>
					Año de nacimiento: <?php  echo $anyoNacimiento; ?> <br>
					<!-- FALTA AÑADIR LAS COMPRAS DEL CLIENTE -->
					
				<?php } ?>
				
				<?php if($tipoObjeto == "tarea") { ?>
					Nombre: <?php echo $nombre;?> <br>
					Tiempo Estimado: <?php echo $tiempoEstimado;?> <br>
			
					<?php if(isset($_GET['tiempoReal'])){ ?>
						Tiempo Real: <?php echo $tiempoReal;?> <br>
					<?php } ?>
			
					<?php if(isset($_GET['proyecto'])){ ?>
						Proyecto: <?php echo $proyecto;?> <br>
					<?php } ?>
			
					<?php if(isset($_GET['colaborador'])){ ?>
						Colaborador: <?php echo $colaborador;?> <br>
					<?php } ?>
			
				<?php } ?>
				
			</div>
			<?php include_once('php/formularios/form_comentario.php')?>
		</section>
					<!-- ASIDE -->
		<aside id="columna">
		</aside>
					<!-- FOOTER -->
		
		<?php include_once('php/_/pie.php')?>
	</div>
	</body>
</html>