<?php
include '../conexion.php';

$query = "SELECT * FROM Sedes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Sedes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .table {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="my-4">Lista de Sedes</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre de la Sede</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['IDSede']}</td>";
                echo "<td>{$row['NombreSede']}</td>";
                echo "<td>";
                echo "<a href='ver.php?id={$row['IDSede']}' class='btn btn-info btn-custom'>Ver</a>";
                echo "<a href='editar.php?id={$row['IDSede']}' class='btn btn-warning btn-custom'>Editar</a>";
                echo "<a href='eliminar.php?id={$row['IDSede']}' class='btn btn-danger btn-custom'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="crear.php" class="btn btn-success">Crear nueva Sede</a>
    <a href="../admin.html" class="btn btn-secondary">Volver al Menu</a>
</div>

<!-- Agregar el script de Bootstrap (jQuery y Popper.js son requeridos por Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
