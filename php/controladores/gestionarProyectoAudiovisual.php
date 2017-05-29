<?php
	function consultaProyectoAudiovisual($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM PROYECTOAUDIOVISUAL AUX "
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
	$stmt contiene los campos IDPROYECTOAUDIOVISUAL, NOMBREPROYECTOAUDIOVISUAL
	*/
?>