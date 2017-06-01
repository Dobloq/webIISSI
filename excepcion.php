<?php
	session_start();
	if(!isset($_SESSION["excepcion"])){
		$mensaje = "Lo sentimos, ha ocurrido algún error desconocido.\nLe rogamos que se lo 
			comunique al administrador de la web.\nDisculpe las molestias";
	} else {
		if(strpos($_SESSION["excepcion"],"ORA-12541")!=false){
				$mensaje="Lo sentimos, la base de datos esta desconectada. 
				Comuniqueselo al administrador del sistema y se solucionará cuanto antes";
		} elseif (strpos($_SESSION["excepcion"],"ORA-01017") !=false){ 
			$mensaje = "Lo sentimos, la base de datos esta inaccesible temporalmente. Disculpe las molestias";
		} else {
			$mensaje = "Lo sentimos, ha ocurrido el siguiente error: <br>"  . $_SESSION["excepcion"] . "<br>Le rogamos que se lo 
			comunique al administrador de la web y disculpe las molestias";}
	}
	include_once('php/_/cabecera.php');
?>


<!doctype html>

<html lang="es">

	<head>
    <meta charset="utf-8">
	</head>
	<body>
		<header id="cabecera">
			<h1> THREEW CLOTH. CO. </h1>
		</header>
        <div id="mensajeError">
        	<p style="text-align:center"><?php echo $mensaje ?></p>
        </div>
        
        <a href="index.php"><button type="button">Pulse aqui si desea volver a la pagina principal</button></a>
        
        <?php include_once('php/_/pie.php')?>
	</body>
	
</html>