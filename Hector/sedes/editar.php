<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idSede = $_GET["id"];

    $query = "SELECT * FROM Sedes WHERE IDSede = $idSede";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSede = $_POST["idSede"];
    $nombreSede = $_POST["nombreSede"];

    $query = "UPDATE Sedes SET NombreSede='$nombreSede' WHERE IDSede=$idSede";
    mysqli_query($conn, $query);
    header("Location: index_sedes.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Editar Sede</title>
</head>
<body>
    <h2>Editar Sede</h2>
    <form method="post" action="">
        <input type="hidden" name="idSede" value="<?php echo $row['IDSede']; ?>">
        Nombre de la Sede: <input type="text" name="nombreSede" value="<?php echo $row['NombreSede']; ?>" required><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
