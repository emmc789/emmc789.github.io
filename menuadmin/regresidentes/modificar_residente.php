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
	$nombreresidente = $_POST['nombreresidente'];
	$telresidente = $_POST['telresidente'];
	$casaresidente = $_POST['casaresidente'];
	$es_propietario;// = $_POST["propietario"];
	$propietarioquery;
	
	//checkbox
	if (isset($_POST["propietario"])) { //isset($_POST["propietario"])
	$es_propietario = true;		
    } else  $es_propietario = false;
	
	//Comprobando existencia de la casa con el propietario en la tabla
	$casa_existente = false;
	$reg_casas = mysqli_query($conexion, "select * from Casas") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_casas)) {
		if ($reg['idCasa']==$casaresidente){
			$casa_existente = true;//Si encuentra la casa registrada en la tabla casas
		}
	}
	//Comprobando existencia del ID a modificar en los residentes
	$residente_existente = false;	
	$reg_residentes = mysqli_query($conexion, "select * from Residentes") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_residentes)) {
		if ($reg['idResidente']==$idresidente){
			$residente_existente = true;
		}
	}
	
	//Comprobando existencia de la ID enviada en las casas
	$propietario_existente = false;
	$reg_casas = mysqli_query($conexion, "select * from Casas") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_casas)) {
		if ($reg['idPropietario']==$idresidente){
			$propietario_existente = true;//Si encuentra la casa registrada en la tabla casas
		}
	}
	
	//Residentes en la casa del residente con el ID enviado
	if($row = mysqli_fetch_assoc(mysqli_query($conexion,
	"select idCasa, cantidad_de_residentes from vistaConteoResidentes
	where idCasa = (Select casaResidente from residentes where idResidente = $idresidente)"))){
		$conteoResidentesCasa = $row['cantidad_de_residentes'];
		/*echo $conteoResidentesCasa ."<br>";*/
	}
	/*
	if($casa_existente==true){
	echo "existe casa<br>";
	}
	if($residente_existente==true){
	echo "existe residente<br>";
	}
	if($propietario_existente==true){
		echo "existe como propietario<br>";
	}
	if($es_propietario==true){
	echo "es propietario chkbx<br>";
	}
	*/
	$update = "UPDATE Residentes 
	set /*idResidente = '$idresidente',*/
	nombreResidente = '$nombreresidente',
	telResidente = '$telresidente',
	casaResidente = '$casaresidente'
	where idResidente = '$idresidente'";
	
	if($residente_existente == true){
		$conexion->query($update);
		
		if($casa_existente==true){
			if($es_propietario == true){//Se hará propietario de la casa en la tabla casas
				$propietarioquery= "UPDATE Casas set idPropietario = '$idresidente' where idCasa = '$casaresidente'";
				$conexion->query($propietarioquery);
			}else{ //Se borrará del reg de tabla casas
				$propietarioquery= "DELETE from Casas where idPropietario = '$idresidente'"; 
				$conexion->query($propietarioquery);
			}
		}else{
			if($propietario_existente==true){
				if($es_propietario == true){
					$propietarioquery = "UPDATE Casas set idCasa = '$casaresidente' where idPropietario = '$idresidente'" ;
					$conexion->query($propietarioquery);
				}else{
					$propietarioquery= "DELETE from Casas where idCasa = '$casaresidente'"; 
					$conexion->query($propietarioquery);
				}
			}else{
				if($es_propietario == true){
					$propietarioquery = "INSERT Casas(idPropietario, idCasa) values('$idresidente','$casaresidente')";
					$conexion->query($propietarioquery);
				}else{
					$propietarioquery= "DELETE from Casas where idCasa = '$casaresidente'"; 
					$conexion->query($propietarioquery);
				}
			}
		}
		
		echo "Actualizado exitosamente<hr>";
	}else{
		echo "Error: No existe ese ID Residente en la BD<hr>";
	}


	
	//Mostrando datos de tablas
	echo "<table border='1'>";
	echo "<tr><th>idResidente</th><th>nombreResidente</th><th>telResidente</th><th>casaResidente</th></tr>";
	
	$reg_residentes = mysqli_query($conexion, "select * from Residentes") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_residentes)) {
	
		echo "<tr><td>" . $reg["idResidente"];
			if($idresidente==$reg["idResidente"]){
				echo "****";
			}
		echo "</td><td>" . $reg["nombreResidente"] .
		"</td><td>" . $reg["telResidente"] .
		"</td><td>" . $reg["casaResidente"] .
		"</td>";
		echo"</tr>";	
	}
	echo "</table>";
	echo "<hr>";
	
	//Mostrando casas
	//echo "<h1>Casas y sus propietarios</h1>";

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




