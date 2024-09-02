<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreFicha = $_POST["nombreFicha"];
    $descripcion = $_POST["descripcion"];
    $IDSede = $_POST["IDSede"];

    $query = "INSERT INTO fichas (NombreFicha, Descripcion, IDSede) VALUES ('$nombreFicha', '$descripcion', $IDSede)";
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

    <title>Crear Nueva Ficha</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
        body {
            background-color: #28a745;
            color: #ff8c00;
        }
        h2 {
            color: #ffffff;
        }
        form {
            margin: 20px 0;
        }
        input[type="text"], textarea, select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ffffff;
            border-radius: 4px;
            background-color: #ffffff; 
            color: #495057; 
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            color: #ffffff; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Crear Nueva Ficha</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nombreFicha">Nombre de Ficha:</label>
                <input type="text" class="form-control" id="nombreFicha" name="nombreFicha" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="IDSede">Sede:</label>
                <select class="form-control" id="IDSede" name="IDSede" required>
                    <?php
                    $querySedes = "SELECT * FROM Sedes";
                    $resultSedes = mysqli_query($conn, $querySedes);
                    
                    while ($rowSede = mysqli_fetch_assoc($resultSedes)) {
                        echo "<option value='{$rowSede['IDSede']}'>{$rowSede['NombreSede']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-secondary">Volver a la Lista</a>
    </div>
</body>
</html>
