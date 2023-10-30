<!DOCTYPE html>
<html>
<head>
    <title>Mostrar Datos de la Base de Datos "Oficina"</title>
</head>
<body>

<form method="post" action="menuadmin.php">
        <input type="submit" value="Menú principal">
    </form>
</body>

    <?php
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "oficina";

    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener datos de "tabla1"
    $query1 = "SELECT * FROM tabla1";
    $result1 = $conn->query($query1);

    // Consulta SQL para obtener datos de "tabla2"
    $query2 = "SELECT * FROM tabla2";
    $result2 = $conn->query($query2);

    // Mostrar los resultados en tablas HTML
    echo "<h1>Tabla 1</h1>";
    echo "<table border='2'>";
    echo "<tr><th>Dato</th></tr>";
    while ($row = $result1->fetch_assoc()) {
        echo "<tr><td>" . $row["dato1"] . "</td></tr>";
    }
    echo "</table>";

    echo "<h1>Tabla 2</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Dato</th></tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr><td>" . $row["dato2"] . "</td></tr>";
    }
    echo "</table>";
	
	// Consulta SQL para realizar un LEFT JOIN entre tabla1 y tabla2
    $leftJoinQuery = "SELECT * FROM tabla1 LEFT JOIN tabla2 ON dato1 = dato2
	order by dato1 ASC";

    // Consulta SQL para realizar un RIGHT JOIN entre tabla1 y tabla2
    $rightJoinQuery = "SELECT * FROM tabla1 RIGHT JOIN tabla2 ON dato1 = dato2";

    // Resultados del LEFT JOIN
    $leftJoinResult = $conn->query($leftJoinQuery);

    // Resultados del RIGHT JOIN
    $rightJoinResult = $conn->query($rightJoinQuery);

    // Mostrar los resultados en tablas HTML
    echo "<h1>LEFT JOIN</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Dato1</th><th>Dato2</th></tr>";
    while ($row = $leftJoinResult->fetch_assoc()) {
        echo "<tr><td>" . $row["dato1"] . "</td><td>" . $row["dato2"] . "</td></tr>";
    }
    echo "</table>";

    echo "<h1>RIGHT JOIN</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Dato1</th><th>Dato2</th></tr>";
    while ($row = $rightJoinResult->fetch_assoc()) {
        echo "<tr><td>" . $row["dato1"] . "</td><td>" . $row["dato2"] . "</td></tr>";
    }
    echo "</table>";
	
	//FULL JOIN
	$query = "SELECT * FROM tabla1 LEFT JOIN tabla2 ON dato1 = dato2
UNION
SELECT * FROM tabla1 RIGHT JOIN tabla2 ON dato1 = dato2
order by dato2 asc;";
	$queryresultado = $conn->query($query);
	echo "<h1>FULL JOIN (left join union right join)</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Dato1</th><th>Dato2</th></tr>";
    while ($row = $queryresultado->fetch_assoc()) {
        echo "<tr><td>" . $row["dato1"] . "</td><td>" . $row["dato2"] . "</td></tr>";
    }
    echo "</table>";

	//estructura para tablas
	//$queryresultado = $conn->query($query);
	echo "<h1>Titulo</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Dato1</th><th>Dato2</th></tr>";
    while ($row = $queryresultado->fetch_assoc()) {
        echo "<tr><td>" . $row["dato1"] . "</td><td>" . $row["dato2"] . "</td></tr>";
    }
    echo "</table>";
	
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "porteria";

    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
	//Guardar valor de una consulta en una variable
	$consulta="select 1+1 as Columna";
	if($row = mysqli_fetch_assoc(mysqli_query($conn,$consulta))){
		$var = $row['Columna'];
	}
	echo $var;
    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
</body>
</html>