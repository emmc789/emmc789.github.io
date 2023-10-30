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
	
	//checkbox
	if (isset($_POST["propietario"])) {
		$es_propietario = true;
    } else {
		$es_propietario = false;  
	}

	//Comprobando existencia de la casa con el propietario
	$casa_existente = false;
	$reg_casas = mysqli_query($conexion, "select * from Casas") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_casas)) {
		if ($reg['idCasa']==$casaresidente){
			$casa_existente = true;//Ya existe un propietario en esa casa
		}
	}
	
	//Comprobando existencia de idResidente en los residentes
	$existente = false;
	$reg_residentes = mysqli_query($conexion, "select * from Residentes") or
    die("Problemas en el select:" . mysqli_error($conexion));
	while ($reg = mysqli_fetch_array($reg_residentes)) {
		if ($reg['idResidente']==$idresidente){
			$existente = true;
		}
	}
	
	$insert = "insert into Residentes(idResidente, nombreResidente, telResidente, casaResidente ) 
	values ('$idresidente','$nombreresidente','$telresidente',$casaresidente)";
	
	if ($existente===TRUE)
	{ //Si existe un registro con ese id
		echo "Error al insertar el registro: Ya existe un registro con esa ID" . $conexion->error;
		echo "<hr>";	
	} 
	else //Si no existe un registro con esa id:
	{
		if($casa_existente==false) //Si no existe una casa con la misma idcasa
		{ 
			if ($es_propietario == true)//y quiere ser propietario, crea registro
			{ 
				//Crea casa con propietario
				$conexion->query("insert into Casas(idCasa, idPropietario) values
				('$casaresidente','$idresidente')");
				//Mete al propietario dentro de los residentes
				$conexion->query($insert);
				echo "Registro agregado correctamente" . $conexion->error;			
			}
			else
			{ //Si no es propietario, no lo crea
				echo "Error: No existe propietario en la casa seleccionada, 
				tiene que registrar el residente como propietario" . $conexion->error;
				echo "<hr>";
			} 				
		}
		else//Si existe una casa con la misma idcasa
		{
			if($es_propietario == true) //Y se quiere ser el propietario
			{
				//Actualiza casa con nuevo propietario
				$conexion->query(" update Casas set idPropietario = '$idresidente' where
				idCasa = $casaresidente");
				//Mete al propietario dentro de los residentes
				$conexion->query($insert);
				echo "Registro agregado correctamente" . $conexion->error;	
			}
			else
			{
				echo "Error: No puede haber residentes en una casa sin propietarios, a menos que este sea el propietario" . $conexion->error;
				echo "<hr>";
			}
		}
	}
			/*
	Al agregar residente, la opcion de propietario estará o no estará marcada
	$es_propietario nos muestra si esta marcada o no
	
	si la op está marcada, este residente será el nuevo propietario, 
	reemplazando al anterior o siendo el nuevo propietario de una casa que no existia
	
	para esto se comprueba que la casa exista
	si ya existe, se reemplazan el propietario de la casa existente
	si no existe, se crea una nueva con esta persona como propietaria
	
	si la op no está marcada, el residente se agregará sin ningún problema
	pero si la casa del residente no existe en tabla casas, no se puede agregar 
	a menos que la opción esté marcada y este sea el nuevo propietario.
	el error seria "no puede agregarse residente a una casa sin propietarios,
	a menos que el residente sea el propietario"
	*/
	
	//Mostrando tablas
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
	
	if($es_propietario==true){//Si se insertó un propietario
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
	}
	
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




