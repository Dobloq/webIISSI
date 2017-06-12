<?php
	function contarProveedores($conexion){
		try {
			$query = "SELECT COUNT(*) FROM PROVEEDOR";
			$stmt = $conexion->prepare($query);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado['COUNT(*)'];	
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	function comprobarProveedor($conexion, $nombre){
		try {
			$query = "SELECT * FROM PROVEEDOR WHERE NOMBREPROVEEDOR = :nombre";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombre', $nombre);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya existe un proveedor con ese nombre";
			} else {
				return "";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}

	function consultaProveedor($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM PROVEEDOR AUX "
					."WHERE ROWNUM <= :ultima ORDER BY CIUDAD"
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
	$stmt contiene los campos IDPROVEEDOR, NOMBREPROVEEDOR, CALIFICACION, SERIGRAFIA (1 o 0), CIUDAD, TECNICAS
	*/
?>