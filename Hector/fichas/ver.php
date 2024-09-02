<?php
include '../conexion.php';

// Inicializar $row como un array vacío para evitar errores
$row = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idFicha = $_GET["id"];

    $query = "SELECT Fichas.*, Sedes.NombreSede 
              FROM Fichas
              INNER JOIN Sedes ON Fichas.IDSede = Sedes.IDSede
              WHERE Fichas.IDFicha = $idFicha";
              
    $result = mysqli_query($conn, $query);
    
    // Verificar si se encontraron resultados
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Manejar el caso donde no se encontraron resultados
        echo "No se encontró la ficha con ID: $idFicha";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos2.css">

    <title>Detalles de la Ficha</title>
    <style>
 body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        a:hover {
            background-color: #0056b3;
        }    </style>
</head>
<body>
    <h2>Detalles de la Ficha</h2>
    
    <?php if (!empty($row)): ?>
        <p>ID de la Ficha: <?php echo $row['IDFicha']; ?></p>
        <p>Nombre de la Ficha: <?php echo $row['NombreFicha']; ?></p>
        <p>Descripción: <?php echo $row['Descripcion']; ?></p>
        <p>Sede: <?php echo $row['NombreSede']; ?></p>
    <?php endif; ?>
    
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
