<?php
session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
$formulario = '';

if(isset($_REQUEST['botonAnyadirPrenda'])){
	$formulario = 'php/formularios/form_alta_prenda.php';
} elseif(isset($_REQUEST['botonAnyadirAlmacen'])){
	$formulario = 'php/formularios/form_alta_almacen.php';
} elseif(isset($_REQUEST['botonAnyadirOferta'])){
	$formulario = 'php/formularios/form_alta_oferta.php';
} elseif(isset($_REQUEST['botonAnyadirTemporada'])){
	$formulario = 'php/formularios/form_alta_temporada.php';
} elseif(isset($_REQUEST['botonAnyadirTarea'])){
	$formulario = 'php/formularios/form_alta_tarea.php';	
} elseif(isset($_REQUEST['botonAnyadirProyectoAV'])){
	$formulario = 'php/formularios/form_alta_proyectoAudiovisual.php';	
} elseif(isset($_REQUEST['botonAnyadirTrabajador'])){
	$formulario = 'php/formularios/form_alta_usuario.php';
} elseif(isset($_REQUEST['botonAnyadirColaboradorAV'])){
	$formulario = 'php/formularios/form_alta_colaboradorAudiovisual.php';
} elseif(isset($_REQUEST['botonAnyadirProveedor'])){
	$formulario = 'php/formularios/form_alta_proveedor.php';	
} elseif(isset($_REQUEST['botonAnyadirColaboradorTextil'])){
	$formulario = 'php/formularios/form_alta_colaboradorTextil.php';
} elseif(isset($_REQUEST['botonAnyadirCompra'])){
	$formulario = 'php/formularios/form_alta_compra.php';
} elseif(isset($_REQUEST['botonAnyadirCliente'])){
	$formulario = 'php/formularios/form_alta_cliente.php';
} elseif(isset($_POST['anyadirArticulo'])){
	$formulario = 'php/formularios/form_alta_compra.php';
}
?>

<!DOCTYPE html>

<html lang="es">
	<?php include_once('php/controladores/gestionBD.php');
	include_once('php/_/cabecera.php');
	/*$conexion = crearConexionBD();*/?>
	
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
				<?php include_once($formulario) ?>
		</section>
					<!-- ASIDE -->
		<aside id="columna">

		</aside>
					<!-- FOOTER -->
		
		<?php include_once('php/_/pie.php')?>
	</div>
	</body>
</html>