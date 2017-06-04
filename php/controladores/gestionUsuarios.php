<?php
	

    function consultaLogin($conexion, $usr, $pass) {
    	
    	$consulta = "SELECT COUNT(*) FROM TRABAJADOR WHERE USUARIO = :usuario AND PASS = :pass";
		$query = "SELECT * FROM TRABAJADOR WHERE USUARIO = :usuario AND PASS = :pass";
		$respuesta = null;
    	try {
    		
			$stmt = $conexion -> prepare($query);
			$stmt -> bindParam(':usuario',$usr);
			$stmt -> bindParam(':pass',$pass);
			$stmt -> execute();
			//if($numero >= 1){
			//	$respuesta = $conexion -> prepare($query);
			//	$respuesta -> bindParam(':usuario',$usr);
			//	$respuesta -> bindParam(':pass',$pass);
			//	$respuesta -> execute();
			//} 
    	} catch(PDOException $e) {
			$_SESSION['excepcion'] = $e->GetMessage();
			header("Location: ../../excepcion.php");
    	}
		return $stmt->fetchAll();
    }
	
	/*
	$respuesta contiene los campos IDTRABAJADOR, NOMBRETRABAJADOR, ESDIRECTOR (1 o 0), VALORACION, USUARIO, PASS
	*/
	
	
	
?>