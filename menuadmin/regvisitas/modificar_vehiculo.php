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
	$idvehiculo = $_POST['idvehiculo'];
	$idpropietario = $_POST['idpropietario'];
	//Ver si el propietario existe en la DB
	$existente = $conexion->query
	("select idExistente($idpropietario) as Resultado")
	->fetch_assoc()['Resultado'];
	
	if($existente == 1){
		$conexion->query("update vehiculos set idPropietario = $idpropietario where idVehiculo = '$idvehiculo'");
		echo "Registro modificado correctamente" . $conexion->error;
	}else{
		echo "Error: No existe alguien con esa ID" . $conexion->error;
	}
	include 'tablas_vehiculo.php';

?>

</html>
