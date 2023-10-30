<html>
<head>
    <title>Menú portero</title>
</head>
<body>
    <h1>Índice de administración de visitas porteros</h1>
    <ul>
		<li><a href="../conexion.php">Probar conexion BD</a></li>

		<li><a href="regvisitas/regvisitas.php">Registrar visitas</a></li>
    </ul>
	<form method="post" action="../inicio.php">
        <input type="submit" value="Cerrar Sesión">
    </form>
	
	<?php 
	session_start();
	$_SESSION['paganterior'] = 'menuportero/menuportero.php';
	?>
	
</body>
</html>