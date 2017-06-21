<?php
	function getPrenda($conexion, $idPrenda){
		try {
			$consulta = "SELECT PRECIO FROM PRENDA WHERE IDPRENDA = :idPrenda";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':idPrenda', $idPrenda);
			$stmt->execute();
			$resultado = $stmt->fetchAll();
			return $resultado;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function actualizarTemporadaPrenda($conexion, $id, $idPrenda){
		try{
			$consulta = 'UPDATE PRENDA SET TEMPORADA = :id  WHERE IDPRENDA = :idPrenda';
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':idPrenda', intval($idPrenda));
			$stmt->bindParam(':id', intval($id));
			$stmt->execute();
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	if(isset($_POST["idPrendaAct"])){
		require_once("gestionBD.php");
		$conexion = crearConexionBD();
		echo actualizarTemporadaPrenda($conexion, $_POST["id"], $_POST["idPrendaAct"]);
		cerrarConexionBD($conexion);
		unset($_POST["idPrendaAct"]);
		}
	
	if(isset($_GET["idPrenda"])){
		require_once("gestionBD.php");
		$conexion = crearConexionBD();
		$resultado = getPrenda($conexion, $_GET["idPrenda"]);
		foreach($resultado as $res){
			echo $res["PRECIO"];
			break;
		}
		cerrarConexionBD($conexion);
		unset($_GET["idPrenda"]);
	}

	function contarPrendas($conexion){
		try {
			$consulta = "SELECT COUNT(*) FROM PRENDA";
			$stmt = $conexion->prepare($consulta);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];		
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function comprobarPrenda($conexion, $color, $tipoPrenda, $calidad, $talla, $precio, $urlImagen, $cantidad, $colaboradorTextil, $temporada, $proveedor, $idOferta){
		try {
		$query = "SELECT * FROM PRENDA WHERE COLOR = :color AND TIPOPRENDA = :tipoPrenda AND CALIDAD = :calidad 
		AND TALLA = :talla AND PRECIO = :precio AND URLIMAGEN = :urlImagen AND CANTIDAD = :cantidad AND 
		COLABORADORTEXTIL = :colaboradorTextil AND TEMPORADA = :temporada AND PROVEEDOR = :proveedor AND IDOFERTA = :idOferta";
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
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
		
	}

    function consultaPrendas($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM PRENDA ORDER BY IDPRENDA DESC) AUX "
					."WHERE ROWNUM <= :ultima ORDER BY TIPOPRENDA"
				.") "
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*$stmt es un array con todas las filas de la consulta, iterando con un foreach devuelve
	cada fila, cuyo contenido es un array con cada columna de la tabla a la que se accede de
	la siguiente forma fila["TIPOPRENDA"] siendo fila cada fila de la consulta
	$stmt contiene los campos IDPRENDA, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN, CANTIDAD, COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA
	*/
	
	function consultaPrendasPorAlmacen($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM (SELECT * FROM PRENDA ORDER BY IDPRENDA DESC) NATURAL JOIN PRENDAALMACEN NATURAL JOIN ALMACEN ORDER BY TIPOPRENDA) AUX "
					."WHERE ROWNUM <= :ultima ORDER BY TIPOPRENDA"
				.") "
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	Devuelve $stmt que es un array con las columnas RNUM , IDALMACEN, IDPRENDA, CANTIDAD, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN,	COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA, NOMBREALMACEN
	*/
	
	function consultaPrendasNovedades($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM PRENDA  ORDER BY IDPRENDA DESC) AUX "
					."WHERE ROWNUM <= :ultima ORDER BY IDPRENDA DESC"
				.") "	
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	Devuelve $stmt que es un array con las columnas RNUM , IDALMACEN, IDPRENDA, CANTIDAD, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN,	COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA, NOMBREALMACEN
	*/
?>