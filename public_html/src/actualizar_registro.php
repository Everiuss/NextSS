<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    
    // Determinar el nuevo valor de 'Registro'
    $nuevoRegistro = ($accion == "registrar") ? 1 : 0;

    // Actualizar la base de datos
    $sql = "UPDATE registro r
            INNER JOIN alumno a ON r.codigoAlumno = a.codigoAlumno
            SET r.Registro = ?
            WHERE a.IdUsuario = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $nuevoRegistro, $IdUsuario);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Registro actualizado correctamente.";
    } else {
        $_SESSION['error'] = "Error al actualizar el registro.";
    }

    $stmt->close();
    CloseCon($conn);

    // Redirigir a la misma página
    header("Location: registro.php");
    exit();
}
?>
