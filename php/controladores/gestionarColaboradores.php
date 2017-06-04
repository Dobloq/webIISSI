<?php
	function contarColaboradoresAU($conexion){
		try {
			$query = "SELECT COUNT(*) FROM COLABORADORAUDIOVISUAL";
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: ../../excepcion.php");
    	}
	}

	function comprobarColaboradorAU($conexion, $nombreCol){
		try {
			$query = "SELECT * FROM COLABORADORAUDIOVISUAL WHERE NOMBRECOLABORADORAUDIOVISUAL = :nombreCol";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombreCol', $nombreCol);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya existe un colaborador audiovisual con ese nombre";
			} else {
				return "";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: ../../excepcion.php");
    	}
	}

	function consultaColaboradoresAudiovisual($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM COLABORADORAUDIOVISUAL AUX "
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
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	$stmt contiene los campos IDCOLABORADORAUDIOVISUAL, NOMBRECOLABORADORAUDIOVISUAL, CALIFICACION
	*/
	
	function contarColaboradoresT($conexion){
		try {
			$query = "SELECT COUNT(*) FROM COLABORADORTEXTIL";
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: ../../excepcion.php");
    	}
	}

	function comprobarColaboradorT($conexion, $nombreCol){
		try {
			$query = "SELECT * FROM COLABORADORTEXTIL WHERE NOMBRECOLABORADORTEXTIL = :nombreCol";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombreCol', $nombreCol);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Existe";
			} else {
				return "No existe";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: ../../excepcion.php");
    	}
	}
	
	function consultaColaboradoresTextil($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM COLABORADORTEXTIL AUX "
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
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	$stmt contiene los campos IDCOLABORADORTEXTIL, NOMBRECOLABORADORTEXTIL, CALIFICACION
	*/
?>