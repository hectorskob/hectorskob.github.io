<?php
include '../conexion.php';

$idUsuario = $_GET['id'];

$query = "DELETE FROM relacionusuarios WHERE IDUsuario = $idUsuario";
mysqli_query($conn, $query);

header("Location: index.php");
?>
