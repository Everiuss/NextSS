<?php
session_start();

require '../vendor/autoload.php';
require_once '../lib/fpdf.php';

// Crear una instancia del objeto FPDF
class PDF extends FPDF {
    function Header() {
        // Cargar la imagen de fondo (convertida desde el PDF original)
        $this->Image('../assets/plantilla_pago.jpg', 0, 0, 210, 297); // Ajusta la ruta y tamaño según sea necesario
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nextss_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del usuario
$IdUsuario = $_SESSION['id_usuario'];
$sql = "SELECT a.codigoAlumno, a.nombreAlumno, r.Carrera 
        FROM alumno a
        JOIN registro r ON a.codigoAlumno = r.codigoAlumno
        WHERE a.IdUsuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();
$alumno = $result->fetch_assoc();

if ($alumno) {
    $codigoAlumno = $alumno['codigoAlumno'];
    $nombreAlumno = $alumno['nombreAlumno'];
    $carrera = $alumno['Carrera'];

    // Posicionar y agregar los datos en la plantilla (primera vez)
    $pdf->SetXY(82, 45); // Ajusta las coordenadas según la plantilla
    $pdf->Cell(0, 10, $codigoAlumno);

    $pdf->SetXY(82,53);
    $pdf->Cell(0, 10, $nombreAlumno);

    $pdf->SetXY(82, 62);
    $pdf->Cell(0, 10, $carrera);

    // Posicionar y agregar los datos en la plantilla (segunda vez)
    $pdf->SetXY(82, 148); // Ajusta las coordenadas para la segunda impresión
    $pdf->Cell(0, 10, $codigoAlumno);

    $pdf->SetXY(82, 156);
    $pdf->Cell(0, 10, $nombreAlumno);

    $pdf->SetXY(82, 165);
    $pdf->Cell(0, 10, $carrera);
} else {
    $pdf->SetXY(150, 53);
    $pdf->Cell(0, 10, 'No se encontraron datos.');
}

// Cerrar conexión
$stmt->close();
$conn->close();

// Salida del PDF
$pdf->Output('D', 'Orden_Pago.pdf');
exit;
?>
