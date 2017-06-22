<?php
session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
require_once("gestionBD.php");
$conexion = crearConexionBD();
if(isset($_POST['borrarTarea'])){
	try{
		unset($_POST['borrarTarea']);
		$id = $_POST['idTarea'];
		$query = "DELETE FROM TAREA WHERE IDTAREA =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarPrenda'])){
	try{
		unset($_POST['borrarPrenda']);
		$id = $_POST['idPrenda'];
		$query = "DELETE FROM PRENDA WHERE IDPRENDA =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarTemporada'])){
	try{
		unset($_POST['borrarTemporada']);
		$id = $_POST['idTemporada'];
		$query = "DELETE FROM TEMPORADA WHERE IDTEMPORADA =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarOferta'])){
	try{
		unset($_POST['borrarOferta']);
		$id = $_POST['idOferta'];
		$query = "DELETE FROM OFERTA WHERE IDOFERTA =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarTrabajador'])){
	try{
		unset($_POST['borrarTrabajador']);
		$id = $_POST['idTrabajador'];
		$query = "DELETE FROM TRABAJADOR WHERE IDTRABAJADOR =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarColaborador'])){
	try{
		unset($_POST['borrarColaborador']);
		$id = $_POST['idColaborador'];
		$query = "DELETE FROM COLABORADORAUDIOVISUAL WHERE IDCOLABORADORAUDIOVISUAL =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarProyecto'])){
	try{
		unset($_POST['borrarProyecto']);
		$id = $_POST['idProyecto'];
		$query = "DELETE FROM PROYECTOAUDIOVISUAL WHERE IDPROYECTOAUDIOVISUAL =:id";
		$stmt = $conexion->prepare($query);
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
	header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarProveedor'])){
	try{
		unset($_POST['borrarProveedor']);
		$id = $_POST['idProveedor'];
		$query = "DELETE FROM PROVEEDOR WHERE IDPROVEEDOR =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarColaboradorTextil'])){
	try{
		unset($_POST['borrarColaboradorTextil']);
		$id = $_POST['idColaboradorTextil'];
		$query = "DELETE FROM COLABORADORTEXTIL WHERE IDCOLABORADORTEXTIL =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarCliente'])){
	try{
		unset($_POST['borrarCliente']);
		$id = $_POST['idCliente'];
		$query = "DELETE FROM CLIENTE WHERE IDCLIENTE =:id";
		$stmt = $conexion->prepare($query);
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
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
elseif(isset($_POST['borrarCompra'])){
	try{
		unset($_POST['borrarCompra']);
		$id = $_POST['idCompra'];
		$query = "DELETE FROM COMPRA WHERE IDCOMPRA =:id";
		$stmt = $conexion->prepare($query);
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
	header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
?>