<?php
session_start();
include("db_connection.php"); // Asegúrate de que este archivo contiene OpenCon() y CloseCon()

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

// Consulta SQL para obtener los datos del alumno y su registro
$sql = "SELECT r.Centro, r.Carrera, r.CreditosRequeridos, r.Sede, r.codigoAlumno, 
               r.Alumno, r.CicloAdmision, r.UltimoCicloCursado, r.Estatus, 
               r.Promedio, r.Creditos, r.Porcentaje, r.Registro 
        FROM registro r
        INNER JOIN alumno a ON r.codigoAlumno = a.codigoAlumno
        WHERE a.IdUsuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();

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
    $registro = $row['Registro']; // Nuevo campo
} else {
    $centro = $carrera = $creditosRequeridos = $sede = $codigoAlumno = 
    $alumno = $cicloAdmision = $ultimoCiclo = $estatus = $promedio = 
    $creditos = $porcentaje = $registro = "0";
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <script>
        function confirmarCancelacion() {
            if (confirm("¿Estás seguro de cancelar tu registro?")) {
                document.getElementById("cancelarForm").submit();
            }
        }
    </script>
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
        
        /* Estilos generales */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080; /* Azul UDG */
            color: white;
            padding: 15px 20px;
            font-family: Arial, sans-serif;
        }

        /* Estilos del título */
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        /* Estilos del botón */
        .logout-button {
            background-color:rgb(52, 170, 185);
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* 📱 Ajustes para pantallas pequeñas */
        @media (max-width: 768px) {
            .header {
                flex-direction: column; /* Elementos en columna */
                text-align: center;
            }

            .header h1 {
                font-size: 1.5rem;
                margin-bottom: 10px;
            }

            .logout-button {
                width: 100%;
                text-align: center;
                padding: 12px 0;
            }
        }
        
        .logout-button:hover {
            background-color: #0056b3;
        }
        .action-button {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
            color: white;
        }
        .cancel-button { background-color: #dc3545; }
        .register-button { background-color: #28a745; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Administración de Servicio Social</h1>
        <a href="cart.php" class="logout-button">Salir al menú</a>
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
            <?php 
            if (intval($registro) === 1) {
                echo "Ya estás registrado en el servicio social.";
            } else {
                echo "No tienes un registro activo en el servicio social.";
            }
            ?>
        </p>

        <!-- Mostrar los botones según el valor de Registro -->
        <?php if ($porcentaje >= $creditosRequeridos) { ?>
            <?php if (intval($registro) === 1) { ?>
                <form method="POST" action="actualizar_registro.php" onsubmit="return confirm('¿Estás seguro de cancelar tu registro?');">
                    <input type="hidden" name="accion" value="cancelar">
                    <button type="submit" class="action-button cancel-button">Cancelar Registro</button>
                </form>
            <?php } else { ?>
                <form method="POST" action="actualizar_registro.php">
                    <input type="hidden" name="accion" value="registrar">
                    <button type="submit" class="action-button register-button">Registrar</button>
                </form>
            <?php } ?>
        <?php } ?>

        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['mensaje'] . "</div>";
            unset($_SESSION['mensaje']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>



        
    </div>
</body>
</html>
