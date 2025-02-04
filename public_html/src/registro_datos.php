<?php
include 'db_connection.php';
$conn = OpenCon();

// Verificar si se enviaron datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $empresa = !empty($_POST['empresa']) ? $_POST['empresa'] : NULL;
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
        $stmt->bind_param("sssssssssssis", 
            $nombre, $curp, $domicilio, $fecha_nacimiento, 
            $colonia, $codigo_postal, $pais, $estado, $ciudad, 
            $email, $telefono, $trabajaBool, $empresa, $codigo);
    } else {
        // Si no existe, insertar
        $sql_insert = "INSERT INTO alumno 
                        (codigoAlumno, nombreAlumno, curp, domicilio, fechaNac, 
                         colonia, codigoPostal, pais, estado, ciudad, 
                         correoAlumno, telefono, trabajoBool, empresa) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("ssssssssssssis", 
            $codigo, $nombre, $curp, $domicilio, $fecha_nacimiento, 
            $colonia, $codigo_postal, $pais, $estado, $ciudad, 
            $email, $telefono, $trabajaBool, $empresa);
    }
    
    // Ejecutar consulta
    if ($stmt->execute()) {
        echo "<script>
                alert('Datos guardados correctamente');
                window.location.href='datos_personales.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al guardar los datos: " . $conn->error . "');
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