<?php if(isset($_POST['signout'])){
	session_destroy();
	Header("Location: index.php");
}
?>

<nav id='menu'>
	<ul>
		<li> <a href='home.php'> Home </a></li>
		<li> <a href='productos.php'> Productos </a></li>
		<!--<li> <a href='panojita.php'> Panojita </a></li>-->
		<li> <a href='tareas.php'> Tareas </a></li>
		<li> <a href='trabajadores.php'> Trabajadores </a></li>
		<li> <a href='proveedores.php'> Proveedores </a></li>
		<li> <a href='datos.php'> Datos </a></li>
		<li> <form action="home.php" method="post"> <button name="signout" id="signout" value="signout" type="submit" style="width:15%;"> <img src="images/shut_down.png" width="100%"/> </button> </form> </li>
	</ul>
</nav>

