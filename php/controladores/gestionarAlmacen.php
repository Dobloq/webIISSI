<?php
	function contarAlmacenes($conexion){
		try {
			$query = "SELECT COUNT(*) FROM ALMACEN";
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
	}

	function comprobarAlmacen($conexion, $nombreAlmacen){
		try {
			$query = "SELECT * FROM ALMACEN WHERE NOMBREALMACEN = :nombreAlmacen";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombreAlmacen', $nombreAlmacen);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya existe un almacen con ese nombre";
			} else {
				return "";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
	}

	function consultaAlmacenes($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM ALMACEN ORDER BY IDALMACEN DESC) AUX "
					."WHERE ROWNUM <= :ultima"
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
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
    }
	
	/*
	$stmt contiene los campos RNUM, IDCLIENTE,NOMBRECLIENTE, TELEFONO, CORREO, ANYONACIMIENTO
	*/
	
	function consultaAlmacenesDePrenda($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM CLIENTE AUX "
					."WHERE ROWNUM <= :ultima"
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
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
    }
	
	function consultaAlmacenPrenda($conexion, $idPrenda){
		try {
			$consulta = "SELECT * FROM ALMACEN WHERE IDALMACEN IN (SELECT IDALMACEN FROM PRENDAALMACEN WHERE IDPRENDA = :idPrenda)";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':idPrenda', $idPrenda );
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
	}
	
	/*
	$stmt contiene los campos RNUM, IDCLIENTE,NOMBRECLIENTE, TELEFONO, CORREO, ANYONACIMIENTO
	*/
	
	

?>