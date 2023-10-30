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

//Mostrando porteros
echo "<hr><h1>Porteros</h1>";

echo "<table border='1'>";
echo "<tr><th>idPortero</th><th>nombrePortero</th><th>horarioPortero</th></tr>";

$reg_porteros = mysqli_query($conexion, "select * from Porteros") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_porteros)) {
	echo "<tr><td>" . $reg["idPortero"] .
	"</td><td>" . $reg["nombrePortero"] .
	"</td><td>" . $reg["horarioPortero"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

$conexion->close();

?>


</html>




