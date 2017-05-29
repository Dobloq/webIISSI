<?php
	function consultaCompras($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM (SELECT ROWNUM RNUM, AUX.* FROM COMPRA AUX WHERE ROWNUM <= :ultima) NATURAL JOIN CLIENTE WHERE RNUM >= :primera ORDER BY FECHACOMPRA DESC";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt->fetchAll();
    }
	
	/*
	$stmt contiene los campos IDCLIENTE, RNUM, IDCOMPRA, FECHACOMPRA, NOMBRECLIENTE, TELEFONO, CORREO, ANYONACIMIENTO
	*/
?>