<?php
include("db_connection.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$conn = OpenCon();

$id_usuario = $_SESSION['id_usuario'];
$id_reporte = $_POST['id_reporte_final'] ?? null;

if ($id_reporte) {
    $sql = "DELETE FROM reportes_finales WHERE id_reporte_final = ? AND IdUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_reporte, $id_usuario);

    if ($stmt->execute()) {
        echo "<script>alert('Reporte eliminado correctamente'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el reporte'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    echo "ID de reporte inválido.";
}

CloseCon($conn);
