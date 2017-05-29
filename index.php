<?php session_start();
if(isset($_SESSION['datosUsuario'])){
	HEADER("Location: home.php");
}
?>
<!DOCTYPE html>

<html lang="es">
	<?php
	include_once('php/controladores/gestionBD.php');
	include_once('php/controladores/gestionarPrendas.php');
	include_once('php/_/cabecera.php');
	?>
	
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
			<div id="cajaLogin">
				<h2>Ingrese su datos:</h2>
				
				<?php include_once('php/formularios/form_login.php')?>
				
			</div>
		</section>
					<!-- ASIDE -->
		<aside id="columna">
			<h2> Instrucciones:</h2>
   <p> Esta página es privada y está dedicada a la gestión de Threew Cloth. Si has llegado aquí por error, te rogamos abandones la página, no se te ha perdido nada aquí.
    Si eres parte del equipo de Threew ingresa tus datos y se te redirigirá a Home.
    <br><br>
    Un saludo. </p>
		</aside>
					<!-- FOOTER -->
		
		<?php include_once('php/_/pie.php')?>
		
	</div>
	</body>
</html>
