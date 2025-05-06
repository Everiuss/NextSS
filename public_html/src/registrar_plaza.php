<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$dependencia = $_POST['dependencia'] ?? '';
$programa = $_POST['programa'] ?? '';
$fecha_inicio = $_POST['fecha_inicio'] ?? date('Y-m-d');

$conn = OpenCon();

// 🔍 Validar si ya existe una plaza ACTIVA
$sql_check = "SELECT COUNT(*) as total FROM plazas WHERE id_alumno = ? AND estatus = 'ACTIVA'";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $IdUsuario);
$stmt_check->execute();
$result = $stmt_check->get_result();
$row = $result->fetch_assoc();

if ($row['total'] > 0) {
    echo json_encode(['error' => 'Ya tienes una plaza activa registrada.']);
    $stmt_check->close();
    CloseCon($conn);
    exit();
}
$stmt_check->close();

// 🧮 Obtener último número de oficio
$sql = "SELECT numero_oficio FROM plazas ORDER BY id_plaza DESC LIMIT 1";
$result = $conn->query($sql);
$ultimo_oficio = $result->fetch_assoc()['numero_oficio'] ?? '820/CUCEI/2024B';

preg_match('/(\d+)\/CUCEI\/(\d+)/', $ultimo_oficio, $matches);
$numero = isset($matches[1]) ? (int)$matches[1] + 1 : 821;
$anio = isset($matches[2]) ? (int)$matches[2] : date('Y');
$nuevo_oficio = sprintf('%03d/CUCEI/%dB', $numero, $anio);

// 📝 Insertar nueva plaza
$stmt = $conn->prepare("INSERT INTO plazas (id_alumno, numero_oficio, estatus, fecha_inicio, fecha_fin, dependencia, programa) VALUES (?, ?, 'ACTIVA', ?, NULL, ?, ?)");
$stmt->bind_param("issss", $IdUsuario, $nuevo_oficio, $fecha_inicio, $dependencia, $programa);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Plaza registrada exitosamente.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Error al registrar la plaza.']);
}

$stmt->close();
CloseCon($conn);
?>
