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


// Obtener listado de plazas activas
$sqlPlazas = "SELECT numero_oficio, estatus, fecha_inicio, fecha_fin, dependencia, programa FROM plazas WHERE id_alumno = ?";
$stmt = $conn->prepare($sqlPlazas);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();  
$result = $stmt->get_result();

$plazas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plazas[] = $row;
    }
}

// Obtener reportes parciales del alumno
$sqlReportes = "SELECT * 
                FROM reportes 
                WHERE IdUsuario = ? AND tipo_reporte = 'BIMESTRAL' 
                ORDER BY consecutivo ASC";

$stmt = $conn->prepare($sqlReportes);
$stmt->bind_param("i", $IdUsuario); 
$stmt->execute();
$result = $stmt->get_result();

$reportesParciales = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reportesParciales[] = $row;
    }
}

// Obtener reporte final del alumno
$sqlFinales = "SELECT *
               FROM reportes_finales 
               WHERE IdUsuario = ?";
                
$stmt = $conn->prepare($sqlFinales);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();
$reportesFinales = $result->fetch_all(MYSQLI_ASSOC);


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">



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
                   <!-- <th>Detalle</th>-->
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($plazas)): ?>
                    <?php foreach ($plazas as $plaza): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($plaza['numero_oficio']); ?></td>
                        <td class="<?php echo $plaza['estatus'] === 'ACTIVA' ? 'text-success' : 'text-danger'; ?>">
                        <?php echo htmlspecialchars($plaza['estatus']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($plaza['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($plaza['fecha_fin'] ?: '-'); ?></td>
                        <td><?php echo htmlspecialchars($plaza['dependencia']); ?></td>
                        <td><?php echo htmlspecialchars($plaza['programa']); ?></td>
                        <!--<td><button class="btn btn-info btn-sm" disabled>Detalle</button></td>-->
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                    <td colspan="7">No hay plazas activas para mostrar</td>
                    </tr>
                <?php endif; ?>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($reportesParciales)): ?>
                        <?php foreach ($reportesParciales as $reporte): ?>
                        <tr><!-- $sqlReportes = "SELECT tipo_reporte, consecutivo, fecha_reporte, fecha_inicio, fecha_fin, estatus, ruta_reporte  -->
                            <td><?php echo htmlspecialchars($reporte['tipo_reporte']); ?></td>
                            <td><?php echo htmlspecialchars($reporte['consecutivo']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($reporte['fecha_reporte'])); ?></td>
                            <td></td> <!-- Columna vacía si no se usa -->
                            <td><?php echo date("d/m/Y", strtotime($reporte['fecha_inicio'])) . " - " . date("d/m/Y", strtotime($reporte['fecha_fin'])); ?></td>
                            <td><?php echo htmlspecialchars($reporte['estatus']); ?></td>
                            <td>
                                <?php if (!empty($reporte['ruta_reporte'])): ?>
                                    <a href="<?php echo htmlspecialchars($reporte['ruta_reporte']); ?>" target="_blank" class="btn btn-sm btn-primary">Ver</a>
                                <?php else: ?>
                                    <span class="text-muted">No disponible</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Botones de acción -->
                                <button 
                                    class="btn btn-sm btn-warning btn-editar-reporte" 
                                    title="Editar"
                                    data-id="<?php echo $reporte['id_reporte']; ?>"
                                    data-tipo="<?php echo htmlspecialchars($reporte['tipo_reporte']); ?>"
                                    data-consecutivo="<?php echo htmlspecialchars($reporte['consecutivo']); ?>"
                                    data-fecha_inicio="<?php echo htmlspecialchars($reporte['fecha_inicio']); ?>"
                                    data-fecha_fin="<?php echo htmlspecialchars($reporte['fecha_fin']); ?>"
                                    data-actividades="<?php echo htmlspecialchars($reporte['actividades_realizadas']); ?>"
                                    data-horas_reportadas="<?php echo htmlspecialchars($reporte['horas_reportadas']); ?>"
                                    data-actividades_ajustadas="<?php echo htmlspecialchars($reporte['actividades_ajustadas']); ?>"
                                    data-nuevos_conocimientos="<?php echo htmlspecialchars($reporte['nuevos_conocimientos']); ?>"
                                    data-experiencias_formativas="<?php echo htmlspecialchars($reporte['experiencias_formativas']); ?>"
                                    data-experiencias_profesionales="<?php echo htmlspecialchars($reporte['experiencias_profesionales']); ?>"
                                    data-adquisicion_habilidades="<?php echo htmlspecialchars($reporte['adquisicion_habilidades']); ?>"
                                    data-aportaciones_institucion="<?php echo htmlspecialchars($reporte['aportaciones_institucion']); ?>"
                                    data-cumplimiento_actividades="<?php echo htmlspecialchars($reporte['cumplimiento_actividades']); ?>"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEditarReporte"
                                >
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <button 
                                    class="btn btn-sm btn-danger btn-eliminar-reporte" 
                                    title="Eliminar"
                                    data-id="<?php echo $reporte['id_reporte']; ?>"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEliminarReporte"
                                >
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                <button class="btn btn-sm btn-success" title="Descargar">
                                    <i class="bi bi-download"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No hay registros por mostrar</td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla Reporte final -->
        <div class="container">
            <h3 class="text-center mb-4">Reporte final</h3>
            <button class="btn-download" data-bs-toggle="modal" data-bs-target="#reporteFinalModal">+</button>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Registro</th>
                            <th>Estatus</th>
                            <th>Reporte</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reportesFinales)): ?>
                            <?php foreach ($reportesFinales as $reporte): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reporte['fecha_registro']); ?></td>
                                <td><?php echo htmlspecialchars($reporte['estatus']); ?></td>
                                <td>
                                    <?php if (!empty($reporte['ruta_documento'])): ?>
                                        <a href="<?php echo htmlspecialchars($reporte['ruta_documento']); ?>" target="_blank" class="btn btn-sm btn-primary">Ver</a>
                                    <?php else: ?>
                                        <span class="text-muted">No disponible</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Botones de acción -->
                                    <button 
                                        class="btn btn-sm btn-warning btn-editar-reporte-final" 
                                        title="Editar"
                                        data-id="<?php echo $reporte['id_reporte_final']; ?>"
                                        data-fecha_termino="<?php echo $reporte['fecha_termino']; ?>"
                                        data-objetivos_programa="<?php echo htmlspecialchars($reporte['objetivos_programa']); ?>"
                                        data-actividades_realizadas="<?php echo htmlspecialchars($reporte['actividades_realizadas']); ?>"
                                        data-metas_alcanzadas="<?php echo htmlspecialchars($reporte['metas_alcanzadas']); ?>"
                                        data-metodologia_utilizada="<?php echo htmlspecialchars($reporte['metodologia_utilizada']); ?>"
                                        data-conclusion_propuestas="<?php echo htmlspecialchars($reporte['conclusion_propuestas']); ?>"
                                        data-aporte_innovaciones="<?php echo htmlspecialchars($reporte['aporte_innovaciones']); ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#reporteFinalModalEditar"
                                    >
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <button 
                                        class="btn btn-sm btn-danger btn-eliminar-reporte-final" 
                                        title="Eliminar"
                                        data-id="<?php echo $reporte['id_reporte_final']; ?>"
                                    >
                                        <i class="bi bi-trash-fill"></i>
                                    </button>

                                    <button class="btn btn-sm btn-success" title="Descargar">
                                        <i class="bi bi-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No hay registros por mostrar</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal reporte parcial -->
    <div class="modal fade" id="reporteParcialModal" tabindex="-1" aria-labelledby="reporteParcialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="reporteParcialModalLabel">Reporte Parcial de Actividades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="guardar_reporte.php" method="POST">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Fecha:</strong></td>
                                <td><?php echo date("d/m/Y H:i"); ?></td>
                                <td><strong>Estatus:</strong></td>
                                <td>EDICIÓN</td>
                            </tr>
                            <tr>
                                <td><strong>tipo:</strong></td>

                                <td>
                                    <select class="form-select" name="tipo_reporte">
                                        <option value="BIMESTRAL">BIMESTRAL</option>
                                    </select>
                                </td>
                                <td><strong>Consecutivo:</strong></td>
                                <td><input type="number" class="form-control" name="consecutivo" required></td>
                            </tr>
                            <tr>
                                <td><strong>Horas reportadas:</strong></td>
                                <td colspan="3">
                                    <select class="form-select dynamic-select" data-range="160" name="horas_reportadas">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Período del Bimestre</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de inicio:</strong></td>
                                <td><input type="date" class="form-control" name="fecha_inicio" required></td>
                                <td><strong>Fecha de fin:</strong></td>
                                <td><input type="date" class="form-control" name="fecha_fin" required></td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Actividades realizadas:</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <textarea class="form-control" rows="5" name="actividades_realizadas" required></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4">Evaluación del Servicio Social</h5>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    ¿Las actividades que estás realizando, se ajustan a las expectativas del programa?
                                </td>
                                <td>
                                    <select class="form-select" name="actividades_ajustadas">
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
                                    <select class="form-select dynamic-select" data-range="100" name="nuevos_conocimientos">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Experiencias formativas personales</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100" name="experiencias_formativas">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Experiencias profesionales</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100" name="experiencias_profesionales">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Adquisición de habilidades</td>
                                <td>
                                    <select class="form-select dynamic-select" data-range="100" name="adquisicion_habilidades">
                                        <option selected>---</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4">Aportaciones a la Institución</h5>
                    <textarea class="form-control" rows="3" placeholder="Describe tus principales aportaciones" name="aportaciones_institucion"></textarea>

                    <h5 class="mt-4"> </h5>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>¿Consideras que estás cumpliendo las actividades asignadas satisfactoriamente para la institución?</td>
                                <td>
                                    <select class="form-select" name="cumplimiento_actividades">
                                        <option selected>---</option>
                                        <option value="1">SI</option>
                                        <option value="2">NO</option>
                                        <option value="3">EN PARTE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Reporte</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Reporte parcial -->
    <div class="modal fade" id="modalEditarReporte" tabindex="-1" aria-labelledby="editarReporteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="actualizar_reporte.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Editar reporte parcial</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_reporte" id="edit_id_reporte">

                        <div class="mb-3">
                            <label class="form-label">Tipo de reporte</label>
                            <input type="text" class="form-control" name="tipo_reporte" id="edit_tipo_reporte">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Consecutivo</label>
                            <input type="number" class="form-control" name="consecutivo" id="edit_consecutivo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="edit_fecha_inicio">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" class="form-control" name="fecha_fin" id="edit_fecha_fin">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Actividades realizadas</label>
                            <textarea class="form-control" name="actividades_realizadas" id="edit_actividades" rows="4"></textarea>
                        </div>

                        <h5 class="mt-4 text-primary">Evaluación del Servicio Social</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                        ¿Las actividades que estás realizando, se ajustan a las expectativas del programa?
                                    </td>
                                    <td>
                                        <select class="form-select" name="actividades_ajustadas" id="edit_actividades_ajustadas">
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
                            <thead class="table-primary">
                                <tr>
                                    <th>Aspecto Evaluado</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nuevos conocimientos adquiridos</td>
                                    <td>
                                        <select class="form-select dynamic-select" data-range="100" name="nuevos_conocimientos" id="edit_nuevos_conocimientos">
                                            <option selected>---</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Experiencias formativas personales</td>
                                    <td>
                                        <select class="form-select dynamic-select" data-range="100" name="experiencias_formativas" id="edit_experiencias_formativas">
                                            <option selected>---</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Experiencias profesionales</td>
                                    <td>
                                        <select class="form-select dynamic-select" data-range="100" name="experiencias_profesionales" id="edit_experiencias_profesionales">
                                            <option selected>---</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Adquisición de habilidades</td>
                                    <td>
                                        <select class="form-select dynamic-select" data-range="100" name="adquisicion_habilidades" id="edit_adquisicion_habilidades">
                                            <option selected>---</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mt-4 text-primary">Aportaciones a la Institución</h5>
                        <textarea class="form-control" rows="3" placeholder="Describe tus principales aportaciones" name="aportaciones_institucion" id="edit_aportaciones_institucion"></textarea>

                        <table class="table table-striped mt-4">
                            <tbody>
                                <tr>
                                    <td>¿Consideras que estás cumpliendo las actividades asignadas satisfactoriamente para la institución?</td>
                                    <td>
                                        <select class="form-select" name="cumplimiento_actividades" id="edit_cumplimiento_actividades">
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
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Eliminar Reporte -->
    <div class="modal fade" id="modalEliminarReporte" tabindex="-1" aria-labelledby="eliminarReporteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="eliminar_reporte.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirmar eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este reporte?
                        <input type="hidden" name="id_reporte" id="delete_id_reporte">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Modal Reporte Final -->
    <div class="modal fade" id="reporteFinalModal" tabindex="-1" aria-labelledby="reporteFinalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="guardar_reporte_final.php" method="POST">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="reporteFinalModalLabel">Reporte Final de Actividades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Fecha de registro:</strong> <?php echo date("d/m/Y H:i"); ?></div>
                            <div class="col-md-6"><strong>Estatus:</strong> EDICIÓN</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Fecha de término de la plaza:</strong></label>
                            <input type="date" class="form-control" name="fecha_termino" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Objetivos del programa:</strong></label>
                            <textarea class="form-control" name="objetivos_programa" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Actividades realizadas:</strong></label>
                            <textarea class="form-control" name="actividades_realizadas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Metas alcanzadas:</strong></label>
                            <textarea class="form-control" name="metas_alcanzadas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Metodología utilizada:</strong></label>
                            <textarea class="form-control" name="metodologia_utilizada" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Conclusión y propuestas:</strong></label>
                            <textarea class="form-control" name="conclusion_propuestas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Aporte de innovaciones:</strong></label>
                            <textarea class="form-control" name="aporte_innovaciones" rows="3" required></textarea>
                        </div>

                        <p class="mt-4"><strong>Después de descargar, imprimir, firmar y sellar el reporte final, deberás agregarlo como PDF o JPG.</strong></p>

                        <!-- Aquí puedes incluir un input para subir archivos si lo deseas -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Subir archivo firmado (PDF/JPG):</strong></label>
                            <input type="file" class="form-control" name="archivo_final" accept=".pdf, .jpg, .jpeg">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Reporte Final</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Reporte Final -->
    <div class="modal fade" id="reporteFinalModalEditar" tabindex="-1" aria-labelledby="reporteFinalModalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="actualizar_reporte_final.php" method="POST">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="reporteFinalModalEditarLabel">Editar Reporte Final</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id_reporte_final" id="edit_id_reporte_final">
                        <div class="mb-3">
                            <label class="form-label"><strong>Fecha de término de la plaza:</strong></label>
                            <input type="date" class="form-control" name="fecha_termino" id="edit_fecha_termino" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Objetivos del programa:</strong></label>
                            <textarea class="form-control" name="objetivos_programa" id="edit_objetivos_programa" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Actividades realizadas:</strong></label>
                            <textarea class="form-control" name="actividades_realizadas" id="edit_actividades_realizadas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Metas alcanzadas:</strong></label>
                            <textarea class="form-control" name="metas_alcanzadas" id="edit_metas_alcanzadas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Metodología utilizada:</strong></label>
                            <textarea class="form-control" name="metodologia_utilizada" id="edit_metodologia_utilizada" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Conclusión y propuestas:</strong></label>
                            <textarea class="form-control" name="conclusion_propuestas" id="edit_conclusion_propuestas" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Aporte de innovaciones:</strong></label>
                            <textarea class="form-control" name="aporte_innovaciones" id="edit_aporte_innovaciones" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Actualizar Reporte Final</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Eliminar Reporte Final -->
    <div class="modal fade" id="modalEliminarReporteFinal" tabindex="-1" aria-labelledby="modalEliminarReporteFinalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="eliminar_reporte_final.php" method="POST">
            <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="modalEliminarReporteFinalLabel">Eliminar Reporte Final</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
            <input type="hidden" name="id_reporte_final" id="delete_id_reporte_final">
            <p>¿Estás seguro de que deseas eliminar este reporte final? Esta acción no se puede deshacer.</p>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
        </div>
    </div>
    </div>




    <!-- Bootstrap 5 Bundle con Popper.js (necesario para el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>

    function poblarSelectsDinamicos() {
        document.querySelectorAll(".dynamic-select").forEach(select => {
            if (select.options.length <= 1) { // evita duplicados
                const range = parseInt(select.dataset.range);
                for (let i = range; i >= 0; i -= 10) {
                    const option = document.createElement("option");
                    option.value = i;
                    option.textContent = i;
                    select.appendChild(option);
                }
            }
        });
    }


    document.addEventListener("DOMContentLoaded", function () {
        poblarSelectsDinamicos(); // <-- primero

        const editarBtns = document.querySelectorAll(".btn-editar-reporte");
        editarBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                poblarSelectsDinamicos(); // <-- por si abren antes de cargar
                document.getElementById("edit_id_reporte").value = this.dataset.id;
                document.getElementById("edit_tipo_reporte").value = this.dataset.tipo;
                document.getElementById("edit_consecutivo").value = this.dataset.consecutivo;
                document.getElementById("edit_fecha_inicio").value = this.dataset.fecha_inicio;
                document.getElementById("edit_fecha_fin").value = this.dataset.fecha_fin;
                document.getElementById("edit_actividades").value = this.dataset.actividades;
                document.getElementById("edit_horas_reportadas").value = this.dataset.horas_reportadas;
                document.getElementById("edit_actividades_ajustadas").value = this.dataset.actividades_ajustadas;
                document.getElementById("edit_nuevos_conocimientos").value = this.dataset.nuevos_conocimientos;
                document.getElementById("edit_experiencias_formativas").value = this.dataset.experiencias_formativas;
                document.getElementById("edit_experiencias_profesionales").value = this.dataset.experiencias_profesionales;
                document.getElementById("edit_adquisicion_habilidades").value = this.dataset.adquisicion_habilidades;
                document.getElementById("edit_aportaciones_institucion").value = this.dataset.aportaciones_institucion;
                document.getElementById("edit_cumplimiento_actividades").value = this.dataset.cumplimiento_actividades;
            });
        });

        const eliminarBtns = document.querySelectorAll(".btn-eliminar-reporte");
        eliminarBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                document.getElementById("delete_id_reporte").value = this.dataset.id;
            });
        });
    });

    </script>

    <script>
    document.querySelectorAll('.btn-editar-reporte-final').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('edit_id_reporte_final').value = button.getAttribute('data-id');
            document.getElementById('edit_fecha_termino').value = button.getAttribute('data-fecha_termino');
            document.getElementById('edit_objetivos_programa').value = button.getAttribute('data-objetivos_programa');
            document.getElementById('edit_actividades_realizadas').value = button.getAttribute('data-actividades_realizadas');
            document.getElementById('edit_metas_alcanzadas').value = button.getAttribute('data-metas_alcanzadas');
            document.getElementById('edit_metodologia_utilizada').value = button.getAttribute('data-metodologia_utilizada');
            document.getElementById('edit_conclusion_propuestas').value = button.getAttribute('data-conclusion_propuestas');
            document.getElementById('edit_aporte_innovaciones').value = button.getAttribute('data-aporte_innovaciones');
        });
    });
    </script>

    <script>
    document.querySelectorAll('.btn-eliminar-reporte-final').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        document.getElementById('delete_id_reporte_final').value = id;
        const modal = new bootstrap.Modal(document.getElementById('modalEliminarReporteFinal'));
        modal.show();
    });
    });
    </script>



</body>
</html>
