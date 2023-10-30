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

//Mostrando visitantes
echo "<h1>Visitantes</h1>";

echo "<table border='1'>";
echo "<tr><th>idVisitante</th><th>nombreVisitante</th></tr>";

$reg_visitantes = mysqli_query($conexion, "select * from Visitantes") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_visitantes)) {
	echo "<tr><td>" . $reg["idVisitante"] .
	"</td><td>" . $reg["nombreVisitante"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";


//Mostrando visitas
echo "<h1>Visitas</h1>";

echo "<table border='1'>";
echo "<tr><th>idVisita</th>
<th>fecha_horaIngreso</th>
<th>idVisitante</th>
<th>nombreVisitante</th>
<th>lugarVisita</th>
<th>motivoVisita</th>
</tr>";

$reg_visitas = mysqli_query($conexion, 
"select * from Visitas left join Visitantes
		on Visitas.idVisitante = Visitantes.idVisitante") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_visitas)) {
	echo "<tr><td>" . $reg["idVisita"] .
	"</td><td>" . $reg["fecha_horaIngreso"] .
	"</td><td>" . $reg["idVisitante"] .
	"</td><td>" . $reg["nombreVisitante"] .
	"</td><td>" . $reg["lugarVisita"] .
	"</td><td>" . $reg["motivoVisita"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

//Hay que mostrar los
//Visitantes con carro
echo "<h1>Visitantes con vehiculo</h1>";

echo "<table border='1'>";
echo "<tr><th>idVisitante</th>
<th>nombreVisitante</th>
<th>idVehiculo</th>
</tr>";

$reg_visitas = mysqli_query($conexion, 
"SELECT idVisitante, nombreVisitante, idVehiculo
FROM visitantes
INNER JOIN vehiculos ON idvisitante = idpropietario;") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_visitas)) {
	echo "<tr><td>" . $reg["idVisitante"] .
	"</td><td>" . $reg["nombreVisitante"] .
	"</td><td>" . $reg["idVehiculo"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

/*VER Visitantes con vehiculos 
SELECT idVisitante, nombreVisitante, idVehiculo
FROM visitantes
INNER JOIN vehiculos ON idvisitante = idpropietario;
*/

$conexion->close();

?>


</html>




