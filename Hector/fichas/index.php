<?php
include '../conexion.php';

$query = "SELECT Fichas.*, Sedes.NombreSede 
          FROM Fichas
          INNER JOIN Sedes ON Fichas.IDSede = Sedes.IDSede";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Lista de Fichas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <style>
        body {
            background-color: #ffffff; /* verde */
            color: #ff8c00; /* naranja */
        }
        h2 {
            color: #ffffff; /* blanco */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ffffff; /* blanco */
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff; /* azul */
            color: #ffffff; /* blanco */
        }
        a {
            color: #ffffff; /* blanco */
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Fichas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Ficha</th>
                    <th>Descripción</th>
                    <th>Sede</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['IDFicha']}</td>";
                    echo "<td>{$row['NombreFicha']}</td>";
                    echo "<td>{$row['Descripcion']}</td>";
                    echo "<td>{$row['NombreSede']}</td>";
                    echo "<td><a href='ver.php?id={$row['IDFicha']}' class='btn btn-primary'>Ver</a> | <a href='editar.php?id={$row['IDFicha']}' class='btn btn-warning'>Editar</a> | <a href='eliminar.php?id={$row['IDFicha']}' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="crear.php" class="btn btn-success">Crear nueva Ficha</a>
        <a href="../admin.html" class="btn btn-secondary">Volver al Menu</a>
    </div>
</body>
</html>
