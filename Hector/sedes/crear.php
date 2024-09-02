<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreSede = $_POST["nombreSede"];

    $query = "INSERT INTO Sedes (NombreSede) VALUES ('$nombreSede')";
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

    <title>Crear Nueva Sede</title>
</head>
<body>
    <h2>Crear Nueva Sede</h2>
    <form method="post" action="">
        Nombre de la Sede: <input type="text" name="nombreSede" required><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
