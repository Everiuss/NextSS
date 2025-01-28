<?php

    session_start();
    if (!isset($_SESSION['correo'])) {
        header('Location: login.php');
    }
    include("db_connection.php");
        $idusuario = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM CARRITO INNER JOIN PRODUCTOS ON CARRITO.IdProducto = PRODUCTOS.IdProducto WHERE CARRITO.IdUsuario = '$idusuario'";
        $result = mysqli_query($conn, $sql);
        $total = 0;
        echo "<table>";
        echo "<tr><td>&nbsp; IdProducto &nbsp;</td><td>&nbsp; Nombre &nbsp;</td><td>&nbsp; Cantidad &nbsp;</td><td>&nbsp; Precio &nbsp;</td></tr>";

        while ($car = mysqli_fetch_assoc($result)) {
            //echo "<tr><td>".$car["id_Producto"]."</td><td>".$car["Nombre"]."</td><td>".$car["Descripcion"]."</td><td>".$car["Precio"]."</td></tr>";
            echo "<tr>";
            echo "<td> &nbsp;".$car["IdProducto"]." &nbsp;</td>";
            echo "<td> &nbsp;".$car["Nombre"]." &nbsp;</td>";
            echo "<td> &nbsp;".$car["Cantidad"]." &nbsp;</td>";
            echo "<td> &nbsp;"."$".$car["Costo"]." MXN"." &nbsp;</td>";
            $total += $car["Costo"];
            echo "<td>";
        }
        echo "<tr>";
        echo "<tr>";
        echo "<td></td><td> &nbsp;Total: </td><td>"."&nbsp;$".$total." MXN"."</td>";
        echo "</table>";

        ?>
        <form class="login100-form" method="post" action="delete_cart.php">
        <div class="container-login100-form-btn">
        <input class="login100-form-btn" type="button" value="Comprar">
    <a href="../index.php#Productos" style="margin-left: 10%"><input class="login100-form-btn" type="button" value="Seguir viendo productos"></a>
    <input class="login100-form-btn" type="submit" name="borrar_carrito" value="Borrar carrito"  style="margin-left: 10%">
		</form>    
		</div>		