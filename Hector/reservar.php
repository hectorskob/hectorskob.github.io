<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $casillero_id = $_POST['casillero_id'];

    // Verificar si el aprendiz ya tiene un casillero reservado
    $id_aprendiz = 10; // ID del aprendiz (ejemplo)
    $verificar_reserva_sql = "SELECT IDPrestamo FROM prestamos WHERE IDAprendiz = $id_aprendiz AND IDLocker IS NOT NULL AND FechaFin IS NULL";
    $resultado_reserva = $conn->query($verificar_reserva_sql);

    if ($resultado_reserva->num_rows > 0) {
        // El aprendiz ya tiene un casillero reservado
        echo "Ya tienes un casillero reservado. Debes devolverlo antes de reservar otro.";
    } else {
        // Verificar si el casillero está disponible
        $verificar_sql = "SELECT Estado FROM lockers WHERE IDLocker = $casillero_id";
        $resultado = $conn->query($verificar_sql);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            if ($row['Estado'] == 'Libre') {
                // Actualizar el estado del casillero a Ocupado y registrar el préstamo
                $fecha_inicio = date('Y-m-d');
                $insertar_prestamo_sql = "INSERT INTO prestamos (IDLocker, IDAprendiz, FechaInicio) VALUES ($casillero_id, $id_aprendiz, '$fecha_inicio')";
                if ($conn->query($insertar_prestamo_sql) === TRUE) {
                    $actualizar_sql = "UPDATE lockers SET Estado = 'Ocupado' WHERE IDLocker = $casillero_id";
                    if ($conn->query($actualizar_sql) === TRUE) {
                        echo "Casillero reservado correctamente.";
                    } else {
                        echo "Error al reservar el casillero: " . $conn->error;
                    }
                } else {
                    echo "Error al registrar el préstamo: " . $conn->error;
                }
            } else {
                echo "El casillero seleccionado no está disponible para reservar.";
            }
        } else {
            echo "Casillero no encontrado.";
        }
    }
}

$conn->close();
?>
