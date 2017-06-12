<?php
	
	function actualizarTrabajadorTarea($conexion, $idTrabajador, $idTarea){
		try{
			$consulta = 'BEGIN PROC_TRABAJADORTAREA(:idTrabajador,:idTarea); END;';
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':idTrabajador', intval($idTrabajador));
			$stmt->bindParam(':idTarea', intval($idTarea));
			$stmt->execute();
		}catch(PDOException $e) {
			//$_SESSION['excepcion'] = $e->GetMessage();
			//$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			//header("Location: ../../excepcion.php");
    	}
	}
	
	if(isset($_GET["idTrabajador"])){
		echo "hace el if";
		//header("Location: ../../panojita.php");
		require_once("gestionBD.php");
		$conexion = crearConexionBD();
		actualizarTrabajadorTarea($conexion, $_GET["idTrabajador"], $_GET["idTarea"]);
		cerrarConexionBD($conexion);
		unset($_POST["idTraAct"]);
	} 
	//echo "no hace el if";

	function contarTrabajadores($conexion){
		try {
			$query = "SELECT COUNT(*) FROM TRABAJADOR";
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];	
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function comprobarTrabajador($conexion, $nombre, $user){
		try {
			$query = "SELECT * FROM TRABAJADOR WHERE NOMBRETRABAJADOR = :nombre OR USUARIO = :usuario";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombre', $nombre);
			$stmt->bindParam(':usuario',$user);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya existe un trabajador con ese nombre o usuario";
			} else {
				return "";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}

	function consultaTrabajadores($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT IDTRABAJADOR, NOMBRETRABAJADOR, ESDIRECTOR, VALORACION, USUARIO FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM TRABAJADOR AUX "
					."WHERE ROWNUM <= :ultima"
				.") "
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	$stmt contiene los campos IDTRABAJADOR, NOMBRETRABAJADOR, ESDIRECTOR, VALORACION, USUARIO
	*/
?>