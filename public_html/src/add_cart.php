<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header('Location: login.php');
}
    include("db_connection.php");
    if(isset($_POST['agregar_carrito'])) {

    $id_usuario = mysqli_real_escape_string($conn, $_POST['id_usuario']);
    $id_producto = mysqli_real_escape_string($conn, $_POST['id_producto']);
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);
    $costo = mysqli_real_escape_string($conn, $_POST['costo']*$cantidad);

    $agregar_carrito = "INSERT INTO CARRITO (IdUsuario, IdProducto, Cantidad, Costo) VALUES ('$id_usuario', '$id_producto', '$cantidad', '$costo')";
    $restar_inventario = "UPDATE PRODUCTOS SET CantidadActual = CantidadActual - $cantidad WHERE IdProducto = $id_producto";
    if($conn -> query($agregar_carrito)){
        $conn -> query($restar_inventario);
        echo '<script type="text/javascript">alert("Se ha agregado al carrito con éxito.");</script>';
        echo '<script type="text/javascript">window.location.href="../index.php#Productos";</script>';
    }else {
        echo"ERROR: no fue posible ejecutar $agregar_carrito." . $conn -> error;}
    }
?>