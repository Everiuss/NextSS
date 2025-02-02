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
        <a href="cart.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="main-content">
        <div class="user-info">
            <h2>Información Personal</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario_datos['nombre']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario_datos['correo']); ?></p>
            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario_datos['usuario']); ?></p>
            <p><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($usuario_datos['fecha_registro']); ?></p>
        </div>
    </div>

    <div class="footer-button">    
        <!-- Botón para guardar datos -->
        <a href="cart.php" class="logout-button">Guardar datos</a>
    </div>

</body>

</html>
