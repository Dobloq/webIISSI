<?php 
	session_start();
	if(isset($_SESSION['paginaAnterior'])){
	$pagAnterior = $_SESSION['paginaAnterior'];
	Header('refresh: 3;url=$paginaAnterior');
	unset($_SESSION['paginaAnterior']);
	}
	else{Header('refresh: 3;url=home.php');}
?>

<!doctype html>

<html lang="es">

	<head>
    <meta charset="utf-8">
		Ups.
	</head>
	<body>
		<header>
			<h1> Ups. Lo sentimos, algo ha fallado, se le redirigirá automáticamente. </h1>
		</header>
	</body>
	
</html>