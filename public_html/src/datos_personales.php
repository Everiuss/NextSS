<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header('Location: login.php');
    exit();
}

include("db_connection.php");

// Obtener el correo desde la sesión
$correo = $_SESSION['correo'];

// Consulta preparada para obtener los datos del usuario usando el correo
$sql = "SELECT * FROM USUARIOS WHERE correo = ?";
$stmt = mysqli_prepare($conn, $sql);

// Enlazar el parámetro (correo)
mysqli_stmt_bind_param($stmt, 's', $correo); // 's' es para string

// Ejecutar la consulta
$execute_result = mysqli_stmt_execute($stmt);

if ($execute_result) {
    // Obtener el resultado
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si se obtuvo un resultado
    if ($user = mysqli_fetch_assoc($result)) {
        // Datos obtenidos correctamente
    } else {
        // Si no hay resultados, asignamos un valor nulo
        $user = null;
    }
} else {
    // Error en la ejecución de la consulta
    die('Error al ejecutar la consulta: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Personales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .logout-button:hover {
            background-color: #0056b3;
        }

        .personal-data-container {
            margin: 20px auto;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="index.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="main-content">
        <div class="personal-data-container">
            <h2>Datos Personales</h2>
            <?php if ($user): ?>
                <p><strong>Nombre:</strong> <?php echo $user['nombre']; ?></p>
                <p><strong>Correo:</strong> <?php echo $user['correo']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $user['telefono']; ?></p>
                <p><strong>Dirección:</strong> <?php echo $user['direccion']; ?></p>
                <a href="#" class="btn">Editar Datos</a>
            <?php else: ?>
                <p>No se encontraron datos o ha ocurrido un error.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
