<html>

<head>
	<title>BD porteria</title>
</head>

<body>
<form method="post" action="../menuadmin.php">
        <input type="submit" value="Menú principal">
    </form>
	
<form method="post" action="insertar_portero.php"
	target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">
    <!-- Campo ID del portero -->
    <label for="idportero">ID del Portero:</label>
    <input type="text" name="idportero" id="idportero" required>
	<input type="submit" name="eliminar" value="Eliminar" formaction="eliminar_portero.php" >
    <br>

    <!-- Campo Nombre del portero -->
    <label for="nombreportero">Nombre del Portero:</label>
    <input type="text" name="nombreportero" id="nombreportero">
    <br>

    <!-- Campo Horario del portero -->
    <label for="horarioportero">Horario del Portero:</label>
    <input type="text" name="horarioportero" id="horarioportero">
    <br>

    <!-- Botones -->
    <input type="submit" name="agregar" value="Agregar">
    
    <input type="submit" name="modificar" value="Modificar" formaction="modificar_portero.php">
	<br>
	
	
	
</form>

<!-- Mostrar tabla porteros -->
	<form method="post" action="tablas_portero.php" 
	  target="popup" onsubmit="window.open('', 'popup', 'width=700,height=600');">

        <input type="submit" name="submit" value="Mostrar porteros">
    </form>


<?php
$server = "localhost"; 
$user = "root";
$password = ""; 
$database = "porteria";
$conexion = new mysqli($server, $user, $password, $database);

if ($conexion->connect_error) {
    die("Error al conectar con la base de datos " . $conexion->connect_error);
}

$conexion->close();

?>

</body>
</html>




