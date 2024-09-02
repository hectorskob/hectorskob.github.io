<?php
include '../conexion.php';

$query = "SELECT Aprendices.*, Fichas.NombreFicha 
          FROM Aprendices
          INNER JOIN Fichas ON Aprendices.IDFicha = Fichas.IDFicha";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Lista de Aprendices</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Aprendices</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Documento de Identidad</th>
                    <th>Nombre Completo</th>
                    <th>Ficha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['IDAprendiz']}</td>";
                    echo "<td>{$row['NombreAprendiz']}</td>";
                    echo "<td>{$row['NombreFicha']}</td>";
                    echo "<td><a href='ver.php?id={$row['IDAprendiz']}' class='btn btn-info'>Ver</a> | <a href='editar.php?id={$row['IDAprendiz']}' class='btn btn-warning'>Editar</a> | <a href='eliminar.php?id={$row['IDAprendiz']}' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="crear.php" class="btn btn-success">Crear nuevo Aprendiz</a>
        <a href="../admin.html" class="btn btn-primary">Volver al Menú</a>
    </div>
</body>
</html>
