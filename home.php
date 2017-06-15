<?php session_start();
if (isset($_SESSION['datosUsuario'])){
	$usuario = $_SESSION['datosUsuario'][1];
} else{
	header("Location: index.php");
	exit();
}


if (isset($_SESSION["paginacion"])) {
	$paginacion = $_SESSION["paginacion"];
}
		
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : 1;
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;

if ($pag_tam < 1) $pag_tam = 5;
	
unset($_SESSION["paginacion"]);


require_once("php/controladores/gestionBD.php");
require_once("php/controladores/gestionarTareas.php");
require_once("php/controladores/gestionarPrendas.php");
require_once("php/controladores/gestionarTemporadas.php");
require_once("php/controladores/gestionarOfertas.php");
require_once("php/controladores/gestionarCliente.php");
require_once("php/controladores/gestionarCompras.php");
$conexion = crearConexionBD();
$resultado = consultaTareasTotales($conexion, $pagina_seleccionada, $pag_tam);
$prendas = consultaPrendas($conexion, contarPrendas($conexion), 1);
$temporadas = consultaTemporada($conexion, contarTemporadas($conexion), 1);
$ofertas = consultaOfertas($conexion, contarOfertas($conexion), 1);
$clientes = consultaClientes($conexion, contarClientes($conexion), 1);
$compras = consultaCompras($conexion, contarCompras($conexion), 1);
cerrarConexionBD($conexion);


$total_paginas = contarTareas($conexion)/$pag_tam;
if(contarTareas($conexion)%$pag_tam>0){$total_paginas++;}

if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;
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
			<h2> Bienvenido <?php echo $usuario; ?> </h2> 
			<article>
				<h2> Novedades: </h2>
                <h2> Última prenda: </h2>
                <?php foreach($prendas as $fila){ ?>
					<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" >
                    <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
						<input type="hidden" name="idPrenda" id="idPrenda" value="<?php echo $fila["IDPRENDA"];?>"/>
					</form>   
				<?php }?>
                <h2> Última temporada: </h2>
                <?php foreach($temporadas as $fila){ ?>
					<div id="divListado" name="divListado">
						Nombre: <?php echo $fila['NOMBRETEMPORADA'];?></br>
						Fecha: <?php echo $fila['FECHA'];?>
                        </br>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idTemporada" id="idTemporada" value="<?php echo $fila["IDTEMPORADA"];?>">
						</form>
					</div></br>
				<?php }?>
                <h2> Última oferta: </h2>
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
					</form></br>
				<?php }?>
                <h2> Último cliente: </h2>
                <?php foreach($clientes as $fila){?>
						<div id="divListado" name="divListado">
							Nombre: <?php echo $fila["NOMBRECLIENTE"];?> <br>
							Teléfono: <?php echo $fila["TELEFONO"];?> <br>
							Correo: <?php echo $fila["CORREO"];?> <br>
							Año de nacimiento: <?php echo $fila["ANYONACIMIENTO"];?> <br>
                            <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
								<input type="hidden" name="idCliente" id="idCliente" value="<?php echo $fila["IDCLIENTE"];?>">
							</form>
							<br>
						</div>
                      	<br>
					<?php }?>
                    <h2> Última compra: </h2>
                    <?php foreach($compras as $fila){?>
						<div id="divListado" name="divListado">
							Nombre del cliente: <?php echo $fila["NOMBRECLIENTE"];?><br>
							Fecha de la compra: <?php echo $fila["FECHACOMPRA"];?><br>
                            <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
								<input type="hidden" name="idCompra" id="idCompra" value="<?php echo $fila["IDCOMPRA"];?>">
							</form><br>
						</div>
                        <br>
					<?php }?>
			</article>
			<article>
 				<h2> Tareas: </h2>
 	            <?php foreach($resultado as $fila){ ?>
     				<div id="divListado" name="divListado">
      					Nombre de la tarea: <?php echo $fila["NOMBRETAREA"];?><br>
      					Tiempo estimado (en minutos): <?php echo $fila["TIEMPOESTIMADO"];?><br>
      					Tiempo real (en minutos): <?php echo $fila["TIEMPOREAL"];?><br>
      					<form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" id="idTarea" name="idTarea" value="<?php echo $fila["IDTAREA"];?>">
							<button id="borrarTarea" name="borrarTarea" type="submit">Borrar tarea </button>
						</form><br>
				</form>
     				</div>
    			<br>
     			<?php }?>
   			</article>
            <article>
            <?php
				for ($pagina = 1; $pagina <= $total_paginas; $pagina++)
					if ($pagina == $pagina_seleccionada) {?>
						<span class="current"><?php echo $pagina; ?></span>
					<?php }	else { ?>
						<a href="home.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
					<?php } ?>
				<form method="get" action="home.php">
					Mostrando <input id="PAG_TAM" name="PAG_TAM" type="number" min="1" max="<?php echo contarTareas($conexion)?>" value="<?php echo $pag_tam?>"> entradas de <?php echo contarTareas($conexion)?> <input type="submit" value="Cambiar">
                </form>
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
