<?php
	function contarItemCompra($conexion){
		try{
			$query = "SELECT COUNT(*) FROM ITEMCOMPRA";
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

	function consultaItemCompra($conexion, $pag_num, $pag_size){
		try{
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT I.IDITEMCOMPRA,I.IMPORTETOTAL,I.CANTIDAD,I.IDPRENDA,P.URLIMAGEN,P.TIPOPRENDA,P.TALLA,
				 P.PRECIO,P.IDOFERTA FROM (SELECT ROWNUM RNUM, AUX.* FROM CLIENTE AUX WHERE ROWNUM <= :ultima) 
				 I LEFT JOIN PRENDA P ON I.IDPRENDA=P.IDPRENDA WHERE RNUM >= :primera";
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
	
	function consultaItemDeCompra($conexion,$idCompra){
		try{
			$consulta = "SELECT * FROM ITEMCOMPRA I LEFT JOIN PRENDA P ON I.IDPRENDA=P.IDPRENDA WHERE IDCOMPRA = :idCompra";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':idCompra', $idCompra );
			$stmt->execute();
			return $stmt;
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
	}
	
	/*
	$stmt contiene los campos IDITEMCOMPRA, IMPORTETOTAL, CANTIDAD, IDPRENDA, URLIMAGEN, TIPOPRENDA, TALLA, PRECIO, IDOFERTA
	*/
?>