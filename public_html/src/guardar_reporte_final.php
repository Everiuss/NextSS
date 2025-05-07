<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

// Obtener id_plaza activa asociada al usuario
$sqlPlaza = "SELECT id_plaza FROM plazas WHERE id_alumno = ? AND estatus = 'ACTIVA' LIMIT 1";
$stmtPlaza = $conn->prepare($sqlPlaza);
$stmtPlaza->bind_param("i", $IdUsuario);
$stmtPlaza->execute();
$resultPlaza = $stmtPlaza->get_result();

if ($row = $resultPlaza->fetch_assoc()) {
    $id_plaza = $row['id_plaza'];
} else {
    echo "<script>alert('No se encontró una plaza activa asociada al alumno.'); window.history.back();</script>";
    exit();
}
$stmtPlaza->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $fecha_termino = $_POST['fecha_termino'];
    $objetivos_programa = $_POST['objetivos_programa'];
    $actividades_realizadas = $_POST['actividades_realizadas'];
    $metas_alcanzadas = $_POST['metas_alcanzadas'];
    $metodologia_utilizada = $_POST['metodologia_utilizada'];
    $conclusion_propuestas = $_POST['conclusion_propuestas'];
    $aporte_innovaciones = $_POST['aporte_innovaciones'];

    $ruta_documento = NULL;

    // Manejo del archivo subido (si existe)
    if (isset($_FILES['archivo_final']) && $_FILES['archivo_final']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['archivo_final']['name'];
        $tmpArchivo = $_FILES['archivo_final']['tmp_name'];

        $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $nuevoNombre = "reporte_final_" . $IdUsuario . "_" . time() . "." . $ext;
        $rutaDestino = "documentos_finales/" . $nuevoNombre;

        // Crear carpeta si no existe
        if (!is_dir("documentos_finales")) {
            mkdir("documentos_finales", 0777, true);
        }

        if (move_uploaded_file($tmpArchivo, $rutaDestino)) {
            $ruta_documento = $rutaDestino;
        } else {
            echo "<script>alert('Error al subir el archivo.'); window.history.back();</script>";
            exit();
        }
    }

    // Insertar en la tabla reportes_finales
    $sql = "INSERT INTO reportes_finales 
        (IdUsuario, id_plaza, fecha_termino, objetivos_programa, actividades_realizadas, metas_alcanzadas, 
         metodologia_utilizada, conclusion_propuestas, aporte_innovaciones, ruta_documento) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssssss", 
        $IdUsuario, 
        $id_plaza,
        $fecha_termino,
        $objetivos_programa,
        $actividades_realizadas,
        $metas_alcanzadas,
        $metodologia_utilizada,
        $conclusion_propuestas,
        $aporte_innovaciones,
        $ruta_documento
    );

    if ($stmt->execute()) {
        echo "<script>alert('Reporte final guardado exitosamente'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Error al guardar el reporte final'); window.history.back();</script>";
    }

    $stmt->close();
    CloseCon($conn);
}
?>
