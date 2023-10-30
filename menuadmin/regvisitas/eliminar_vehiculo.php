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
	//Ver si el propietario existe en la DB
	$existente = $conexion->query
	("SELECT CASE WHEN EXISTS (select * from vehiculos where idVehiculo = '$idvehiculo')
THEN true else false end as Resultado;")
	->fetch_assoc()['Resultado'];
	
	if($existente == 1){
		$conexion->query("delete from vehiculos where idVehiculo = '$idvehiculo'");
		echo "Registro eliminado correctamente" . $conexion->error;
	}else{
		echo "Error: No existe un vehiculo con esa ID" . $conexion->error;
	}
	include 'tablas_vehiculo.php';
	
	
	/* CODIGO INNECESARIO
	//Comprobando existencia del visitante
	$existente = false;
	$reg_porteros = mysqli_query($conexion, "select * from Porteros") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_porteros)) {
		if ($reg['idPortero']==$idportero){
			$existente = true;
		}
	}
	
	if($existente == true){
		echo "ERROR: Ya existe un portero con esta ID";
		include 'tablas_portero.php';
	}else if($nombreportero=="" || $horarioportero==""){
		echo "ERROR: No deje vacíos los campos requeridos";
		$conexion->close();
	}else{
		$conexion->query("insert into Porteros(idPortero, nombrePortero, horarioPortero) values ($idportero,'$nombreportero','$horarioportero')");
		echo "Registro agregado correctamente" . $conexion->error;
		include 'tablas_portero.php';
	}
	*/

?>
</body>
</html>