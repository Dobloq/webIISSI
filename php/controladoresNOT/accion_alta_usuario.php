<?php
session_start();

$generosLiterarios = ["NG"=>"Novela Gráfica", "NH"=>"Novela Histórica",
	"NN"=>"Novela Negra","CF"=>"Ciencia Ficción","E"=>"Ensayo","P"=>"Poesía",
	"B"=>"Biografías","T"=>"Terror","I"=>"Infantil","O"=>"Otro"];

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	// Recogemos los datos del formulario
	$nuevoUsuario["nif"] = $_REQUEST["nif"];
	$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
	$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
	$nuevoUsuario["email"] = $_REQUEST["email"];
	$nuevoUsuario["perfil"] = $_REQUEST["perfil"];
	$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
	$nuevoUsuario["pass"] = $_REQUEST["pass"];
	$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
	$nuevoUsuario["provincia"] = $_REQUEST["provincia"];
	$nuevoUsuario["calle"] = $_REQUEST["calle"];
	
	if(isset($_REQUEST["generoLiterario"])){
		$nuevoUsuario["generoLiterario"] = $_REQUEST["generoLiterario"];
	}else{
		$nuevoUsuario["generoLiterario"] = array();
	}

	
	
/////////////////////// EJERCICIO 3	 APT 1
	// Guardar la variable local con los datos del formulario en la sesión.
	
/////////////////////// FIN EJERCICIO 3 APT 1
	
	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($nuevoUsuario);
	
	/////////////////// EJERCICIO 2
	// Si se han detectado errores
	
		// Guardo en la sesión los mensajes de error
	
		// Redirigimos al usuario al formulario
	
	// Si NO se han detectado errores
		// Redirigimos al usuario a la página de éxito
	
	
	/////////////////// FIN DE EJERCICIO 2
// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
}else{
	Header("Location:alta_usuario.html");
}	

// Obtener el nombre completo del género literario mediante un array
function getNombreGeneroLiterario($abbrv){
	global $generosLiterarios;
	
	if (isset($generosLiterarios[$abbrv])){
		return $generosLiterarios[$abbrv];
	}else {
		return "ERROR: abreviatura '" . $abbrv . "' inexistente.";
	}
}

// Formatear la fecha
function getFechaFormateada($fecha){
	$fechaNacimiento = date('d/m/Y', strtotime($fecha));
	
	return $fechaNacimiento;
}

/////////////////// EJERCICIO 1
// Validación en servidor del formulario de alta de usuario
function validarDatosUsuario($nuevoUsuario){
	global $generosLiterarios;
	$error = "";	
	
	// Validación del NIF
	

	// Validación del Nombre			
	
	
	// Validación del email
	
	
	// Validación del perfil
	
	
	// Validación de la contraseña
	
	
	// Validación de la dirección
	
	
	// Validación del género literario

			
	return $error;
}
/////////////////// FIN DE EJERCICIO 1
?>
