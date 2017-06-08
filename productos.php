<?php session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
} 
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarPrendas.php");
require_once("php/controladores/gestionarTemporadas.php");
require_once("php/controladores/gestionarOfertas.php");
$conexion = crearConexionBD();
	//if(isset($_REQUEST('botonPorAlmacen'))){
	
if (isset($_SESSION["paginacion"])) {
	$paginacion = $_SESSION["paginacion"];
}
		
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : null;
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;

if ($pag_tam < 1) $pag_tam = 5;
	
unset($_SESSION["paginacion"]);
	
$filas = consultaPrendas($conexion, $pagina_seleccionada, $pag_tam);
$temporadas = consultaTemporada($conexion, $pagina_seleccionada, $pag_tam);
$ofertas = consultaOfertas($conexion, $pagina_seleccionada, $pag_tam);
$total_paginas = contarPrendas($conexion)/$pag_tam;
if(contarPrendas($conexion)%$pag_tam>0){$total_paginas++;}

if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;

	
	/*if(isset($_GET['PAG_NUM']) && isset($_GET['PAG_TAM'])){
		$numPag = $_GET['PAG_NUM'];
		$tamPag = $_GET['PAG_TAM'];
	} else {
		$numPag = 1;
		$tamPag = 20;
	}*/
		//}
	//else{
	//	$filas = consultaPrendasPorAlmacen($conexion, 1, 20);
	//}
$novedades = consultaPrendasNovedades($conexion, 1, 5);
cerrarConexionBD($conexion);

$camisetas = array();
$sudaderas = array();
$gorras = array();
foreach($filas as $fila){
	if($fila['TIPOPRENDA']=="Camiseta"){
		array_push($camisetas, $fila);
	}
	else if($fila['TIPOPRENDA']=="Sudadera"){
		array_push($sudaderas, $fila);
	}
	else if($fila['TIPOPRENDA']=="Headwear"){
		array_push($gorras, $fila);
	}
}

	/*if(isset($_REQUEST['botonAnyadirPrenda'])){
		$_SESSION['botonAnyadirPrenda'] = $_REQUEST['botonAnyadirPrenda'];	
	}*/
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
		<?php include_once('php/_/nav.php');?>
		<!-- SECTION -->
		<section id="seccion">
			<h2> Productos </h2>
			<article>
				<h2> Novedades: </h2>
					<?php foreach($novedades as $fila){ ?>
						<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" >
					<?php }?>
			</article>
			<article>
				<h2> Camisetas: </h2>
				<?php foreach($camisetas as $fila){ ?>
					<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" >
                    <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>">
						<button name="borrarPrenda" id="borrarPrenda" type="submit"> Borrar prenda </button>
					</form>
				<?php }?>
			</article>
			<article>
				<h2> Sudaderas: </h2>
				<?php foreach($sudaderas as $fila){ ?>
					<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" ><br>
                	<form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>"/>
						<button name="borrarPrenda" id="borrarPrenda" type="submit"> Borrar prenda </button>
					</form>   
				<?php }?>
			</article>
			<article>
				<h2> HeadWear: </h2>
				<?php foreach($gorras as $fila){ ?>
					<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" >
                    <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>"/>
						<button name="borrarPrenda" id="borrarPrenda" type="submit"> Borrar prenda </button>
					</form>   
				<?php }?>
			</article>
			<article>
				<?php
				for ($pagina = 1; $pagina <= $total_paginas; $pagina++)
					if ($pagina == $pagina_seleccionada) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="productos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="productos.php">
					
					Mostrando <input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo contarPrendas($conexion)?>" value="<?php echo $pag_tam?>"> entradas de <?php echo contarPrendas($conexion)?> <input type="submit" value="Cambiar">
				</form>
			</article>
			<article>
				<h2> Temporada: </h2>
				<?php foreach($temporadas as $fila){ ?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila['NOMBRETEMPORADA'];?></br>
						Fecha: <?php echo $fila['FECHA'];?>
                        </br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idTemporada" id="idTemporada" value="<?php echo $fila["IDTEMPORADA"];?>">
							<button name="borrarTemporada" id="borrarTemporada" type="submit"> Borrar temporada </button>
						</form>
					</div></br>
				<?php }?>
			</article>
			<article>
				<h2> Ofertas: </h2>
				<?php foreach($ofertas as $fila){ ?>
					<div id="divListado" name="divListado">
						<?php echo $fila['PRECIOOFERTADO'];?></br>
                        <?php 
						$conexion = crearConexionBD();
						$prendasOferta = prendasDeOferta($conexion,$fila['IDOFERTA']);
						cerrarConexionBD($conexion);
                        foreach($prendasOferta as $prendaOferta){
						?>
						<img src="<?php echo $prendaOferta['URLIMAGEN'];?>" width="20%" ><?php }?>
						</div>
                    <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idOferta" id="idOferta" value="<?php echo $fila["IDOFERTA"];?>">
						<button name="borrarOferta" id="borrarOferta" type="submit"> Borrar oferta </button>
					</form></br>
				<?php }?>
			</article>
		</section>
		<!-- ASIDE -->
		<aside id="columna">
			<h2>Acciones:</h2>
			<div id="rackBotones">
				<form action="altas.php" method="get">
					<div id="botonesAside">
						<button id="botonAnyadirPrenda" name="botonAnyadirPrenda" type="submit" value="anyadirPrenda">Añadir Prenda</button>
                       	<button id="botonAnyadirOferta" name="botonAnyadirOferta" type="submit" value="anyadirOferta">Añadir Oferta</button>
                       	<button id="botonAnyadirTemporada" name="botonAnyadirTemporada" type="submit" value="anyadirTemporada">Añadir Temporada</button>
					</div>
					<div id="botonesAside">
						<button id="botonAnyadirAlmacen" name="botonAnyadirAlmacen" type="submit" value="AnyadirAlmacen">Añadir Almacén</button>
					</div>
				</form>
				<form action="productos.php" method="get">
					<div id="botonesAside">
						<button id="botonPorAlmacen" name="botonPorAlmacen" type="submit" value="ordenarPorAlmacen">Ordenar por almacén</button>					
					</div>
				</form>
			</div>			
		</aside> 
		<!-- FOOTER -->
		<?php include_once('php/_/pie.php');?>
	</div>
	</body>
</html>
