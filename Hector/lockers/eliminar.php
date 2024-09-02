<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idLocker = $_GET["id"];

    // Eliminar registros relacionados en la tabla prestamos
    $queryPrestamos = "DELETE FROM prestamos WHERE IDLocker = $idLocker";
    mysqli_query($conn, $queryPrestamos);

    // Ahora eliminar el locker
    $queryLockers = "DELETE FROM lockers WHERE IDLocker = $idLocker";
    mysqli_query($conn, $queryLockers);

    header("Location: index.php");
}
?>
