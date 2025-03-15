<?php
session_start();
include("db_connection.php"); // Asegúrate de que este archivo contiene OpenCon() y CloseCon()

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirige al login si no hay sesión
    exit();
}

$IdUsuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión
$conn = OpenCon();

// Consulta SQL para obtener los datos del alumno y su registro
$sql = "SELECT r.Centro, r.Carrera, r.CreditosRequeridos, r.Sede, r.codigoAlumno, 
               r.Alumno, r.CicloAdmision, r.UltimoCicloCursado, r.Estatus, 
               r.Promedio, r.Creditos, r.Porcentaje 
        FROM registro r
        INNER JOIN alumno a ON r.codigoAlumno = a.codigoAlumno
        WHERE a.IdUsuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay datos
if ($row = $result->fetch_assoc()) {
    $centro = $row['Centro'];
    $carrera = $row['Carrera'];
    $creditosRequeridos = $row['CreditosRequeridos'];
    $sede = $row['Sede'];
    $codigoAlumno = $row['codigoAlumno'];
    $alumno = $row['Alumno'];
    $cicloAdmision = $row['CicloAdmision'];
    $ultimoCiclo = $row['UltimoCicloCursado'];
    $estatus = $row['Estatus'];
    $promedio = $row['Promedio'];
    $creditos = $row['Creditos'];
    $porcentaje = $row['Porcentaje'];
} else {
    $centro = $carrera = $creditosRequeridos = $sede = $codigoAlumno = 
    $alumno = $cicloAdmision = $ultimoCiclo = $estatus = $promedio = 
    $creditos = $porcentaje = "No disponible";
}

$stmt->close();
CloseCon($conn);
?>

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
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Administración de Servicio Social</h1>
        <a href="cart.php" class="logout-button">Volver al Perfil</a>
    </div>
    <div class="container">
        <h3>Ciclo de registro al servicio: <strong><?php echo htmlspecialchars($cicloAdmision); ?></strong></h3>
        <table class="table">
            <tr><td>Centro: <?php echo htmlspecialchars($centro); ?></td></tr>
            <tr><td>Carrera: <?php echo htmlspecialchars($carrera); ?></td></tr>
            <tr><td>Créditos requeridos: <?php echo htmlspecialchars($creditosRequeridos); ?>%</td></tr>
            <tr><td>Sede: <?php echo htmlspecialchars($sede); ?></td></tr>
            <tr><td>Código: <?php echo htmlspecialchars($codigoAlumno); ?></td></tr>
            <tr><td>Alumno: <?php echo htmlspecialchars($alumno); ?></td></tr>
            <tr><td>Último ciclo cursado: <?php echo htmlspecialchars($ultimoCiclo); ?></td></tr>
            <tr><td>Estatus: <?php echo htmlspecialchars($estatus); ?></td></tr>
            <tr><td>Promedio: <?php echo htmlspecialchars($promedio); ?></td></tr>
            <tr><td>Créditos: <?php echo htmlspecialchars($creditos); ?></td></tr>
            <tr><td>Porcentaje: <?php echo htmlspecialchars($porcentaje); ?>%</td></tr>
        </table>
        <p style="text-align: center; font-weight: bold;">
            <?php echo ($estatus == "Activo") ? "Tienes una plaza inscrita o activa" : "No tienes una plaza activa"; ?>
        </p>
    </div>
</body>
</html>
