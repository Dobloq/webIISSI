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
			Header("Location: ../../panojita.php");
		}
		else{
			try{
				if(isset($datosUsr[0])){
			$_SESSION['datosUsuario'] = $datosUsr[0];}
			else { Header("Location: ../../error.php");}
		}catch(Excepcion $e){
				
			}
			if(isset($_SESSION['datosUsuario'])){
				Header("Location: ../../home.php");
			}
			
			
		}
	}
?>