<?php
	session_start();

		/////////////////////// EJERCICIO 3 APT 2
	// Si no existen datos del formulario en la sesión
	
		// Inicializamos la variable con los datos del formulario asignando valores por defecto a los elementos
		$formulario['nif'] = "";
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['perfil'] = "ALUMNO";
		$formulario['fechaNacimiento'] = "";
		$formulario['email'] = "";
		$formulario['pass'] = "";
		$formulario['generoLiterario'] = array();
		$formulario['calle'] = "";
		$formulario['provincia'] = "";
		
		// Guardamos los datos en la sesión
		
	// Si ya existían valores, los cogemos para inicializar el formulario
	
	   /////////////////////// FIN DEL EJERCICIO 3 APT 2
	   
	 /////////////////////// EJERCICIO 2
	// Si en la sesión hay errores, los guardamos en una variable local
	
	/////////////////////// FIN DE EJERCICIO 2

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css"  href="css/estilo.css" />
  <title>Gestión de biblioteca: Usuarios</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	
	<?php 
	/////////////////////// EJERCICIO 2
	// Si hay errores, los mostramos en un div con el atributo class="error"
	
	/////////////////////// FIN DE EJERCICIO 2
	?>
	
	<form id="altaUsuario" method="get" action="accion_alta_usuario.php" novalidate>
			<p>
				<i>Los campos obligatorios están marcados con </i><em>*</em>
			</p>
			<fieldset>
				<legend>Datos personales</legend>
				<div></div><label for="nif">NIF<em>*</em></label>
				<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required>
				</div>

				<div><label for="nombre">Nombre:<em>*</em></label>
				<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
				</div>

				<div><label for="apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
				</div>

				<div><label>Perfil:</label>
				<label>
					<input name="perfil" type="radio" value="ALUMNO" <?php if($formulario['perfil']=='ALUMNO') echo ' checked ';?>/>
					Alumno</label>
				<label>
					<input name="perfil" type="radio" value="PDI" <?php if($formulario['perfil']=='PDI') echo ' checked ';?>/>
					PDI</label>
				<label>
					<input name="perfil" type="radio" value="PAS" <?php if($formulario['perfil']=='PAS') echo ' checked ';?>/>
					PAS</label>
				</div>

				<div<<label for="fechaNacimiento">Fecha de nacimiento:</label>
				<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
				</div>

				<div><label for="email">Email:<em>*</em></label>
				<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['email'];?>" required/><br>
				</div>
			</fieldset>

			<fieldset>
				<legend>Datos de usuario</legend>
				<div>
				<label for="nick">Nickname:</label>
				<input id="nick" name="nick" type="text" size="40"/>
				</div>

				<div>
				<label for="pass">Password:<em>*</em></label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required/>
				</div>
				<div>
				<label for="confirmpass">Confirmar Password: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required />
				</div>

				<div><label for="generoLiterario">¿Cuáles son tus géneros literarios favoritos?</label>
				<select multiple name="generoLiterario[]" id="generoLiterario">
					<option value="CF" <?php      
						if (in_array("CF",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Ciencia Ficción</option>
					<option value="NH" <?php
						if (in_array("NH",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Novela Histórica</option>
					<option value="NN" <?php
						if (in_array("NN",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Novela Negra</option>
					<option value="NG" <?php
						if (in_array("NG",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Novela Gráfica</option>
					<option value="E" <?php
						if (in_array("E",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Ensayo</option>
					<option value="P" <?php
						if (in_array("P",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Poesía</option>
					<option value="B" <?php
						if (in_array("B",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Biografías</option>
					<option value="T" <?php
						if (in_array("T",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Terror</option>
					<option value="I" <?php
						if (in_array("I",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Infantil</option>
					<option value="O" <?php
						if (in_array("O",$formulario['generoLiterario'])){
							echo "selected";
						}?> >Otro</option>
				</select>
				</div>
			</fieldset>

			<fieldset>
				<legend>Dirección</legend>

				<div>
				<label for="calle">Calle/Avda.:<em>*</em></label>
				<input id="calle" name="calle" type="text" size="80" value="<?php echo $formulario['calle'];?>" required/>
				</div>

				<div>
				<label for="provincia">Provincia:<em>*</em></label>
				<input list="opcionesProvincias" name="provincia" id="provincia" 
					value="<?php if ($formulario['provincia'] != "") echo $formulario['provincia'];?>" 
					required/>
				<datalist id="opcionesProvincias">
				  	<option value="CD">Cádiz</option>
					<option value="SV">Sevilla</option>
					<option value="MA">Málaga</option>
					<option value="HU">Huelva</option>
					<option value="CO">Córdoba</option>
					<option value="JA">Jaén</option>
					<option value="AL">Almería</option>
					<option value="GR">Granada</option>
					<option value="OT">Otra</option>
				</datalist>
				</div>
			</fieldset>
			<div><input type="submit" value="Enviar" /></div>
		</form>
	<?php
		include_once("pie.php");
	?>
	</body>
</html>
