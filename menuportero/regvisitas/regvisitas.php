<html>

<head>
	<title>BD porteria</title>
	<link rel="stylesheet" type="text/css" href="../../estilo.css">
</head>

<body>

<form method="post" action="../menuportero.php">
        <input type="submit" value="Menú principal">
    </form>
	<h1>Registro de nuevas visitas y visitantes</h1>
	<form method="post" action="insertar_visita.php"
	target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
	
        <label for="idvisitante">ID Visitante*:         </label>
		<input type="text" name="idvisitante" required>
		<input type="submit" name="eliminar" value="Eliminar visitante" formaction="eliminar_visitante.php" >
    <br>
		
		<label for="nombrevisitante">Nombre Visitante*:</label>
		<input type="text" name="nombrevisitante" >
		<input type="submit" name="insertar" value="Insertar visitante" formaction="insertar_visitante.php">
		<input type="submit" name="modificar" value="Modificar visitante" formaction="modificar_visitante.php">
    <br>
		<label for="lugarvisita">Casa a Visitar:        </label>
        <input type="text" name="lugarvisita" ><br>
		<label for="motivovisita">Motivo de Visita:   </label>
        <input type="text" name="motivovisita" ><br>
		
		
        <input type="submit" value="Insertar Visita"><br>
		
		<label for="placavehiculo">Vehiculo (opcional):</label>
        <input type="text" name="idvehiculo" >
		<input type="submit" name="insertar" value="Insertar Vehiculo" formaction="../regvehiculos/insertar_vehiculo.php">
    </form>
<hr>
	<h1>Administrar visitas</h1>
    <form method="post" target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
        <label for="idvisita">ID Visita:</label>
        <input type="text" name="idvisita" required>
		<input type="submit" value="Eliminar visita" formaction="eliminar_visita.php">
		<br>
		<label for="idvisitante">ID Visitante:</label>
        <input type="text" name="idvisitante">
		<br>
		<label for="lugarvisita">Casa a Visitar:</label>
        <input type="text" name="lugarvisita">
		<br>
		<label for="motivovisita">Motivo de Visita:</label>
        <input type="text" name="motivovisita">
		<br>
		<input type="submit" name="modificar" value="Modificar visita" formaction="modificar_visita.php" >
		
    </form>
	<hr>
	<form method="post" action="tablas_visitante.php" 
	  target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
        <input type="submit" name="submit" value="Mostrar visitas y visitantes">
    </form>
	


<?php

session_start();
$_SESSION['paganterior'] = 'Visitas';

$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";


$conexion = new mysqli($server, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}

$conexion->close();

?>

</body>

</html>




