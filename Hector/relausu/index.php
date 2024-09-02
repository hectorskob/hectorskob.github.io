<?php
include '../conexion.php';

$queryAsignaciones = "SELECT relacionusuarios.*, Usuarios.NombreUsuario, Aprendices.NombreAprendiz 
                     FROM relacionusuarios 
                     JOIN Usuarios ON relacionusuarios.IDUsuario = Usuarios.IDUsuario
                     JOIN Aprendices ON relacionusuarios.IDAprendiz = Aprendices.IDAprendiz";

$resultAsignaciones = mysqli_query($conn, $queryAsignaciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Lista de Asignaciones</title>
</head>
<body><center>
    <h2>Lista de Asignaciones</h2>
    <table border="1">
        <tr>
            <th>ID Usuario</th>
            <th>Nombre Usuario</th>
            <th>ID Aprendiz</th>
            <th>Nombre Aprendiz</th>
            <th>Acciones</th>
            </center>
        </tr>
        <?php
        while ($rowAsignacion = mysqli_fetch_assoc($resultAsignaciones)) {
            echo "<tr>";
            echo "<td>{$rowAsignacion['IDUsuario']}</td>";
            echo "<td>{$rowAsignacion['NombreUsuario']}</td>";
            echo "<td>{$rowAsignacion['IDAprendiz']}</td>";
            echo "<td>{$rowAsignacion['NombreAprendiz']}</td>";
            echo "<td><a href='editar.php?id={$rowAsignacion['IDUsuario']}'>Editar</a> | <a href='eliminar.php?id={$rowAsignacion['IDUsuario']}'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <a href="crear.php">Crear Asignación</a>
    <a href="../admin.html">Volver al Menu</a>

</body>
</html>
