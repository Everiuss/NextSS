<?php

    session_start();
    if (!isset($_SESSION['correo'])) {
        header('Location: login.php');
    }

    include("db_connection.php");

	// Valores obtenidos desde el formulario
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conn, md5($_POST['contrasena']));
	$result = mysqli_query($conn, "SELECT * FROM USUARIOS WHERE Correo = '$correo' AND Contrasena = '$contrasena'");

	if(mysqli_num_rows($result) > 0) {
	    $ur = $result -> fetch_array();
        session_start();
        $_SESSION['id_usuario'] = $ur['IdUsuario'];
        $_SESSION['correo'] = $correo;
        $_SESSION['usuario'] = $ur['Usuario'];
        $_SESSION['rol'] = $ur['Rol'];
        $_SESSION['nombre'] = $ur['Nombre'];

        if(isset($_POST['rastreo'])) {
            setcookie('correo', $_POST['correo'], time()+3600*24*365*100, '/');
        }
        header('Location: ../index.php');
	} else {
	    include("login.php");
        echo 'Usuario no encontrado';
    }
    mysqli_close($conn);
?>