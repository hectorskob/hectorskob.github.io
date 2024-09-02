<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idaprendiz = isset($_POST["idaprendiz"]) ? $_POST["idaprendiz"] : '';
    $nombreAprendiz = $_POST["nombreAprendiz"];
    $idFicha = $_POST["idFicha"];
    $nombreUsuario = $_POST["nombreUsuario"];
    $contraseña = $_POST["contraseña"];

    // Insertar en la tabla Aprendices
    $queryAprendiz = "INSERT INTO Aprendices (IDAprendiz, NombreAprendiz, IDFicha) VALUES ('$idaprendiz', '$nombreAprendiz', $idFicha)";
    mysqli_query($conn, $queryAprendiz);

    // Obtener el ID generado para el nuevo aprendiz
    $idAprendizGenerado = mysqli_insert_id($conn);

    // Insertar en la tabla Usuarios
    $queryUsuario = "INSERT INTO Usuarios (NombreUsuario, Contraseña, Rol) VALUES ('$nombreUsuario', '$contraseña', 'Aprendiz')";
    mysqli_query($conn, $queryUsuario);

    // Obtener el ID generado para el nuevo usuario
    $idUsuarioGenerado = mysqli_insert_id($conn);

    // Insertar en la tabla RelacionUsuarios
    $queryRelacion = "INSERT INTO RelacionUsuarios (IDUsuario, IDAprendiz) VALUES ($idUsuarioGenerado, $idAprendizGenerado)";
    mysqli_query($conn, $queryRelacion);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">

    <title>Crear Nuevo Aprendiz</title>

    <!-- Agregar enlaces a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Crear Nuevo Aprendiz</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="idaprendiz">Documento de Identidad:</label>
            <input type="text" class="form-control" name="idaprendiz" required>
        </div>
        <div class="form-group">
            <label for="nombreAprendiz">Nombre Completo:</label>
            <input type="text" class="form-control" name="nombreAprendiz" required>
        </div>
        <div class="form-group">
            <label for="idFicha">Ficha:</label>
            <select class="form-control" name="idFicha" required>
                <?php
                $queryFichas = "SELECT * FROM Fichas";
                $resultFichas = mysqli_query($conn, $queryFichas);

                while ($rowFicha = mysqli_fetch_assoc($resultFichas)) {
                    echo "<option value='{$rowFicha['IDFicha']}'>{$rowFicha['NombreFicha']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nombreUsuario">Nombre de Usuario:</label>
            <input type="text" class="form-control" name="nombreUsuario" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <input type="password" class="form-control" name="contraseña" required>
        </div>
        <button type="submit" class="btn btn-sena-green">Guardar</button>
    </form>
    <br>
    <a href="index.php" class="btn btn-sena-orange">Volver a la Lista</a>
</div>

<!-- Agregar el script de Bootstrap (jQuery y Popper.js son requeridos por Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
