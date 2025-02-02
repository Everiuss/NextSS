<?php
// Conexión a la base de datos
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $correo = mysqli_real_escape_string($conn, $_POST["correo"]);
    $contrasena = mysqli_real_escape_string($conn, md5($_POST["contrasena"])); // Contraseña encriptada

    // Insertar datos en la base
    $query = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registro exitoso.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al registrar. Inténtalo de nuevo.'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(45deg, #a2c2e7, #86b3d1, #a2c2e7, #86b3d1);
            background-size: 800% 800%;
            animation: gradientAnimation 2s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .header {
            background-color: rgba(52, 58, 64, 0.8);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
        }

        .logout-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            position: absolute;
            right: 20px;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }

        .main-content {
            margin-top: 50px;
            text-align: center;
        }

        .form-container {
            background-color: rgba(52, 58, 64, 0.9);
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Registro</h1>
        <a href="cart.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="main-content">
        <div class="form-container">
            <h2>Crear Cuenta</h2>
            <form method="POST" action="registrar_usuario.php">
                <input type="text" name="nombre" placeholder="Nombre Completo" required>
                <input type="email" name="correo" placeholder="Correo Electrónico" required>
                <input type="text" name="usuario" placeholder="Nombre de Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <input type="submit" name="registrar" value="Registrar">
            </form>
        </div>
    </div>

</body>
</html>
