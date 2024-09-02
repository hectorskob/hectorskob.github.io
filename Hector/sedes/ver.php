<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idSede = $_GET["id"];

    $query = "SELECT * FROM Sedes WHERE IDSede = $idSede";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Detalles de la Sede</title>
</head>
<body>
    <h2>Detalles de la Sede</h2>
    <p>ID de la Sede: <?php echo $row['IDSede']; ?></p>
    <p>Nombre de la Sede: <?php echo $row['NombreSede']; ?></p>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
