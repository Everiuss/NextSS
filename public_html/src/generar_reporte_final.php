<?php
session_start();

require '../vendor/autoload.php';
require_once '../lib/fpdf.php';

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos
include("db_connection.php");
$conn = OpenCon();

// Obtener datos del reporte final con información adicional
$sql = "SELECT rf.*, a.codigoAlumno, a.nombreAlumno, p.numero_oficio, p.dependencia, p.programa, 
               reg.Carrera, o.turno
        FROM reportes_finales rf
        JOIN alumno a ON rf.IdUsuario = a.IdUsuario
        JOIN plazas p ON rf.id_plaza = p.id_plaza
        JOIN registro reg ON a.codigoAlumno = reg.codigoAlumno
        JOIN ofertas o ON p.dependencia = o.dependencia AND p.programa = o.programa
        WHERE rf.IdUsuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();
$reporte = $result->fetch_assoc();

if (!$reporte) {
    die("No se encontró reporte final para este usuario.");
}

// Crear PDF personalizado con la plantilla
class PDF extends FPDF {
    function Header() {
        // Cargar la imagen de fondo (asegúrate que reportefinal.png existe)
        if(file_exists('../assets/reportesplantillas/reportefinal.png')) {
            $this->Image('../assets/reportesplantillas/reportefinal.png', 0, 0, 210, 297);
        } else {
            // Encabezado alternativo si no hay plantilla
            $this->SetFont('Arial','B',15);
            $this->Cell(0,10,'REPORTE FINAL DE SERVICIO SOCIAL',0,1,'C');
            $this->Ln(10);
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);

// Posicionar los datos en la plantilla (coordenadas exactas)

// Datos del alumno
$pdf->SetXY(116, 40.8);
$pdf->Cell(0, 10, $reporte['codigoAlumno']."-");

$pdf->SetXY(132, 40.8);
$pdf->Cell(0, 10, $reporte['nombreAlumno']);

// Nuevos campos agregados
$pdf->SetXY(116, 45.4);
$pdf->Cell(0, 10, " ".$reporte['Carrera']);

$pdf->SetXY(35, 42.2);
$pdf->Cell(0, 10, " ".$reporte['numero_oficio']);

$pdf->SetXY(35, 47.4);
$pdf->Cell(0, 10, " ".$reporte['turno']);

$pdf->SetXY(35, 57.4);
$pdf->Cell(0, 10, " ".$reporte['dependencia']);

$pdf->SetXY(35, 55);
$pdf->MultiCell(150, 5, " ".$reporte['programa']);

// Fecha de término
$pdf->SetXY(108, 84.7);
$pdf->MultiCell(150, 5, " ".date("d/m/Y", strtotime($reporte['fecha_termino'])));

// Objetivos y actividades
$pdf->SetXY(16, 92);
$pdf->MultiCell(150, 5, "\n".$reporte['objetivos_programa']);

$pdf->SetXY(16, 106);
$pdf->MultiCell(150, 5, "\n".$reporte['actividades_realizadas']);

// Metas y metodología
$pdf->SetXY(16, 124);
$pdf->MultiCell(150, 5, "\n".$reporte['metas_alcanzadas']);

$pdf->SetXY(16, 148);
$pdf->MultiCell(150, 5, "\n".$reporte['metodologia_utilizada']);

$pdf->SetXY(16, 169);
$pdf->MultiCell(150, 5, "\n".$reporte['conclusion_propuestas']);

$pdf->SetXY(16, 186);
$pdf->MultiCell(150, 5, "\n".$reporte['aporte_innovaciones']);

// Nombre del archivo
$nombre_archivo = "Reporte_Final_".$reporte['codigoAlumno'].".pdf";

// Cerrar conexión
$stmt->close();
CloseCon($conn);

// Salida del PDF
$pdf->Output('D', $nombre_archivo);
exit;