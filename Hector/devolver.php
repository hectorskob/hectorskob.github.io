<?php
include 'conexion.php';

try {
    // Verificar si la solicitud es POST y el parámetro casillero_id está presente
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['casillero_id'])) {
        $casillero_id = $_POST['casillero_id'];

        // Validar que casillero_id sea un entero
        if (!is_numeric($casillero_id)) {
            throw new Exception("ID de casillero no válido.");
        }

        // Actualizar el estado del casillero a 'Libre'
        $actualizar_sql = "UPDATE lockers SET Estado = 'Libre' WHERE IDLocker = $casillero_id";
        if (!$conn->query($actualizar_sql)) {
            throw new Exception("Error al actualizar el estado del casillero: " . $conn->error);
        }

        // Marcar el préstamo como devuelto (FechaFin actualizada)
        $fecha_devolucion = date('Y-m-d');
        $marcar_devuelto_sql = "UPDATE prestamos SET FechaFin = '$fecha_devolucion' WHERE IDLocker = $casillero_id AND FechaFin IS NULL";
        if (!$conn->query($marcar_devuelto_sql)) {
            throw new Exception("Error al marcar el préstamo como devuelto: " . $conn->error);
        }

        echo "Casillero devuelto correctamente.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos al finalizar
$conn->close();
?>
