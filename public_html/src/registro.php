<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Social</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #a2c2e7, #86b3d1);
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
            position: relative;
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
            top: 20px;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
        .info-container {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .buttons {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Sistema de Administración de Servicio Social</h1>
        <a href="cart.php" class="logout-button">Volver al Perfil</a>
    </div>

    <div class="container">
        <h3>Ciclo de registro al servicio: <strong>...</strong></h3>

        <div class="info-container">
            <table class="table">
                <tr><td>Centro:</td><td></td></tr>
                <tr><td>Carrera:</td><td></td></tr>
                <tr><td>Créditos requeridos:</td><td></td></tr>
                <tr><td>Sede:</td><td></td></tr>
                <tr><td>Código:</td><td></td></tr>
                <tr><td>Alumno:</td><td></td></tr>
                <tr><td>Ciclo de admisión:</td><td></td></tr>
                <tr><td>Último ciclo cursado:</td><td></td></tr>
                <tr><td>Estatus:</td><td></td></tr>
                <tr><td>Promedio:</td><td></td></tr>
                <tr><td>Créditos:</td><td></td></tr>
                <tr><td>Porcentaje:</td><td></td></tr>
            </table>
        </div>

        <p style="text-align: center; font-weight: bold;">Tienes una plaza inscrita o activa</p>

        <div class="buttons">
            <button class="btn">Registrar</button>
            <button class="btn btn-danger">Eliminar Registro</button>
        </div>
    </div>

</body>
</html>