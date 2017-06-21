<?php /*Aquí pillamos los datos del objeto y mostramos los detalles*/

session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}

	if(isset($_GET['toDetails'])){
	
		$tipoObjeto = $_GET['tipoObjeto'];
		
		if($tipoObjeto == "prenda") {
			$urlImagen = $_GET['urlImagen'];
			$color = $_GET['color'];
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
			$nombre = $_GET['nombre'];
			$fecha = $_GET['fecha'];
		}
		if($tipoObjeto == "proveedor") {
			$nombre = $_GET['nombre'];
			$id = $_GET['id'];
			$calificacion = $_GET['calificacion'];
			$serigrafia = $_GET['serigrafia'];
			$ciudad = $_GET['ciudad'];
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
		
		if($tipoObjeto == "trabajador") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
			$esDirector = $_GET['esDirector'];
			$valoracion = $_GET['valoracion'];
			$usuario = $_GET['usuario'];
			//no está la contraseña, si queremos subirla habrá que hacerlo por session o post
		}
		
	} else {
		header("Location: index.php");
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
				<?php if($tipoObjeto == "prenda") { ?>
					<img src="<?php echo $urlImagen; ?>" id="imgDetalle" name="imgDetalle" width="40%"/>
					<br>
					Precio: <?php echo $precio; ?> <br>
					Talla: <?php echo $talla; ?> <br>
					Color: <?php echo $color; ?> <br>
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
					<?php if(isset($_GET['oferta'])){ ?>
						Oferta: <?php echo $oferta; ?>
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
					Nombre: <?php echo $nombre; ?> <br>
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
				<?php //http://127.0.0.1:8081/ThreewGestion/vistaDetalle.php?toDetails=true&tipoObjeto="tarea"&id=10&nombre="Grabacion spot: dia 4"&tiempoEstimado=120 ?>
				<?php if($tipoObjeto == "tarea") { ?>
                <script type="text/javascript">
					var x = $(document);
					x.ready(function(e) {
                        $("#terminarTarea").click(function(){
							$("#terminar").fadeToggle("slow");	
						});
						$("#guardarTiempo").click(function(){
							var idT = $("#idTarea").val();
							var tiempo = $("#tiempoRealS").val();
							if($("#tiempoRealS").val().length>0 && $("#tiempoRealS").val() >= 1){
								$.post("php/controladores/gestionarTareas.php", {idTareaT : idT, tiempoRealT : tiempo}, function(){alert("Actualizada correctamente"); window.location.replace("home.php");});
							} else {
								document.getElementById("tiempoRealS").setCustomValidity("Debe introducir un tiempo valido");
							}
						});
						 $("#asignarTarea").click(function(){
							$("#asignar").fadeToggle("slow");	
						});
						$("#guardarAsignacion").click(function(){
							var idTar = $("#idTarea").val();
							var trab = document.getElementById("selectTrabajadores").options[document.getElementById("selectTrabajadores").selectedIndex].value;
							$.post("php/controladores/gestionarTrabajadores.php", {idTrab : trab, idTarea : idTar}, function(){location.reload(true)});
						});
                    });
				</script>
                	<input type="hidden" id="idTarea" name="idTarea" value="<?php echo $id ?>">
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
					<button type="button" name="terminarTarea" id="terminarTarea">Terminar tarea</button>
                    <fieldset id="terminar" hidden>
                    	<label>Tiempo final en minutos:</label><br>
							<input type="number" name="tiempoRealS" min="1" id="tiempoRealS"><br>
                            <button type="button" name="guardarTiempo" id="guardarTiempo">Guardar</button>
                    </fieldset>
                    <?php if($_SESSION["datosUsuario"]["ESDIRECTOR"]==1){ 
					require_once("php/controladores/gestionarTrabajadores.php");
					require_once("php/controladores/gestionBD.php");
					$conexion = crearConexionBD();
					$trabajadores = consultaTrabajadores($conexion, 1, 200);?>
                    	<button type="button" name="asignarTarea" id="asignarTarea">Asignar tarea</button>
                    	<fieldset id="asignar" hidden>
                    		<label>Seleccione un trabajador</label>
                            	<select id="selectTrabajadores" name="selectTrabajadores">
                                	<?php foreach($trabajadores as $fila){?>
									<option value="<?php echo $fila["IDTRABAJADOR"]; ?>">
									<?php echo $fila["NOMBRETRABAJADOR"]; ?> </option>
									<?php }?>
                                </select>
                                <button type="button" name="guardarAsignacion" id="guardarAsignacion">Guardar</button>
                    	</fieldset>
                    <?php } ?>
				<?php } ?>
				
				<?php if($tipoObjeto == "trabajador") { ?>
					Nombre: <?php echo $nombre; ?> <br>
                    ¿Es director?: <?php echo ($esDirector==0) ? "No" : "Si";?><br>
					Valoración: <?php echo $valoracion; ?> <br>
					Nombre de usuario: <?php echo $usuario; ?> <br>
                    
                 	<?php 
					require_once("/php/controladores/gestionBD.php");
					require_once("/php/controladores/gestionarTareas.php");
					$conexion = crearConexionBD();
					if(contarTareasTrabaj($conexion, $id)>0){
						$tareas = consultaTareasDeUnTrabajador($conexion, 1, 2000, $id);?>
                        <br>
                        Tareas del trabajador:<br>
                        <?php foreach($tareas as $fila){ 
				$tiempoReal = "";
				$proyectoTarea = "";
				$colaborador = "";?>
					<div id="divListado" name="divListado">
						Nombre de la tarea: <a href="vistaDetalle.php?toDetails=true&tipoObjeto=tarea&id=<?php echo $fila['IDTAREA']; ?>&nombre=<?php echo $fila["NOMBRETAREA"];?>&tiempoEstimado=<?php echo $fila["TIEMPOESTIMADO"];?><?php echo $tiempoReal; ?><?php echo $proyectoTarea; ?> <?php echo $colaborador; ?>">
							<?php echo $fila["NOMBRETAREA"];?>
						</a><br>
						Tiempo estimado (en minutos): <?php echo $fila["TIEMPOESTIMADO"];?><br>
						<?php if(isset($fila["TIEMPOREAL"])){
							$tiempoReal = "&tiempoReal=". $fila["TIEMPOREAL"];?>
							Tiempo real (en minutos): <?php echo $fila["TIEMPOREAL"];?> <br>
						<?php } ?>
						
						<?php if(isset($fila["PROYECTOAUDIOVISUAL"])){
							$proyectoTarea = "&proyecto=". $fila["PROYECTOAUDIOVISUAL"];?>
							Proyecto: <?php echo $fila["PROYECTOAUDIOVISUAL"];?> <br>
						<?php } ?>
						
						<?php if(isset($fila["COLABORADORAUDIOVISUAL"])){
							$colaborador = "&colaborador=". $fila["COLABORADORAUDIOVISUAL"];?>
							Colaborador: <?php echo $fila["COLABORADORAUDIOVISUAL"];?> <br>
						<?php } ?>
                        <form id="formListado" method="post" action="php/controladores/eliminar.php" onSubmit="return confirm('¿Está seguro de que desea borrar?')">
							<input type="hidden" name="idTarea" id="idTarea" value="<?php echo $fila["IDTAREA"];?>">
							<button name="borrarTarea" id="borrarTarea" type="submit">Borrar tarea</button>
						</form>
                        <br>
					</div>
					<br>
				<?php }?>
                        
					<?php }?>
				<?php } ?>
				
			</div>
			<?php //include_once('php/formularios/form_comentario.php')?>
		</section>
					<!-- ASIDE -->
		<aside id="columna">
		</aside>
					<!-- FOOTER -->
		
		<?php include_once('php/_/pie.php')?>
	</div>
	</body>
</html>