<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $IdUsuario = $_SESSION['id_usuario'];

    // Conexión
    $conn = OpenCon();

    // Recibir y limpiar datos
    $codigo = $_POST['codigo'] ?? '';
    $nombre = $_POST['nombre_alumno'] ?? '';
    $curp = $_POST['curp'] ?? '';
    $domicilio = $_POST['domicilio'] ?? '';
    $fecha_nac = $_POST['fecha_nacimiento'] ?? '';
    $colonia = $_POST['colonia'] ?? '';
    $codigo_postal = $_POST['codigo_postal'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $correo = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $trabaja = $_POST['trabaja'] ?? '0';

    // Si trabaja, obtener el nombre de la empresa; si no, dejar en null
    $empresa = ($trabaja == '1' && isset($_POST['empresa']) && $_POST['empresa'] !== '') ? $_POST['empresa'] : null;

    // Validación extra: si trabaja debe haber empresa
    if ($trabaja == '1' && empty($empresa)) {
        CloseCon($conn);
        echo "Error: Debes ingresar el nombre de la empresa si trabajas.";
        exit();
    }

    // Consulta para insertar o actualizar
    $sql = "INSERT INTO alumno 
        (IdUsuario, codigoAlumno, nombreAlumno, curp, domicilio, fechaNac, colonia, codigoPostal, pais, estado, ciudad, correoAlumno, telefono, trabajoBool, empresa)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        codigoAlumno = VALUES(codigoAlumno),
        nombreAlumno = VALUES(nombreAlumno),
        curp = VALUES(curp),
        domicilio = VALUES(domicilio),
        fechaNac = VALUES(fechaNac),
        colonia = VALUES(colonia),
        codigoPostal = VALUES(codigoPostal),
        pais = VALUES(pais),
        estado = VALUES(estado),
        ciudad = VALUES(ciudad),
        correoAlumno = VALUES(correoAlumno),
        telefono = VALUES(telefono),
        trabajoBool = VALUES(trabajoBool),
        empresa = VALUES(empresa)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "issssssssssssis",
        $IdUsuario,
        $codigo,
        $nombre,
        $curp,
        $domicilio,
        $fecha_nac,
        $colonia,
        $codigo_postal,
        $pais,
        $estado,
        $ciudad,
        $correo,
        $telefono,
        $trabaja,
        $empresa
    );

    if ($stmt->execute()) {
        header("Location: cart.php?guardado=1");
        exit();
    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
    CloseCon($conn);
}
?>
