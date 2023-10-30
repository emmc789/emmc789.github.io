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
	//echo "<h1>Porteros</h1>";

	$idvisitante = $_POST['idvisitante'];
	$nombrevisitante = $_POST['nombrevisitante'];
	
	$existente = $conexion->query
	("select idExistente($idvisitante) as Resultado")
	->fetch_assoc()['Resultado'];
	
	if($nombrevisitante == ""){
		echo "ERROR: Ingrese el nombre del visitante";
	}else if($existente == 0){
		echo "ERROR: No existe alguien con esa ID";
	}else{
		$conexion->query
		("update Visitantes set nombreVisitante = '$nombrevisitante' where idVisitante = $idvisitante");
		echo "Registro agregado correctamente" . $conexion->error;
	}
	include 'tablas_visitante.php';
?>
</body>
</html>