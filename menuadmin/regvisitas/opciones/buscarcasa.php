<html>
<head>

</head>

<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";
$conexion = new mysqli($server, $user, $password, $database);
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}

	//session_start();
	//echo "<h1>Porteros</h1>";
	//if($_SESSION['paganterior']=='Visitas'){	
	//	$idpropietario = $_POST['idvisitante'];
	//}else if ($_SESSION['paganterior']=='Vehiculos'){
	$lugarvisita = $_POST['lugarvisita'];
	//}else{$idpropietario = $_POST['idpropietario'];}
	
	if($lugarvisita == '' || $lugarvisita == NULL){
		echo "ERROR: Ingrese una Casa";
	}else{
		//Ver si el propietario existe en la DB
		$resultadocasa = $conexion->query
		("select comprobarExistenciaCasa($lugarvisita) as Resultado")
		->fetch_assoc()['Resultado'];
		if($resultadocasa == 0){
			echo "La casa seleccionada no tiene propietario<br>";
		}else{
			//Mostrando casas
			echo "<h1>Casas</h1>";

			echo "<table border='1'>";
			echo "<tr><th>idCasa</th><th>idPropietario</th><th>nombreResidente</th></tr>";

			$reg_casas = mysqli_query($conexion, "select * from Casas left join Residentes on idPropietario = idResidente where idCasa = $lugarvisita") or
				die("Problemas en el select:" . mysqli_error($conexion));
			while ($reg = mysqli_fetch_array($reg_casas)) {
				echo "<tr><td>" . $reg["idCasa"] . "</td><td>" .
				$reg["idPropietario"] . "</td><td>" .
				$reg["nombreResidente"]. "</td></tr>";
			}
			echo "</table>";
			echo "<hr>";
		}
		$resultadoresidente = $conexion->query
		("select comprobarResidentesCasa($lugarvisita) as Resultado")
		->fetch_assoc()['Resultado'];
		if($resultadoresidente == 0){
			echo "La casa seleccionada no tiene residentes<br>";
		}else{
			//Mostrando residentes
			echo "<h1>Residentes</h1>";

			echo "<table border='1'>";
			echo "<tr><th>idResidente</th><th>nombreResidente</th><th>telResidente</th><th>casaResidente</th></tr>";

			$reg_residentes = mysqli_query($conexion, "select * from Residentes where casaResidente = $lugarvisita") or
				die("Problemas en el select:" . mysqli_error($conexion));
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
		
		
	}
	
?>
</body>
</html>