<?php
    session_start();

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    $servername = "localhost";  // Ajusta según tu servidor
    $username = "root";         // Ajusta según tu base de datos
    $password = "";             // Ajusta según tu base de datos
    $dbname = "nextss_db";      // Nombre de tu base de datos

    // Conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Obtener el ID del usuario desde la sesión
    $user_id = $_SESSION['id_usuario'];  // Asegúrate de tener esta variable en la sesión

    // Obtener el código de alumno y nombre, carrera del alumno
    $sql = "SELECT a.codigoAlumno, a.nombreAlumno, r.Carrera
            FROM alumno a
            JOIN registro r ON a.codigoAlumno = r.codigoAlumno
            WHERE a.IdUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        // Obtener los datos
        $row = $result->fetch_assoc();
        $codigoAlumno = $row['codigoAlumno'];
        $nombreAlumno = $row['nombreAlumno'];
        $carrera = $row['Carrera'];
    } else {
        // En caso de que no se encuentre el usuario
        $codigoAlumno = "No disponible";
        $nombreAlumno = "No disponible";
        $carrera = "No disponible";
    }

    // Cierra la conexión
    $stmt->close();
    $conn->close();
?>  

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(45deg, #a2c2e7, #86b3d1, #a2c2e7, #86b3d1);
            background-size: 800% 800%;
            animation: gradientAnimation 2s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Estilos generales */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080; /* Azul UDG */
            color: white;
            padding: 15px 20px;
            font-family: Arial, sans-serif;
        }

        /* Estilos del título */
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        /* Estilos del botón */
        .logout-button {
            background-color:rgb(52, 170, 185);
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        /* 📱 Ajustes para pantallas pequeñas */
        @media (max-width: 768px) {
            .header {
                flex-direction: column; /* Elementos en columna */
                text-align: center;
            }

            .header h1 {
                font-size: 1.5rem;
                margin-bottom: 10px;
            }

            .logout-button {
                width: 100%;
                text-align: center;
                padding: 12px 0;
            }
        }

        .logout-button:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            margin: 15px 0;
            font-size: 16px;
        }

        .btn-download, .btn-back {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-download:hover, .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="cart.php" class="logout-button">Salir al menú</a>
    </div>

    <div class="container">
        <h2>ACREDITACIÓN</h2>

        <div class="container">
            <!-- Mostrar información del alumno -->
            <p><strong>Alumno:</strong> <?php echo $codigoAlumno . " - " . $nombreAlumno; ?></p>
            <p><strong>Carrera:</strong> <?php echo $carrera; ?></p>

            <p>Aquí puedes ver la acreditación :)</p>

            <!-- Información sobre los requisitos para la acreditación -->
            <div class="info">
                <p><strong>YA TIENES LAS HORAS SUFICIENTES</strong> para tramitar la acreditación de tu servicio social.</p>
                <p>Para realizar tu trámite de acreditación deberás presentar la siguiente documentación en la Unidad de Servicio Social de tu Centro Universitario:</p>
                <ul>
                    <li>Kárdex certificado.</li>
                    <li>Oficio de término.</li>
                    <li>Informe final de actividades.</li>
                    <li>Oficio de comisión.</li>
                    <li>Cuatro fotografías tamaño credencial deben ser de estudio a blanco y negro, con ropa formal (saco oscuro y camisa/blusa clara, hombres con corbata).</li>
                    <li>Orden de pago.</li>
                </ul>
            </div>

            <!-- Botones para elegir centro universitario y regresar -->
            <div class="btn-container">
                <a href="generar_pdf.php" class="btn-download">Orden de Pago</a>
            </div>
        </div>
    </div>

</body>
</html>
