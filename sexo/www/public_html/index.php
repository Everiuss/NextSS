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
		<meta name="author" content="SERVICIO SOCIAL">
		<!-- Meta Description -->
		<meta name="description" content="Una pagina para mejorar la experiencia del servicio social .">
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
<!--
            <style>

                #active {
                    background: rgba(255,255,255, 0.15);
                    border-radius: 4px
                }
			</style>
			-->
			<style>
		<style>
    #active {
        background: rgba(255,255,255, 0.15);
        border-radius: 4px;
    }

    .banner-area {
        position: relative;
    }

    .banner-content h1 {
        font-size: 80px; /* Hacerlo más grande */
        font-weight: bold;
        text-align: center; /* Centrado */
        color: #fff;
        animation: fadeIn 5s ease-in-out; /* Cambiar la duración a 5 segundos */
        margin-top: 150px; /* Espaciado superior mayor para que esté más abajo */
    }

    .banner-content img {
        position: absolute;
        bottom: 20px; /* Colocar la imagen en la parte inferior */
        left: 20px; /* Colocar la imagen hacia la izquierda */
        width: 150px; /* Ajusta el tamaño de la imagen */
        height: auto;
        z-index: -1; /* Asegura que la imagen esté detrás del título */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(40px); /* Desplazar más abajo al inicio */
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Asegura que el título en dispositivos móviles también se vea grande */
    @media (max-width: 768px) {
        .banner-content h1 {
            font-size: 50px;
            margin-top: 100px; /* Ajusta también el espaciado en móviles */
        }

        .banner-content img {
            width: 100px; /* Ajusta el tamaño de la imagen en móviles */
            left: 10px; /* Mueve la imagen más cerca del borde en dispositivos pequeños */
        }
    }
</style>

<!-- HTML -->
<section class="banner-area" id="home">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-start">
            <div class="banner-content col-lg-7">
                <h1>Comprende mejor <br> tu Servicio Social</h1>
                <img src="img/logo.png" alt="Logo" />
            </div>
        </div>
    </div>
</section>



		</head>
		<body>

            <header id="header" id="home">
            <div class="header-top">
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
						<meta charset="UTF-8">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Fecha y Hora Actual</title>
						<i style="color: white;">Fecha y Hora Actual</i>
						<p style="color: white;">
							<?php
							// Establecer la zona horaria
							date_default_timezone_set('America/Mexico_City');
							
							// Obtener la fecha y hora actual
							echo "Fecha y Hora: " . date('d-m-Y H:i:s');
							?>
						</p>
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
									<!-- Reemplazar el nombre de usuario por "MENÚ" -->
									<a href="#home" id="active"><?php echo "MENÚ"; ?></a>
									<ul style="overflow: auto; height: auto; z-index: 999">
									<?php
										if ($_SESSION['rol'] != "Administrador") { ?>
											<li><a href="src/cart.php">ALUMNO</a></li>
										<?php } ?>
										<li><a href="src/logout.php">Cerrar Sesión</a></li>
									</ul>
								</li>
							<?php
							} else { ?>
								<li class="menu-has-children">
									<a href="src/login.php" id="active"><?php echo "Inicia sesión"; ?></a>
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
						<li> <b> <a href="#Nosotros"> Bienvenida </a> </b> </li>
                        <!-- <li> <b> <a href="#Productos"> Encuentranos </a> </b> </li> </li> -->
                        <!--<li> <b> <a href="#Galeria"> Galería de Imágenes </a> </b> </li>-->
                        <li> <b> <a href="#Video"> Video </a> </b> </li>

                    </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
            </header><!-- #header -->

			<!-- start banner Area 
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
			</section> -->
			<!-- End banner Area -->
		
			<!-- Start review Area -->
			<section class="review-area section-gap" id="Nosotros">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10">Sistema de Administración de Servicio Social.
                                </h1>
								<p><br>La Unidad de Servicio Social de la Universidad de Guadalajara da la bienvenida a este espacio para la administración de los procesos de Servicio Social en la Red Universitaria en sus cinco diferentes fases: Convenios específicos en materia de servicio social, Registro de Programas, Registro de prestadores, Seguimiento y Acreditación.


								El Servicio Social debe ser una actividad comprometida con la problemática social, que contribuya a la formación de los futuros profesionistas, apoye el desarrollo estatal, regional y nacional, y propicie mayores oportunidades para el desarrollo de los estudiantes y la comunidad en general.






                                </p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 single-review">
							<div class="title d-flex flex-row">
								<h4></h4>
							</div>
							<p>
							El servicio social se define como actividad formativa y de aplicación de conocimientos que de manera temporal y obligatoria realizan los alumnos o pasantes de la Universidad y de las instituciones que imparten programas educativos con reconocimiento de validez oficial de estudios, en beneficio de los diferentes sectores de la sociedad.
							</p>
						</div>
						<div class="col-lg-6 col-md-6 single-review">
						
							<div class="title d-flex flex-row">
								<h4></h4>
								<!-- <div class="star">
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
								</div> -->
							</div>
							<p>
							El servicio social debe de integrar las dos funciones sustantivas, vincular a la universidad con la sociedad y los sectores que la integran en apoyo a la solución de las problemáticas que se presentan, y a la vez apoyar la formación integral de los estudiantes. Es fundamental en la formación integral del alumno, complementa su etapa formativa al desarrollar una conciencia cívica, de servicio y retribución a la sociedad, además de ser también, una vía de retro-alimentación de la propia Universidad.
							</p>
						</div>
					</div>
					<div class="row counter-row justify-content-center">
						<div class="col-lg-3 col-md-6 single-counter text-center">
							<h1 id="counter-1" class="counter">339</h1>
							<p>Alumnos felices</p>
						</div>
						<div class="col-lg-3 col-md-6 single-counter text-center">
							<h1 id="counter-2" class="counter">73</h1>
							<p>Personas que nos recomiendan</p>
						</div>
						<div class="col-lg-3 col-md-6 single-counter text-center">
							<h1 id="counter-3" class="counter">55</h1>
							<p>Clientes que nos siguen por Facebook</p>
						</div>
					</div>

					<script>
					// Función para actualizar los contadores
					function updateCounters() {
						// Recuperar los contadores del localStorage, o inicializar a 0 si no existen
						let count1 = localStorage.getItem('counter1');
						let count2 = localStorage.getItem('counter2');
						let count3 = localStorage.getItem('counter3');

						if (!count1) {
							localStorage.setItem('counter1', 339);  // Valor inicial
							count1 = 339;
						} else {
							count1 = parseInt(count1) + 1;  // Incrementar en 1
							localStorage.setItem('counter1', count1);
						}

						if (!count2) {
							localStorage.setItem('counter2', 73);  // Valor inicial
							count2 = 73;
						} else {
							count2 = parseInt(count2) + 1;  // Incrementar en 1
							localStorage.setItem('counter2', count2);
						}

						if (!count3) {
							localStorage.setItem('counter3', 55);  // Valor inicial
							count3 = 55;
						} else {
							count3 = parseInt(count3) + 1;  // Incrementar en 1
							localStorage.setItem('counter3', count3);
						}

						// Actualizar los elementos en la página
						document.getElementById('counter-1').innerText = count1;
						document.getElementById('counter-2').innerText = count2;
						document.getElementById('counter-3').innerText = count3;
					}

					// Llamar a la función cuando la página se haya cargado
					window.onload = updateCounters;
					</script>


				</div>
			</section>
			<!-- End review Area -->

			<!-- Start menu Area -->
			<section class="menu-area section-gap" id="Productos" style="background-color: white;">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-10">
							<div class="title text-center">
								<h1 class="mb-10"> Entra desde tu dispositivo móvil o computadora </h1>
								<p>Distintas visualizaciones</p>
							</div>
							<div class="row d-flex justify-content-center mt-4">
								<div class="d-flex justify-content-center align-items-center flex-wrap">
									<img src="img/cel.png" alt="Imagen 1" class="img-fluid" style="max-width: 400px; margin: 10px;">
									<img src="img/pc.png" alt="Imagen 2" class="img-fluid" style="max-width: 700px; margin: 10px;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- End menu Area -->

			<!-- Start Galería Area -->
			<!--
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
			-->
			<!--End gallery Area -->

			<!-- Start video-sec Area -->
			<section class="video-sec-area pb-100 pt-40" id="Video">
				<div class="container">
					<!-- Título centrado -->
					<div class="row">
						<div class="col-12 text-center">
							<h6>UDG Virtual</h6>
							<h1>Tutorial Servicio Social</h1>
						</div>
					</div>
					<!-- Video incrustado centrado -->
					<div class="row justify-content-center align-items-center mt-4">
						<div class="col-lg-8 text-center">
							<iframe 
								width="100%" 
								height="400px" 
								src="https://www.youtube.com/embed/YJmGusVyDLs" 
								title="YouTube video player" 
								frameborder="0" 
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
								allowfullscreen>
							</iframe>
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
				<div class="d-flex justify-content-start align-items-center flex-wrap">
					<img src="img/contacto_udg.png" alt="Imagen 1" class="img-fluid" style="max-width: 800px; margin: 10px;">
				</div>
												<!-- 
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
                    </div>-->
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
