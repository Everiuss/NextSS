<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del reporte principal
    $tipo_reporte = $_POST['tipo_reporte'];
    $consecutivo = $_POST['consecutivo'];
    $horas_reportadas = $_POST['horas_reportadas'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $actividades_realizadas = $_POST['actividades_realizadas'];

    // Datos de la evaluación
    $actividades_ajustadas = $_POST['actividades_ajustadas'];
    $nuevos_conocimientos = $_POST['nuevos_conocimientos'];
    $experiencias_formativas = $_POST['experiencias_formativas'];
    $experiencias_profesionales = $_POST['experiencias_profesionales'];
    $adquisicion_habilidades = $_POST['adquisicion_habilidades'];

    // Datos de las aportaciones
    $aportaciones_institucion = $_POST['aportaciones_institucion'];

    // Datos de la última pregunta de evaluación
    $cumplimiento_actividades = $_POST['cumplimiento_actividades'];

    // Insertar en la tabla reportes
    $sql = "INSERT INTO reportes
            (IdUsuario, tipo_reporte, consecutivo, horas_reportadas, fecha_inicio, fecha_fin, actividades_realizadas, 
             actividades_ajustadas, nuevos_conocimientos, experiencias_formativas, experiencias_profesionales, 
             adquisicion_habilidades, aportaciones_institucion, cumplimiento_actividades) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssssssss", 
        $IdUsuario, 
        $tipo_reporte, 
        $consecutivo,   
        $horas_reportadas, 
        $fecha_inicio, 
        $fecha_fin, 
        $actividades_realizadas, 
        $actividades_ajustadas, 
        $nuevos_conocimientos, 
        $experiencias_formativas, 
        $experiencias_profesionales, 
        $adquisicion_habilidades, 
        $aportaciones_institucion,
        $cumplimiento_actividades
    );


    if ($stmt->execute()) {
        echo "<script>alert('Reporte guardado exitosamente'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Error al guardar el reporte'); window.history.back();</script>";
    }

    $stmt->close();
    CloseCon($conn);
}
?>