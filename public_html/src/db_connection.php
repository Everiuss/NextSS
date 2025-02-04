<?php
function OpenCon() {
    $conn = new mysqli('localhost', 'root', '', 'clatyhouse_db');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("ERROR: No se ha podido establecer la conexión: " . $conn->connect_error);
    }
    return $conn;
}

//function CloseCon($conn) {
//    $conn->close();
//}
?>
