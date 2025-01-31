<?php 
    session_start();
    if (isset($_SESSION['correo'])) {
        header('Location: ../src/recetario.php');
    }
    if(!isset($_POST['ingresar'])){
	$correo = (isset($_COOKIE['correo'])) ? $_COOKIE['correo'] : NULL;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Iniciar Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
		<div class="container-login100">
			<div class="wrap-login100">
						
				<div class="login100-form-title" style="background-image: url(../img/IngresoHead.jpg);">
					<span class="login100-form-title-1">
						Inicia Sesión
					</span>
					<span class="login100-form-title-1">
						Servicio Social
					</span>
				</div>

				<form class="login100-form validate-form" method="post" action="validation.php">
					<div class="wrap-input100 validate-input m-b-26" data-validate="El Código es Obligatorio">
						<span class="label-input100">Correo:</span>
						<input class="input100" type="email" name="correo" placeholder="Ingresa tu código" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "La Contraseña es Obligatoria">
						<span class="label-input100">Contraseña:</span>
						<input class="input100" type="password" name="contrasena" placeholder="Ingresa tu Contraseña" required>
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="rastreo" checked>
							<label class="label-checkbox100" for="ckb1">
								Recuerdame
							</label>
						</div>
					</div>
					
					<div class="flex-sb-m w-full p-b-30">
						<label class="label">
					    <a href="user_register.php" style="text-decoration: none;">
							¿No tienes una cuenta? <b>Crea una aquí.</b>
						</a>
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="ingresar" value="Iniciar Sesion" align="center" style="padding: 0 125px;">
							Ingresar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="../js/Ingreso.js"></script>

</body>
</html>