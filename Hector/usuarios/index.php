<?php
include '../conexion.php';

$query = "SELECT * FROM Usuarios";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Lista de Usuarios</title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
   
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Usuarios</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['IDUsuario']}</td>";
                    echo "<td>{$row['NombreUsuario']}</td>";
                    echo "<td>{$row['Rol']}</td>";
                    echo "<td><a href='ver.php?id={$row['IDUsuario']}' class='btn btn-primary'>Ver</a> | <a href='editar.php?id={$row['IDUsuario']}' class='btn btn-warning'>Editar</a> | <a href='eliminar.php?id={$row['IDUsuario']}' class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="crear.php" class="btn btn-success">Crear nuevo Usuario</a>
        <a href="../admin.html" class="btn btn-secondary">Volver al Menu</a>
    </div>
</body>
</html>
