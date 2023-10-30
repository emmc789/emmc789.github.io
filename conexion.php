<html>

<head>
	<title>BD porteria</title>
</head>

<body>

<?php

session_start();
$paganterior = $_SESSION['paganterior'];

echo '<form method="post" action="' . $paganterior . '">
        <input type="submit" value="Menú principal">
    </form>
</body>';

$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";


$conexion = new mysqli($server, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}
else {
	echo "CONECTADO EXITOSAMENTE A LA BASE DE DATOS<br>";
}

$conexion->close();

?>


</html>




