<?php
include("db_connection.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$conn = OpenCon();

$id_usuario = $_SESSION['id_usuario'];
$id_reporte = $_POST['id_reporte'] ?? null;

if ($id_reporte) {
    $sql = "UPDATE reportes SET 
        tipo_reporte = ?, consecutivo = ?, fecha_inicio = ?, fecha_fin = ?, 
        actividades_realizadas = ?, horas_reportadas = ?, actividades_ajustadas = ?, 
        nuevos_conocimientos = ?, experiencias_formativas = ?, experiencias_profesionales = ?, 
        adquisicion_habilidades = ?, aportaciones_institucion = ?, cumplimiento_actividades = ?
        WHERE id_reporte = ? AND IdUsuario = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sisssissssssiii",
        $_POST['tipo_reporte'],
        $_POST['consecutivo'],
        $_POST['fecha_inicio'],
        $_POST['fecha_fin'],
        $_POST['actividades_realizadas'],
        $_POST['horas_reportadas'],
        $_POST['actividades_ajustadas'],
        $_POST['nuevos_conocimientos'],
        $_POST['experiencias_formativas'],
        $_POST['experiencias_profesionales'],
        $_POST['adquisicion_habilidades'],
        $_POST['aportaciones_institucion'],
        $_POST['cumplimiento_actividades'],
        $id_reporte,
        $id_usuario
    );
    

    if ($stmt->execute()) {
        echo "<script>alert('Reporte editado correctamente'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el reporte'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    echo "ID de reporte inválido.";
}

CloseCon($conn);
?>
