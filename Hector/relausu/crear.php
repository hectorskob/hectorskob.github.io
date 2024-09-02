<?php
include '../conexion.php';

$queryUsuarios = "SELECT IDUsuario, NombreUsuario FROM Usuarios";
$resultUsuarios = mysqli_query($conn, $queryUsuarios);

$queryAprendices = "SELECT IDAprendiz, NombreAprendiz FROM Aprendices";
$resultAprendices = mysqli_query($conn, $queryAprendices);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];
    $idAprendiz = $_POST["idAprendiz"];

    $query = "INSERT INTO relacionusuarios (IDUsuario, IDAprendiz) VALUES ('$idUsuario', $idAprendiz)";
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

    <title>Asignar Aprendiz a Usuario</title>
</head>
<body>
    <h2>Asignar Aprendiz a Usuario</h2>
    <form method="post" action="">
        ID Usuario:
        <select name="idUsuario" required>
            <?php
            while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                echo "<option value='{$rowUsuario['IDUsuario']}'>{$rowUsuario['IDUsuario']} - {$rowUsuario['NombreUsuario']}</option>";
            }
            ?>
        </select><br>

        ID Aprendiz:
        <select name="idAprendiz" required>
            <?php
            while ($rowAprendiz = mysqli_fetch_assoc($resultAprendices)) {
                echo "<option value='{$rowAprendiz['IDAprendiz']}'>{$rowAprendiz['IDAprendiz']} - {$rowAprendiz['NombreAprendiz']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Asignar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
