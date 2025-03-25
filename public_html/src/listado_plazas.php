<?php
session_start();
include("db_connection.php");

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

// Obtener datos del alumno
$sql = "SELECT codigoAlumno, nombreAlumno FROM alumno WHERE IdUsuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();
$alumno = $result->fetch_assoc() ?: [];

$stmt->close();
CloseCon($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>Listado de plazas</title>
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

        .container {
            max-width: 950px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .container h3 {
            color: #333;
            margin: 0px auto;
            margin-bottom: 0rem !important;
        }

        h2 {
            color: #333;
        }

        p {
            margin: 15px 0;
            font-size: 16px;
        }

        .btn-download, .btn-back {
            display: inline-block;
            background-color:rgb(52, 170, 185);
            color: white;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 10px auto;
        }

        .btn-download:hover, .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".dynamic-select").forEach(select => {
        let max = parseInt(select.getAttribute("data-range"), 10);
        for (let i = 1; i <= max; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            select.appendChild(option);
        }
    });
});
</script>


<body>

    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="cart.php" class="logout-button">Salir al menú</a>
    </div>

    <div class="container mt-4">
        <h4 class="text-left mb-4">
            Plazas de <?php echo htmlspecialchars($alumno['codigoAlumno'] . " - " . $alumno['nombreAlumno']); ?>
        </h4>

        <!-- Tabla Listado de plazas activas -->
        <div class="container">
            <h3 class="text-center mb-4">Listado de Plazas</h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No. Oficio</th>
                            <th>Estatus</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Dependencia</th>
                            <th>Programa</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>821/CUCEI/2024B</td>
                            <td class="text-success">ACTIVA</td>
                            <td>02/09/2024</td>
                            <td>-</td>
                            <td>COMPUTO Y TELECOMUNICACIONES PARA EL APRENDIZAJE CUCEI</td>
                            <td>Soporte Técnico y Mantenimiento de Equipos de Cómputo</td>
                            <td><button class="btn btn-info btn-sm" disabled>Detalle</button></td>
                        </tr>
                        <!-- Agregar más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla Reportes parciales -->
        <div class="container">
            <h3 class="text-center mb-4">Reportes parciales</h3>
            <button class="btn-download" data-bs-toggle="modal" data-bs-target="#reporteParcialModal">+</button>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Tipo</th>
                            <th>No.</th>
                            <th>Fecha</th>
                            <th></th>
                            <th>Periodo Reportado</th>
                            <th>Estatus</th>
                            <th>Reporte</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8">No hay registros por mostrar</td>
                        </tr>
                        <!-- Agregar más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla Reporte final -->
        <div class="container">
            <h3 class="text-center mb-4">Reporte final</h3>
            <button class="btn-download" data-bs-toggle="modal" data-bs-target="#reporteParcialModal">+</button>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Registro</th>
                            <th>Estatus</th>
                            <th>Reporte</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">No hay registros por mostrar</td>
                        </tr>
                        <!-- Agregar más filas según sea necesario -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Contenedor Flotante -->
    <div class="modal fade" id="reporteParcialModal" tabindex="-1" aria-labelledby="reporteParcialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="reporteParcialModalLabel">Reporte Parcial de Actividades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Fecha:</strong></td>
                                <td>24/03/2025 19:53</td>
                                <td><strong>Estatus:</strong></td>
                                <td>EDICIÓN</td>
                            </tr>
                            <tr>
                                <td><strong>Tipo:</strong></td>
                                <td>BIMESTRAL</td>
                                <td><strong>Consecutivo:</strong></td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td><strong>Horas reportadas:</strong></td>
                                <td colspan="3">
                                    <select class="form-select dynamic-select" data-range="160">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Período del Bimestre</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de inicio:</strong></td>
                                <td><input type="date" class="form-control"></td>
                                <td><strong>Fecha de fin:</strong></td>
                                <td><input type="date" class="form-control"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Actividades realizadas:</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea class="form-control" rows="5"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Tablas adicionales -->
                    <h5 class="mt-4">Evaluación del Servicio Social</h5>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    ¿Las actividades que estás realizando, se ajustan a las expectativas del programa?
                                </td>
                                <td>
                                    <select class="form-select">
                                        <option selected>---</option>
                                        <option value="1">SI</option>
                                        <option value="2">NO</option>
                                        <option value="3">EN PARTE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Aspecto Evaluado</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nuevos conocimientos adquiridos</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Experiencias formativas personales</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Experiencias profesionales</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Adquisición de habilidades</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4">Aportaciones a la Institución</h5>
                    <textarea class="form-control" rows="3" placeholder="Describe tus principales aportaciones"></textarea>

                    <h5 class="mt-4"> </h5>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>¿Consideras que estás cumpliendo las actividades asignadas satisfactoriamente para la institución?</td>
                                <td>
                                    <select class="form-select">
                                        <option selected>---</option>
                                        <option value="1">SI</option>
                                        <option value="2">NO</option>
                                        <option value="3">EN PARTE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle con Popper.js (necesario para el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
