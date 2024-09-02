<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idUsuario = $_GET["id"];

    $query = "SELECT * FROM Usuarios WHERE IDUsuario = $idUsuario";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];

    $query = "UPDATE Usuarios 
              SET NombreUsuario='$nombreUsuario', Contraseña='$contrasena', Rol='$rol' 
              WHERE IDUsuario=$idUsuario";

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

    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form method="post" action="">
        ID Usuario: <input type="text" name="idUsuario" value="<?php echo $row['IDUsuario']; ?>" readonly><br>
        Nombre Usuario: <input type="text" name="nombreUsuario" value="<?php echo $row['NombreUsuario']; ?>" required><br>
        Contraseña: <input type="password" name="contrasena" value="<?php echo $row['Contraseña']; ?>" required><br>
        Rol: 
        <select name="rol" required>
            <option value="Administrador" <?php if ($row['Rol'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
            <option value="Aprendiz" <?php if ($row['Rol'] == 'Aprendiz') echo 'selected'; ?>>Aprendiz</option>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
