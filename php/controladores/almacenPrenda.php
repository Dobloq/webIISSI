<?php
try{
	require_once("gestionBD.php");
	if(isset($_GET["prenda"])){
		$conexion = crearConexionBD();
		$resultado = consultaAlmacen($conexion, $_GET["prenda"]);
		if(resultado != NULL){
			foreach($resultado as $almacen){
			// Creamos options con valores = oid_municipio y label = nombre del municipio
				echo "<option label='" . $almacen["NOMBREALMACEN"] . "' value='" . $almacen["IDALMACEN"] . "'/>";	
			}
		}
		cerrarConexionBD($conexion);
		unset($_GET["prenda"]);
	}
}catch(PDOException $e) {
	$_SESSION['excepcion'] = $e->GetMessage();
	$_SESSION['destino'] = $_SERVER['HTTP_REFERER'];
	header("Location: ../../excepcion.php");
}
	

function consultaAlmacen($conexion, $idPrenda){
	$consulta = "SELECT * FROM ALMACEN WHERE IDALMACEN IN (SELECT IDALMACEN FROM PRENDAALMACEN WHERE IDPRENDA = :idPrenda)";
	$stmt = $conexion->prepare( $consulta );
	$stmt->bindParam( ':idPrenda', $idPrenda );
	$stmt->execute();
	return $stmt;
}
	
	/*
	Devuelve $stmt que es un array con las columnas RNUM , IDALMACEN, IDPRENDA, CANTIDAD, COLOR, TIPOPRENDA, CALIDAD, TALLA, VENTAS, PRECIO, URLIMAGEN,	COLABORADORTEXTIL, TEMPORADA, PROVEEDOR, IDOFERTA, NOMBREALMACEN
	*/



?>