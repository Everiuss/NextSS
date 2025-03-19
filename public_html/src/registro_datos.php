<?php
session_start(); // Iniciar sesión para acceder a $_SESSION
include 'db_connection.php';
$conn = OpenCon();

// Verificar si se enviaron datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id_usuario'])) {
        echo "<script>
                alert('Error: No hay una sesión activa.');
                window.location.href='login.php';
              </script>";
        exit();
    }

    $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario de la sesión
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre_alumno'];
    $curp = $_POST['curp'];
    $domicilio = $_POST['domicilio'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $colonia = $_POST['colonia'];
    $codigo_postal = $_POST['codigo_postal'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $ciudad = $_POST['ciudad'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $trabaja = $_POST['trabaja'];
    $empresa = (!empty($_POST['empresa']) && $_POST['trabaja'] == "si") ? $_POST['empresa'] : 'NA';
    $trabajaBool = ($trabaja == "si") ? 1 : 0;

    // Verificar si el alumno ya existe
    $sql_check = "SELECT * FROM alumno WHERE codigoAlumno = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $codigo);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Si existe, actualizar
        $sql_update = "UPDATE alumno SET 
                        nombreAlumno=?, curp=?, domicilio=?, fechaNac=?, 
                        colonia=?, codigoPostal=?, pais=?, estado=?, ciudad=?, 
                        correoAlumno=?, telefono=?, trabajoBool=?, empresa=? 
                        WHERE codigoAlumno=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ssssssssssssis", 
            $nombre, $curp, $domicilio, $fecha_nacimiento, 
            $colonia, $codigo_postal, $pais, $estado, $ciudad, 
            $email, $telefono, $trabajaBool, $empresa, $codigo);
    } else {
        // Si no existe, insertar con IdUsuario
        $sql_insert = "INSERT INTO alumno 
                        (codigoAlumno, nombreAlumno, curp, domicilio, fechaNac, 
                         colonia, codigoPostal, pais, estado, ciudad, 
                         correoAlumno, telefono, trabajoBool, empresa, IdUsuario) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("sssssssssssssii", 
            $codigo, $nombre, $curp, $domicilio, $fecha_nacimiento, 
            $colonia, $codigo_postal, $pais, $estado, $ciudad, 
            $email, $telefono, $trabajaBool, $empresa, $id_usuario);
    }

    // Ejecutar consulta
    if ($stmt->execute()) {
        echo "<script>
                alert('Datos guardados correctamente');
                window.location.href='datos_personales.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al guardar los datos: " . $stmt->error . "');
              </script>";
    }

    // Cerrar conexiones
    $stmt->close();
    $stmt_check->close();
    CloseCon($conn);
} else {
    echo "<script>
            alert('Acceso no autorizado');
            window.location.href='datos_personales.php';
          </script>";
}
?>
