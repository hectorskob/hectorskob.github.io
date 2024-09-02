<?php
include '../conexion.php';

$query = "SELECT * FROM Prestamos";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Lista de Préstamos</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
    
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Préstamos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Préstamo</th>
                    <th>ID Locker</th>
                    <th>ID Aprendiz</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['IDPrestamo']}</td>";
                    echo "<td>{$row['IDLocker']}</td>";
                    echo "<td>{$row['IDAprendiz']}</td>";
                    echo "<td>{$row['FechaInicio']}</td>";
                    echo "<td>{$row['FechaFin']}</td>";
                    echo "<td><a href='ver.php?id={$row['IDPrestamo']}' class='btn btn-primary'>Ver</a> | <a href='editar.php?id={$row['IDPrestamo']}' class='btn btn-warning'>Editar</a> | <a href='eliminar.php?id={$row['IDPrestamo']}' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="crear.php" class="btn btn-success">Crear nuevo Préstamo</a>
        <a href="../admin.html" class="btn btn-secondary">Volver al Menú</a>
    </div>
</body>
</html>
