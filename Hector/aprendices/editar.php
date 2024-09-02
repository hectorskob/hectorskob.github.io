<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idAprendiz = $_GET["id"];

    $query = "SELECT Aprendices.*, Fichas.Descripcion AS DescripcionFicha
              FROM Aprendices
              INNER JOIN Fichas ON Aprendices.IDFicha = Fichas.IDFicha
              WHERE Aprendices.IDAprendiz = $idAprendiz";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAprendiz = $_POST["idAprendiz"];
    $nombreAprendiz = $_POST["nombreAprendiz"];
    $idFicha = $_POST["idFicha"];

    $query = "UPDATE Aprendices 
              SET NombreAprendiz='$nombreAprendiz', IDFicha=$idFicha 
              WHERE IDAprendiz=$idAprendiz";

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

    <title>Editar Aprendiz</title>
</head>
<body>
    <h2>Editar Aprendiz</h2>
    <form method="post" action="">
        ID Aprendiz: <input type="text" name="idAprendiz" value="<?php echo $row['IDAprendiz']; ?>" readonly><br>
        Nombre Completo: <input type="text" name="nombreAprendiz" value="<?php echo $row['NombreAprendiz']; ?>" required><br>
        Ficha:
        <select name="idFicha" required>
            <?php
            $queryFichas = "SELECT * FROM Fichas";
            $resultFichas = mysqli_query($conn, $queryFichas);
            
            while ($rowFicha = mysqli_fetch_assoc($resultFichas)) {
                $selected = ($rowFicha['IDFicha'] == $row['IDFicha']) ? 'selected' : '';
                echo "<option value='{$rowFicha['IDFicha']}' $selected>{$rowFicha['Descripcion']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
