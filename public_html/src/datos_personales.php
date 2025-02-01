<?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header('Location: login.php');
        exit;
    }

    include("db_connection.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ciclo_servicio = mysqli_real_escape_string($conn, $_POST['ciclo_servicio']);
        $centro_universitario = mysqli_real_escape_string($conn, $_POST['centro_universitario']);
        $carrera = mysqli_real_escape_string($conn, $_POST['carrera']);
        $creditos_requeridos = mysqli_real_escape_string($conn, $_POST['creditos_requeridos']);
        $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
        $nombre_alumno = mysqli_real_escape_string($conn, $_POST['nombre_alumno']);
        $ciclo_admision = mysqli_real_escape_string($conn, $_POST['ciclo_admision']);
        $ultimo_ciclo_cursado = mysqli_real_escape_string($conn, $_POST['ultimo_ciclo_cursado']);
        $estatus = mysqli_real_escape_string($conn, $_POST['estatus']);
        $promedio = mysqli_real_escape_string($conn, $_POST['promedio']);
        $creditos_acumulados = mysqli_real_escape_string($conn, $_POST['creditos_acumulados']);
        $porcentaje = mysqli_real_escape_string($conn, $_POST['porcentaje']);

        $query = "INSERT INTO datos_registro (
            ciclo_servicio, centro_universitario, carrera, creditos_requeridos, codigo, 
            nombre_alumno, ciclo_admision, ultimo_ciclo_cursado, estatus, promedio, 
            creditos_acumulados, porcentaje
        ) VALUES (
            '$ciclo_servicio', '$centro_universitario', '$carrera', '$creditos_requeridos', '$codigo', 
            '$nombre_alumno', '$ciclo_admision', '$ultimo_ciclo_cursado', '$estatus', '$promedio', 
            '$creditos_acumulados', '$porcentaje'
        )";

        if ($conn->query($query)) {
            echo '<script>alert("Datos registrados con éxito.");</script>';
        } else {
            echo '<script>alert("Error al registrar los datos: ' . $conn->error . '");</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Datos</title>
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
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Registro de Datos - Servicio Social</h1>
        <a href="perfil_usuario.php" class="btn btn-secondary" style="position: absolute; right: 20px; top: 20px;">Volver al Perfil</a>
    </div>
    <div class="container">
        <form method="POST" action="registro_datos.php">
            <div class="form-group">
                <label for="ciclo_servicio">Ciclo de registro al servicio:</label>
                <input type="text" class="form-control" id="ciclo_servicio" name="ciclo_servicio" required>
            </div>
            <div class="form-group">
                <label for="centro_universitario">Centro Universitario:</label>
                <input type="text" class="form-control" id="centro_universitario" name="centro_universitario" required>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <input type="text" class="form-control" id="carrera" name="carrera" required>
            </div>
            <div class="form-group">
                <label for="creditos_requeridos">Créditos requeridos:</label>
                <input type="number" class="form-control" id="creditos_requeridos" name="creditos_requeridos" required>
            </div>
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="nombre_alumno">Alumno (nombre completo):</label>
                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" required>
            </div>
            <div class="form-group">
                <label for="ciclo_admision">Ciclo de admisión:</label>
                <input type="text" class="form-control" id="ciclo_admision" name="ciclo_admision" required>
            </div>
            <div class="form-group">
                <label for="ultimo_ciclo_cursado">Último ciclo cursado:</label>
                <input type="text" class="form-control" id="ultimo_ciclo_cursado" name="ultimo_ciclo_cursado" required>
            </div>
            <div class="form-group">
                <label for="estatus">Estatus:</label>
                <input type="text" class="form-control" id="estatus" name="estatus" required>
            </div>
            <div class="form-group">
                <label for="promedio">Promedio:</label>
                <input type="number" step="0.01" class="form-control" id="promedio" name="promedio" required>
            </div>
            <div class="form-group">
                <label for="creditos_acumulados">Créditos acumulados:</label>
                <input type="number" class="form-control" id="creditos_acumulados" name="creditos_acumulados" required>
            </div>
            <div class="form-group">
                <label for="porcentaje">Porcentaje:</label>
                <input type="number" class="form-control" id="porcentaje" name="porcentaje" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Datos</button>
        </form>
    </div>
</body>
</html>
