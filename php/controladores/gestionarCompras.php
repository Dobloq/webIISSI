<?php
	function contarCompras($conexion){
		try {
			$query = "SELECT COUNT(*) FROM COMPRA NATURAL JOIN CLIENTE";
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
	
	function getUltimaCompra($conexion){
		try {
			$id = consultaCompras($conexion, contarCompras($conexion),1);
			echo $id[0]["IDCOMPRA"];
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			if(file_exists("excepcion.php")){header("Location: excepcion.php");}
			if(file_exists("../excepcion.php")){header("Location: ../excepcion.php");}
			if(file_exists("../../excepcion.php")){header("Location: ../../excepcion.php");}
    	}
	}
	
	function comprobarCompras($conexion, $fechaCompra, $idCliente){
		try {
			$query = "SELECT * FROM COMPRA WHERE FECHACOMPRA = :fechaCompra AND IDCLIENTE = :idCliente";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':fechaCompra', $fechaCompra);
			$stmt->bindParam(':idCliente',$idCliente);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya exite una compra para ese cliente y fecha";
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
	
	
	function consultaCompras($conexion, $pag_num, $pag_size){
		try {
			$primera = ( $pag_num - 1 ) * $pag_size + 1;
			$ultima  = $pag_num * $pag_size;
			$consulta = 
				 "SELECT * FROM (SELECT ROWNUM RNUM, AUX.* FROM COMPRA AUX WHERE ROWNUM <= :ultima) 
  				 NATURAL JOIN CLIENTE WHERE RNUM >= :primera ORDER BY FECHACOMPRA DESC";
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
	
	function consultaComprasCliente($conexion, $idCliente){
		try{
			$consulta = "SELECT * FROM (SELECT * FROM COMPRA ORDER BY FECHACOMPRA) NATURAL JOIN CLIENTE WHERE IDCLIENTE = :idCliente";
			$stmt = $conexion->prepare( $consulta );
			$stmt->bindParam( ':idCliente', $idCliente );
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
	$stmt contiene los campos IDCLIENTE, RNUM, IDCOMPRA, FECHACOMPRA, NOMBRECLIENTE, TELEFONO, CORREO, ANYONACIMIENTO
	*/
?>