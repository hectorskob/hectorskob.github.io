<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['IDUsuario']) && isset($_POST['contrasena'])) {
    $IDUsuario = $_POST['IDUsuario'];
    $contrasena = $_POST['contrasena'];


    if ($IDUsuario === "IDUsuario" && $contrasena === "contrasena") {
        
        session_start();
        $_SESSION['IDUsuario'] = $IDUsuario;

        header("Location: login.html");
        exit;
    } else {
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
} else {
    echo "bienvenido a la plataforma de lockers,admin.";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Redireccionando...</title>
</head>
<body>
  <h1>Redireccionando al login...</h1>
  <script>
    setTimeout(function() {
      window.location.href = "login.html";
    }, 000); // 5000 milisegundos = 5 segundos
  </script>
</body>
</html>