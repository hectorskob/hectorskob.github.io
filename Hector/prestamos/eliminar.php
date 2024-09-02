<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idPrestamo = $_GET["id"];

    $query = "DELETE FROM Prestamos WHERE IDPrestamo = $idPrestamo";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
