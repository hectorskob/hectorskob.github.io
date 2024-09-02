<?php
include '../conexion.php';

$query = "SELECT Lockers.*, Sedes.NombreSede 
          FROM Lockers
          INNER JOIN Sedes ON Lockers.IDSede = Sedes.IDSede";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Lista de Lockers</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Lockers</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Estado</th>
                    <th>Sede</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['IDLocker']}</td>";
                    echo "<td>{$row['CodigoLocker']}</td>";
                    echo "<td>{$row['Estado']}</td>";
                    echo "<td>{$row['NombreSede']}</td>";
                    echo "<td><a href='ver.php?id={$row['IDLocker']}' class='btn btn-primary'>Ver</a> | <a href='editar.php?id={$row['IDLocker']}' class='btn btn-warning'>Editar</a> | <a href='eliminar.php?id={$row['IDLocker']}' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="crear.php" class="btn btn-success">Crear nuevo Locker</a>
        <a href="../admin.html" class="btn btn-secondary">Volver al Menú</a>
    </div>
</body>
</html>
