<?php

function limpiar($input) {
	return htmlspecialchars(stripslashes(trim($input)));
}

session_start();
if(!isset($_SESSION['datosUsuario'])){
	header("Location: index.php");
}
require_once("gestionBD.php");
$conexion = crearConexionBD();
$stmt = null;

/*-------------------------------------------------------------Almacen-----------------------------------------------------------------*/

if(isset($_POST["modificarAlmacen"])){
	unset($_POST["modificarAlmacen"]);
	//proviene de Almacén
	$errorAlmacen = "";
	if(isset($_POST["nombreAlmacen"])) {
		$nombreAlmacen = limpiar($_POST["nombreAlmacen"]);
	} else {
		$errorAlmacen .= "Falta el nombre. ";
	}
	
	if(isset($_POST["idAlmacen"])) {
		$idAlmacen = limpiar($_POST["idAlmacen"]);
	} else {
		$errorAlmacen .= "Falta el id del almacen. ";
	}

	if ($errorAlmacen!="") {
		$_SESSION['excepcion'] = "Error(es) al editar almacen: " . $errorAlmacen;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}

	try{
		$query = "UPDATE ALMACEN SET NOMBREALMACEN = :nombreAlmacen WHERE IDALMACEN = :idAlmacen;";
		$stmt = $conexion->prepare( $query );
		$stmt->bindParam( ':nombreAlmacen', $nombreAlmacen );
		$stmt->bindParam( ':idAlmacen', $idAlmacen );
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
    }

	header("Location: ../../productos.php");
	exit();
}

/*-------------------------------------------------------------Cliente---------------------------------------------------------------*/

else if(isset($_POST["modificarCliente"])){ 
	unset($_POST["modificarCliente"]);
	//proviene de Cliente
	$errorCliente = "";
	if(isset($_POST["idCliente"])) {
		$idCliente = limpiar($_POST["idCliente"]);
	} else {
		$errorCliente .= "Falta el id. ";
	}
	
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
		$_SESSION['excepcion'] = "Error(es) al editar cliente: " . $errorCliente;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}
	
	try{
		$query = "UPDATE CLIENTE SET NOMBRECLIENTE = :nombreCliente, TELEFONO = :telefonoCliente, CORREO = :correo, ANYONACIMIENTO = :anyoNacimiento WHERE IDCLIENTE = :idCliente;";
		$stmt = $conexion->prepare( $query );
		$stmt->bindParam( ':nombreCliente', $nombreCliente );
		$stmt->bindParam( ':telefonoCliente', $telefonoCliente );
		$stmt->bindParam( ':correo', $correoCliente);
		$stmt->bindParam( ':anyoNacimiento', $anyoNacimiento );
		$stmt->bindParam( ':idCliente', $idCliente );
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
    }
	header("Location: ../../datos.php");
	exit();
}

/*------------------------------------------------------------Colaborador Audiovisual-----------------------------------------------------------*/

else if(isset($_POST["modificarCAV"])){
	unset($_POST["modificarCAV"]);
	//proviene de ColaboradorAudiovisual
	$errorColAU = "";
	if(isset($_POST["idCAV"])) {
		$idColAu = limpiar($_POST["idCAV"]);
	} else {
		$errorColAU .= "Falta el id. ";
	}
	
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
		$_SESSION['excepcion'] = "Error(es) al editar colaborador audiovisual: " . $errorColAU;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}
	try{
	$query = "UPDATE COLABORADORAUDIOVISUAL SET NOMBRECOLABORADORAUDIOVISUAL = :nombreColAu CALIFICACION = :calColAu WHERE IDCOLABORADORAUDIOVISUAL = :idColAu;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombreColAu', $nombreColAu);
	$stmt->bindParam(':calColAu', $calColAu);
	$stmt->bindParam(':idColAu', $idColAu);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    }
	header("Location: ../../trabajadores.php");
}

/*------------------------------------------------------Colaborador Textil---------------------------------------------------------*/

else if(isset($_POST["modificarCT"])){
	//proviene de ColaboradorTextil
	unset($_POST["modificarCT"]);
	$errorColT = "";
	if(isset($_POST["idCT"])) {
		$idColText = limpiar($_POST["idCT"]);
	} else {
		$errorColT .= "Falta el id. ";
	}
	
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
		$_SESSION['excepcion'] = "Error(es) al editar colaborador textil: " . $errorColT;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}
	try{
	$query = "BEGIN PROC_COLABORADORTEXTIL(:nombreColText,:calColText); END;";
	$consulta = "UPDATE COLABORADORTEXTIL SET NOMBRECOLABORADORTEXTIL = :nombreColText, CALIFICACION =:calColText WHERE IDCOLABORADORTEXTIL = :idColText;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombreColText', $nombreColText);
	$stmt->bindParam(':calColText', $calColText);
	$stmt->bindParam(':idColText', $idColText);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    }
	header("Location: ../../proveedores.php");
}

/*-----------------------------------------------------------Compra-----------------------------------------------------------------*/

else if(isset($_POST["modificarCompra"])){ //proviene de Compra
	unset($_POST["modificarCompra"]);
	$errorCompra = "";
	if(isset($_POST["idCompra"])) {
		$idCompra = limpiar($_POST["idCompra"]);
	} else {
		$errorCompra .= "Falta el id. ";
	}

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
		$_SESSION['excepcion'] = "Error(es) al editar compra: " . $errorCompra;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}
	try{
	$query = "UPDATE COMPRA SET FECHACOMPRA = :fechaCompra, IDCLIENTE = :idCliente WHERE IDCOMPRA = :idCompra); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':fechaCompra', $fechaCompra);
	$stmt->bindParam(':idCliente', $idCliente);
	$stmt->bindParam(':idCompra', $idCompra);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    }
	require_once("gestionarCompras.php");
	return getUltimaCompra($conexion);
	//header("Location: ../../datos.php");
}

/*-----------------------------------------------------------Prenda----------------------------------------------------------*/

else if(isset($_POST["modificarPrenda"])){
	unset($_POST["modificarPrenda"]);
	//proviene de Prenda
	$errorPrenda = "";
	if(isset($_POST["idPrenda"])) {
		$idPrenda = limpiar($_POST["idPrenda"]);
	} else {
		$errorPrenda .= "Falta el id. ";
	}
	
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
		$errorPrenda .= "Falta el colaborador. ";
	}

	$ventas = 0;
	$oferta = null;


	if ($errorPrenda!="") {
		$_SESSION['excepcion'] = "Error(es) al editar prenda: " . $errorPrenda;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		$_SESSION['error'] = $error;
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}

	try{
		$consulta = "UPDATE PRENDA SET COLOR = :color, TIPOPRENDA = :tipo, CALIDAD = :calidad, TALLA = :talla, VENTAS = :ventas, PRECIO = :precio, URLIMAGEN = :url, CANTIDAD = :cantidad, COLABORADORTEXTIL = :colTextil, TEMPORADA = :temporada, PROVEEDOR = :proveedor, IDOFERTA = :oferta)";
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
		$stmt->bindParam(':idPrenda',$idPrenda);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
    }

	header("Location: ../../productos.php");
	exit();
}

/*-------------------------------------------------------------------Proveedor------------------------------------------------------------------*/

else if(isset($_POST['modificarProveedor'])){
	unset($_POST['modificarProveedor']);
	//proviene de Proveedor
	$errorProveedor = "";
	if(isset($_POST["idProveedor"])) {
		$id = limpiar($_POST["idProveedor"]);
	} else {
		$errorProveedor .= "Falta el id. ";
	}
	
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
		$_SESSION['excepcion'] = "Error(es) al editar proveedor: " . $errorProveedor;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}

	try{
		$query = "UPDATE PROVEEDOR SET NOMBREPROVEEDOR =:nombre, CALIFICACION = :calificacion, SERIGRAFIA = :serigrafia, CIUDAD = :ciudad, TECNICAS = :tecnicas WHERE IDPROVEEDOR = :id;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':calificacion',$calificacion);
		$stmt->bindParam(':serigrafia',$serigrafia);
		$stmt->bindParam(':ciudad',$ciudad);
		$stmt->bindParam(':tecnicas',$tecnicas);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
    }
	header("Location: ../../proveedores.php");
	exit();
}

/*----------------------------------------------------------Proyecto audiovisual-----------------------------------------------------------*/

else if(isset($_POST['modificarPAV'])){
	//proviene de ProyectoAudiovisual
	unset($_POST['modificarPAV']);
	$errorPAV = "";
	if(isset($_POST["idPAV"])) {
		$id = limpiar($_POST["idPAV"]);
	} else {
		$errorPAV .= "Falta el id. ";
	}
	
	if(isset($_POST["nombreProyAudiovisual"])) {
		$nombre = limpiar($_POST["nombreProyAudiovisual"]);
	} else {
		$errorPAV .= "Falta el nombre. ";
	}

	if ($errorPAV!="") {
		$_SESSION['excepcion'] = "Error(es) al editar proyecto audiovisual: " . $errorPAV;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}

	try{
		$query = "UPDATE PROYECTOAUDIOVISUAL SET NOMBRE = :nombre WHERE IDPROYECTOAUDIOVISUAL = :id;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    }
	
	header("Location: ../../tareas.php");
	exit();
}

/*-----------------------------------------------------------Tarea--------------------------------------------------------------*/

else if(isset($_POST['modificarTarea'])){
	//proviene de Tarea
	unset($_POST['modificarTarea']);
	$errorTarea = "";
	if(isset($_POST['idTarea2'])) {
		$id = limpiar($_POST['idTarea2']);
	} else {
		$errorTarea .= "Falta el id de la tarea. ";
	}
	
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
		$_SESSION['excepcion'] = "Error(es) al editar tarea: " . $errorTarea;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}

	try{
		$query = "UPDATE TAREA SET NOMBRE = :nombre, TIEMPOESTIMADO = :tiempo, IDPROYECTOAUDIOVISUAL = :proyecAud, IDCOLABORADORAUDIOVISUAL = :colabAud WHERE IDTAREA = :idTarea;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':tiempo',$tiempo);
		$stmt->bindParam(':proyecAud',$proyecAud);
		$stmt->bindParam(':colabAud',$colabAud);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	} catch(PDOException $e) {
		echo $e->getMessage();
		exit();
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
    }
	header("Location: ../../tareas.php");
	exit();
}

/*-----------------------------------------------------------Temporada-----------------------------------------------------------------------*/

else if(isset($_POST["modificarTemporada"])){
	//proviene de Temporada
	unset($_POST["modificarTemporada"]);
	$errorTemporada = "";
	if(isset($_POST["idTemporada"])) {
		$id = limpiar($_POST["idTemporada"]);
	} else {
		$errorTemporada .= "Falta el nombre. ";
	}
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
		$_SESSION['excepcion'] = "Error(es) al editar temporada: " . $errorTemporada;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}

	try{
		$query = "UPDATE TEMPORADA SET  NOMBRETEMPORADA = :nombre, FECHA = :fecha WHERE IDTEMPORADA = :id;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':fecha',$fecha);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
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

/*-----------------------------------------------------------Trabajador---------------------------------------------------------------*/

else if(isset($_POST["modificarTrabajador"])){ //proviene de Usuario(trabajador)
	unset($_POST["modificarTrabajador"]);
	$errorTrabajador = "";
	if(isset($_POST["idTrabajador"])) {
		$id = limpiar($_POST["idTrabajador"]);
	} else {
		$errorTrabajador .= "Falta el id. ";
	}
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
	if(isset($_POST["user"])) {
		$usuario = limpiar($_POST["user"]);
	} else {
		$errorTrabajador .= "Falta la fecha. ";
	}

	if ($errorTrabajador!="") {
		$_SESSION['excepcion'] = "Error(es) al editar trabajador: " . $errorTrabajador;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}
if(!isset($_POST['esDirector'])){
	$esDirector = 0;
} else {
	$esDirector = 1;
}
	try{
	$query = "UPDATE TRABAJADOR SET NOMBRETRABAJADOR = :nombre, ESDIRECTOR = :esDirector, USUARIO = :usuario, PASS = :pass WHERE IDTRABAJADOR = :id;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':esDirector',$esDirector);
	$stmt->bindParam(':usuario',$usuario);
	$stmt->bindParam(':pass',$pass);
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    }
	header("Location: ../../trabajadores.php");

/*-------------------------------------------------------Item compra--------------------------------------------------*/

} else if(isset($_POST["itemCompra"])){
	unset($_POST["itemCompra"]);
	$errorItemCompra = "";
	if(isset($_POST["idItem"])) {
		$id = limpiar($_POST["idItem"]);
	} else {
		$errorItemCompra .= "Falta el id. ";
	}
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
		$_SESSION['excepcion'] = "Error(es) al editar item compra: " . $errorItemCompra;
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
	}
	try{
		$query = "UPDATE ITEMCOMPRA SET IMPORTETOTAL =:importe, CANTIDAD = :cantidad, IDCOMPRA = :idCompra, IDPRENDA = :idPrenda WHERE IDITEMCOMPRA = :id;";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':importe',$importe);
		$stmt->bindParam(':cantidad',$cantidad);
		$stmt->bindParam(':idCompra',$idCompra);
		$stmt->bindParam(':idPrenda',$idPrenda);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		if(file_exists("excepcion.php")){header("Location: excepcion.php");}
		if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
		if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
		exit();
    }
}

cerrarConexionBD($conexion);
?>