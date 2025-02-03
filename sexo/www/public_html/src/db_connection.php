<?php	
	// Crear conexion
	$conn = mysqli_connect('localhost', 'root', '', 'clatyhouse_db');
	// Checa la conexion
	if (!$conn) {
	    die ("ERROR: no se ha podido establecer la conexión" . mysql_connect_error());
	}
?>