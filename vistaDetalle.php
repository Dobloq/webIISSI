<?php /*Aquí pillamos los datos del objeto y mostramos los detalles*/

session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
if($_SESSION["datosUsuario"]["ESDIRECTOR"]==0){
	header("Location: "+$_SERVER['HTTP_REFERER']);
}
	if(isset($_GET['toDetails'])){
	
		$host= $_SERVER["HTTP_HOST"];
		$url= $_SERVER["REQUEST_URI"];
		$urlActual = "http://" . $host . $url;
	
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
			$fecha = $_GET['fechaCompra'];
			$idCliente = $_GET['idCliente'];
			$nombreCliente = $_GET['nombreCliente'];
		}
		if($tipoObjeto == "colaboradorTextil") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
		}
		
		if($tipoObjeto == "colaboradorAudiovisual") {
			$id = $_GET['id'];
			$nombre = $_GET['nombre'];
			$calificacion = $_GET['calificacion'];
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
				
					<?php if(isset($_POST['editarPrenda'])) { ?>
					<?php 
						require_once("php/controladores/gestionarProyectoAudiovisual.php");
						require_once("php/controladores/gestionarProveedor.php");
						require_once("php/controladores/gestionarTemporadas.php");
						require_once("php/controladores/gestionarColaboradores.php");
						$conexion = crearConexionBD();
						$temporada = consultaTemporada($conexion, 1, 200);
						$proveedores = consultaProveedor($conexion, 1, 200);
						$colaboradores = consultaColaboradoresTextil($conexion, 1, 20);
						cerrarConexionBD($conexion);
					?>
					<script type="text/javascript" src="js/validacion_alta_prenda.js"></script>
					<div id="divFormAltaPrenda">
						<form id="formEditarPrenda" class="altas-form" enctype="multipart/form-data" action='php/controladores/editar.php' method="post" onSubmit="return validationForm()">
							<input type="hidden" id="idPrenda" name="idPrenda" value="<?php echo $id ?>">
							<label>Color:</label><br>
								<input type="text" name="colorPrenda" id="colorPrenda" onBlur="colorValidation()" required value="<?php echo $color; ?>"><br>
							<label>Tipo:</label><br>
							<div id="divRadio" name="divRadio">
								<?php if($_GET['tipoPrenda'] == "Camiseta") { ?>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Camiseta" required checked>Camiseta<br>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Sudadera" required> Sudadera<br>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Headwear" required> Headwear
								<?php } ?>
								
								<?php if($_GET['tipoPrenda'] ==  "Sudadera") { ?>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Camiseta" required>Camiseta<br>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Sudadera" required checked> Sudadera<br>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Headwear" required> Headwear
								<?php } ?>
								
								<?php if($_GET['tipoPrenda'] == "Headwear") { ?>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Camiseta" required>Camiseta<br>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Sudadera" required> Sudadera<br>
									<input type="radio" name="tipoPrenda" id="tipoPrenda" value="Headwear" required checked> Headwear
								<?php } ?>
							</div>
							<label>Calidad: </label><br>
								<input type="number" min="0" max="10" name="calidadPrenda" id="calidadPrenda" onBlur="calidadValidation()" required value="<?php echo $calidad; ?>"><br>
							<label>Talla: </label><br>
							<div id="divRadio" name="divRadio">
							
								<?php if($_GET['talla'] == "S") { ?>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S" required checked> S<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M" required> M<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" required > L<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL" required> XL<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL" required> XXL
								<?php } ?>
								
								<?php if($_GET['talla'] == "M") { ?>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S" required> S<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M" required checked> M<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" required > L<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL" required> XL<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL" required> XXL
								<?php } ?>
								
								<?php if($_GET['talla'] == "L") { ?>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S" required> S<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M" required> M<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" required checked> L<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL" required> XL<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL" required> XXL
								<?php } ?>
								
								<?php if($_GET['talla'] == "XL") { ?>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S" required> S<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M" required> M<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" required > L<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL" required checked> XL<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL" required> XXL
								<?php } ?>
								
								<?php if($_GET['talla'] == "XXL") { ?>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="S" required> S<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="M" required> M<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="L" required > L<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XL" required> XL<br>
									<input type="radio" name="tallaPrenda" id="tipoPrenda" value="XXL" required checked> XXL
								<?php } ?>
									
							</div>
							<label>Precio (&euro;): </label><br>
								<input type="number" step="0.5" min="0" name="precioPrenda" id="precioPrenda" onBlur="precioValidation()" required value="<?php echo $precio; ?>"><br>
							<label>Añade una imagen: </label><br>
								<input type="hidden" name="MAX_FILE_SIZE" value="30000000" >
								<input type="file" name="imagenPrenda" id="imagenPrenda" accept="image/*" required value="<?php echo $urlImagen; ?>"><br>
							<label>Cantidad: </label><br>
								<input type="number" min="0" name="cantidadPrenda" id="cantidadPrenda" onBlur="cantidadValidation()" required value="<?php echo $cantidad; ?>"><br>
							<label>¿Pertenece a alguna de éstas temporadas? </label><br>
								<select name="selectTemporadaPrenda" id="selectTemporadaPrenda" >
									<option value="null">No</option>
									<?php foreach($temporada as $fila){?>
										<option value="<?php echo $fila["IDTEMPORADA"]; ?>"><?php echo $fila["NOMBRETEMPORADA"]; ?> </option>
									<?php }?>
								</select><br>
							<label>¿Es de alguno de éstos proveedores? </label><br>
								<select name="selectProveedorPrenda" id="selectProveedorPrenda" required>
									<?php foreach($proveedores as $fila){?>
										<option value="<?php echo $fila["IDPROVEEDOR"]; ?>"><?php echo $fila["NOMBREPROVEEDOR"]; ?> </option>
									<?php }?>
								</select><br>
							<label>¿Es una colaboración textil? </label><br>
								<select name="selectColaboradorPrenda" id="selectColaboradorPrenda" >
									<option value="null">No</option>
								<?php foreach($colaboradores as $fila){?>
									<option value="<?php echo $fila["IDCOLABORADORTEXTIL"]; ?>"><?php echo $fila["NOMBRECOLABORADORTEXTIL"]; ?> </option>
								<?php }?>
								</select><br><br>
							<button type="submit" id="modificarPrenda" name="modificarPrenda">Enviar</button>
						</form>
					
					<?php } else { ?>
					
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
							Oferta: <?php echo $oferta; ?> <br>
						<?php } ?>					
					
						<?php if(isset($_GET['oferta'])){ ?>
							Oferta: <?php echo $oferta; ?> <br>
						<?php } ?>
							<form id="formEditaPrenda" action="<?php echo $urlActual; ?>" method="post">
								<button id="editarPrenda" name="editarPrenda" value="true"> Editar </button>
							</form>
						<?php } ?>
					
				<?php } ?>
				
				<?php if($tipoObjeto == "colaboradorAudiovisual") { ?>
				
						<?php if(isset($_POST['editarColaboradorAudiovisual'])) { ?>
							<script type="text/javascript" src="js/validacion_alta_colaboradorAudiovisual.js"></script>
							<form id="formEditarCAV" action='php/controladores/editar.php' method="post" onSubmit="return validationForm()">
								<input type="hidden" id="idCAV" name="idCAV" value="<?php echo $id ?>">
								<label> Nombre: </label><br>
									<input type="text" name="nombreCAV" id="nombreCAV" required value="<?php echo $nombre; ?>" onBlur="nombreValidation()"><br>
								<label> Calificación: </label><br>
									<input type="number" step="1" name="calificacionCAV" id="calificacionCAV" required value="<?php echo $calificacion; ?>" onBlur="calificacionValidation()"><br>
								<button type="submit" id="modificarCAV" name="modificarCAV" onClick="validationForm()">Enviar</button>
							</form>
						
						<?php } else { ?>
				
					
						Nombre: <?php echo $nombre; ?> <br>
                        Calificacion: <?php echo $calificacion; ?> <br>
						<form id="formEditaColaboradorAudiovisual" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarColaboradorAudiovisual" name="editarColaboradorAudiovisual" value="true"> Editar </button>
						</form> <br><br>
                        <?php
						require_once("php/controladores/gestionBD.php");
						require_once("php/controladores/gestionarTareas.php");
						$conexion = crearConexionBD();
						$tareasColab = consultaTareaColaboradorAU($conexion,$id);
						?>
                        <?php foreach($tareasColab as $fila){ 
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
						
						</div>
						<br>
						<?php }?>
					<?php }?>
				<?php } ?>
				
				<?php if($tipoObjeto == "temporada") { ?>
					
					<?php if(isset($_POST['editarTemporada'])) { ?>
						<script src="js/validacion_alta_temporada.js" type="text/javascript" ></script>
						<form id="formEditarTemporada" class="altas-form" action='php/controladores/editar.php' method="post">
							<input type="hidden" id="idTemporada" name="idTemporada" value="<?php echo $id ?>">
							<label>Nombre:</label><br>
								<input type="text" name="nombreTemporada" id="nombreTemporada" required value="<?php echo $nombre; ?>" onBlur="nombreValidation()"><br>
							<label>Fecha:</label><br>
								<input type="date" name="fechaTemporada" id="fechaTemporada" value="<?php echo date("Y-m-d");?>" required value="<?php echo $fecha; ?>" onBlur="fechaValidation()"><br>
							<button type="submit" id="modificarTemporada" name="modificarTemporada">Enviar</button>
						</form>
						
					<?php } else { ?>
					
						Nombre: <?php echo $nombre; ?> <br>
						Fecha: <?php echo $fecha; ?> <br>
					
						<form id="formEditaTemporada" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarTemporada" name="editarTemporada" value="true"> Editar </button>
						</form>
					
						<?php
						require_once("php/controladores/gestionBD.php");
						require_once("php/controladores/gestionarTareas.php");
						$conexion = crearConexionBD();
						$prendasTemp = consultaPrendasTemporada($conexion,$id);
						foreach($prendasTempo as $fila){ ?>
						
							<a href="vistaDetalle.php?toDetails=true&tipoObjeto=prenda&id=<?php echo $fila['IDPRENDA'];?>&urlImagen=<?php echo $fila['URLIMAGEN'];?>&color=<?php echo $fila['COLOR']; ?>&precio=<?php echo $fila['PRECIO'];?>&talla=<?php echo $fila['TALLA'];?>&tipoPrenda=<?php echo $fila['TIPOPRENDA'];?>&ventas=<?php echo $fila['VENTAS'];?>&cantidad=<?php echo $fila['CANTIDAD'];?>&calidad=<?php echo $fila['CALIDAD'];?><?php echo $temporadaPrenda; ?><?php echo $colaboradorTextil; ?><?php echo $ofertaPrenda; ?>">
							<img src="<?php echo $fila['URLIMAGEN'];?>" width="20%" ><br>
							</a>
						<?php } ?>
						
					<?php } ?>
					
				<?php } ?>
				
				<?php if($tipoObjeto == "proveedor") { ?>
					
					<?php if(isset($_POST['editarProveedor'])) { ?>
						<script type="text/javascript" src="js/validacion_alta_proveedor.js"></script>
						<form id="formEditarProveedor" action='php/controladores/editar.php' method="post" onSubmit="return validationForm()">
							<input type="hidden" id="idProveedor" name="idProveedor" value="<?php echo $id ?>">
							Nombre: <input type="text" name="nombreProveedor" id="nombreProveedor" onBlur="nombreValidation()" required value="<?php echo $nombre; ?>" > <br>
							Calificación: <input type="number" step="1" name="calificacionProveedor" id="calificacionProveedor" onBlur="calificacionValidation()" required value="<?php echo $calificacion; ?>"> <br>
							Serigrafía: <input type="checkbox" name="serigrafiaProveedor" id="serigrafiaProveedor" value="<?php echo $serigrafia; ?>"> <br>
							Ciudad: <input type="text" name="ciudadProveedor" id="ciudadProveedor" onBlur="ciudadValidation()" required value="<?php echo $ciudad; ?>"> <br>
							Técnicas: <input type="text" name="tecnicasProveedor" id="tecnicasProveedor" onBlur="tecnicasValidation()" required value="<?php echo $tecnicas; ?>"> <br>
							
							<button type="submit" id="modificarProveedor" name="modificarProveedor">Enviar</button>
							
						</form>
					<?php } else { ?>
						Nombre: <?php echo $nombre; ?> <br>
						Calificación: <?php echo $calificacion; ?> <br>
						Serigrafía: <?php echo $serigrafia; ?> <br>
						Ciudad: <?php echo $ciudad; ?> <br>
						Técnicas: <?php echo $tecnicas; ?> <br>
						<form id="formEditaProveedor" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarProveedor" name="editarProveedor" value="true"> Editar </button>
						</form>
					<?php } ?>
				<?php } ?>
				
				<?php  if($tipoObjeto == "compra") { ?>
				
				
					<?php if(isset($_POST['editarCompra'])) { ?>
						<form id="formEditaCompra" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarCompra" name="editarCompra" value="true"> Editar </button>
						</form>
					<?php } else { ?>
						
					<?php } ?>
					<!-- FALTA AÑADIR DETALLES DE LA COMPRA -->
				<?php } ?>
				
				<?php  if($tipoObjeto == "colaboradorTextil") { ?>
					Nombre: <?php echo $nombre; ?> <br>
					<!-- FALTA AÑADIR PRENDAS DEL COLABORADOR -->
					
				<?php } ?>
				
				<?php  if($tipoObjeto == "almacen") { ?>
					<?php if(isset($_POST['editarAlmacen'])) { ?>
						<form id="formEditarAlmacen" class="altas-form" action='php/controladores/editar.php' method="post" onSubmit="return validationForm()">
						<input type="hidden" id="idAlmacen" name="idAlmacen" value="<?php echo $id ?>">
							<label>Nombre:</label><br>
								<input type="text" name="nombreAlmacen" id="nombreAlmacen" required value="<?php echo $nombre; ?>" onBlur="nombreValidation()"><br><br>
							<button type="submit" id="modificarAlmacen" name="modificarAlmacen">Enviar</button>
						</form>
						
					<?php } else { ?>
						Nombre: <?php echo $nombre; ?> <br>
						<form id="formEditaAlmacen" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarAlmacen" name="editarAlmacen" value="true"> Editar </button>
						</form>
					<?php } ?>
					
					<!-- FALTA AÑADIR PRENDAS DEL ALMACÉN -->
					
				<?php } ?>
				
				<?php if($tipoObjeto == "cliente") { ?>
										
					<?php if(isset($_POST['editarCliente'])) { ?>
						<form id="formEditarCliente" action='php/controladores/editar.php' method="post" onSubmit="return validationForm()">
							<input type="hidden" id="idCliente" name="idCliente" value="<?php echo $id ?>">
							<label>Nombre:</label><br>
								<input type="text" name="nombreCliente" id="nombreCliente"  onBlur="nombreValidation()" value="<?php  echo $nombre; ?>"><br>
							<label>Teléfono:</label><br>
								<input type="tel" name="telefonoCliente" id="telefonoCliente"  onBlur="telefonoValidation()" value="<?php  echo $telefono; ?>"><br>
							<label>Mail:</label><br>
								<input type="mail" name="mailCliente" id="mailCliente"  onBlur="mailValidation()" value="<?php  echo $correo; ?>"><br>
							<label>Año de nacimiento:</label><br>
								<select name="anyoNacimiento"  value="<?php  echo $anyoNacimiento; ?>">
									<?php for($i = date("Y"); $i >= 1960; $i--){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}?>
								</select><br>
							<button type="submit" id="modificarCliente" name="modificarCliente">Enviar</button>
						</form>
					<?php } else { ?>
					
						Nombre: <?php  echo $nombre; ?> <br>
						Telefono: <?php  echo $telefono; ?> <br>
						Correo: <?php  echo $correo; ?> <br>
						Año de nacimiento: <?php  echo $anyoNacimiento; ?> <br>
						
						<form id="formEditaCliente" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarCliente" name="editarCliente" value="true"> Editar </button>
						</form>
					<?php } ?>
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
										
					<?php if(isset($_POST['editarTarea'])) { ?>
						<script type="text/javascript" src="js/validacion_alta_tarea.js"></script>
						<form id="formEditarTarea" method="post" action="../ThreewGestion/php/controladores/editar.php" onSubmit="validationForm()">
							<input type="hidden" id="idTarea2" name="idTarea2" value="<?php echo $id ?>">
							<label>Nombre:</label><br>
								<input type="text" name="nombreTarea" id="nombreTarea" required onBlur="nombreValidation()" value="<?php echo $nombre;?>"><br>
							<label>Tiempo estimado en minutos:</label><br>
								<input type="number" name="tiempoEstimado" min="1" id="tiempoEstimado" required onBlur="tiempoValidation()" value="<?php echo $tiempoEstimado;?>"><br>
								<input type="hidden" id="idTarea2" name="idTarea2" value="<?php echo $id ?>">
							<button type="submit" id="modificarTarea" name="modificarTarea">Enviar</button>
						</form>
					<?php } else { ?>
						Nombre: <?php echo $nombre;?> <br>
						Tiempo Estimado: <?php echo $tiempoEstimado;?> minutos<br>
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
						<form id="formEditaTarea" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarTarea" name="editarTarea" value="true"> Editar </button>
						</form>
					<?php } ?>
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
										
					<?php if(isset($_POST['editaTrabajador'])) { ?>
						<script type="text/javascript" src="js/validacion_alta_usuario.js"></script>
						<div id="divFormAltaUsr">
							<form id="formEditarUsr" action='php/controladores/editar.php' method="post" onSubmit="return validationForm()">
								<input type="hidden" id="idTrabajador" name="idTrabajador" value="<?php echo $id ?>">
								<label>Nombre:</label><br>
									<input type="text" name="nombreUsr" id="nombreUsr" required onBlur="nameValidation()" value="<?php echo $nombre; ?>"><br>
								<label>Usuario:</label><br>
									<input type="text" name="user" id="user" required onBlur="usernameValidation()" value="<?php echo $usuario; ?>"><br>
								<label>Contraseña:</label><br>
									<input type="password" name="userPass" id="userPass" required onBlur="passwordValidation()"><br>
								<label>Repita la contraseña:</label><br>
									<input type="password" name="userPassConfirm" id="userPassConfirm" required onBlur="passwordConfirmation()"><br>
								<label>¿Es director?</label><br>
									<?php if($_GET['esDirector'] == 1) { ?>
										<input type="checkbox" name="esDirector" id="esDirector" value=1 checked><br>
									<?php } else { ?>
										<input type="checkbox" name="esDirector" id="esDirector" value=1 ><br>
									<?php } ?>
								<button type="submit" id="modificarTrabajador" name="modificarTrabajador">Enviar</button>		
							</form>
						</div>
					<?php } else { ?>
						Nombre: <?php echo $nombre; ?> <br>
						¿Es director?: <?php echo ($esDirector==0) ? "No" : "Si";?><br>
						Valoración: <?php echo $valoracion; ?> <br>
						Nombre de usuario: <?php echo $usuario; ?> <br>
						<form id="formEditaTrabajador" action="<?php echo $urlActual; ?>" method="post">
							<button id="editarTrabajador" name="editarTrabajador" value="true"> Editar </button>
						</form>
					<?php } ?>
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