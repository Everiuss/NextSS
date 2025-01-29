<?php
    session_start();
?>
<!DOCTYPE html>
	<html lang="es" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/icono.png">
		<!-- Author Meta -->
		<meta name="author" content="Equipo Osa Mayor">
		<!-- Meta Description -->
		<meta name="description" content="Una pagina sin animo de lucro, forma parte de un proyecto escolar.">
		<!-- Meta Keyword -->
		<meta name="keywords" content="Proyecto escolar">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Servicio Social</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">

            <style>

                #active {
                    background: rgba(255,255,255, 0.15);
                    border-radius: 4px
                }
			</style>
		</head>
		<body>

            <header id="header" id="home">
            <div class="header-top">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
                            <ul>
                                <li>
                                    <i> Lunes &nbsp; & &nbsp; Viernes: 9am a 9pm &nbsp;</i>
                                </li>
                                <li>
                                        <i> Martes &nbsp; - &nbsp; Jueves &nbsp; & &nbsp; Sábado: 9am a 6pm </i>
                                </li>
                                <li>
                                        <i> <a href="https://api.whatsapp.com/send?phone=3322695236" target="_blank"> &nbsp; +52 33 22695236 </a> </i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-between ">
                    <div id="logo">
                        <a href="index.php"><img src="img/logo.png" alt="UDG" title="Logo de UDG" style="width: 100px; height: 100px;"/></a>
                    </div>

                    <nav id="nav-menu-container">
                    <ul class="nav-menu">

                        <?php
                            if (isset($_SESSION['correo'])) { ?>
                                <li class="menu-has-children">
                                    <a href="#home" id="active"><?php echo $_SESSION['usuario'];?></a>
                                    <ul style="overflow: auto; height: auto; z-index: 999">
                                    <?php
                                        if ($_SESSION['rol'] != "Administrador") { ?>
                                            <li><a href="src/cart.php">Carrito</a></li>
                                        <?php } ?>
                                        <li><a href="src/logout.php">Cerrar Sesión</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }
                                    else { ?>
                                    <li class="menu-has-children">
                                        <a href="src/login.php" id="active"><?php echo "Inicia sesión";?></a>
                                    </li>
                                <?php } ?>
                        <?php
						
                        if(isset($_SESSION['correo']) AND $_SESSION['rol'] === "Administrador") { ?>
                        <li class="menu-has-children no-a">
                            <a href="#home"><?php echo $_SESSION['rol'];?></a>
                            <ul style="overflow: auto; height: auto; z-index: 999">
                                <li>
                                    <a href="src/admin_register.php">Registrar administradores</a>
                                </li>
								 <li>
                                    <a href="src/recetario.php">Recetario</a>
                                </li>
                                <li>
                                    <a href="src/add_recipe.php">Agregar recetas</a>
                                </li>
								<li>
                                    <a href="src/update_recipe.php">Actualizar recetas</a>
                                </li>
								<li>
                                    <a href="src/add_product.php">Agregar productos</a>
                                </li>
                                <li>
                                    <a href="src/update_product.php">Actualizar productos</a>
                                </li>
								 <li>
                                    <a href="src/add_ingredient.php">Agregar ingredientes</a>
                                </li>
                                <li>
                                    <a href="src/update_ingredient.php">Actualizar ingredientes</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <!-- Aquí iba un </li> -->
                        <li class="menu-active"><a href="#home"> Inicio </a></li>
                        <li> <b> <a href="#Productos"> Productos </a> </b> </li>
                        <li> <b> <a href="#Galeria"> Galería de Imágenes </a> </b> </li>
                        <li> <b> <a href="#Nosotros"> Nosotros </a> </b> </li>
                        <li> <b> <a href="#Video"> Video </a> </b> </li>

                    </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
            </header><!-- #header -->

			<!-- start banner Area -->
			<section class="banner-area" id="home">
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-start">
						<div class="banner-content col-lg-7">
							<h1>
								Comprende mejor <br>
								tu Servicio Social
							</h1>
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start menu Area -->
			<section class="menu-area section-gap" id="Productos">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10"> Nuestras principales dependencias </h1>
								<p>Recomendaciones</p>
							</div>
						</div>
					</div>
                    <div class="row">
                    <?php
                            include("src/db_connection.php");
                            
                            $obtener_producto = "SELECT * FROM PRODUCTOS";
                            
                            
                            if($productos = $conn -> query($obtener_producto)) {
                                if($productos -> num_rows > 0) {
                                    while($pr = $productos -> fetch_array()) {
                    ?>
						<div class="col-lg-4">
							<div class="single-menu">
								<div class="title-div justify-content-between d-flex">
            
									<h4><?php echo $pr['Nombre']; ?></h4>
									<p class="price float-right">
										<?php echo "$".$pr['Costo']." MXN"; ?>
									</p>
								</div>
								<p>
									<?php echo $pr['Informacion']; ?>
								</p>
								<p style="margin-top: 4%;">
                                    <?php
                                        if($pr['CantidadActual'] > "0") {?>
									<?php echo "Cantidad actual: ".$pr['CantidadActual']; ?>
                                    <?php
                                        }
                                        else {
                                            echo "<b>NO SE ENCUENTRA DISPONIBLE.</b>";
                                        }?>
								</p>
                                <?php 
                                    if (isset($_SESSION['correo']) AND $_SESSION['rol'] != "Administrador") {?>
                                <form action="src/add_cart.php" method="post">
                                    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'];?>">
                                    <input type="hidden" name="id_producto" value="<?php echo $pr['IdProducto'];?>">
                                    <input type="hidden" name="costo" value="<?php echo $pr['Costo'];?>">
                                    <?php if ($pr['CantidadActual'] > "0") { ?>
                                    <input type="number" name="cantidad" min="1" max="<?php echo $pr['CantidadActual']?>" value="1">
                                        <input class="login100-form-btn" style="margin-top:4%;" type="submit" name="agregar_carrito" value="Agregar al carrito">
                                    <?php } ?>
                                    </form>
                                <?php }?>
                                </div>
							</div>
						
                        <?php }}} ?>
					</div>
				</div>
			</section>
			<!-- End menu Area -->

			<!-- Start Galería Area 
			<section class="gallery-area section-gap" id="Galeria">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Te brindamos el mejor servicio</h1>
                                <?php
                                if (isset($_SESSION['correo'])) { ?>
								    <p> Dando lo mejor para ti: &nbsp; <?php echo $_SESSION['nombre'];?>  </p>
                                <?php
                                }
                                else { ?>
                                    <p> Dando lo mejor para ti.</p>
                                <?php } ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<a href="img/img1.jpg" class="img-pop-home">
								<img class="img-fluid" src="img/img1.jpg" alt="">
							</a>
							<a href="img/img2.jpg" class="img-pop-home">
								<img class="img-fluid" src="img/img2.jpg" alt="">
							</a>
						</div>
						<div class="col-lg-8">
							<a href="img/img3.jpg" class="img-pop-home">
								<img class="img-fluid" src="img/img3.jpg" alt="">
							</a>
							<div class="row">
								<div class="col-lg-6">
									<a href="img/img4.jpg" class="img-pop-home">
										<img class="img-fluid" src="img/img4.jpg" alt="">
									</a>
								</div>
								<div class="col-lg-6">
									<a href="img/img5.jpg" class="img-pop-home">
										<img class="img-fluid" src="img/img5.jpg" alt="">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			End gallery Area -->
			
			<!-- Start review Area -->
			<section class="review-area section-gap" id="Nosotros">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Tienda de postres con años de experiencia elaborando productos de repostería como pasteles, galletas, panadería, postres, gelatinas y más.
                                </h1>
								<p>Todo lo que ofrecemos a Usted, está elaborado con recetas propias, productos naturales, procesos y métodos tradicionales. Y los ingredientes básicos que nunca faltan: Dedicación, esfuerzo, amor y respeto de todo el personal.
                                </p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 single-review">
							<img src="img/r1.png" alt="">
							<div class="title d-flex flex-row">
								<h4>Más información</h4>
								<!-- <div class="star">
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
								</div> -->
							</div>
							<p>
								Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo tempore nesciunt quas quae unde numquam laudantium alias corporis optio odio, accusantium tenetur adipisci quibusdam corrupti. Dolor dolores atque similique corrupti.
							</p>
						</div>
						<div class="col-lg-6 col-md-6 single-review">
							<img src="img/r2.png" alt="">
							<div class="title d-flex flex-row">
								<h4>Información importante</h4>
								<!-- <div class="star">
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
								</div> -->
							</div>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, molestias. Optio, explicabo harum, sapiente delectus mollitia repellendus unde illo nemo sunt earum impedit veniam, eaque a necessitatibus provident quia. Ex.
							</p>
						</div>
					</div>
					<div class="row counter-row">
						<div class="col-lg-3 col-md-6 single-counter" align="center">
							<h1 class="counter">3339</h1>
							<p align="center">Clientes Felices - Demo</p>
						</div>
						<div class="col-lg-3 col-md-6 single-counter" align="center">
							<h1 class="counter" align="center">573</h1>
							<p>Personas que nos recomiendan - Demo</p>
						</div>
						<div class="col-lg-3 col-md-6 single-counter" align="center">
							<h1 class="counter" align="center">9670</h1>
							<p>Pasteles hechos con amor - Demo</p>
						</div>
						<div class="col-lg-3 col-md-6 single-counter" align="center">
							<h1 class="counter" align="center">3265</h1>
							<p>Clientes que nos siguen por Facebook - Demo</p>
						</div>
					</div>
				</div>
			</section>
			<!-- End review Area -->

            
			<!-- Start video-sec Area -->
			<section class="video-sec-area pb-100 pt-40" id="Video">
				<div class="container">
					<div class="row justify-content-start align-items-center">
						<div class="col-lg-6 video-right justify-content-center align-items-center d-flex">
							<div class="overlay overlay-bg">
							<a class="play-btn" href="https://youtu.be/RQ3DQBfm8ns?si=qrDqM7KCEZRLT6wr">
							    <center><img class="img-fluid" src="img/play-icon.png" alt=""></a></center>
							</div>
						</div>
						<div class="col-lg-6 video-left">
							<h6>Palabras de Claty House</h6>
							<h1>¿Qué somos?</h1>
							<p><span>Somos una tienda de postres</span></p>
							<p>
                                Pasteles personalizados, caseros con diseños minimalistas.
                                <b>Somos Claty House.</b>
							</p>
							<img class="img-fluid" src="img/logoF.png" alt="">
						</div>
					</div>
				</div>
			</section>
			<!-- End video-sec Area -->

			<!-- Start blog Area -->
			<!-- <section class="blog-area section-gap" id="Galeria">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Galeria</h1>
								<p> ¡¡Síguenos para no perderte NINGUNA promoción!! </p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 single-blog">
							<img class="img-fluid" src="img/b1.jpg" alt="">
							<ul class="post-tags">
								<li><a href="#">Claty House</a></li>
								<li><a href="#">Estilo de Vida</a></li>
							</ul>
							<a href="#"><h4>Lorem ipsum dolor sit amet consectetur adipisicing elit</h4></a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore.
							</p>
							<p class="post-date">
								22 de Marzo del 2023
							</p>
						</div>
						<div class="col-lg-6 col-md-6 single-blog">
							<img class="img-fluid" src="img/b2.jpg" alt="">
							<ul class="post-tags">
								<li><a href="#">Claty House</a></li>
								<li><a href="#">Puro</a></li>
								<li><a href="#">Estilo de Vida</a></li>
							</ul>
							<a href="#"><h4>Lorem ipsum dolor sit amet consectetur adipisicing elit</h4></a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore.
							</p>
							<p class="post-date">
								23 de Marzo del 2023
							</p>
						</div>
					</div>
				</div>
			</section> -->
			<!-- End blog Area -->


			<!-- start footer Area -->
			<footer class="footer-area section-gap">
				<div class="container">
                <div class="row justify-content-end">
                        <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
                            <ul>
                                <li>
                                    <i> Lunes &nbsp; & &nbsp; Viernes: 9am a 9pm </i>
                                </li>
                                <li>
                                        <i> Martes &nbsp; - &nbsp; Jueves &nbsp; & &nbsp; Sábado: 9am a 6pm </i>
                                </li>
                                <li>
                                        <i> <a href="https://api.whatsapp.com/send?phone=3322695236" target="_blank"> &nbsp; +52 33 22695236 </a> </i>
                                </li>
                                <li>
                                    <i> <a href="https://www.facebook.com/claty.house" target="_blank">Facebook</a></i>
                                </li>
                                <li>
                                    <i> <a href="https://www.instagram.com/claty.house/" target="_blank">Instagram</a></i>
                                </li>
                            </ul>
                        </div>
                    </div>
				</div>
			</footer>

			<!-- End footer Area -->

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>
			<script src="js/owl.carousel.min.js"></script>
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>
			<script src="js/parallax.min.js"></script>
			<script src="js/waypoints.min.js"></script>
			<script src="js/jquery.counterup.min.js"></script>
			<script src="js/mail-script.js"></script>
			<script src="js/main.js"></script>

		</body>
	</html>
