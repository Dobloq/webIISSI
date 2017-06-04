<?php
session_start();
if (isset($_REQUEST["nombreUsr"])){
		
		require_once("gestionBD.php");
		require_once("gestionUsuarios.php");
		
		$user = $_POST["nombreUsr"];
		$pass = $_POST["passUsr"];
		$conexion = crearConexionBD();
		
		$datosUsr = consultaLogin($conexion, $user, $pass);
		cerrarConexionBD($conexion);
			
		if (!isset($datosUsr)) {
			$_SESSION["excepcion"] = $datosUsr;
			$_SESSION["destino"] = "form_login.php";
			Header("Location: ../../excepcion.php");
		}
		else{
			try{
				if(isset($datosUsr[0])){
					$_SESSION['datosUsuario'] = $datosUsr[0];
				} else { 
					$_SESSION["excepcion"] = "Datos de login erroneos";
					Header("Location: ../../excepcion.php");
				}
			}catch(Excepcion $e){
				$_SESSION['excepcion'] = $e->GetMessage();
				header("Location: ../../excepcion.php");
			}
			if(isset($_SESSION['datosUsuario'])){
				Header("Location: ../../home.php");
			}
			
			
		}
	}
?>