<?php
	function contarPrendas($conexion){
		$consulta = "SELECT COUNT(*) FROM PRENDA";
		$stmt = $conexion->prepare($consulta);
		$stmt->execute();
		$resultado = $stmt->fetch();
		return $resultado['COUNT(*)'];		
	}
	
	function comprobarPrenda($conexion, $color, $tipoPrenda, $calidad, $talla, $precio, $urlImagen, $cantidad, $colaboradorTextil, $temporada, $proveedor, $idOferta){
		$query = "SELECT * FROM PRENDA WHERE COLOR = :color AND TIPOPRENDA = :tipoPrenda AND CALIDAD = :calidad AND TALLA = :talla AND PRECIO = :precio AND URLIMAGEN = :urlImagen AND CANTIDAD = :cantidad AND COLABORADORTEXTIL = :colaboradorTextil AND TEMPORADA = :temporada AND PROVEEDOR = :proveedor AND IDOFERTA = :idOferta";
		$stmt = $conexion->prepare($query);
		$stmt->bindParam(':color', $color);
		$stmt->bindParam(':tipoPrenda',$tipoPrenda);
		$stmt->bindParam(':calidad',$calidad);
		$stmt->bindParam(':talla',$talla);
		$stmt->bindParam(':precio',$precio);
		$stmt->bindParam(':urlImagen',$urlImagen);
		$stmt->bindParam(':cantidad',$cantidad);
		$stmt->bindParam(':colaboradorTextil',$colaboradorTextil);
		$stmt->bindParam(':temporada',$temporada);
		$stmt->bindParam(':proveedor',$proveedor);
		$stmt->bindParam(':oferta',$idOferta);
		$stmt->execute();
		if($stmt->fetch()!=false){
			return "Ya existe una prenda con esos datos";
		} else {
			return "";
		}
		
	}

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