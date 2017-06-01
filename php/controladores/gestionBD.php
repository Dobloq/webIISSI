<?php

function crearConexionBD()
{
	$host="oci:dbname=localhost/XE;charset=UTF8";
	$usuario="webClient";
	$password="client001";

	try{
		/* Indicar que las sucesivas conexiones se puedan reutilizar */	
		$conexion=new PDO($host,$usuario,$password,array(PDO::ATTR_PERSISTENT => true));
	    /* Indicar que se disparen excepciones cuando ocurra un error*/
    	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conexion;
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: ../../excepcion.php");
	}
}

function cerrarConexionBD($conexion){
	$conexion=null;
}

function total_consulta( $conn, $query )
 {
  try {
   $total_consulta = "SELECT COUNT(*) AS TOTAL FROM ($query)";
 
   $stmt = $conn->query($total_consulta);
   $result = $stmt->fetch();
   $total = $result['TOTAL'];
   return  $total;
  }
  catch ( PDOException $e ) {
   $_SESSION['excepcion'] = $e->GetMessage();
   header("Location: excepcion.php");
  }
 } 

?>