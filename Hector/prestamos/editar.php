<?php
include '../conexion.php';

$queryLockers = "SELECT IDLocker, CodigoLocker FROM Lockers";
$resultLockers = mysqli_query($conn, $queryLockers);

$queryAprendices = "SELECT NombreAprendiz FROM Aprendices";
$resultAprendices = mysqli_query($conn, $queryAprendices);
$idPrestamo = $_GET['id'];

$queryPrestamo = "SELECT * FROM Prestamos WHERE IDPrestamo = $idPrestamo";
$resultPrestamo = mysqli_query($conn, $queryPrestamo);
$rowPrestamo = mysqli_fetch_assoc($resultPrestamo);

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

            $query = "UPDATE Prestamos 
                      SET IDLocker = $idLocker, 
                          IDAprendiz = $idAprendiz, 
                          FechaInicio = '$fechaInicio', 
                          FechaFin = '$fechaFin' 
                      WHERE IDPrestamo = $idPrestamo";
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

    <title>Editar Préstamo</title>
</head>
<body>
    <h2>Editar Préstamo</h2>
    <form method="post" action="">
        ID Locker:
        <select name="idLocker" required>
            <?php
            while ($rowLocker = mysqli_fetch_assoc($resultLockers)) {
                $selected = ($rowPrestamo['IDLocker'] == $rowLocker['IDLocker']) ? 'selected' : '';
                echo "<option value='{$rowLocker['IDLocker']}' $selected>{$rowLocker['IDLocker']} - {$rowLocker['CodigoLocker']}</option>";
            }
            ?>
        </select><br>

        Nombre Aprendiz:
        <select name="nombreAprendiz" required>
            <?php
            while ($rowAprendiz = mysqli_fetch_assoc($resultAprendices)) {
                $selected = ($rowPrestamo['IDAprendiz'] == $rowAprendiz['IDAprendiz']) ? 'selected' : '';
                echo "<option value='{$rowAprendiz['NombreAprendiz']}' $selected>{$rowAprendiz['NombreAprendiz']}</option>";
            }
            ?>
        </select><br>

        Fecha Inicio: <input type="date" name="fechaInicio" value="<?php echo $rowPrestamo['FechaInicio']; ?>" required><br>
        Fecha Fin: <input type="date" name="fechaFin" value="<?php echo $rowPrestamo['FechaFin']; ?>" required><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
