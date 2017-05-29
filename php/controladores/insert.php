<?php

session_start();
$pagina_anterior=$_SERVER['HTTP_REFERER'];
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
require_once("gestionBD.php");
$conexion = crearConexionBD();
$stmt = null;
if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirAlmacen=AnyadirAlmacen"){
	//proviene de Almacén
	$nombreAlmacen = $_POST['nombreAlmacen'];
	try{
	$query = "BEGIN PROC_ALMACEN(:nombreAlmacen); END;";
	$stmt = $conexion->prepare( $query );
	$stmt->bindParam( ':nombreAlmacen', $nombreAlmacen );
	$stmt->execute();
	}catch(PDOException $e) {
		print($e->getMessage());
		
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
}
else if ($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirOferta=anyadirOferta"){
$precio = $_POST['precioOfertado'];
$prenda1 = $_POST['selectPrendaCompra'];
$prenda2 = $_POST['selectPrendaCompra2'];
	try{
	$query = "BEGIN PROC_HACEROFERTA(:precio, :prenda1, :prenda2); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':precio',$precio);
	$stmt->bindParam(':prenda1',$prenda1);
	$stmt->bindParam(':prenda2',$prenda2);
	$stmt->execute();
	}catch(PDOException $e) {
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
}
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirPrenda=anyadirPrenda"){
	//proviene de Prenda
	$color = $_POST['colorPrenda'];
	$tipo = $_POST['tipoPrenda'];
	$calidad = $_POST['calidadPrenda'];
	$talla = $_POST['tallaPrenda'];
	$ventas = 0;
	$precio = $_POST['precioPrenda'];
	$url = "ftp://CamisetaVerde.jpg";//$_POST['imagenPrenda'];
	$cantidad = $_POST['cantidadPrenda'];
	$colTextil = null;//$_POST['selectColaboradorPrenda'];
	$temporada = null;//$_POST['selectTemporadaPrenda'];
	$proveedor = 1;//$_POST['selectProveedorPrenda'];
	$oferta = null;
	try{
	$query = "BEGIN PROC_PRENDA(:color, :tipo, :calidad, :talla, :ventas, :precio, :url, :cantidad, :colTextil, :temporada, :proveedor, :oferta); END;";
	$consulta = "INSERT INTO PRENDA VALUES(oid_prenda.nextval,:color, :tipo, :calidad, :talla, :ventas, :precio, :url, :cantidad, :colTextil, :temporada, :proveedor, :oferta)";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':color', $color);
	$stmt->bindParam(':tipo',$tipo);
	$stmt->bindParam(':calidad',$calidad);
	$stmt->bindParam(':talla',$talla);
	$stmt->bindParam(':ventas',$ventas);
	$stmt->bindParam(':precio',$precio);
	$stmt->bindParam(':url',$url);
	$stmt->bindParam(':cantidad',$cantidad);
	$stmt->bindParam(':colTextil',$colTextil);
	$stmt->bindParam(':temporada',$temporada);
	$stmt->bindParam(':proveedor',$proveedor);
	$stmt->bindParam(':oferta',$oferta);
	$stmt->execute();
	}catch(PDOException $e) {
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
}
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirProyectoAV=anyadirProyectoAV"){
	//proviene de ProyectoAudiovisual
	$nombre = $_POST['nombreProyAudiovisual'];
	try{
	$query = "BEGIN PROC_PROYECTOAUDIOVISUAL(:nombre); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->execute();
	}catch(PDOException $e) {
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
}
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirTarea=anyadirTarea"){ //proviene de Tarea
$nombre = $_POST['nombreTarea'];
$tiempo = $_POST['tiempoEstimado'];
$proyecAud = null;//$_POST[''];
$colabAud = null;//$_POST[''];
	try{
	$query = "BEGIN PROC_TAREA(:nombre, :tiempo, :proyecAud, :colabAud); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':tiempo',$tiempo);
	$stmt->bindParam(':proyecAud',$proyecAud);
	$stmt->bindParam(':colabAud',$colabAud);
	$stmt->execute();
	}catch(PDOException $e) {
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
}
else if($pagina_anterior=="http://127.0.0.1:8081/ThreewGestion/altas.php?botonAnyadirTemporada=anyadirTemporada"){ //proviene de Temporada
$nombre = $_POST['nombreTemporada'];
$fecha = $_POST['fechaTemporada'];
	try{
	$query = "BEGIN PROC_TEMPORADA(:nombre, :fecha); END;";
	$stmt = $conexion->prepare($query);
	$stmt->bindParam(':nombre',$nombre);
	$stmt->bindParam(':fecha',$fecha);
	$stmt->execute();
	}catch(PDOException $e) {
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../exito.php');
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
		print($e->getMessage());
    }
	Header('Location: ../../home.php');
}*/

cerrarConexionBD($conexion);
?>