<html>

<head>
	<title>BD porteria</title>
	<link rel="stylesheet" type="text/css" href="../estilo.css">
</head>

<body>

<form method="post" action="menuadmin.php">
        <input type="submit" value="Menú principal">
    </form>
</body>

<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";

$conexion = new mysqli($server, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}

echo "<hr>";

//Mostrando casas
echo "<h1>Casas</h1>";

echo "<table border='1'>";
echo "<tr><th>idCasa</th><th>idPropietario</th><th>nombreResidente</th></tr>";

$reg_casas = mysqli_query($conexion, "select * from Casas left join Residentes on idPropietario = idResidente") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_casas)) {
	echo "<tr><td>" . $reg["idCasa"] . "</td><td>" .
	$reg["idPropietario"] . "</td><td>" .
	$reg["nombreResidente"]. "</td></tr>";
}
echo "</table>";
echo "<hr>";

//Mostrando porteros
echo "<h1>Porteros</h1>";

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


//Mostrando residentes
echo "<h1>Residentes</h1>";

echo "<table border='1'>";
echo "<tr><th>idResidente</th><th>nombreResidente</th><th>telResidente</th><th>casaResidente</th></tr>";

$reg_residentes = mysqli_query($conexion, "select * from Residentes") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_residentes)) {
echo "<tr><td>" . $reg["idResidente"] .
	"</td><td>" . $reg["nombreResidente"] .
	"</td><td>" . $reg["telResidente"] .
	"</td><td>" . $reg["casaResidente"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

//Mostrando vehiculos
echo "<h1>Vehiculos</h1>";

echo "<table border='1'>";
echo "<tr><th>idVehiculo</th><th>idPropietario</th></tr>";

$reg_vehiculos = mysqli_query($conexion, "select * from Vehiculos") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_vehiculos)) {
echo "<tr><td>" . $reg["idVehiculo"] .
	"</td><td>" . $reg["idPropietario"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

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

//Mostrando Residentes sin propietarios (si existen)
$residentes_sin_propietarios = $conexion->query("select count(*) as Conteo from Residentes 
left join Casas on casaResidente = idCasa
where idCasa is NULL");
if($residentes_sin_propietarios){
	$residentes_sin_propietarios = $residentes_sin_propietarios->fetch_assoc();
	$residentes_sin_propietarios = $residentes_sin_propietarios['Conteo'];
	//echo $residentes_sin_propietarios;
}
if($residentes_sin_propietarios > 0){
echo "<h1>Residentes sin propietarios</h1>";

echo "<table border='1'>";
echo "<tr>
<th>idResidente</th>
<th>nombreResidente</th>
<th>telResidente</th>
<th>casaResidente</th>
</tr>";

$reg_residentes = mysqli_query($conexion, 
"select * from Residentes 
left join Casas on casaResidente = idCasa
where idCasa is NULL;") or
    die("Problemas" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_residentes)) {
	echo "<tr><td>" . $reg["idResidente"] .
	"</td><td>" . $reg["nombreResidente"] .
	"</td><td>" . $reg["telResidente"] .
	"</td><td>" . $reg["casaResidente"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";
}

//Mostrando Registros

echo "<h1>Registros DB</h1>";

echo "<table border='1'>";
echo "<tr><th>idRegistro</th>
<th>Registro</th>
<th>fecha_horaRegistro</th>
</tr>";

$reg_Registros = mysqli_query($conexion, 
"select * from Registros ") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_Registros)) {
	echo "<tr><td>" . $reg["idRegistro"] .
	"</td><td>" . $reg["Registro"] .
	"</td><td>" . $reg["fecha_horaRegistro"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

//Mostrando usuarios
echo "<h1>Usuarios</h1>";

echo "<table border='1'>";
echo "<tr><th>nombreUsuario</th>
<th>contraseña</th>
</tr>";

$reg_visitas = mysqli_query($conexion, 
"select * from usuarios ") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_visitas)) {
	echo "<tr><td>" . $reg["nombreUsuario"] .
	"</td><td>" . $reg["contraseña"] .
	"</td></tr>";
}
echo "</table>";
echo "<hr>";

$conexion->close();

?>


</html>




