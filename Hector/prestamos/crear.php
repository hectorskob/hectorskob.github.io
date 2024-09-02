<?php
include '../conexion.php';

$queryLockers = "SELECT IDLocker, CodigoLocker FROM Lockers";
$resultLockers = mysqli_query($conn, $queryLockers);

$queryAprendices = "SELECT NombreAprendiz FROM Aprendices";
$resultAprendices = mysqli_query($conn, $queryAprendices);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLocker = $_POST["idLocker"];
    $nombreAprendiz = $_POST["nombreAprendiz"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];

    $queryLockerCodigo = "SELECT CodigoLocker FROM Lockers WHERE IDLocker = $idLocker";
    $resultLockerCodigo = mysqli_query($conn, $queryLockerCodigo);
    
    if ($rowLockerCodigo = mysqli_fetch_assoc($resultLockerCodigo)) {
        $codigoLocker = $rowLockerCodigo['CodigoLocker'];
        
        $queryAprendizID = "SELECT IDAprendiz FROM Aprendices WHERE NombreAprendiz = '$nombreAprendiz'";
        $resultAprendizID = mysqli_query($conn, $queryAprendizID);
        
        if ($rowAprendizID = mysqli_fetch_assoc($resultAprendizID)) {
            $idAprendiz = $rowAprendizID['IDAprendiz'];

            $query = "INSERT INTO Prestamos (IDLocker, IDAprendiz, FechaInicio, FechaFin) 
                      VALUES ('$idLocker', $idAprendiz, '$fechaInicio', '$fechaFin')";
            mysqli_query($conn, $query);
            header("Location: index.php");
        } else {
            echo "Error al obtener el ID del aprendiz.";
        }
    } else {
        echo "Error al obtener el CodigoLocker del locker.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Crear Nuevo Préstamo</title>
</head>
<body>
    <h2>Crear Nuevo Préstamo</h2>
    <form method="post" action="">
        ID Locker:
        <select name="idLocker" required>
            <?php
            while ($rowLocker = mysqli_fetch_assoc($resultLockers)) {
                echo "<option value='{$rowLocker['IDLocker']}'>{$rowLocker['IDLocker']} - {$rowLocker['CodigoLocker']}</option>";
            }
            ?>
        </select><br>

        Nombre Aprendiz:
        <select name="nombreAprendiz" required>
            <?php
            while ($rowAprendiz = mysqli_fetch_assoc($resultAprendices)) {
                echo "<option value='{$rowAprendiz['NombreAprendiz']}'>{$rowAprendiz['NombreAprendiz']}</option>";
            }
            ?>
        </select><br>

        Fecha Inicio: <input type="date" name="fechaInicio" required><br>
        Fecha Fin: <input type="date" name="fechaFin" required><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
