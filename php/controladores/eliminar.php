<?php
session_start();
if(!isset($_SESSION['datosUsuario'])){
	HEADER("Location: index.php");
}
require_once("gestionBD.php");
$conexion = crearConexionBD();
if(isset($_POST['borrarTarea'])){
		unset($_POST['borrarTarea']);
		$id = $_POST['idTarea'];
		$query = "DELETE FROM TAREA WHERE IDTAREA =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
if(isset($_POST['borrarPrenda'])){
	unset($_POST['borrarPrenda']);
		$id = $_POST['idPrenda'];
		$query = "DELETE FROM PRENDA WHERE IDPRENDA =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarTemporada'])){
		unset($_POST['borrarTemporada']);
		$id = $_POST['idTemporada'];
		$query = "DELETE FROM TEMPORADA WHERE IDTEMPORADA =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}if(isset($_POST['borrarOferta'])){
		unset($_POST['borrarOferta']);
		$id = $_POST['idOferta'];
		$query = "DELETE FROM OFERTA WHERE IDOFERTA =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarTrabajador'])){
		unset($_POST['borrarTrabajador']);
		$id = $_POST['idTrabajador'];
		$query = "DELETE FROM TRABAJADOR WHERE IDTRABAJADOR =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarColaborador'])){
		unset($_POST['borrarColaborador']);
		$id = $_POST['idColaborador'];
		$query = "DELETE FROM COLABORADORAUDIOVISUAL WHERE IDCOLABORADORAUDIOVISUAL =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarProyecto'])){
		unset($_POST['borrarProyecto']);
		$id = $_POST['idProyecto'];
		$query = "DELETE FROM PROYECTOAUDIOVISUAL WHERE IDPROYECTOAUDIOVISUAL =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarProveedor'])){
		unset($_POST['borrarProveedor']);
		$id = $_POST['idProveedor'];
		$query = "DELETE FROM PROVEEDOR WHERE IDPROVEEDOR =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarColaboradorTextil'])){
		unset($_POST['borrarColaboradorTextil']);
		$id = $_POST['idColaboradorTextil'];
		$query = "DELETE FROM COLABORADORTEXTIL WHERE IDCOLABORADORTEXTIL =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarCliente'])){
		unset($_POST['borrarCliente']);
		$id = $_POST['idCliente'];
		$query = "DELETE FROM CLIENTE WHERE IDCLIENTE =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
	if(isset($_POST['borrarCompra'])){
		unset($_POST['borrarCompra']);
		$id = $_POST['idCompra'];
		$query = "DELETE FROM COMPRA WHERE IDCOMPRA =:id";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		Header('Location: ../../exito.php');
	}
?>