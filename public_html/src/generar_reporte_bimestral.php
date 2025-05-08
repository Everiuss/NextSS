<?php
session_start();

require '../vendor/autoload.php';
require_once '../lib/fpdf.php';

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener ID del reporte
$id_reporte = $_GET['id_reporte'] ?? 0;

// Conectar a la base de datos
include("db_connection.php");
$conn = OpenCon();

// Obtener datos del reporte con información adicional
$sql = "SELECT r.*, a.codigoAlumno, a.nombreAlumno, p.numero_oficio, p.dependencia, p.programa, 
               reg.Carrera, o.turno
        FROM reportes r
        JOIN alumno a ON r.IdUsuario = a.IdUsuario
        JOIN plazas p ON r.id_plaza = p.id_plaza
        JOIN registro reg ON a.codigoAlumno = reg.codigoAlumno
        JOIN ofertas o ON p.dependencia = o.dependencia AND p.programa = o.programa
        WHERE r.id_reporte = ? AND r.IdUsuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_reporte, $_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();
$reporte = $result->fetch_assoc();

if (!$reporte) {
    die("Reporte no encontrado o no tienes permiso para acceder a él.");
}

// Función para formatear fecha en texto completo
function fechaCompleta($fecha) {
    $meses = [
        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
    ];
    $fechaObj = new DateTime($fecha);
    return $fechaObj->format('d') . ' de ' . $meses[$fechaObj->format('n')-1] . ' de ' . $fechaObj->format('Y');
}

// Crear PDF personalizado con la plantilla
class PDF extends FPDF {
    function Header() {
        // Cargar la imagen de fondo
        $this->Image('../assets/reportesplantillas/reportebimestral.jpg', 0, 0, 210, 297);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

// Posicionar los datos en la plantilla (coordenadas exactas)

// Datos del alumno
$pdf->SetXY(114, 41.8);
$pdf->Cell(0, 10, $reporte['codigoAlumno']. "-");

$pdf->SetXY(130, 41.8);
$pdf->Cell(0, 10, $reporte['nombreAlumno']);

// Nuevos campos
$pdf->SetXY(113, 46.8); 
$pdf->Cell(0, 10, " ".$reporte['Carrera']);

$pdf->SetXY(32, 48.6); 
$pdf->Cell(0, 10, "".$reporte['turno']);

$pdf->SetXY(31, 58.4);
$pdf->Cell(0, 10, " ".$reporte['dependencia']);

$pdf->SetXY(31, 43.7);
$pdf->Cell(0, 10, " ".$reporte['numero_oficio']);

$pdf->SetXY(31, 55.9);
$pdf->MultiCell(150, 5, " ".$reporte['programa']);

// Resto del reporte
$pdf->SetXY(30, 78);
$pdf->SetFont('Arial', 'B', 8); // Negritas para consecutivo
$pdf->Cell(0, 10, "".$reporte['consecutivo']);
$pdf->SetFont('Arial', '', 8); // Volver a normal

// Periodo con fecha completa
$pdf->SetXY(39, 94.1);
$pdf->MultiCell(150, 5, " ".fechaCompleta($reporte['fecha_inicio'])." - ".fechaCompleta($reporte['fecha_fin']));

$pdf->SetXY(9, 99);
$pdf->MultiCell(150, 5, "\n".$reporte['actividades_realizadas']);

// Horas reportadas en negritas
$pdf->SetXY(165, 87.5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(150, 5, " ".$reporte['horas_reportadas']);
$pdf->SetFont('Arial', '', 8);

// Evaluación
$pdf->SetXY(12, 121);
$pdf->MultiCell(150, 5, "Nuevos conocimientos: ".$reporte['nuevos_conocimientos']."%");

$pdf->SetXY(53, 121);
$pdf->MultiCell(150, 5, "Experiencias formativas personales: ".$reporte['experiencias_formativas']."%");

$pdf->SetXY(110, 121);
$pdf->MultiCell(150, 5, "Experiencias profesionales: ".$reporte['experiencias_profesionales']."%");

$pdf->SetXY(154, 121);
$pdf->MultiCell(150, 5, "Adquisicion de habilidades: ".$reporte['adquisicion_habilidades']."%");

// Nuevos campos solicitados
$pdf->SetXY(12, 135);
$pdf->MultiCell(180, 5, " ".$reporte['actividades_ajustadas']);

$pdf->SetXY(12, 145);
$pdf->MultiCell(180, 5, "".$reporte['aportaciones_institucion']);

$pdf->SetXY(12, 159);
$pdf->MultiCell(180, 5, " ".$reporte['cumplimiento_actividades']);

// Fecha completa en lugar de formato corto
$pdf->SetXY(36, 84.9);
$pdf->Cell(0, 10, " ".fechaCompleta(date('Y-m-d')));

// Nombre del archivo
$nombre_archivo = "Reporte_Bimestral_".$reporte['consecutivo']."_".$reporte['codigoAlumno'].".pdf";

// Cerrar conexión
$stmt->close();
CloseCon($conn);

// Salida del PDF
$pdf->Output('D', $nombre_archivo);
exit;