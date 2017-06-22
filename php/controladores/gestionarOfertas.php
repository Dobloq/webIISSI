<?php
	function contarOfertas($conexion){
		try{
			$query = "SELECT COUNT(*) FROM OFERTA";
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
	
	function prendasDeOferta($conexion, $idOferta){
		try{
			$consulta = "SELECT * FROM PRENDA WHERE IDOFERTA = :idOferta";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':idOferta',$idOferta);
			$stmt->execute();
			return $stmt->fetchAll();
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
	}

	function consultaOfertas($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM ( "
					."SELECT ROWNUM RNUM, AUX.* FROM (SELECT * FROM OFERTA ORDER BY IDOFERTA DESC) AUX "
					."WHERE ROWNUM <= :ultima"
				.") "
				."WHERE RNUM >= :primera";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':primera', $primera );
			$stmt->bindParam( ':ultima',  $ultima  );
			$stmt->execute();
			return $stmt->fetchAll();
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
    }
	
	/*
	$stmt contiene los campos IDOFERTA, PRECIOOFERTADO
	*/
?>