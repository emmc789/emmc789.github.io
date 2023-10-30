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

	echo "<h1>Residentes</h1>";
	
	$idresidente = $_POST['idresidente'];
	
	/*
	al borrar el residente, tendra que verse si existe en propietarios
	si existe, eliminar propietario
	*/

	//Existencia en Residentes
	$existente = false;
	$reg_residentes = mysqli_query($conexion, "select * from Residentes") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_residentes)) {
		if ($reg['idResidente']==$idresidente){
			$existente = true;
		}
	}
	//Existencia en Casas (propietarios)
	$propietario_existente = false;
	$reg_casas = mysqli_query($conexion, "select * from Casas") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_casas)) {
		if ($reg['idPropietario']==$idresidente){
			$propietario_existente = true;//Si encuentra la casa en la tabla casas
		}
	}
	
	$delete = "DELETE from Residentes where idResidente = $idresidente";
	if ($existente===false){
		echo "Error al eliminar el registro: No existe un registro con esa ID<br>" . $conexion->error;
	} else {
		$conexion->query($delete); 
		echo "Eliminado el registro con la ID $idresidente<br>". $conexion->error;
	}
	
	if($propietario_existente==true){
		$conexion->query("DELETE from Casas where idPropietario = $idresidente"); 
	}
	
	echo "<hr>";
	//Mostrando tablas
	echo "<table border='1'>";
	echo "<tr><th>idResidente</th><th>nombreResidente</th><th>telResidente</th><th>casaResidente</th></tr>";
	
	$reg_residentes = mysqli_query($conexion, "select * from Residentes") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_residentes)) {
	echo "<tr><td>" . $reg["idResidente"] .
		"</td><td>" . $reg["nombreResidente"] .
		"</td><td>" . $reg["telResidente"] .
		"</td><td>" . $reg["casaResidente"] .
		"</td>";
		echo"</tr>";
	}
	echo "</table>";
	echo "<hr>";
	
	echo "<table border='1'>";
	echo "<tr><th>idCasa</th><th>idPropietario</th><th>Propietario</th><th>Telefono</th></tr>";

	$reg_casas = mysqli_query($conexion, "select * from vistaCasas") or
		die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_casas)) {
		echo "<tr><td>" .
		$reg["Casa"] . "</td><td>" .
		$reg["ID"]; 
		if($idresidente==$reg["ID"]) echo "****";
		echo  "</td><td>" .
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




