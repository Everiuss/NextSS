<?php
    session_start();
    if (!isset($_SESSION['correo'])) {
        header('Location: login.php');
    }
    include("db_connection.php");
    if(isset($_POST['borrar_carrito'])) {
        $id_usuario = $_SESSION['id_usuario'];
        $cantidad_carrito = "SELECT * FROM CARRITO";
        $eliminar_carrito = "DELETE FROM CARRITO WHERE IdUsuario = $id_usuario";
        
        if($cantidad_productos = $conn -> query($cantidad_carrito)) {
            if(mysqli_num_rows($cantidad_productos)>0){
                while($cantidad = $cantidad_productos->fetch_array()) {
                    $id_producto = $cantidad['IdProducto'];
                    $cantidad_tabla = $cantidad['Cantidad'];
                    $result = mysqli_query($conn, "UPDATE PRODUCTOS SET CantidadActual = CantidadActual + $cantidad_tabla WHERE IdProducto = $id_producto");
                }
                $result = mysqli_query($conn, $eliminar_carrito);
                echo '<script type="text/javascript">alert("Se ha eliminado del carrito con éxito.");</script>';
                echo '<script type="text/javascript">window.location.href="cart.php";</script>';
            }
            else {
                echo '<script type="text/javascript">alert("No existen productos en el carrito.");</script>';
                echo '<script type="text/javascript">window.location.href="cart.php";</script>';
            }
        }
        else {
            echo"ERROR: no fue posible ejecutar $cantidad_carrito." . $conn -> error;
        }
    }
?>