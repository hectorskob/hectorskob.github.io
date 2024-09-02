<?php
include 'conexion.php';

// Consulta para obtener todos los casilleros junto con la sede
$sql = "
    SELECT lockers.IDLocker, lockers.CodigoLocker, lockers.Estado, sedes.NombreSede
    FROM lockers
    JOIN sedes ON lockers.IDSede = sedes.IDSede
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Casilleros</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .locker-list {
            list-style-type: none;
            padding: 0;
        }
        .locker-list li {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .locker-details {
            display: flex;
            flex-direction: column;
        }
        .locker-buttons form {
            display: inline-block;
        }
        .btn-reserve {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            margin-right: 5px;
        }
        .btn-return {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
<?php
// ...

while($row = $result->fetch_assoc()) {
    echo "<li>";
    echo "<div class='locker-details'>";
    echo "<span>ID: " . $row["IDLocker"]. " - Código: " . $row["CodigoLocker"]. "</span>";
    echo "<span>Estado: " . $row["Estado"] . "</span>";
    echo "<span>Sede: " . $row["NombreSede"] . "</span>";
    echo "</div>";
    echo "<div class='locker-buttons'>";

    // Mostrar botón para reservar solo si el casillero está libre
    if ($row["Estado"] == "Libre") {
        echo "<form action='reservar.php' method='post'>";
        echo "<input type='hidden' name='casillero_id' value='" . $row["IDLocker"] . "'>";
        echo "<button type='submit' name='submit' class='btn btn-reserve'>Reservar</button>";
        echo "</form>";
    } elseif ($row["Estado"] == "Ocupado") {
        // Mostrar formulario para devolver el casillero solo si está ocupado
        echo "<form action='devolver.php' method='post'>";
        echo "<input type='hidden' name='casillero_id' value='" . $row["IDLocker"] . "'>";
        echo "<button type='submit' name='submit' class='btn btn-return'>Devolver</button>";
        echo "</form>";
    } elseif ($row["Estado"] == "Mantenimiento") {
        echo "<span class='text-danger'>Mantenimiento</span>";
    }

    echo "</div>";
    echo "</li>";
}

// ...
?>
</div>

<div class="container mt-4">
    <form action="reservar.php" method="post">
        <div class="form-group">
            <label for="casillero_id">Selecciona un casillero por su ID:</label>
            <input type="text" class="form-control" id="casillero_id" name="casillero_id">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Reservar Casillero</button>
    </form>
</div>

<!-- Agregar el script de Bootstrap (jQuery y Popper.js son requeridos por Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
