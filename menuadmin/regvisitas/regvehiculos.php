<html>

<body>

	<h1>Registro de Vehiculos</h1>
	<form method="post"
	target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
	
        <label for="idvehiculo">ID Vehiculo: </label>
		<input type="text" name="idvehiculo" required>
		<input type="submit" name="eliminar" value="Eliminar Vehiculo" formaction="eliminar_vehiculo.php">
	<br>
		<label for="idpropietario">ID Propietario: </label>
		<input type="text" name="idpropietario" >
	<br><BR>
		<input type="submit" name="insertar" value="Insertar Vehiculo" formaction="insertar_vehiculo.php">
		<input type="submit" name="modificar" value="Modificar Vehiculo" formaction="modificar_vehiculo.php">
		
    </form>

	<form method="post" action="tablas_vehiculo.php" 
	  target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
        <input type="submit" name="submit" value="Mostrar vehiculos y sus propietarios">
    </form>


<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";


$conexion = new mysqli($server, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}
//session_start();
	$_SESSION['paganterior'] = 'Vehiculos';

$conexion->close();

?>

</body>
</html>




