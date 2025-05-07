<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_reporte'])) {
    $id_reporte = $_POST['id_reporte'];

    $sql = "DELETE FROM reportes WHERE id_reporte = ? AND IdUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_reporte, $IdUsuario);

    if ($stmt->execute()) {
        echo "<script>alert('Reporte eliminado correctamente'); window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el reporte'); window.history.back();</script>";
    }

    $stmt->close();
    CloseCon($conn);
}
?>
