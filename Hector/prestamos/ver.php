<?php
include '../conexion.php';

$idPrestamo = $_GET['id'];

$queryPrestamo = "SELECT Prestamos.*, Lockers.CodigoLocker, Aprendices.NombreAprendiz 
                  FROM Prestamos 
                  JOIN Lockers ON Prestamos.IDLocker = Lockers.IDLocker
                  JOIN Aprendices ON Prestamos.IDAprendiz = Aprendices.IDAprendiz
                  WHERE IDPrestamo = $idPrestamo";

$resultPrestamo = mysqli_query($conn, $queryPrestamo);

if ($rowPrestamo = mysqli_fetch_assoc($resultPrestamo)) {
    $codigoLocker = $rowPrestamo['CodigoLocker'];
    $nombreAprendiz = $rowPrestamo['NombreAprendiz'];
    $fechaInicio = $rowPrestamo['FechaInicio'];
    $fechaFin = $rowPrestamo['FechaFin'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos2.css">

    <title>Ver Préstamo</title>
</head>
<body>
    <h2>Detalles del Préstamo</h2>
    <p><strong>ID Locker:</strong> <?php echo $codigoLocker; ?></p>
    <p><strong>Nombre Aprendiz:</strong> <?php echo $nombreAprendiz; ?></p>
    <p><strong>Fecha Inicio:</strong> <?php echo $fechaInicio; ?></p>
    <p><strong>Fecha Fin:</strong> <?php echo $fechaFin; ?></p>

    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>

<?php
} else {
    echo "No se encontró el préstamo.";
}
?>
