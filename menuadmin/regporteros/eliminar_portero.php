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

	$idportero = $_POST['idportero'];
	
	//Comprobando existencia del portero
	$existente = false;
	$reg_porteros = mysqli_query($conexion, "select * from Porteros") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_porteros)) {
		if ($reg['idPortero']==$idportero){
			$existente = true;
		}
	}
	if($existente != true){
		echo "ERROR: No existe un portero con esta ID";
	}else{
		$conexion->query("delete from Porteros where idPortero = $idportero");
		echo "Registro eliminado correctamente" . $conexion->error;	
		
	}
	
	include 'tablas_portero.php';

?>


</html>




