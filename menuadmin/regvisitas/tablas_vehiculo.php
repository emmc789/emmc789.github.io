<html>

<head>
	<title>BD porteria</title>
</head>


<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";

$conexion = new mysqli($server, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}

//Mostrando vehiculos
echo "<h1>Vehiculos</h1>";

echo "<table border='1'>";
echo "<tr><th>idVehiculo</th>
<th>idPropietario</th>
<th>nombrePropietario</th>
<th>tipoPropietario</th></tr>";

$reg_vehiculos = mysqli_query($conexion, "select * from vistaVehiculosPropietario") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_vehiculos)) {
echo "<tr><td>" . $reg["idVehiculo"] .
	"</td><td>" . $reg["idPropietario"] .
	"</td><td>" . $reg["nombrePropietario"] .
	"</td><td>" . $reg["tipoPropietario"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

$conexion->close();

?>


</html>




