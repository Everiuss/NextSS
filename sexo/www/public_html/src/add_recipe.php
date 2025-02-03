<?php
session_start();
    if (!isset($_SESSION['correo']) OR $_SESSION['rol'] != "Administrador") {
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html> <!--A completar-->
<html lang="es">
	<head>
		<title>Agregar una Receta</title>
        
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
    <script type="text/javascript">alert("Esta página cuenta con errores, NO se recomienda su uso. En DESARROLLO.");</script>
    <div class="limiter">
		<div class="container-login100" style="background: url(../img/ProductoFondo.png);">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(../img/IngresoHead.jpg);">
					<span class="login100-form-title-1">
						Agrega una <br> receta
					</span>
                </div>

				<br>

    &nbsp; &nbsp; <a href="../index.php"> <img src="../img/Salir.png" width="40" height="40" alt="Salir" name="Salir"> </a>
                
    <?php
    
        include("db_connection.php");
        if(isset($_POST['registrar']))
        {
            $idproducto = $_POST['idproducto'];
            $nombre = $_POST['nombre'];
            $preparacion = $_POST['preparacion'];
            $registrar_recetas = "INSERT INTO RECETAS 
            (IdProducto, Nombre, Preparacion) VALUES ('$idproducto','$nombre','$preparacion')";

            if($conn -> query($registrar_recetas))
            {
                echo '<script type="text/javascript">alert("La nueva receta ha sido añadida con éxito.");</script>';
            }
            else 
            {
                echo "ERROR: no fue posible ejecutar $registrar_recetas." . $conn -> error;
            }
                
            $selreceta = "SELECT * FROM RECETAS";
            if($recetas= $conn -> query($selreceta)) 
            {
                if($recetas->num_rows > 0) 
                { ?>
                    <table border ="1" cellspaciong="0" border ="1" bordercolor="#6C4028" style="margin: 0 auto; text-align: center">
                    <tr>
                        
                    <td>&nbsp; IdReceta &nbsp;</td>
                    <td>&nbsp; IdProducto &nbsp;</td>
                    <td>&nbsp; Nombre &nbsp;</td>
                    <td>&nbsp; Preparacion &nbsp;</td>

                    </tr>
                    <?php while($re= $recetas->fetch_array()) 
                    { ?>
                        <tr>
                            
                        <td><?php echo $re['IdReceta'];?></td>
                        <td><?php echo $re['IdProducto'];?></td>
                        <td><?php echo $re['Nombre'];?></td>
                        <td><?php echo $re['Preparacion'];?></td>

                        </tr>
                        <?php 
                    }
                }
            }
        } 
    ?>

    <?php
    
        include("db_connection.php");
        if(isset($_POST['agregar']))
        {
            $idreceta = $_POST['idreceta'];
            $idingrediente = $_POST['idingrediente'];
            $cantidad = $_POST['cantidad'];
            $registrar_receta_ingrediente = "INSERT INTO RECETA_INGREDIENTES
            (Id_Receta, Id_Ingrediente, cantidad) VALUES ('$idreceta','$idingrediente','$cantidad')";

            if($conn -> query($registrar_receta_ingrediente))
            {
                echo '<script type="text/javascript">alert("El nuevo ingrediente ha sido añadido con éxito.");</script>';
            }
            else 
            {
                echo "ERROR: no fue posible ejecutar $registrar_receta_ingrediente." . $conn -> error;
            }
                
            $selreceta_ing = "SELECT * FROM RECETA_INGREDIENTES";
            if($recetasing= $conn -> query($selreceta_ing)) 
            {
                if($recetasing->num_rows > 0) 
                { ?>
                    <table border ="1" cellspaciong="0" border ="1" bordercolor="#6C4028" style="margin: 0 auto; text-align: center">
                    <tr>
                        
                    <td>&nbsp; Id Receta &nbsp;</td>
                    <td>&nbsp; Id Ingrediente &nbsp;</td>
                    <td>&nbsp; Cantidad &nbsp;</td>

                    </tr>
                    <?php while($re= $recetasing->fetch_array()) 
                    { ?>
                        <tr>
                            
                        <td><?php echo $re['Id_Receta'];?></td>
                        <td><?php echo $re['Id_Ingrediente'];?></td>
                        <td><?php echo $re['cantidad'];?></td>

                        </tr>
                        <?php 
                    }
                }
            }
        } 
    ?>

	 </table>

     <?php 
     $sel_productos = "SELECT * FROM PRODUCTOS";
    if($productos = $conn-> query($sel_productos))
    {
        if($productos -> num_rows > 0) 
        {
            ?>

                
                    <form class="login100-form" method="post" action="add_recipe.php">
                        
                        <!--Producto en lista desplegable-->
                        <div class="wrap-input100 m-b-26" style="border-bottom: none">
                            <span class="label-input100">Producto:</span>
                            <form action="add_recipe.php" method="post" class="login100-form">
                            <select name="idproducto" class="select" style="margin-top: 10px; border-radius: 5px; border-color:#808080" required>

                            <?php 
                                while($pr = $productos-> fetch_array())
                                {
                                    ?>
                                        
                                    <option value="<?php echo $pr['IdProducto'];?>">
                                    <?php echo $pr['IdProducto'].'.&nbsp; &nbsp;'.$pr['Nombre'].'&nbsp; &nbsp;'.'$'.$pr['Costo'].' MXN'?>
                                    </option> <?php 
                                }
               ?>
                    </select>
                </div>
            
                
                <!---->

                <div class="wrap-input100 m-b-26" >
                        <span class="label-input100">Nombre de la receta:</span>
                        <input type="text" class="input100" name="nombre" placeholder="Ingresa el Nombre de la receta" required/>
                        <span class="focus-input100" ></span>
                </div>

                <div class="wrap-input100 m-b-26">
                    <span class="label-input100"> Preparación:</span>
                    <input type="text" class="input100" name="preparacion" placeholder="Ingresa el método de preparación del producto" required/>
                    <span class="focus-input100"></span>
                </div> 
                
                    <?php
        }
    } ?>


    <!---->
                
    
    <div class="container-login100-form-btn">

    <input class="login100-form-btn" type="submit" name="registrar" value="Registrar">
	</form>   
	</div>	

    
    <?php 
     $sel_recetas = "SELECT * FROM RECETAS";
    if($recetas = $conn-> query($sel_recetas))
    {
        if($recetas -> num_rows > 0) 
        {
            ?>

            <?php 
            $sel_ingredientes = "SELECT * FROM INGREDIENTES";
            if($ingredientes = $conn-> query($sel_ingredientes))
            {
                if($ingredientes -> num_rows > 0) 
                {
                ?>
                
                    <form class="login100-form" method="post" action="add_recipe.php">
                        
                        <!--Producto en lista desplegable-->
                        <div class="wrap-input100 m-b-26" style="border-bottom: none">
                            <span class="label-input100">Receta:</span>
                            <form action="add_recipe.php" method="post" class="login100-form">
                            <select name="idreceta" class="select" style="margin-top: 10px; border-radius: 5px; border-color:#808080" required>

                            <?php 
                                while($re = $recetas-> fetch_array())
                                {
                                    ?>
                                        
                                    <option value="<?php echo $re['IdReceta'];?>">
                                    <?php echo $re['IdReceta'].'.&nbsp; &nbsp;'.$re['Nombre'].'&nbsp; &nbsp;'?>
                                    </option> <?php 
                                }?>
                
                    </select>
                    </div>   
                    
                    <div class="wrap-input100 m-b-26" style="border-bottom: none">
                    <span class="label-input100">Selección de ingredientes:</span>
                    <form action="add_recipe.php" method="post" class="login100-form">
                    <select name="idingrediente" class="select" style="margin-top: 10px; border-radius: 5px; border-color:#808080"  required>

                        <?php 
                            while($in = $ingredientes-> fetch_array())
                            {
                                ?>
                                
                            
                                <option value="<?php echo $in['IdIngrediente'];?>">
                                    <?php echo $in['IdIngrediente'].'.&nbsp; &nbsp;'.$in['Nombre'].'&nbsp; &nbsp;'?>
                                </option> 
                                <?php 
                            }
                            ?>

                    </select>
                    </div>

                        <div class="wrap-input100 m-b-26">
                            <span class="label-input100"> Cantidad del ingrediente:</span>
                            <input type="number" class="input100" name="cantidad" placeholder="Ingresa la cantidad del ingrediente" required/>
                            <span class="focus-input100"></span>
                        </div> 
                
                    <div class="container-login100-form-btn">

                    <input type="submit" name="agregar" value="Agregar ingredientes a la receta" class="login100-form-btn" >
                    </div>        
                
                <?php
                }
            } 

        }
    } ?>

    
    
		
    </body>
</html>