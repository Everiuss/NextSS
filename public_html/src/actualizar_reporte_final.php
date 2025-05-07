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
    $ruta_documento = null;

    // Procesar archivo si se cargó uno nuevo
    if (isset($_FILES['archivo_final']) && $_FILES['archivo_final']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = basename($_FILES['archivo_final']['name']);
        $ruta_subida = 'documentos/' . uniqid() . '_' . $nombre_archivo;

        if (move_uploaded_file($_FILES['archivo_final']['tmp_name'], $ruta_subida)) {
            $ruta_documento = $ruta_subida;
        } else {
            echo "Error al subir el archivo.";
            exit();
        }
    } else {
        // Conservar el archivo existente si no se cargó uno nuevo
        $ruta_documento = $_POST['ruta_documento_existente'] ?? null;
    }

    $sql = "UPDATE reportes_finales SET 
        id_plaza = ?, 
        fecha_termino = ?, 
        objetivos_programa = ?, 
        actividades_realizadas = ?, 
        metas_alcanzadas = ?, 
        metodologia_utilizada = ?, 
        conclusion_propuestas = ?, 
        aporte_innovaciones = ?, 
        ruta_documento = ?
        WHERE id_reporte_final = ? AND IdUsuario = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "issssssssii",
        $_POST['id_plaza'],
        $_POST['fecha_termino'],
        $_POST['objetivos_programa'],
        $_POST['actividades_realizadas'],
        $_POST['metas_alcanzadas'],
        $_POST['metodologia_utilizada'],
        $_POST['conclusion_propuestas'],
        $_POST['aporte_innovaciones'],
        $ruta_documento,
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
