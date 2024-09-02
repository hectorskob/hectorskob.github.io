<?php
include '../conexion.php';

$idUsuario = $_GET['id'];

$queryAsignacion = "SELECT * FROM relacionusuarios WHERE IDUsuario = $idUsuario";
$resultAsignacion = mysqli_query($conn, $queryAsignacion);
$rowAsignacion = mysqli_fetch_assoc($resultAsignacion);

$queryUsuarios = "SELECT IDUsuario, NombreUsuario FROM Usuarios";
$resultUsuarios = mysqli_query($conn, $queryUsuarios);

$queryAprendices = "SELECT IDAprendiz, NombreAprendiz FROM Aprendices";
$resultAprendices = mysqli_query($conn, $queryAprendices);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuarioNuevo = $_POST["idUsuario"];
    $idAprendiz = $_POST["idAprendiz"];

    $query = "UPDATE relacionusuarios SET IDUsuario = '$idUsuarioNuevo', IDAprendiz = $idAprendiz WHERE IDUsuario = $idUsuario";
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

    <title>Editar Asignación</title>
</head>
<body>
    <h2>Editar Asignación</h2>
    <form method="post" action="">
        ID Usuario:
        <select name="idUsuario" required>
            <?php
            while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                $selected = ($rowAsignacion['IDUsuario'] == $rowUsuario['IDUsuario']) ? 'selected' : '';
                echo "<option value='{$rowUsuario['IDUsuario']}' $selected>{$rowUsuario['IDUsuario']} - {$rowUsuario['NombreUsuario']}</option>";
            }
            ?>
        </select><br>

        ID Aprendiz:
        <select name="idAprendiz" required>
            <?php
            while ($rowAprendiz = mysqli_fetch_assoc($resultAprendices)) {
                $selected = ($rowAsignacion['IDAprendiz'] == $rowAprendiz['IDAprendiz']) ? 'selected' : '';
                echo "<option value='{$rowAprendiz['IDAprendiz']}' $selected>{$rowAprendiz['IDAprendiz']} - {$rowAprendiz['NombreAprendiz']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
