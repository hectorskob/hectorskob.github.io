<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idFicha = $_GET["id"];

    $query = "SELECT * FROM Fichas WHERE IDFicha = $idFicha";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idFicha = $_POST["idFicha"];
    $nombreFicha = $_POST["nombreFicha"];
    $descripcion = $_POST["descripcion"];
    $idSede = $_POST["idSede"];

    // Corrige el nombre de la columna a 'Descripcion' en lugar de 'Descripccion'
    $query = "UPDATE Fichas 
              SET NombreFicha='$nombreFicha', Descripcion='$descripcion', IDSede=$idSede 
              WHERE IDFicha=$idFicha";
              
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <h2>Editar Ficha</h2>
    <form method="post" action="">
        <input type="hidden" name="idFicha" value="<?php echo $row['IDFicha']; ?>">
        Nombre de Ficha: <input type="text" name="nombreFicha" value="<?php echo $row['NombreFicha']; ?>" required><br>
        Descripción: <textarea name="descripcion" required><?php echo $row['Descripcion']; ?></textarea><br>
        Sede: 
        <select name="idSede" required>
            <?php
            $querySedes = "SELECT * FROM Sedes";
            $resultSedes = mysqli_query($conn, $querySedes);
            
            while ($rowSede = mysqli_fetch_assoc($resultSedes)) {
                $selected = ($rowSede['IDSede'] == $row['IDSede']) ? 'selected' : '';
                echo "<option value='{$rowSede['IDSede']}' $selected>{$rowSede['NombreSede']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <a href="index.php">Volver a la Lista</a>
</body>
</html>
