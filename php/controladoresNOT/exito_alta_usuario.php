<?php
	session_start();
	
	$generosLiterarios =["NG"=>"Novela Gráfica", "NH"=>"Novela Histórica",
		"NN"=>"Novela Negra","CF"=>"Ciencia Ficción","E"=>"Ensayo","P"=>"Poesía",
		"B"=>"Biografías","T"=>"Terror","I"=>"Infantil","O"=>"Otro"];
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_usuario.php");	

	// Obtener el nombre completo del género literario mediante un array
	function getNombreGeneroLiterario($abbrv){
		global $generosLiterarios;
	
		if (isset($generosLiterarios[$abbrv])){
				return $generosLiterarios[$abbrv];
			}else {
				return "ERROR: abreviatura '" . $abbrv . "' inexistente.";
			}
	}

	// Función para formatear una fecha al formato de Oracle
	function getFechaFormateada($fecha){
		$fechaNacimiento = date('d/m/Y', strtotime($fecha));
		return $fechaNacimiento;
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Biblioteca: Alta de Usuario realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
			
		<div id="div_exito">
		  <h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
			<div id="div_volver">	
			   Pulsa <a href="form_alta_usuario.php">aquí</a> para volver al formulario de altas de usuarios.
			</div>
		</div>

		<h2>El nuevo usuario ha sido dado de alta con éxito con los siguientes datos:</h2>
		<ul>
			<li><?php echo "NIF: " . $nuevoUsuario["nif"]; ?></li>
			<li><?php echo "Nombre: " . $nuevoUsuario["nombre"]; ?></li>
			<li><?php echo "Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
			<li><?php echo "e-mail: " . $nuevoUsuario["email"]; ?></li>
			<li><?php echo "Perfil: " . $nuevoUsuario["perfil"]; ?></li>
			<li><?php echo "Fecha de Nacimiento: " . getFechaFormateada($nuevoUsuario["fechaNacimiento"]); ?></li>
			<li><?php echo "Provincia: " . $nuevoUsuario["provincia"]; ?></li>
			<li><?php echo "Dirección: " . $nuevoUsuario["calle"]; ?></li>
			<li><?php echo "Género literario favorito: "; ?>
				<ul>
				<?php
					foreach($nuevoUsuario["generoLiterario"] as $genero){
						echo "<li>" . getNombreGeneroLiterario($genero) . "</li>";
					}
				?>
				</ul>
			</li>
		</ul>		
	</main>
	<?php
		include_once("pie.php");
	?>
</body>
</html>