<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "servicio_social";

$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener datos del usuario logueado
$usuario_actual = $_SESSION['usuario'];
$sql = "SELECT nombre, correo, usuario, fecha_registro FROM usuarios WHERE usuario = '$usuario_actual'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $usuario_datos = $resultado->fetch_assoc();
} else {
    echo "<script>alert('No se encontraron datos del usuario.'); window.location.href='index.php';</script>";
    exit;
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title>
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

        .options-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .option {
            background-color: rgba(52, 58, 64, 0.9);
            color: white;
            padding: 15px;
            border-radius: 5px;
            width: 150px;
            text-align: center;
        }

        .option a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .option a:hover {
            background-color: #007bff;
        }

        .user-info {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            display: inline-block;
            text-align: left;
            margin-top: 30px;
        }

        .user-info h2 {
            color: #343a40;
        }

        .user-info p {
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Perfil del Usuario</h1>
        <a href="../index.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="main-content">
        <div class="user-info">
            <h2>Información Personal</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario_datos['nombre']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario_datos['correo']); ?></p>
            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario_datos['usuario']); ?></p>
            <p><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($usuario_datos['fecha_registro']); ?></p>
        </div>

        <div class="options-container">
            <div class="option">
                <a href="datos_personales.php">Datos personales</a>
            </div>
            <div class="option">
                <a href="#">Registro</a>
            </div>
            <div class="option">
                <a href="#">Orden de pago</a>
            </div>
            <div class="option">
                <a href="#">Ofertas disponibles</a>
            </div>
            <div class="option">
                <a href="#">Listado de plazas</a>
            </div>
            <div class="option">
                <a href="#">Acreditación</a>
            </div>
            <div class="option">
                <a href="#">Cambiar contraseña</a>
            </div>
        </div>
    </div>

</body>
</html>
