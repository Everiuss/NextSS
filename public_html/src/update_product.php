<?php
    session_start();
    if (!isset($_SESSION['correo']) OR $_SESSION['rol'] != "Administrador") {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Actualizar Producto</title>
        
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
						Actualiza datos de los Productos
					</span>
                </div>

			 <br>

&nbsp; &nbsp; <a href="../index.php"> <img src="../img/Salir.png" width="40" height="40" alt="Salir" name="Salir"> </a>

<?php
include("db_connection.php");

if(isset ($_POST['actualizado']))
{
	$id_producto = mysqli_real_escape_string($conn, $_POST ['id_producto']);
	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$informacion = mysqli_real_escape_string($conn, $_POST['informacion']);
    $cantidad_actual = mysqli_real_escape_string($conn, $_POST['cantidad_actual']);
    $costo = mysqli_real_escape_string($conn, $_POST['costo']);
    $imagen = mysqli_real_escape_string($conn, $_POST['imagen']);
	$actualizar_producto="UPDATE PRODUCTOS SET Nombre = '$nombre', Informacion = '$informacion', CantidadActual = '$cantidad_actual', Costo = '$costo', Imagen = '$imagen' WHERE IdProducto = '$id_producto'";
	if($conn -> query ($actualizar_producto))
	{
        echo '<script type="text/javascript">alert("'.$conn -> affected_rows.' Fila(s) actualizadas.");</script>';
}else{
	echo "ERROR: no fue posible ejecutar; $actualizar_producto.".$conn->error;
}}




 if(isset($_POST['eliminar']))
 {
	$id_producto = mysqli_real_escape_string($conn, $_POST['id_producto']);
		$eliminar_producto = "DELETE FROM PRODUCTOS WHERE IdProducto = '$id_producto'";
	if($conn -> query($eliminar_producto)){
        echo '<script type="text/javascript">alert("Registro eliminado de forma exitosa.");</script>';
        }else {
            echo "ERROR: No fue posible ejecutar $eliminar_producto.".$conn -> error;
        }
    }
	
$sel_producto = "SELECT * FROM PRODUCTOS";
if($productos = $conn-> query($sel_producto)){
if($productos -> num_rows > 0){
?>

<br>
<center> Seleccina un dato para actualizarlo&nbsp;: </center>

<div class="wrap-input100 m-b-26" style="border-bottom: none">
<form action="update_product.php" method="post" class="login100-form">
<select name="id_producto" class="select" style="margin-top: 10px; border-radius: 5px; border-color:#808080" required>

<?php 
while($pr = $productos -> fetch_array()){
?>
	
	
<option value="<?php echo $pr['IdProducto'];?>">
<?php echo $pr['IdProducto'].'.&nbsp; &nbsp;'.$pr['Nombre'].'&nbsp; &nbsp;'.'$'.$pr['Costo'].' MXN'?>
</option> <?php } ?>
</select>

</div>

<div class="container-login100-form-btn">

<input type="submit" name="actualizar" value="Actualizar" class="login100-form-btn" style="margin-left: 22%; margin-bottom: 3%">
<input type="submit" name="eliminar" value="Eliminar" class="login100-form-btn" style="margin-left: 20%" >

</form>
	</div>

<?php } else{
	echo 'No se encontraron registros en la tabla';
    }
} 
	
	if(isset($_POST['actualizar'])){
		$id_producto = mysqli_real_escape_string($conn, $_POST['id_producto']);
		$sel_producto = "SELECT * FROM PRODUCTOS WHERE IdProducto = '$id_producto'";
		
	//Arreglo de una fila 
	//no se hace while por que solo es un registro
		$producto = $conn -> query($sel_producto);
		$pr = $producto -> fetch_array(); ?>

        <form class="login100-form" action="update_product.php" method="post">

<div class="wrap-input100 m-b-26">

<span class="label-input100">Producto:</span>
    <input type="text" class="input100" name="nombre" value="<?php echo $pr['Nombre']; ?>"/>
    <span class="focus-input100"></span>

</div>

<div class="wrap-input100 m-b-26">

    <span class="label-input100">Información:</span>
    <input type="text" class="input100" name="informacion" value="<?php echo $pr['Informacion']; ?>"/>
    <span class="focus-input100"></span>

</div>

<div class="wrap-input100 m-b-26">

<span class="label-input100">Cantidad Actual:</span>
    <input type="number" class="input100" name="cantidad_actual" value="<?php echo $pr['CantidadActual']; ?>"/>
    <span class="focus-input100"></span>

</div>	   

<div class="wrap-input100 m-b-26">

    <span class="label-input100">Costo:</span>
    <input type="number" class="input100" name="costo" value="<?php echo $pr['Costo']; ?>"/>
    <span class="focus-input100"></span>

</div>

<div class="wrap-input100 m-b-26">

    <span class="label-input100">Imagen:</span>
    <input type="text" class="input100" name="imagen" value="<?php echo $pr['Imagen']; ?>"/>
    <span class="focus-input100"></span>
</div>	   

			
        <!--boton para actualizar la tabla -->
        <div class="container-login100-form-btn">

<input type="submit" name="actualizado" value="Actualizar" class="login100-form-btn" style="margin-left: 20%;">

        <input type="hidden" name="id_producto" value="<?php echo $_POST['id_producto'];?>" />
        
        </form>

	   </div>
  <?php } ?>
</body>
</html>