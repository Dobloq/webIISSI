<?php
	function contarOfertas($conexion){
		$query = "SELECT COUNT(*) FROM TAREA";
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$resultado = $stmt->fetch();
		return $resultado['COUNT(*)'];	
	}
	
	function prendasDeOferta($conexion, $idOferta){
		$consulta = "SELECT * FROM PRENDA WHERE IDOFERTA = :idOferta";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':idOferta',$idOferta);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function consultaOfertas($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM OFERTA AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt->fetchAll();
    }
	
	/*
	$stmt contiene los campos IDOFERTA, PRECIOOFERTADO
	*/
?>