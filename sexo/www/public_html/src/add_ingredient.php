<?php
session_start();
    if (!isset($_SESSION['correo']) OR $_SESSION['rol'] != "Administrador") {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Agregar Ingredientes</title>
        
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
						Agrega un Ingrediente
					</span>
                </div>

				<br>

&nbsp; &nbsp; <a href="../index.php"> <img src="../img/Salir.png" width="40" height="40" alt="Salir" name="Salir"> </a>
                
    <?php
    
        include("db_connection.php");
        if(isset($_POST['registrar'])){
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
            $imagen = mysqli_real_escape_string($conn, $_POST['imagen']);
            $registrar_ingredientes = "INSERT INTO INGREDIENTES 
            (Nombre, CantidadActual, Imagen) VALUES ('$nombre','$cantidad','$imagen')";

            if($conn -> query($registrar_ingredientes)){
                echo '<script type="text/javascript">alert("El nuevo ingrediente ha sido añadido con éxito.");</script>';
            }else {
                echo "ERROR: no fue posible ejecutar $registrar_ingredientes." . $conn -> error;
            }
                
            $sel_ingrediente = "SELECT * FROM INGREDIENTES";
            if($ingredientes= $conn -> query($sel_ingrediente)) {
                if($ingredientes->num_rows > 0) { ?>
                <table border ="1" cellspaciong="0" border ="1" bordercolor="#6C4028" style="margin: 0 auto; text-align: center">
                <tr>
                    
                <td>&nbsp; IdIngrediente &nbsp;</td>
                <td>&nbsp; Nombre &nbsp;</td>
                <td>&nbsp; CantidadActual &nbsp;</td>
                <td>&nbsp; Imagen &nbsp;</td>

                </tr>
                <?php while($ing= $ingredientes->fetch_array()) { ?>
            <tr>
                
            <td><?php echo $ing['IdIngrediente'];?></td>
            <td><?php echo $ing['Nombre'];?></td>
            <td><?php echo $ing['CantidadActual'];?></td>
            <td><?php echo "<img src='".$ing['Imagen']."'"." style='height: 130px; width: 130px'/>";?></td>

            </tr>
            <?php }}}} ?>
	 </table>
	 
	<form class="login100-form" method="post" action="add_ingredient.php">

        <div class="wrap-input100 m-b-26">
                <span class="label-input100">Nombre del Ingrediente:</span>
                <input type="text" class="input100" name="nombre" placeholder="Ingresa el Nombre del Ingrediente" required/>
                <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 m-b-26">
        <span class="label-input100">Cantidad actual:</span>
        <input type="number" class="input100" name="cantidad" placeholder="Ingresa la Cantidad actual del Ingrediente" required/>
        <span class="focus-input100"></span>
        </div> 
        
        <div class="wrap-input100 m-b-26">
        <span class="label-input100">Imagen:</span>
        <input type="text" class="input100" name="imagen" placeholder="Ingresa la Imagen del Ingrediente" required/>
        <span class="focus-input100"></span>
        </div> 
            
        <div class="container-login100-form-btn">

    <input class="login100-form-btn" type="submit" name="registrar" value="Registrar">
		</form>    
		</div>		
		
	</body>
</html>