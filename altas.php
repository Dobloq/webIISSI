<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
if(!isset($_SERVER['HTTP_REFERER'])){
	HEADER("Location: home.php");
}
    $pagina_anterior=$_SERVER['HTTP_REFERER'];
	$_SESSION['paginaAnterior']=$pagina_anterior;
	$formulario = '';
	if($pagina_anterior == "http://127.0.0.1:8081/ThreewGestion/productos.php" || $pagina_anterior == "http://localhost:8081/ThreewGestion/productos.php"){
		if(isset($_REQUEST['botonAnyadirPrenda'])){
			$formulario = 'php/formularios/form_alta_prenda.php';
		}
		if(isset($_REQUEST['botonAnyadirAlmacen'])){
			$formulario = 'php/formularios/form_alta_almacen.php';
		}
		if(isset($_REQUEST['botonAnyadirOferta'])){
			$formulario = 'php/formularios/form_alta_oferta.php';
		}
		if(isset($_REQUEST['botonAnyadirTemporada'])){
			$formulario = 'php/formularios/form_alta_temporada.php';
		}
	}
	
	if($pagina_anterior == "http://127.0.0.1:8081/ThreewGestion/tareas.php" || $pagina_anterior == "http://localhost:8081/ThreewGestion/tareas.php"){
		if(isset($_REQUEST['botonAnyadirTarea'])){
			$formulario = 'php/formularios/form_alta_tarea.php';	
		}
		if(isset($_REQUEST['botonAnyadirProyectoAV'])){
			$formulario = 'php/formularios/form_alta_proyectoAudiovisual.php';	
		}
	}
	if($pagina_anterior == "http://127.0.0.1:8081/ThreewGestion/trabajadores.php" || $pagina_anterior == "http://localhost:8081/ThreewGestion/trabajadores.php"){
		if(isset($_REQUEST['botonAnyadirTrabajador'])){
			$formulario = 'php/formularios/form_alta_usuario.php';
		}
		if(isset($_REQUEST['botonAnyadirColaboradorAV'])){
			$formulario = 'php/formularios/form_alta_colaboradorAudiovisual.php';
		}
	}
	if($pagina_anterior == "http://127.0.0.1:8081/ThreewGestion/proveedores.php" || $pagina_anterior == "http://localhost:8081/ThreewGestion/proveedores.php"){
		if(isset($_REQUEST['botonAnyadirProveedor'])){
			$formulario = 'php/formularios/form_alta_proveedor.php';	
		}
		if(isset($_REQUEST['botonAnyadirColaboradorTextil'])){
			$formulario = 'php/formularios/form_alta_colaboradorTextil.php';
		}
	}

	if($pagina_anterior == "http://127.0.0.1:8081/ThreewGestion/datos.php" || $pagina_anterior =="http://localhost:8081/ThreewGestion/datos.php" ){
		if(isset($_REQUEST['botonAnyadirCompra'])){
			$formulario = 'php/formularios/form_alta_compra.php';
		}
		if(isset($_REQUEST['botonAnyadirCliente'])){
			$formulario = 'php/formularios/form_alta_cliente.php';
		}
	}
	
	
	if($pagina_anterior == "http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirCompra=anyadirCompra" || $pagina_anterior =="http://localhost:8081/ThreewGestion/altas.php?botonAnyadirCompra=anyadirCompra" ){
		if(isset($_POST['anyadirArticulo'])){
			$formulario = 'php/formularios/form_alta_compra.php';
		}
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