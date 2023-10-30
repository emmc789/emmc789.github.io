<html>

<head>
	<title>Residentes</title>
	
</head>

<body>
	
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
	
	
	$idportero = $_POST['idportero'];
	$nombreportero = $_POST['nombreportero'];
	$horarioportero = $_POST['horarioportero'];
	
	//Comprobando existencia del portero
	$existente = false;
	$reg_porteros = mysqli_query($conexion, "select * from Porteros") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_porteros)) {
		if ($reg['idPortero']==$idportero){
			$existente = true;
		}
	}
	
	if($existente == false){
		echo "ERROR: No existe un portero con esa ID";
		include 'tablas_portero.php';
	}else{
		$conexion->query("call ModificarPortero($idportero,'$nombreportero','$horarioportero')");
		echo "Registro modificado correctamente" . $conexion->error;
		include 'tablas_portero.php';
	}
?>


</html>




