<?php
    session_start();
    if (!isset($_SESSION['correo']) OR $_SESSION['rol'] != "Administrador") {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Actualizar Receta</title>
        
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
						Actualiza datos de las Recetas
					</span>
                </div>

			 <br>

&nbsp; &nbsp; <a href="../index.php"> <img src="../img/Salir.png" width="40" height="40" alt="Salir" name="Salir"> </a>

<?php
include("db_connection.php");

if(isset ($_POST['actualizado']))
{
	$id_receta = mysqli_real_escape_string($conn, $_POST['id_receta']);
	$id_producto = mysqli_real_escape_string($conn, $_POST['id_producto']);
	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$modo_preparacion = mysqli_real_escape_string($conn, $_POST['modo_preparacion']);
	$actualizar_receta="UPDATE RECETAS SET IdProducto = '$id_producto', Nombre = '$nombre',  Preparacion = '$modo_preparacion' WHERE IdReceta = '$id_receta'";
	if($conn -> query ($actualizar_receta))
	{
        echo '<script type="text/javascript">alert("'.$conn -> affected_rows.' Fila(s) actualizadas.");</script>';
	}
	else
	{
		echo "ERROR: no fue posible ejecutar; $actualizar_receta.".$conn->error;
	}
}




if(isset($_POST['eliminar']))
{
	$id_receta = mysqli_real_escape_string($conn, $_POST['id_receta']);
	$eliminar_receta = "DELETE FROM RECETAS WHERE IdReceta = '$id_receta'";
	if($conn -> query($eliminar_receta))
	{
        echo '<script type="text/javascript">alert("Registro eliminado de forma exitosa.");</script>';
    }
	else 
	{
        echo "ERROR: No fue posible ejecutar $eliminar_receta.".$conn -> error;
    }
}
	
$sel_recipe = "SELECT * FROM RECETAS";
if($recetas = $conn-> query($sel_recipe))
{
	if($recetas -> num_rows > 0)
	{?>

		<br>
		<center> Seleccina una receta para actualizarla&nbsp;: </center>

		<div class="wrap-input100 m-b-26" style="border-bottom: none">
		<form action="update_recipe.php" method="post" class="login100-form">
		<select name="id_receta" class="select" style="margin-top: 10px; border-radius: 5px; border-color:#808080" required>

		<?php 
		while($ing = $recetas-> fetch_array())
		{?>	
			
			<option value="<?php echo $ing['IdReceta'];?>">
			<?php echo $ing['IdReceta'].'.&nbsp; &nbsp;'.$ing['Nombre'].'&nbsp; &nbsp;'?>
			</option> <?php 
		}?>
		</select>

		</div>

		<div class="container-login100-form-btn">

		<input type="submit" name="actualizar" value="Actualizar" class="login100-form-btn" style="margin-left: 22%; margin-bottom: 3%">
		<input type="submit" name="eliminar" value="Eliminar" class="login100-form-btn" style="margin-left: 20%" >

		</form>
			</div>

		<?php 
	} 
	else
	{
		echo 'No se encontraron registros en la tabla';
	}
} 
	
	if(isset($_POST['actualizar']))
	{
		$id_receta = mysqli_real_escape_string($conn, $_POST['id_receta']);
		$sel_recipe = "SELECT * FROM RECETAS WHERE IdReceta = '$id_receta'";
		
		//Arreglo de una fila 
		//no se hace while por que solo es un registro
		$ingrediente = $conn -> query($sel_recipe);
		$ing = $ingrediente -> fetch_array(); ?>

        <form class="login100-form" action="update_recipe.php" method="post">

		
		<div class="wrap-input100 m-b-26">

			<span class="label-input100">Producto:</span>
			<input type="text" class="input100" name="id_producto" value="<?php echo $ing['IdProducto']; ?>"/>
			<span class="focus-input100"></span>
		</div>

		<div class="wrap-input100 m-b-26">

			<span class="label-input100">Nombre:</span>
			<input type="text" class="input100" name="nombre" value="<?php echo $ing['Nombre']; ?>"/>
			<span class="focus-input100"></span>
		</div>

		
		<div class="wrap-input100 m-b-26">

			<span class="label-input100">Preparación:</span>
			<input type="text" class="input100" name="modo_preparacion" value="<?php echo $ing['Preparacion']; ?>"/>
			<span class="focus-input100"></span>
		</div>	

					
			<!--boton para actualizar la tabla -->
			<div class="container-login100-form-btn">

		<input type="submit" name="actualizado" value="Actualizar" class="login100-form-btn" style="margin-left: 20%;">

				<input type="hidden" name="id_receta" value="<?php echo $_POST['id_receta'];?>" />
				
				</form>

			</div>
			<?php 
	} ?>
</body>
</html>