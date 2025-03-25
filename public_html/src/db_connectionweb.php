
<?php
function OpenCon() {
    $servername = "sql213.infinityfree.com"; // Confirma el host en tu cuenta de InfinityFree
    $username = "if0_38558356"; // Usuario de la base de datos
    $password = "LaRinconada21"; // Cambia esto en InfinityFree
    $database = "if0_38558356_nextss_db"; // Usa el nombre correcto con el prefijo

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("ERROR: No se ha podido establecer la conexión: " . $conn->connect_error);
    }
    return $conn;
}

function CloseCon($conn) {
    $conn->close();
}
?>
