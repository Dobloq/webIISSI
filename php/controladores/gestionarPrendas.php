<?php
    function consultaPrendas($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM PRENDA AUX "
				."WHERE ROWNUM <= :ultima ORDER BY TIPOPRENDA"
			.") "
			."WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
    }
	
	/*$stmt es un array con todas las filas de la consulta, iterando con un foreach devuelve
	cada fila, cuyo contenido es un array con cada columna de la tabla a la que se accede de
	la siguiente forma fila["TIPOPRENDA"] siendo fila cada fila de la consulta
	$stmt contiene los campos IDPRENDA, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN, CANTIDAD, COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA
	*/
	
	function consultaPrendasPorAlmacen($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM PRENDA NATURAL JOIN PRENDAALMACEN NATURAL JOIN ALMACEN ORDER BY TIPOPRENDA) AUX "
				."WHERE ROWNUM <= :ultima ORDER BY TIPOPRENDA"
			.") "
			."WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
    }
	
	/*
	Devuelve $stmt que es un array con las columnas RNUM , IDALMACEN, IDPRENDA, CANTIDAD, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN,	COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA, NOMBREALMACEN
	*/
	
	function consultaPrendasNovedades($conexion, $pag_num, $pag_size){
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM PRENDA AUX "
				."WHERE ROWNUM <= :ultima ORDER BY IDPRENDA DESC"
			.") "
			."WHERE RNUM >= :primera";
		$stmt = $conexion->prepare( $consulta );
		$stmt->bindParam( ':primera', $primera );
		$stmt->bindParam( ':ultima',  $ultima  );
		$stmt->execute();
		return $stmt;
    }
	
	/*
	Devuelve $stmt que es un array con las columnas RNUM , IDALMACEN, IDPRENDA, CANTIDAD, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN,	COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA, NOMBREALMACEN
	*/
?>