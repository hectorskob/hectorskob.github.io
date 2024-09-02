<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idAprendiz = $_GET["id"];

    $query = "SELECT Aprendices.*, Fichas.NombreFicha 
              FROM Aprendices
              INNER JOIN Fichas ON Aprendices.IDFicha = Fichas.IDFicha
              WHERE Aprendices.IDAprendiz = $idAprendiz";
              
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

    <title>Detalles del Aprendiz</title>
  
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalles del Aprendiz</h2>
        <p>ID del Aprendiz: <?php echo $row['IDAprendiz']; ?></p>
        <p>Nombre Completo: <?php echo $row['NombreAprendiz']; ?></p>
        <p>Ficha: <?php echo $row['IDFicha']; ?></p>
        <br>
        <a href="index.php">Volver a la Lista</a>
    </div>
</body>
</html>
