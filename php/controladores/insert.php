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
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirCliente=anyadirCliente"){ 
	//proviene de Cliente
	$nombreCliente = $_POST['nombreCliente'];
	$telefonoCliente = $_POST['telefonoCliente'];
	$correo = $_POST['mailCliente'];
	$anyoNacimiento = $_POST['anyoNacimiento'];
	try{
	$query = "BEGIN PROC_CLIENTE(:nombreCliente, :telefonoCliente, :correo, :anyoNacimiento); END;";
	$stmt = $conexion->prepare( $query );
	$stmt->bindParam( ':nombreCliente', $nombreCliente );
	$stmt->bindParam( ':telefonoCliente', $telefonoCliente );
	$stmt->bindParam( ':correo', $correo );
	$stmt->bindParam( ':anyoNacimiento', $anyoNacimiento );
	$stmt->execute();
	}catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		header("Location: ../../excepcion.php");
    }
	header("Location: ../../datos.php");
}
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirColaboradorAV=anyadirColaboradorAV"){
	//proviene de ColaboradorAudiovisual
	$nombreColAu = $_POST['nombreCAV'];
	$calColAu = $_POST['calificacionCAV'];
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
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirColaboradorTextil=AnyadirColaboradorTextil"){
	//proviene de ColaboradorTextil
	$nombreColText = $_POST['nombreCT'];
	$calColText = $_POST['calificacionCT'];
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
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirCompra=anyadirCompra"){ //proviene de Compra
$idCliente = $_POST['selectClienteCompra'];
$fechaCompra = date('d/m/Y', strtotime($_POST["fechaCompra"]));
/*$i = 1;
$prenda1 = $_POST['selectPrendaCompra1'];$cantidad1 = $_POST['ctdPrenda1'];
if(isset($_POST['selectPrendaCompra2'])){$prenda2 = $_POST['selectPrendaCompra2'];$cantidad2 = $_POST['ctdPrenda2'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra3'])){$prenda3 = $_POST['selectPrendaCompra3'];$cantidad3 = $_POST['ctdPrenda3'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra4'])){$prenda4 = $_POST['selectPrendaCompra4'];$cantidad4 = $_POST['ctdPrenda4'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra5'])){$prenda5 = $_POST['selectPrendaCompra5'];$cantidad5 = $_POST['ctdPrenda5'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra6'])){$prenda6 = $_POST['selectPrendaCompra6'];$cantidad6 = $_POST['ctdPrenda6'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra7'])){$prenda7 = $_POST['selectPrendaCompra7'];$cantidad7 = $_POST['ctdPrenda7'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra8'])){$prenda8 = $_POST['selectPrendaCompra8'];$cantidad8 = $_POST['ctdPrenda8'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra9'])){$prenda9 = $_POST['selectPrendaCompra9'];$cantidad9 = $_POST['ctdPrenda9'];$i=$i+1;}
if(isset($_POST['selectPrendaCompra10'])){$prenda10 = $_POST['selectPrendaCompra10'];$cantidad10 = $_POST['ctdPrenda10'];$i=$i+1;}

for($j = 1; $j<$i;$j=$j+1){
	$query = "PROC_ITEMCOMPRA()";
}
$query = $query."END;";*/
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
	header("Location: ../../datos.php");
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
	//TODO imagenPrenda
	$imagenPrenda = "images/prendas/prenda-nueva.png";
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
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirProveedor=anyadirProveedor"){
	//proviene de Proveedor
	$nombre = $_POST['nombreProveedor'];
	$calificacion = $_POST['calificacionProveedor'];
	//$serigrafia = $_POST['serigrafiaProveedor'];
	$ciudad = $_POST['ciudadProveedor'];
	$tecnicas = $_POST['tecnicasProveedor'];
	if(!isset($_POST['serigrafiaProveedor'])){
	$serigrafia = 0;
} else {
	$serigrafia = 1;
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
    }
	header("Location: ../../proveedor.php");
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
	$nombre = $_POST['nombreTarea'];
	$tiempo = $_POST['tiempoEstimado'];
	$colabAud = null;//$_POST[''];
	if(isset($_POST['selectProyecto'])) {
		$proyecAud = limpiar($_POST['selectProyecto']);
		if($_POST['selectProyecto']=="null"){
			$proyecAud = null;
		}
	} else {
		$errorTarea .= "Falta el proyecto audiovisual. ";
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
		//$_SESSION['excepcion'] = $e->GetMessage();
		//$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
		//header("Location: ../../excepcion.php");
		//exit();
    }
	require_once("gestionarTareas.php");
	echo getUltimaTarea($conexion);
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
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirTrabajador=anyadirTrabajador"){ //proviene de Usuario(trabajador)
	$nombre = $_POST['nombreUsr'];
$pass = $_POST['userPass'];
//$esDirector = $_POST['esDirector'];
$usuario = $_POST['user'];
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