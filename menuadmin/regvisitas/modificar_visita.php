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
	$idvisita = $_POST['idvisita'];
	$idvisitante = $_POST['idvisitante'];
	$lugarvisita = $_POST['lugarvisita'];
	$motivovisita = $_POST['motivovisita'];
	
	$existente = $conexion->query
	("select idExistente($idvisitante) as Resultado")
	->fetch_assoc()['Resultado'];
	
	if($existente == 0){
		echo "ERROR: No existe alguien con la ID ingresada";
	}else{
	$conexion->query
	("update Visitas 
	set idVisitante = $idvisitante,
	lugarVisita = $lugarvisita,
	motivoVisita = '$motivovisita' where idVisita = $idvisita");
	echo "Registro modificado correctamente" . $conexion->error;
	}
	include 'tablas_visitante.php';

?>
</body>
</html>