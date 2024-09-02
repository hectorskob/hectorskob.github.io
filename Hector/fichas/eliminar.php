<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idFicha = $_GET["id"];

    $query = "DELETE FROM Fichas WHERE IDFicha = $idFicha";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
