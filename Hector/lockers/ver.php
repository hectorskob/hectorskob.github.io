<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idLocker = $_GET["id"];

    $query = "SELECT Lockers.*, Sedes.NombreSede 
              FROM Lockers
              INNER JOIN Sedes ON Lockers.IDSede = Sedes.IDSede
              WHERE Lockers.IDLocker = $idLocker";
              
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


    <title>Detalles del Locker</title>
</head>
<body>
    <h2>Detalles del Locker</h2>
    <p>ID del Locker: <?php echo $row['IDLocker']; ?></p>
    <p>Código del Locker: <?php echo $row['CodigoLocker']; ?></p>
    <p>Estado del Locker: <?php echo $row['Estado']; ?></p>
    <p>Sede del Locker: <?php echo $row['NombreSede']; ?></p>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
