<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$server = "localhost"; 
	$user = "root";
	$password = ""; 
	$database = "porteria";

	$conexion = new mysqli($server, $user, $password, $database);
		if ($conexion->connect_error) {
			die("Error al conectar con la base de datos " . $conexion->connect_error);
		}

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario' AND contraseña = '$contrasena'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $tipoUsuario = $row["nombreUsuario"];

        // Redirige al usuario según el tipo de usuario.
        if ($tipoUsuario === "admin") {
            header("Location: menuadmin/menuadmin.php");
        } elseif ($tipoUsuario === "portero") {
            header("Location: menuportero/menuportero.php");
        }
    } else {
        // Usuario o contraseña incorrectos
		echo '<script type="text/javascript">alert("USUARIO O CONTRASEÑA INCORRECTO(S)");</script>';
        header("Location: inicio.php");
    }

    // Cierra la conexión a la base de datos.
    mysqli_close($conexion);
}
?>