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
            background: linear-gradient(45deg, #e0eafc, #cfdef3);
            margin: 0;
            padding: 20px;
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
            background-color: #6c757d;
            color: white;
            padding: 8px 15px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Orden de Pago</h2>
        <p>Aquí puedes descargar tu orden de pago para el servicio social.</p>

        <!-- Botón simulado para descargar -->
        <a href="#" class="btn-download">Descargar Orden de Pago</a>

        <br><br>

        <!-- Botón para regresar -->
        <a href="index.php" class="btn-back">Volver al menú</a>
    </div>

</body>
</html>
