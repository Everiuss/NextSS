<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    die("No hay sesión iniciada. Acceso denegado.");
}

require '../vendor/autoload.php';  // Asegúrate de que la ruta sea correcta
require_once '../lib/fpdf.php';  // Asegúrate de que fpdf.php está en la ruta correcta

// Crear una instancia del objeto FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Establecer la fuente antes de usarla
$pdf->SetFont('Arial', 'B', 16);  // Establece la fuente Arial en negrita y tamaño 16
$pdf->Cell(40, 10, 'Orden de Pago');

// Conectar a la base de datos y obtener los datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nextss_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario desde la sesión
$IdUsuario = $_SESSION['id_usuario'];

// Obtener los datos del alumno basado en el ID del usuario
$sql = "SELECT * FROM alumno WHERE IdUsuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();
$alumno = $result->fetch_assoc();

// Verificar si se encontraron datos del alumno
if ($alumno) {
    // Obtener los datos del alumno
    $nombreAlumno = $alumno['nombreAlumno'];
    $curp = $alumno['curp'];
    $domicilio = $alumno['domicilio'];
    $correoAlumno = $alumno['correoAlumno'];

    // Agregar la información al PDF
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Nombre: ' . $nombreAlumno);
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'CURP: ' . $curp);
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Domicilio: ' . $domicilio);
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Correo: ' . $correoAlumno);
} else {
    // Si no se encuentran datos del alumno, mostrar mensaje
    $pdf->Cell(0, 10, 'No se encontraron datos del alumno.');
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Salida del archivo PDF
$pdf->Output('D', 'Orden_Pago.pdf');
exit;
?>
