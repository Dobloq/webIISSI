<?php

function limpiar($input) {
	return htmlspecialchars(stripslashes(trim($input)));
}

session_start();
$pagina_anterior=$_SERVER['HTTP_REFERER'];
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
}
require_once("gestionBD.php");
$conexion = crearConexionBD();
$stmt = null;
if(isset($_POST["botonSubirAlmacen"])){
	//proviene de Almacén
	$errorAlmacen = "";
	if(isset($_POST["nombreAlmacen"])) {
		$nombreAlmacen = limpiar($_POST["nombreAlmacen"]);
	} else {
		$errorAlmacen .= "Falta el nombre. ";
	}

	if ($errorAlmacen!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de almacen: " . $errorAlmacen;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$query = "BEGIN PROC_ALMACEN(:nombreAlmacen); END;";
		$stmt = $conexion->prepare( $query );
		$stmt->bindParam( ':nombreAlmacen', $nombreAlmacen );
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }

	header("Location: ../../productos.php");
	exit();
}
else if(isset($_POST["botonSubirCliente"])){ 
	//proviene de Cliente
	$errorCliente = "";
	if(isset($_POST["nombreCliente"])) {
		$nombreCliente = limpiar($_POST["nombreCliente"]);
	} else {
		$errorCliente .= "Falta el nombre. ";
	}

	if(isset($_POST["telefonoCliente"])) {
		$telefonoCliente = $_POST["telefonoCliente"];
	} else {
		$errorCliente .= "Falta el telefono. ";
	}

	if(isset($_POST["mailCliente"])) {
		$correoCliente = $_POST["mailCliente"];
	} else {
		$errorCliente .= "Falta el correo. ";
	}

	if(isset($_POST["anyoNacimiento"])) {
		$anyoNacimiento = $_POST["anyoNacimiento"];
	} else {
		$errorCliente .= "Falta el año de nacimiento. ";
	}

	if ($errorCliente!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de cliente: " . $errorCliente;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}
	
	try{
		$query = "BEGIN PROC_CLIENTE(:nombreCliente, :telefonoCliente, :correo, :anyoNacimiento); END;";
		$stmt = $conexion->prepare( $query );
		$stmt->bindParam( ':nombreCliente', $nombreCliente );
		$stmt->bindParam( ':telefonoCliente', $telefonoCliente );
		$stmt->bindParam( ':correo', $correoCliente);
		$stmt->bindParam( ':anyoNacimiento', $anyoNacimiento );
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }
	header("Location: ../../datos.php");
	exit();
}
else if(isset($_POST["botonSubirCAV"])){
	//proviene de ColaboradorAudiovisual
	$errorColAU = "";
	if(isset($_POST["nombreCAV"])) {
		$nombreColAu = limpiar($_POST["nombreCAV"]);
	} else {
		$errorColAU .= "Falta el nombre. ";
	}

	if(isset($_POST["calificacionCAV"])) {
		$calColAu = $_POST["calificacionCAV"];
	} else {
		$errorColAU .= "Falta la calificacion. ";
	}
	
	if ($errorColAU!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de colaborador audiovisual: " . $errorColAU;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}
	try{
	$query = "BEGIN PROC_COLABORADORAUDIOVISUAL(:nombreColAu,:calColAu); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombreColAu', $nombreColAu);
	$stmt->bindParam(':calColAu', $calColAu);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	header("Location: ../../trabajadores.php");
}
else if(isset($_POST["botonSubirCT"])){
	//proviene de ColaboradorTextil
	
	$errorColT = "";
	if(isset($_POST["nombreCT"])) {
		$nombreColText = limpiar($_POST["nombreCT"]);
	} else {
		$errorColT .= "Falta el nombre. ";
	}

	if(isset($_POST["calificacionCT"])) {
		$calColText = $_POST["calificacionCT"];
	} else {
		$errorColT .= "Falta la calificacion. ";
	}
	
	if ($errorColT!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de colaborador textil: " . $errorColT;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}
	try{
	$query = "BEGIN PROC_COLABORADORTEXTIL(:nombreColText,:calColText); END;";
	$consulta = "INSERT INTO COLABORADORTEXTIL VALUES (oid_colaboradorTextil.nextval,:nombreColText,:calColText)";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombreColText', $nombreColText);
	$stmt->bindParam(':calColText', $calColText);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	header("Location: ../../proveedores.php");
}
else if(isset($_POST["botonSubirCompra"])){ //proviene de Compra
$errorCompra = "";
	if(isset($_POST["selectClienteCompra"])) {
		$idCliente = limpiar($_POST["selectClienteCompra"]);
	} else {
		$errorCompra .= "Falta el cliente. ";
	}
	if(isset($_POST["fechaCompra"])) {
		$fechaCompra = date('d/m/Y', strtotime($_POST["fechaCompra"]));
	} else {
		$errorCompra .= "Falta la fecha. ";
	}

	if ($errorCompra!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de compra: " . $errorCompra;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}
	try{
	$query = "BEGIN PROC_COMPRA(:fechaCompra, :idCliente); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':fechaCompra', $fechaCompra);
	$stmt->bindParam(':idCliente', $idCliente);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	require_once("gestionarCompras.php");
	return getUltimaCompra($conexion);
	//header("Location: ../../datos.php");
}
else if (isset($_POST["botonSubirOferta"])){
	//proviene de Oferta
	$errorOferta = "";
	if(isset($_POST["precioOfertado"]) && is_numeric($_POST["precioOfertado"])) {
		$precio = (double) $_POST["precioOfertado"];
		if ($precio < 0.0) {
			$errorOferta .= "El precio es negativo. ";
		}
	} else {
		$errorOferta .= "Falta el precio. ";
	}

	$prenda1 = $_POST['selectPrendaCompra'];
	$prenda2 = $_POST['selectPrendaCompra2'];

	if ($errorOferta!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de oferta: " . $errorOferta;
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$query = "BEGIN PROC_HACEROFERTA(:precio, :prenda1, :prenda2); END;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':precio',$precio);
		$stmt->bindParam(':prenda1',$prenda1);
		$stmt->bindParam(':prenda2',$prenda2);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }
	header("Location: ../../productos.php");
	exit();
} 
else if(isset($_POST["botonSubirPrenda"])){
	//proviene de Prenda
	$errorPrenda = "";
	if(isset($_POST["colorPrenda"])) {
		$colorPrenda = limpiar($_POST["colorPrenda"]);
	} else {
		$errorPrenda .= "Falta el color. ";
	}
	if(isset($_POST["tipoPrenda"])) {
		$tipoPrenda = limpiar($_POST["tipoPrenda"]);
	} else {
		$errorPrenda .= "Falta el tipo. ";
	}
	if(isset($_POST["calidadPrenda"]) && is_numeric($_POST["calidadPrenda"])) {
		$calidadPrenda = (int) $_POST["calidadPrenda"];
		if ($calidadPrenda < 0 || $calidadPrenda > 10) {
			$errorPrenda .= "La calidad no está comprendida ente 0 y 10. ";
		}
	} else {
		$errorPrenda .= "Falta la calidad. ";
	}
	if(isset($_POST["tallaPrenda"])) {
		$tallaPrenda = limpiar($_POST["tallaPrenda"]);
	} else {
		$errorPrenda .= "Falta la talla. ";
	}
	if(isset($_POST["precioPrenda"]) && is_numeric($_POST["precioPrenda"])) {
		$precioPrenda = (double) $_POST["precioPrenda"];
		if ($precioPrenda < 0.0) {
			$errorPrenda .= "El precio es negativo. ";
		}
	} else {
		$errorPrenda .= "Falta el precio. ";
	}
	
	$dir_subida = 'C:/xampp/htdocs/ThreewGestion/images/prendas/';
	$dir = 'images/prendas/';
	$fichero_subido = $dir_subida . basename($_FILES['imagenPrenda']['name']);
	
	if (move_uploaded_file($_FILES['imagenPrenda']['tmp_name'], $fichero_subido)) {
    	$imagenPrenda = $dir . basename($_FILES['imagenPrenda']['name']);
	} else {
    	$errorPrenda .= "Imagen no subida";
		$errorPrenda .= $_FILES['imagenPrenda']['tmp_name'];
		$error = $_FILES['imagenPrenda'];
	}
	
	//$imagenPrenda = "images/prendas/prenda-nueva.png";
	if(isset($_POST["cantidadPrenda"]) && is_numeric($_POST["cantidadPrenda"])) {
		$cantidadPrenda = (int) $_POST["cantidadPrenda"];
		if ($cantidadPrenda < 0) {
			$errorPrenda .= "La cantidad es negativa. ";
		}
	} else {
		$errorPrenda .= "Falta la cantidad. ";
	}
	if(isset($_POST["selectTemporadaPrenda"])) {
		$temporadaPrenda = limpiar($_POST["selectTemporadaPrenda"]);
		if($_POST["selectTemporadaPrenda"]="null"){
			$temporadaPrenda = null;
		}
	} else {
		$errorPrenda .= "Falta la temporada. ";
	}
	if(isset($_POST["selectProveedorPrenda"])) {
		
		$proveedorPrenda = limpiar($_POST["selectProveedorPrenda"]);
		
	} else {
		$errorPrenda .= "Falta el proveedor. ";
	}
	if(isset($_POST["selectColaboradorPrenda"])) {
		$colaboradorPrenda = limpiar($_POST["selectColaboradorPrenda"]);
		if($_POST["selectColaboradorPrenda"]="null"){
			$colaboradorPrenda = null;
		}
	} else {
		$errorPrenda .= "Falta el collaborador. ";
	}

	$ventas = 0;
	$oferta = null;


	if ($errorPrenda!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de prenda: " . $errorPrenda;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		$_SESSION['error'] = $error;
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$consulta = "INSERT INTO PRENDA VALUES(oid_prenda.nextval,:color, :tipo, :calidad, :talla, :ventas, :precio, :url, :cantidad, :colTextil, :temporada, :proveedor, :oferta)";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':color', $colorPrenda);
		$stmt->bindParam(':tipo',$tipoPrenda);
		$stmt->bindParam(':calidad',$calidadPrenda);
		$stmt->bindParam(':talla',$tallaPrenda);
		$stmt->bindParam(':ventas',$ventas);
		$stmt->bindParam(':precio',$precioPrenda);
		$stmt->bindParam(':url',$imagenPrenda);
		$stmt->bindParam(':cantidad',$cantidadPrenda);
		$stmt->bindParam(':colTextil',$colaboradorPrenda);
		$stmt->bindParam(':temporada',$temporadaPrenda);
		$stmt->bindParam(':proveedor',$proveedorPrenda);
		$stmt->bindParam(':oferta',$oferta);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }

	header("Location: ../../productos.php");
	exit();
}
else if(isset($_POST['botonSubirProveedor'])){
	//proviene de Proveedor
	$errorProveedor = "";
	if(isset($_POST["nombreProveedor"])) {
		$nombre = limpiar($_POST["nombreProveedor"]);
	} else {
		$errorProveedor .= "Falta el nombre. ";
	}
	if(isset($_POST["calificacionProveedor"]) && is_numeric($_POST["calificacionProveedor"])) {
		$calificacion = (int) $_POST['calificacionProveedor'];
		if ($calificacion < 0 || $calificacion > 10) {
			$errorPrenda .= "La calificación tiene que ser un número entre 0 y 10. ";
		}
	} else {
		$errorProveedor .= "Falta la calificacion. ";
	}
	if(isset($_POST["ciudadProveedor"])) {
		$ciudad = $_POST['ciudadProveedor'];
	} else {
		$errorProveedor .= "Falta la ciudad. ";
	}
	if(isset($_POST["tecnicasProveedor"])) {
		$tecnicas = $_POST['tecnicasProveedor'];
	} else {
		$errorProveedor .= "Faltan las técnicas. ";
	}
	if(!isset($_POST['serigrafiaProveedor'])){
		$serigrafia = 0;
	} else {
		$serigrafia = 1;
	}

	if ($errorProveedor!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de proveedor: " . $errorProveedor;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$query = "BEGIN PROC_PROVEEDOR(:nombre, :calificacion, :serigrafia, :ciudad, :tecnicas); END;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':calificacion',$calificacion);
		$stmt->bindParam(':serigrafia',$serigrafia);
		$stmt->bindParam(':ciudad',$ciudad);
		$stmt->bindParam(':tecnicas',$tecnicas);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }
	header("Location: ../../proveedores.php");
	exit();
}
else if(isset($_POST['botonSubirPAV'])){
	//proviene de ProyectoAudiovisual

	$errorPAV = "";
	if(isset($_POST["nombreProyAudiovisual"])) {
		$nombre = limpiar($_POST["nombreProyAudiovisual"]);
	} else {
		$errorPAV .= "Falta el nombre. ";
	}

	if ($errorPAV!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de proyecto: " . $errorPAV;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$query = "BEGIN PROC_PROYECTOAUDIOVISUAL(:nombre); END;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	
	header("Location: ../../tareas.php");
	exit();
}
else if(isset($_POST['botonSubirTarea'])){
	//proviene de Tarea
	unset($_POST['botonSubirTarea']);
	$errorTarea = "";
	
	if(isset($_POST['nombreTarea'])) {
		$nombre = limpiar($_POST['nombreTarea']);
	} else {
		$errorTarea .= "Falta el nombre de la tarea. ";
	}
	
	if(isset($_POST['tiempoEstimado'])) {
		$tiempo = limpiar($_POST['tiempoEstimado']);
	} else {
		$errorTarea .= "Falta el tiempo estimado. ";
	}
	
	if(isset($_POST['selectProyecto'])) {
		$proyecAud = limpiar($_POST['selectProyecto']);
		if($_POST['selectProyecto']=="null"){
			$proyecAud = null;
		}
	} else {
		$errorTarea .= "Falta el proyecto audiovisual. ";
	}
	
	if(isset($_POST['selectCompartir'])) {
		$colabAud = limpiar($_POST['selectCompartir']);
		if($_POST['selectCompartir']=="null"){
			$colabAud = null;
		}
	} else {
		$errorTarea .= "Falta el colaborador audiovisual audiovisual. ";
	}

	if ($errorTarea!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de tarea: " . $errorTarea;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$query = "BEGIN PROC_TAREA(:nombre, :tiempo, :proyecAud, :colabAud); END;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':tiempo',$tiempo);
		$stmt->bindParam(':proyecAud',$proyecAud);
		$stmt->bindParam(':colabAud',$colabAud);
		$stmt->execute();
	} catch(PDOException $e) {
		echo $e->getMessage();
		exit();
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }
	header("Location: ../../tareas.php");
	exit();
}
else if(isset($_POST["botonSubirTemporada"])){
	//proviene de Temporada
	$errorTemporada = "";
	if(isset($_POST["nombreTemporada"])) {
		$nombre = limpiar($_POST["nombreTemporada"]);
	} else {
		$errorTemporada .= "Falta el nombre. ";
	}
	if(isset($_POST["fechaTemporada"])) {
		$fecha = date('d/m/Y', strtotime($_POST["fechaTemporada"]));
	} else {
		$errorTemporada .= "Falta la fecha. ";
	}

	if ($errorTemporada!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de temporada: " . $errorTemporada;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}

	try{
		$query = "BEGIN PROC_TEMPORADA(:nombre, :fecha); END;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':fecha',$fecha);
		$stmt->execute();
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }
	if(isset($_POST["mostrar"])){
		require_once("gestionarTemporadas.php");
		return getUltimaTemporada($conexion);
	} else {
		header("Location: ../../productos.php");
		exit();
	}
}
else if(isset($_SESSION["botonSubirTrabajador"])){ //proviene de Usuario(trabajador)
	$errorTrabajador = "";
	if(isset($_POST["nombreUsr"])) {
		$nombre = limpiar($_POST["nombreUsr"]);
	} else {
		$errorTrabajador .= "Falta el nombre. ";
	}
	if(isset($_POST["userPass"])) {
		$pass = limpiar($_POST["userPass"]);
	} else {
		$errorTrabajador .= "Falta la fecha. ";
	}
	if(isset($_POST["usuario"])) {
		$usuario = limpiar($_POST["usuario"]);
	} else {
		$errorTrabajador .= "Falta la fecha. ";
	}

	if ($errorTrabajador!="") {
		$_SESSION['excepcion'] = "Error(es) en formulario de trabajador: " . $errorTrabajador;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}
if(!isset($_POST['esDirector'])){
	$esDirector = 0;
} else {
	$esDirector = 1;
}
	try{
	$query = "BEGIN PROC_TRABAJADOR(:nombre, :esDirector, :usuario, :pass); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':esDirector',$esDirector);
	$stmt->bindParam(':usuario',$usuario);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	header("Location: ../../trabajadores.php");
	
} else if(isset($_POST["itemCompra"])){
	$errorItemCompra = "";
	if(isset($_POST["ctd"])) {
		$cantidad = limpiar($_POST["ctd"]);
	} else {
		$errorItemCompra .= "Falta el nombre. ";
	}
	if(isset($_POST["importe"])) {
		$importe = limpiar($_POST["importe"]);
	} else {
		$errorItemCompra .= "Falta el importe. ";
	}
	if(isset($_POST["idC"])) {
		$idCompra = limpiar($_POST["idC"]);
	} else {
		$errorItemCompra .= "Falta el id de compra. ";
	}
	if(isset($_POST["idPr"])) {
		$idPrenda = limpiar($_POST["idPr"]);
	} else {
		$errorItemCompra .= "Falta el id de compra. ";
	}

	if ($errorItemCompra!="") {
		$_SESSION['excepcion'] = "Error(es) en la creacion de item compra: " . $errorItemCompra;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
	}
	try{
		$query = "BEGIN PROC_ITEMCOMPRA(:importe, :cantidad, :idCompra, :idPrenda); END;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':importe',$importe);
		$stmt->bindParam(':cantidad',$cantidad);
		$stmt->bindParam(':idCompra',$idCompra);
		$stmt->bindParam(':idPrenda',$idPrenda);
		$stmt->execute();
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
		exit();
    }
}
/*else if(){ //proviene de Comentario
$idObjeto = $_POST[''];
$tipoObjeto = $_POST[''];
$fecha = $_POST[''];
$usuario = $_POST[''];
	try{
	$query = "BEGIN PROC_COMENTARIO(:idObjeto, :tipoObjeto, :fecha, :usuario); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':idObjeto',$idObjeto);
	$stmt->bindParam(':tipoObjeto',$tipoObjeto);
	$stmt->bindParam(':fecha',$fecha);
	$stmt->bindParam(':usuario',$usuario);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	header("Location: ../../home.php");
}*/

cerrarConexionBD($conexion);
?>