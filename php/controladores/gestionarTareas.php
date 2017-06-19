<?php
	function contarTareasTrabaj($conexion, $trabajador){
		try {
			$consulta = "SELECT COUNT(*) FROM TAREA WHERE IDTAREA IN (SELECT IDTAREA FROM TRABAJADORTAREA WHERE IDTRABAJADOR = :trabajador)";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam( ':trabajador', $trabajador );
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];	
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			//header("Location: ../../excepcion.php");
    	}
	}
	
	if(isset($_POST["tiempoReal"])){
		require_once("gestionBD.php");
		$conexion = crearConexionBD();
		echo terminarTarea($conexion, $_POST["idTarea"], $_POST["tiempoReal"]);
		cerrarConexionBD($conexion);
	}
	
	function terminarTarea($conexion, $idTarea, $tiempo){
		try {
			$consulta = "UPDATE TAREA SET TIEMPOREAL = :tiempo WHERE IDTAREA = :idTarea";
			$stmt = $conexion->prepare($cosulta);
			$stmt->bindParam( ':tiempo', $tiempo );
			$stmt->bindParam( ':idTarea', $idTarea );
			$stmt->execute();
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function getUltimaTarea($conexion){
		try{
			$id = consultaTareasTotales($conexion, contarTareas($conexion),1);
			return $id[0]["IDTAREA"];
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function contarTareas($conexion){
		try {
			$consulta = "SELECT COUNT(*) FROM TAREA";
			$stmt = $conexion->prepare($consulta);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];	
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function comprobarTarea($conexion, $nombreTarea){
		try {
			$query = "SELECT * FROM TAREA WHERE NOMBRETAREA = :nombreTarea";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombreTarea', $nombreTarea);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya existe una tarea con ese nombre";
			} else {
				return "";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}

	function consultaTareasDeUnTrabajador($conexion, $pag_num, $pag_size, $trabajador){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM TAREA AUX "
					."WHERE ROWNUM <= :ultima AND IDTAREA IN (SELECT IDTAREA FROM TRABAJADORTAREA WHERE IDTRABAJADOR = :trabajador) AND TIEMPOREAL IS 				NULL"
				.") "
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':trabajador', $trabajador );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt->fetchAll();
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	$stmt contiene los campos IDTAREA, NOMBRETAREA, TIEMPOESTIMADO, TIEMPOREAL, IDPROYECTOAUDIOVISUAL, IDCOLABORADORAUDIOVISUAL
	*/
	
	function consultaTareasTotales($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM TAREA AUX "
					."WHERE ROWNUM <= :ultima AND TIEMPOREAL IS NULL"
				.") "
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':trabajador', $trabajador );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt->fetchAll();
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	$stmt contiene los campos IDTAREA, NOMBRETAREA, TIEMPOESTIMADO, TIEMPOREAL, IDPROYECTOAUDIOVISUAL, IDCOLABORADORAUDIOVISUAL
	*/
?>