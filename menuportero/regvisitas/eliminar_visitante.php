<html>
<head>
	<title>BD porteria</title>
</head>
<body>

<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";
$conexion = new mysqli($server, $user, $password, $database);
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}

	$idvisitante = $_POST['idvisitante'];
	
	$conexion->query
	("delete from visitantes where idVisitante = $idvisitante");
	echo "Registro eliminado correctamente" . $conexion->error;
	include 'tablas_visitante.php';

?>
</body>
</html>