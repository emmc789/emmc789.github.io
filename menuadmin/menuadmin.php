<html>
<head>
    <title>Menú principal</title>
	<link rel="stylesheet" type="text/css" href="../estilo.css">
</head>
<body>
    <h1>Índice de administración de registros</h1>
    <ul>
		<li><a href="../conexion.php">Probar conexion BD</a></li>
        <li><a href="tablas.php">Mostrar todas las tablas</a></li>
		<li><a href="regresidentes/regresidentes.php">Registros residentes y propietarios</a></li>
		<li><a href="regporteros/regporteros.php">Registros porteros</a></li>
		<li><a href="regvisitas/regvisitas.php">Registros de visitantes, vehiculos y visitas</a></li>
    </ul>
	<form method="post" action="../inicio.php">
        <input type="submit" value="Cerrar Sesión">
    </form>
	
	<?php 
	session_start();
	$_SESSION['paganterior'] = 'menuadmin/menuadmin.php';
	?>
</body>
</html>