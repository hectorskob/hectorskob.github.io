<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idUsuario = $_GET["id"];

    $query = "DELETE FROM Usuarios WHERE IDUsuario = $idUsuario";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
