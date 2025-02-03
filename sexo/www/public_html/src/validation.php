<?php
session_start();
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valores obtenidos desde el formulario
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conn, md5($_POST['contrasena']));
    
    // Consulta para verificar credenciales
    $result = mysqli_query($conn, "SELECT * FROM USUARIOS WHERE Correo = '$correo' AND Contrasena = '$contrasena'");

    if (mysqli_num_rows($result) > 0) {
        $ur = $result->fetch_array();
        $_SESSION['id_usuario'] = $ur['IdUsuario'];
        $_SESSION['correo'] = $correo;
        $_SESSION['usuario'] = $ur['Usuario'];
        $_SESSION['rol'] = $ur['Rol'];
        $_SESSION['nombre'] = $ur['Nombre'];

        if (isset($_POST['rastreo'])) {
            setcookie('correo', $_POST['correo'], time() + 3600 * 24 * 365 * 100, '/');
        }

        // Redirigir a cart.php después del login exitoso
        header('Location: cart.php');
        exit();
    } else {
        // Redirigir a login.php con un mensaje de error
        header('Location: login.php?error=Usuario no encontrado');
        exit();
    }
}

mysqli_close($conn);
?>