<?php
    session_start();
    if (!isset($_SESSION['correo']) OR $_SESSION['rol'] != "Administrador") {
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
	<head>
        <title>Mostrar recetas</title>
        
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

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="../css/linearicons.css">
			<link rel="stylesheet" href="../css/font-awesome.min.css">
			<link rel="stylesheet" href="../css/bootstrap.css">
			<link rel="stylesheet" href="../css/magnific-popup.css">
			<link rel="stylesheet" href="../css/nice-select.css">
			<link rel="stylesheet" href="../css/animate.min.css">
			<link rel="stylesheet" href="../css/owl.carousel.css">
			<link rel="stylesheet" href="../css/main.css">

            <style>

                #active {
                    background: rgba(255,255,255, 0.15);
                    border-radius: 4px
                }
			</style>
    </head>

    <body>


        &nbsp; &nbsp; <a href="../index.php"> <img src="../img/Salir.png" width="40" height="40" alt="Salir" name="Salir"> </a>

        <section class="review-area section-gap">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="menu-content pb-60 col-lg-10">
                                    <div class="title text-center">
                                        <h1 class="mb-10"> Recetario de claty house </h1>
                                        <p>--------------------------------------------------------------------</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <?php
                                    include("db_connection.php");
                                    
                                    $obtener_receta = "SELECT * FROM RECETAS";

                                    $receta_ingredientes = "SELECT r.Nombre AS nombre_receta, i.Nombre AS nombre_ingrediente, ri.cantidad AS cantidad 
                                    FROM RECETAS r 
                                    JOIN RECETA_INGREDIENTES ri ON r.IdReceta = ri.Id_Receta 
                                    JOIN INGREDIENTES i ON ri.Id_Ingrediente = i.IdIngrediente";
                                    
                                    if(isset ($_POST['usar']))
                                    {
                                        $id_receta = $_POST['id_receta'];
                                        $ingredientes_receta = $conn->query("
                                            SELECT ri.Id_Ingrediente, ri.cantidad 
                                            FROM RECETA_INGREDIENTES ri 
                                            WHERE ri.Id_Receta = $id_receta
                                        ");
                                        
                                        while ($ingrediente_receta = $ingredientes_receta->fetch_array()) 
                                        {
                                            $id_ingrediente = $ingrediente_receta['Id_Ingrediente'];
                                            $cantidad_necesaria = $ingrediente_receta['cantidad'];
                                            
                                            $cantidad_actual_query = $conn->query("
                                                SELECT CantidadActual 
                                                FROM INGREDIENTES 
                                                WHERE IdIngrediente = $id_ingrediente
                                            ");
                                            $cantidad_actual = $cantidad_actual_query->fetch_array()['CantidadActual'];
                                            
                                            if($cantidad_actual < $cantidad_necesaria)
                                            {
                                                // Mostrar mensaje indicando que no hay suficiente cantidad del ingrediente en la despensa
                                                echo '<script type="text/javascript">alert("No hay suficiente cantidad del ingrediente en la despensa.");</script>';
                                            }
                                            else
                                            {
                                                $cantidad_actual_nueva = $cantidad_actual - $cantidad_necesaria;
                                                
                                                $update_query = $conn->query("
                                                    UPDATE INGREDIENTES 
                                                    SET CantidadActual = $cantidad_actual_nueva 
                                                    WHERE IdIngrediente = $id_ingrediente
                                                ");
                                                
                                                $update_query = $conn->query("
                                                    UPDATE RECETA_INGREDIENTES 
                                                    SET cantidad_utilizada = cantidad_utilizada + $cantidad_necesaria 
                                                    WHERE Id_Receta = $id_receta AND Id_Ingrediente = $id_ingrediente
                                                ");
                                            }
                                        }
                                        
                                        // Mostrar mensaje indicando que la receta se ha utilizado con éxito
                                        echo '<script type="text/javascript">alert("La receta fue utilizada exitosamente.");</script>';
                                    }

                                    if($recetas = $conn -> query($obtener_receta)) 
                                    {
                                        if($recetas -> num_rows > 0) 
                                        {
                                            while($re = $recetas -> fetch_array()) 
                                            {
                                            ?>
                                                <div class="col-lg-4">
                                                    <div class="single-menu">
                                                        <input type="hidden" name="receta_id" value="<?php echo $re['IdReceta']; ?>">
                                                        <div class="title-div justify-content-between d-flex">
                                    
                                                            <h4><?php echo $re['Nombre']; ?></h4>
                                                            <p class="price float-right">
                                                                <?php echo "Receta #".$re['IdReceta']; ?>
                                                            </p>
                                                        </div>

                                                        <div class="title-div justify-content-between d-flex">
                                                            <p>
                                                                <?php echo $re['Preparacion']; ?>
                                                            </p>
                                                        </div>
                                                        
                                                        <h4>
                                                            <?php echo "Ingredientes: "; ?>
                                                        </h4>
                                                        

                                                        <ul>
                                                            <?php
                                                            $receta_ingredientes = $conn->query("
                                                                SELECT r.Nombre AS nombre_receta, i.Nombre AS nombre_ingrediente, ri.cantidad AS cantidad 
                                                                FROM RECETAS r 
                                                                JOIN RECETA_INGREDIENTES ri ON r.IdReceta = ri.Id_Receta 
                                                                JOIN INGREDIENTES i ON ri.Id_Ingrediente = i.IdIngrediente
                                                                WHERE r.IdReceta = {$re['IdReceta']}
                                                            ");
                                                            while ($ri = $receta_ingredientes->fetch_array()) 
                                                            {
                                                                ?>
                                                                <li><?php echo $ri['nombre_ingrediente'] . " " . $ri['cantidad'] . " unidades"; ?></li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>

                                                        <div class="container-login100-form-btn">
                                                            <input type="submit" name="usar" value="Utilizar receta" class="login100-form-btn" style="margin-left: 47%" >
                                                        </div>
                                                        
                                                        </div>
                                                    </div>
                                                
                                                <?php 
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="container">
                                            <div class="row d-flex justify-content-center">
                                                <div class="menu-content pb-60 col-lg-10">
                                                    <div class="title text-center">
                                                        <h1 class="mb-10">Aún no hay recetas ingresadas.
                                                        </h1>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                        }
                                    } ?>
                            </div>
                        </div>
                    </section>
    </body>
</html>