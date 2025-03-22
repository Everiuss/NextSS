<?php
// Aquí podrías agregar validación de sesión si es necesario
?>  

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Pago</title>
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

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            margin: 15px 0;
            font-size: 16px;
        }

        .btn-download {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-download:hover {
            background-color: #0056b3;
        }

        .btn-back {
            display: inline-block;
            background-color: red; /* Cambiar a rojo */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: darkred; /* Cambiar a un tono más oscuro de rojo al pasar el mouse */
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="../index.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="container">
        <h2>Orden de Pago</h2>
        <p>Aquí puedes descargar tu orden de pago para el servicio social.</p>

        <!-- Botón para descargar el PDF -->
        <a href="generar_pdf.php" class="btn-download">Generar y Descargar Orden de Pago</a>

        <br><br>


        <br><br>

        <!-- Botón para regresar -->
        <a href="cart.php" class="btn-back">Volver al menú</a>
    </div