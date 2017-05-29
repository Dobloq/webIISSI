<?php
	function consultaTareasDeUnTrabajador($conexion, $pag_num, $pag_size, $trabajador){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM TAREA AUX "
				."WHERE ROWNUM <= :ultima AND IDTAREA IN (SELECT IDTAREA FROM TRABAJADORTAREA WHERE IDTRABAJADOR = :trabajador) AND TIEMPOREAL IS NULL"
			.") "
			."WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':trabajador', $trabajador );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt->fetchAll();
    }
	
	/*
	$stmt contiene los campos IDTAREA, NOMBRETAREA, TIEMPOESTIMADO, TIEMPOREAL, IDPROYECTOAUDIOVISUAL, IDCOLABORADORAUDIOVISUAL
	*/
	
	function consultaTareasTotales($conexion, $pag_num, $pag_size){
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
    }
	
	/*
	$stmt contiene los campos IDTAREA, NOMBRETAREA, TIEMPOESTIMADO, TIEMPOREAL, IDPROYECTOAUDIOVISUAL, IDCOLABORADORAUDIOVISUAL
	*/
?>