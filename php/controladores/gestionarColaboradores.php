<?php
	function consultaColaboradoresAudiovisual($conexion, $pag_num, $pag_size){
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
    }
	
	/*
	$stmt contiene los campos IDCOLABORADORAUDIOVISUAL, NOMBRECOLABORADORAUDIOVISUAL, CALIFICACION
	*/
	
	function consultaColaboradoresTextil($conexion, $pag_num, $pag_size){
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
    }
	
	/*
	$stmt contiene los campos IDCOLABORADORTEXTIL, NOMBRECOLABORADORTEXTIL, CALIFICACION
	*/
?>