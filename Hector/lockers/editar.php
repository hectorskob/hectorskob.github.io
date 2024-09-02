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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLocker = $_POST["idLocker"];
    $codigoLocker = $_POST["codigoLocker"];
    $estado = $_POST["estado"];
    $idSede = $_POST["idSede"];

    $query = "UPDATE Lockers 
              SET CodigoLocker='$codigoLocker', Estado='$estado', IDSede=$idSede 
              WHERE IDLocker=$idLocker";
              
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

    <title>Editar Locker</title>
</head>
<body>
    <h2>Editar Locker</h2>
    <form method="post" action="">
        <input type="hidden" name="idLocker" value="<?php echo $row['IDLocker']; ?>">
        Código del Locker: <input type="text" name="codigoLocker" value="<?php echo $row['CodigoLocker']; ?>" required><br>
        Estado del Locker: 
        <select name="estado" required>
            <option value="Libre" <?php if($row['Estado'] == 'Libre') echo 'selected'; ?>>Libre</option>
            <option value="Ocupado" <?php if($row['Estado'] == 'Ocupado') echo 'selected'; ?>>Ocupado</option>
            <option value="Mantenimiento" <?php if($row['Estado'] == 'Mantenimiento') echo 'selected'; ?>>Mantenimiento</option>
        </select><br>
        Sede del Locker:
        <select name="idSede" required>
            <?php
            $querySedes = "SELECT * FROM Sedes";
            $resultSedes = mysqli_query($conn, $querySedes);
            
            while ($rowSede = mysqli_fetch_assoc($resultSedes)) {
                $selected = ($rowSede['IDSede'] == $row['IDSede']) ? 'selected' : '';
                echo "<option value='{$rowSede['IDSede']}' $selected>{$rowSede['NombreSede']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
