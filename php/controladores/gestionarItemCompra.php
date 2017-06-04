<?php
	function contarItemCompra($conexion){
		$query = "SELECT COUNT(*) FROM ITEMCOMPRA";
		$stmt = $conexion->prepare($query);
		$stmt->execute();
		$resultado = $stmt->fetch();
		return $resultado['COUNT(*)'];
	}

	function consultaCompras($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT I.IDITEMCOMPRA,I.IMPORTETOTAL,I.CANTIDAD,I.IDPRENDA,P.URLIMAGEN,P.TIPOPRENDA,P.TALLA,P.PRECIO,P.IDOFERTA FROM (SELECT ROWNUM RNUM, AUX.* FROM CLIENTE AUX WHERE ROWNUM <= :ultima) I LEFT JOIN PRENDA P ON I.IDPRENDA=P.IDPRENDA WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
    }
	
	/*
	$stmt contiene los campos IDITEMCOMPRA, IMPORTETOTAL, CANTIDAD, IDPRENDA, URLIMAGEN, TIPOPRENDA, TALLA, PRECIO, IDOFERTA
	*/
?>