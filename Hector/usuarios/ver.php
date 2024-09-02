<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idUsuario = $_GET["id"];

    $query = "SELECT * FROM Usuarios WHERE IDUsuario = $idUsuario";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos2.css">

    <title>Detalles del Usuario</title>
</head>
<body>
    <h2>Detalles del Usuario</h2>
    <p>ID Usuario: <?php echo $row['IDUsuario']; ?></p>
    <p>Nombre Usuario: <?php echo $row['NombreUsuario']; ?></p>
    <p>Rol: <?php echo $row['Rol']; ?></p>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
