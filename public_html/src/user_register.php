
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Cambiar contraseña</title>
        
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../img/icono.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/Ingreso.css">
<!--===============================================================================================-->
	</head>

	<body>
    <div class="limiter">
		<div class="container-login100" style="background: url(../img/ProductoFondo.png);">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(../img/IngresoHead.jpg);">
					<span class="login100-form-title-1">
						Crea una cuenta en Servicio Social
					</span>
                </div>

				<br>

&nbsp; &nbsp; <a href="login.php"> <img src="../img/Salir.png" width="40" height="40" alt="Salir" name="Salir"> </a>
                
    <?php
        
        session_start();
        include("db_connection.php");
        $conn = OpenCon();


        if(isset($_POST['registrar'])){
            $correo = mysqli_real_escape_string($conn, $_POST['correo']);
            $contrasena = mysqli_real_escape_string($conn, md5($_POST['contrasena']));
            $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $registrar_usuario = "INSERT INTO USUARIOS 
            (Correo, Contrasena, Usuario, Nombre, Rol) VALUES ('$correo','$contrasena','$usuario','$nombre','Usuario')";

            if($conn -> query($registrar_usuario)){
                echo '<script type="text/javascript">alert("Se ha creado la cuenta con éxito.");</script>';
                echo '<script type="text/javascript">window.location.href="login.php";</script>';
            }else {
                echo "ERROR: no fue posible ejecutar $registrar_usuario." . $conn -> error;
            }
        }
        CloseCon($conn);
    ?>
	 
	<form class="login100-form" method="post" action="user_register.php" novalidate>

        <div class="wrap-input100 m-b-26">
                <span class="label-input100">Codigo:</span>
                <input type="email" class="input100" name="correo" placeholder="Ingresa tu Codigo" required/>
                <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 m-b-26" data-validate="El Código es Obligatorio">
                <span class="label-input100">Contrasena:</span>
                <input type="password" class="input100" name="contrasena" placeholder="Ingresa tu Contrasena" required/>
                <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 m-b-26">
        <span class="label-input100">Usuario:</span>
        <input type="text" class="input100" name="usuario" placeholder="Ingresa tu Usuario" required/>
        <span class="focus-input100"></span>
        </div> 
                
        <div class="wrap-input100 m-b-26">
        <span class="label-input100">Nombre:</span>
        <input type="text" class="input100" name="nombre" placeholder="Ingresa tu Nombre completo" required/>
        <span class="focus-input100"></span>
        </div>
        
            
        <div class="container-login100-form-btn">

    <input class="login100-form-btn" type="submit" name="registrar" value="Registrar">
		</form>    
		</div>		
		
	</body>
</html>