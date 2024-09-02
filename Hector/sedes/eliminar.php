<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idSede = $_GET["id"];

    $query = "DELETE FROM Sedes WHERE IDSede = $idSede";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
