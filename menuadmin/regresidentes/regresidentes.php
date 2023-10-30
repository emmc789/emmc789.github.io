<html>

<head>
	<title>Residentes y propietarios</title>

</head>

<body>

<form method="post" action="../menuadmin.php">
        <input type="submit" value="Menú principal">
    </form>
	
		<h1>Residentes y propietarios</h1>
	
<form method="post" action="insertar_residente.php" 
	  target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
        <label for="idresidente">ID Residente:</label>
        <input type="text" name="idresidente" required><br>

        <label for="nombreresidente">Nombre Residente:</label>
        <input type="text" name="nombreresidente" required><br>

        <label for="telresidente">Tel Residente:</label>
        <input type="text" name="telresidente"><br>

        <label for="casaresidente">Casa Residente:</label>
        <input type="text" name="casaresidente" required>
		
        <input type="checkbox" name="propietario" value="propietario"> Propietario<br>
        
		
        <input type="submit" name="submit" value="Agregar Residente">
		<button type="submit" formaction="modificar_residente.php">Modificar residente</button>
		 
    </form>
	
	<form method="post" action="borrar_residente.php" 
	  target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
        <label for="idresidente">ID Residente:</label>
        <input type="text" name="idresidente" required><br>

        <input type="submit" name="submit" value="Borrar Residente">
    </form>
	
	<form method="post" action="tablas_residente.php" 
	  target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">

        <input type="submit" name="submit" value="Mostrar residentes, casas y sus propietarios">
		
		 
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
/*
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

*/
$conexion->close();

?>


</html>




