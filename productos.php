<?php

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
	exit();
} 	
if (isset($_SESSION["paginacion_prendas"])) {
	$paginacion_prendas = $_SESSION["paginacion_prendas"];
}
if (isset($_SESSION["paginacion_temporadas"])) {
	$paginacion_temporadas = $_SESSION["paginacion_temporadas"];
}
if (isset($_SESSION["paginacion_ofertas"])) {
	$paginacion_ofertas = $_SESSION["paginacion_ofertas"];
}
		
$pagina_seleccionada_prendas = isset($_GET["PAG_NUM_PRENDAS"]) ? (int)$_GET["PAG_NUM_PRENDAS"] : 1;
$pagina_seleccionada_temporadas = isset($_GET["PAG_NUM_TEMPORADAS"]) ? (int)$_GET["PAG_NUM_TEMPORADAS"] : 1;
$pagina_seleccionada_ofertas = isset($_GET["PAG_NUM_OFERTAS"]) ? (int)$_GET["PAG_NUM_OFERTAS"] : 1;

$pag_tam_prendas = isset($_GET["PAG_TAM_PRENDAS"]) ? (int)$_GET["PAG_TAM_PRENDAS"] : (isset($paginacion_prendas) ? (int)$paginacion_prendas["PAG_TAM_PRENDAS"] : 5);
$pag_tam_temporadas = isset($_GET["PAG_TAM_TEMPORADAS"]) ? (int)$_GET["PAG_TAM_TEMPORADAS"] : (isset($paginacion_temporadas) ? (int)$paginacion_temporadas["PAG_TAM_TEMPORADAS"] : 5);
$pag_tam_ofertas = isset($_GET["PAG_TAM_OFERTAS"]) ? (int)$_GET["PAG_TAM_OFERTAS"] : (isset($paginacion_ofertas) ? (int)$paginacion_ofertas["PAG_TAM_OFERTAS"] : 5);

if ($pagina_seleccionada_prendas < 1) $pagina_seleccionada_prendas = 1;
if ($pagina_seleccionada_temporadas < 1) $pagina_seleccionada_temporadas = 1;
if ($pagina_seleccionada_ofertas < 1) $pagina_seleccionada_ofertas = 1;

if ($pag_tam_prendas < 1) $pag_tam_prendas = 5;
if ($pag_tam_temporadas < 1) $pag_tam_temporadas = 5;
if ($pag_tam_ofertas < 1) $pag_tam_ofertas= 5;
	
unset($_SESSION["paginacion_prendas"]);
unset($_SESSION["paginacion_temporadas"]);
unset($_SESSION["paginacion_ofertas"]);
	
require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarPrendas.php");
require_once("php/controladores/gestionarTemporadas.php");
require_once("php/controladores/gestionarOfertas.php");
$conexion = crearConexionBD();
	//if(isset($_REQUEST('botonPorAlmacen'))){
		
$filas = consultaPrendas($conexion, $pagina_seleccionada_prendas, $pag_tam_prendas);
$temporadas = consultaTemporada($conexion, $pagina_seleccionada_temporadas, $pag_tam_temporadas);
$ofertas = consultaOfertas($conexion, $pagina_seleccionada_ofertas, $pag_tam_ofertas);

$total_paginas_prendas = contarPrendas($conexion)/$pag_tam_prendas;
$total_paginas_temporadas = contarTemporadas($conexion)/$pag_tam_temporadas ;
$total_paginas_ofertas = contarOfertas($conexion)/$pag_tam_ofertas ;

if(contarPrendas($conexion)%$pag_tam_prendas>0){$total_paginas_prendas++;}
if ($pagina_seleccionada_prendas > $total_paginas_prendas) $pagina_seleccionada_prendas = $total_paginas_prendas;

if(contarTemporadas($conexion)%$pag_tam_temporadas>0){$total_paginas_temporadas++;}
if ($pagina_seleccionada_temporadas > $total_paginas_temporadas) $pagina_seleccionada_temporadas = $total_paginas_temporadas;

if(contarOfertas($conexion)%$pag_tam_ofertas>0){$total_paginas_ofertas++;}
if ($pagina_seleccionada_ofertas > $total_paginas_ofertas) $pagina_seleccionada_ofertas = $total_paginas_ofertas;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion_prendas["PAG_NUM_PRENDAS"] = $pagina_seleccionada_prendas;
$paginacion_prendas["PAG_TAM_PRENDAS"] = $pag_tam_prendas;
$_SESSION["paginacion_prendas"] = $paginacion_prendas;

$paginacion_temporadas["PAG_NUM_TEMPORADAS"] = $pagina_seleccionada_temporadas;
$paginacion_temporadas["PAG_TAM_TEMPORADAS"] = $pag_tam_temporadas;
$_SESSION["paginacion_temporadas"] = $paginacion_temporadas;

$paginacion_ofertas["PAG_NUM_OFERTAS"] = $pagina_seleccionada_ofertas;
$paginacion_ofertas["PAG_TAM_OFERTAS"] = $pag_tam_ofertas;
$_SESSION["paginacion_ofertas"] = $paginacion_ofertas;

	
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
				<?php foreach($camisetas as $fila){
				$temporadaPrenda = "";
				$colaboradorTextil = "";
				$ofertaPrenda = "";
				if(isset($fila['TEMPORADA'])){
					$temporadaPrenda = "&temporada=". $fila['TEMPORADA'];
					//devuelve la ID de temporada
				}
				
				if(isset($fila['COLABORADORTEXTIL'])){
					$colaboradorTextil = "&colaboradorTextil=". $fila['COLABORADORTEXTIL'];
					//devuelve ID de colaborador textil
				} 
				
				if(isset($fila['IDOFERTA'])){
					$ofertaPrenda = "&oferta=". $fila['IDOFERTA'];
				} 
				
				?>
					<a href="vistaDetalle.php?toDetails=true&tipoObjeto=prenda&id=<?php echo $fila['IDPRENDA'];?>&urlImagen=<?php echo $fila['URLIMAGEN'];?>&color=<?php echo $fila['COLOR']; ?>&precio=<?php echo $fila['PRECIO'];?>&talla=<?php echo $fila['TALLA'];?>&tipoPrenda=<?php echo $fila['TIPOPRENDA'];?>&ventas=<?php echo $fila['VENTAS'];?>&cantidad=<?php echo $fila['CANTIDAD'];?>&calidad=<?php echo $fila['CALIDAD'];?><?php echo $temporadaPrenda; ?><?php echo $colaboradorTextil; ?><?php echo $ofertaPrenda; ?>">
						<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" >
					</a>
                    <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>">
						<button name="borrarPrenda" id="borrarPrenda" type="submit"> Borrar prenda </button>
					</form>
				<?php }?>
			</article>
			<article>
				<h2> Sudaderas: </h2>
				<?php foreach($sudaderas as $fila){ 
				$temporadaPrenda = "";
				$colaboradorTextil = "";
				$ofertaPrenda = "";
				if(isset($fila['TEMPORADA'])){
					$temporadaPrenda = "&temporada=". $fila['TEMPORADA'];
					//devuelve la ID de temporada
				}
				
				if(isset($fila['COLABORADORTEXTIL'])){
					$colaboradorTextil = "&colaboradorTextil=". $fila['COLABORADORTEXTIL'];
					//devuelve ID de colaborador textil
				} 
				
				if(isset($fila['IDOFERTA'])){
					$ofertaPrenda = "&oferta=". $fila['IDOFERTA'];
				}
				
				?>
					<a href="vistaDetalle.php?toDetails=true&tipoObjeto=prenda&id=<?php echo $fila['IDPRENDA'];?>&urlImagen=<?php echo $fila['URLIMAGEN'];?>&color=<?php echo $fila['COLOR']; ?>&precio=<?php echo $fila['PRECIO'];?>&talla=<?php echo $fila['TALLA'];?>&tipoPrenda=<?php echo $fila['TIPOPRENDA'];?>&ventas=<?php echo $fila['VENTAS'];?>&cantidad=<?php echo $fila['CANTIDAD'];?>&calidad=<?php echo $fila['CALIDAD'];?><?php echo $temporadaPrenda; ?><?php echo $colaboradorTextil; ?><?php echo $ofertaPrenda; ?>">
						<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" ><br>
					</a>
                	<form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>"/>
						<button name="borrarPrenda" id="borrarPrenda" type="submit"> Borrar prenda </button>
					</form>   
				<?php }?>
			</article>
			<article>
				<h2> HeadWear: </h2>
				<?php foreach($gorras as $fila){ 
				$temporadaPrenda = "";
				$colaboradorTextil = "";
				$ofertaPrenda = "";
				if(isset($fila['TEMPORADA'])){
					$temporadaPrenda = "&temporada=". $fila['TEMPORADA'];
					//devuelve la ID de temporada
				}
				
				if(isset($fila['COLABORADORTEXTIL'])){
					$colaboradorTextil = "&colaboradorTextil=". $fila['COLABORADORTEXTIL'];
					//devuelve ID de colaborador textil
				} 
				
				if(isset($fila['IDOFERTA'])){
					$ofertaPrenda = "&oferta=". $fila['IDOFERTA'];
				}
				
				?>
					<a href="vistaDetalle.php?toDetails=true&tipoObjeto=prenda&id=<?php echo $fila['IDPRENDA'];?>&urlImagen=<?php echo $fila['URLIMAGEN'];?>&color=<?php echo $fila['COLOR']; ?>&precio=<?php echo $fila['PRECIO'];?>&talla=<?php echo $fila['TALLA'];?>&tipoPrenda=<?php echo $fila['TIPOPRENDA'];?>&ventas=<?php echo $fila['VENTAS'];?>&cantidad=<?php echo $fila['CANTIDAD'];?>&calidad=<?php echo $fila['CALIDAD'];?><?php echo $temporadaPrenda; ?><?php echo $colaboradorTextil; ?><?php echo $ofertaPrenda; ?>">
						<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" >
					</a>
                    <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>"/>
						<button name="borrarPrenda" id="borrarPrenda" type="submit"> Borrar prenda </button>
					</form>   
				<?php }?>
			</article>
			<!-- PAGINACION PRENDAS -->
			<article>
				<?php
				for ($pagina = 1; $pagina <= $total_paginas_prendas; $pagina++)
					if ($pagina == $pagina_seleccionada_prendas) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="productos.php?PAG_NUM_PRENDAS=<?php echo $pagina; ?>&PAG_TAM_PRENDAS=<?php echo $pag_tam_prendas; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="productos.php">
					
					Mostrando <input id="PAG_TAM_PRENDAS" name="PAG_TAM_PRENDAS" type="number" min="1" max="<?php echo contarPrendas($conexion)?>" value="<?php echo $pag_tam_prendas?>"> entradas de <?php echo contarPrendas($conexion)?> <input type="submit" value="Cambiar">
				</form>
			</article>
			
			<article>
				<h2> Temporada: </h2>
				<?php foreach($temporadas as $fila){ ?>
					<div id="divListado" name="divListado">
						Nombre: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=temporada&id=<?php echo $fila['IDTEMPORADA'];?>&nombre=<?php echo $fila['NOMBRETEMPORADA'];?>&fecha=<?php echo $fila['FECHA'];?>">
							<?php echo $fila['NOMBRETEMPORADA'];?></br>
						</a>
						Fecha: <?php echo $fila['FECHA'];?>
                        </br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idTemporada" id="idTemporada" value="<?php echo $fila["IDTEMPORADA"];?>">
							<button name="borrarTemporada" id="borrarTemporada" type="submit"> Borrar temporada </button>
						</form>
					</div></br>
				<?php }?>
			</article>
			<!-- PAGINACION TEMPORADAS -->
			<article>
				<?php
				for ($pagina = 1; $pagina <= $total_paginas_temporadas; $pagina++)
					if ($pagina == $pagina_seleccionada_temporadas) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="productos.php?PAG_NUM_TEMPORADAS=<?php echo $pagina; ?>&PAG_TAM_TEMPORADAS=<?php echo $pag_tam_temporadas; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="productos.php">
					
					Mostrando <input id="PAG_TAM_TEMPORADAS" name="PAG_TAM_TEMPORADAS" type="number" min="1" max="<?php echo contarTemporadas($conexion)?>" value="<?php echo $pag_tam_temporadas?>"> entradas de <?php echo contarTemporadas($conexion)?> <input type="submit" value="Cambiar">
				</form>
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
			<!-- PAGINACION OFERTAS -->
			<article>
				<?php
				for ($pagina = 1; $pagina <= $total_paginas_ofertas; $pagina++)
					if ($pagina == $pagina_seleccionada_ofertas) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="productos.php?PAG_NUM_OFERTAS=<?php echo $pagina; ?>&PAG_TAM_OFERTAS=<?php echo $pag_tam_ofertas; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="productos.php">
					
					Mostrando <input id="PAG_TAM_OFERTAS" name="PAG_TAM_OFERTAS" type="number" min="1" max="<?php echo contarOfertas($conexion)?>" value="<?php echo $pag_tam_ofertas?>"> entradas de <?php echo contarOfertas($conexion)?> <input type="submit" value="Cambiar">
				</form>
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
			</div>			
		</aside> 
		<!-- FOOTER -->
		<?php include_once('php/_/pie.php');?>
	</div>
	</body>
</html>
