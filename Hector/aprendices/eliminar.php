<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idAprendiz = $_GET["id"];

    $query = "DELETE FROM Aprendices WHERE IDAprendiz = $idAprendiz";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
