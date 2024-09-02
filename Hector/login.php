<?php
session_start();
include("conexion.php");
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST['IDUsuario']; // Nombre del campo del formulario
    $password = $_POST['contrasena']; // Nombre del campo del formulario

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE NombreUsuario = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        // Usuario encontrado, verificar la contraseña
        $row = $result->fetch_assoc();
        $stored_password = $row['Contraseña'];

        // Verificar la contraseña
        if ($password == $stored_password) {
            // Contraseña válida, obtener el rol del usuario
            $rol = $row['Rol'];

            // Guardar información en la sesión
            $_SESSION['username'] = $username;
            $_SESSION['rol'] = $rol;

            // Redirigir según el rol
            if ($rol == 'Administrador') {
                header("Location: admin.html");
            } elseif ($rol == 'Aprendiz') {
                header("Location: aprendiz.php");
            }
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

