<?php
	function contarClientes($conexion){
		try {
			$query = "SELECT COUNT(*) FROM CLIENTE";
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
	
	function comprobarCliente($conexion, $nombreCliente, $telefonoCliente, $correoCliente){
		try {
			$query = "SELECT * FROM CLIENTE WHERE NOMBRECLIENTE = :nombreCliente OR TELEFONO = :telefonoCliente OR CORREO = :correoCliente";
			$stmt = $conexion->prepare($query);
			$stmt->bindParam(':nombreCliente', $nombreCliente);
			$stmt->bindParam(':telefonoCliente',$telefonoCliente);
			$stmt->bindParam(':correoCliente',$correoCliente);
			$stmt->execute();
			if($stmt->fetch()!=false){
				return "Ya existe un cliente con esos datos";
			} else {
				return "";
			}
		}catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
			header("Location: ../../excepcion.php");
    	}
		
	}

	function consultaClientes($conexion, $pag_num, $pag_size){
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
			header("Location: ../../excepcion.php");
    	}
    }
	
	/*
	$stmt contiene los campos RNUM, IDCLIENTE,NOMBRECLIENTE, TELEFONO, CORREO, ANYONACIMIENTO
	*/
?>