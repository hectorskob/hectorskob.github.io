<?php
include '../conexion.php';

$querySedes = "SELECT * FROM Sedes";
$resultSedes = mysqli_query($conn, $querySedes);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoLocker = $_POST["codigoLocker"];
    $estado = $_POST["estado"];
    $idSede = $_POST["idSede"]; 

    $query = "INSERT INTO Lockers (CodigoLocker, Estado, IDSede) VALUES ('$codigoLocker', '$estado', $idSede)";
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

    <title>Crear Nuevo Locker</title>
</head>
<body>
    <h2>Crear Nuevo Locker</h2>
    <form method="post" action="">
        Código del Locker: <input type="text" name="codigoLocker" required><br>
        Estado del Locker: 
        <select name="estado" required>
            <option value="Libre">Libre</option>
            <option value="Ocupado">Ocupado</option>
            <option value="Mantenimiento">Mantenimiento</option>
        </select><br>
        Sede del Locker:
        <select name="idSede" required>
            <?php
            while ($rowSede = mysqli_fetch_assoc($resultSedes)) {
                echo "<option value='{$rowSede['IDSede']}'>{$rowSede['NombreSede']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
