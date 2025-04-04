<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Pago</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(45deg, #a2c2e7, #86b3d1);
            background-size: 200% 200%;
            animation: gradientAnimation 6s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #004080;
            color: white;
            padding: 20px;
            font-family: Arial, sans-serif;
            animation: slideInDown 0.8s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        @keyframes slideInDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .logout-button {
            margin-top: 10px;
            background: linear-gradient(135deg, #34aab9, #2e8ba3);
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background: linear-gradient(135deg, #2e8ba3, #247a91);
            transform: scale(1.05);
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #004080;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin: 15px 0;
            font-size: 16px;
            color: #444;
        }

        .btn-download {
            display: inline-block;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 16px;
            font-weight: bold;
            animation: popIn 0.5s ease;
        }

        .btn-download:hover {
            background: linear-gradient(135deg, #0056b3, #003f8a);
            transform: scale(1.05);
        }

        @keyframes popIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        .animated-image {
            width: 100px;
            margin: 20px auto;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.5rem;
            }

            .logout-button {
                width: 100%;
                padding: 12px 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="cart.php" class="logout-button">Salir al menú</a>
    </div>

    <div class="container">
        <h2>Orden de Pago</h2>
        <p>Aquí puedes descargar tu orden de pago para el servicio social.</p>
        <a href="generar_pdf.php" class="btn-download">Generar orden de Pago</a>
    </div>
</body>
</html>
