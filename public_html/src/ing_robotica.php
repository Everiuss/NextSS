<?php
// Aquí podrías agregar validación de sesión si es necesario
?>  

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ing Robotica :)</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Fuente del texto */
            margin: 0; /* Sin márgenes */
            padding: 0; /* Sin relleno */
            height: 100vh; /* Altura completa de la ventana */
            background: linear-gradient(45deg, #a2c2e7, #86b3d1, #a2c2e7, #86b3d1); /* Fondo con degradado */
            background-size: 800% 800%; /* Tamaño del fondo */
            animation: gradientAnimation 2s ease infinite; /* Animación del fondo */
        }

        /* Animación del fondo */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%; /* Posición inicial */
            }
            50% {
                background-position: 100% 50%; /* Posición intermedia */
            }
            100% {
                background-position: 0% 50%; /* Posición final */
            }
        }

        /* Estilos del encabezado */
        .header {
            background-color: rgba(52, 58, 64, 0.8); /* Color de fondo con transparencia */
            color: white; /* Color del texto */
            padding: 15px; /* Relleno interno */
            display: flex; /* Usar flexbox */
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
            position: relative; /* Posición relativa para el botón de salida */
        }

        .header h1 {
            margin: 0; /* Sin márgenes */
        }

        /* Estilos del contenedor principal */
        .container {
            max-width: 900px; /* Ancho máximo */
            margin: 50px auto; /* Margen superior e inferior, centrado horizontalmente */
            background: white; /* Color de fondo */
            padding: 20px; /* Relleno interno */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
            text-align: center; /* Centrar texto */
        }

        h2 {
            color: #333; /* Color del encabezado */
        }

        p {
            margin: 15px 0; /* Margen superior e inferior */
            font-size: 16px; /* Tamaño de fuente */
        }

        /* Estilos del área de texto */
        textarea {
            width: 100%; /* Ancho completo */
            height: 150px; /* Altura del área de texto */
            padding: 10px; /* Relleno interno */
            border: 1px solid #ccc; /* Borde */
            border-radius: 5px; /* Bordes redondeados */
            resize: none; /* Sin opción de redimensionar */
            margin-top: 10px; /* Margen superior */
        }

        /* Estilos de los botones */
        .btn-submit, .btn-back {
            display: inline-block; /* Mostrar como bloque en línea */
            background-color: #007bff; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 10px 20px; /* Relleno interno */
            text-decoration: none; /* Sin subrayado */
            border-radius: 5px; /* Bordes redondeados */
            transition: background-color 0.3s; /* Transición suave para el color de fondo */
            margin-top: 10px; /* Margen superior */
        }

        .btn-submit:hover, .btn-back:hover {
            background-color: #0056b3; /* Color de fondo al pasar el mouse */
        }

        .btn-back {
            background-color: red; /* Color de fondo rojo */
        }

        .btn-back:hover {
            background-color: darkred; /* Color de fondo más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <!-- Botón de Salir -->
        <a href="ofertas_disponibles.php" class="btn-exit">Volver a las ofertas disponibles</a>
    </div>

    <div class="container">
        <h1>Ingeniería Robotica</h1>
        
        <h2>🔹 FANUC México</h2>
        <h3 style="text-align: justify; font-weight: normal;"><b>Descripción:</b> Empresa líder en soluciones de automatización industrial y robótica, especializada en robots industriales y sistemas de manufactura inteligente.</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Dirección:</b> Av. Vallarta 5400, Camichines Vallarta, 45010 Zapopan, Jal.</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Teléfono:</b> +52 33 3770 5900</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Sitio web:</b> <a href="https://www.fanucamerica.com" target="_blank">https://www.fanucamerica.com</a></h3>

        <h2>🔹 KUKA Robotics México</h2>
        <h3 style="text-align: justify; font-weight: normal;"><b>Descripción:</b> Compañía alemana líder en robótica industrial, con aplicaciones en manufactura avanzada y automatización de procesos.</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Dirección:</b> Av. Juan Palomar y Arias 200, Puerta de Hierro, 45116 Zapopan, Jal.</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Teléfono:</b> +52 33 3770 6000</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Sitio web:</b> <a href="https://www.kuka.com" target="_blank">https://www.kuka.com</a></h3>

        <h2>🔹 ABB México</h2>
        <h3 style="text-align: justify; font-weight: normal;"><b>Descripción:</b> Empresa multinacional suiza especializada en robótica, automatización y soluciones eléctricas industriales.</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Dirección:</b> Periférico Sur 7999, Toluquilla, 45610 San Pedro Tlaquepaque, Jal.</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Teléfono:</b>  +52 33 3770 6100</h3>
        <h3 style="text-align: justify; font-weight: normal;"><b>Sitio web:</b> <a href="https://global.abb" target="_blank">https://global.abb</a></h3>

    </div>

    <style>
        /* Estilos para el botón de salir */
        .btn-exit {
            position: absolute;
            right: 20px; /* Distancia desde el borde derecho */
            top: 50%;
            transform: translateY(-50%); /* Centrar verticalmente */
            background-color: red; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 10px 15px; /* Espaciado interno */
            text-decoration: none; /* Sin subrayado */
            border-radius: 5px; /* Bordes redondeados */
            transition: background-color 0.3s; /* Animación al pasar el cursor */
        }

        .btn-exit:hover {
            background-color: darkred; /* Cambio de color al pasar el mouse */
        }
    </style>

</body>
