<?php
	function contarComentarios($conexion){
		try {
			$query = "SELECT COUNT(*) FROM COMENTARIO";
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: ../../excepcion.php");
    	}
	}

	function consultaTareasDeUnTrabajador($conexion, $pag_num, $pag_size, $trabajador){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM COMENTARIO AUX "
				."WHERE ROWNUM <= :ultima AND USUARIO = :trabajador)"
			.") "
			."WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':trabajador', $trabajador );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
    }
	
	/*
	$stmt contiene los campos IDCOMENTARIO, IDOBJETO, TIPOOBJETO, FECHA, USUARIO, TEXTO
	*/
?>