<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];

    $query = "INSERT INTO Usuarios (NombreUsuario, Contraseña, Rol) VALUES ('$nombreUsuario', '$contrasena', '$rol')";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Crear Nuevo Usuario</title>
</head>
<body>
    <h2>Crear Nuevo Usuario</h2>
    <form method="post" action="">
        Nombre Usuario: <input type="text" name="nombreUsuario" required><br>
        Contraseña: <input type="password" name="contrasena" required><br>
        Rol: 
        <select name="rol" required>
            <option value="Administrador">Administrador</option>
            <option value="Aprendiz">Aprendiz</option>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
