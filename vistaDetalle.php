<?php /*Aquí pillamos los datos del objeto y mostramos los detalles*/
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
				<?php 
				if(tipoObjeto == "prenda") { ?>
					<img src="" id="prendaEnDetalle" name="prendaEnDetalle"/>
				<?php }
				?>
				
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