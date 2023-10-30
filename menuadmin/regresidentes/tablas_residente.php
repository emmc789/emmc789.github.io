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

//Mostrando casas
echo "<h1>Casas y sus propietarios</h1>";

echo "<table border='1'>";
echo "<tr><th>idCasa</th><th>idPropietario</th><th>Propietario</th><th>Telefono</th></tr>";

$reg_casas = mysqli_query($conexion, "select * from vistaCasas") or
    die("Problemas en el select:" . mysqli_error($conexion));
while ($reg = mysqli_fetch_array($reg_casas)) {
	echo "<tr><td>" .
	$reg["Casa"] . "</td><td>" .
	$reg["ID"] .  "</td><td>" .
	$reg["Propietario"] . "</td><td>" .
	$reg["Telefono"] . "</td></tr>";
	
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

$conexion->close();

?>


</html>




