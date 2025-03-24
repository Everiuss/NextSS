<?php
// Aquí podrías agregar validación de sesión si es necesario
?>  

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
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
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .container h3 {
            color: #333;
            margin: 0px auto;
            margin-bottom: 0rem !important;
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
            background-color:rgb(52, 170, 185);
            color: white;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 10px auto;
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

    <div class="container mt-4">
        <!-- Tabla Listado de plazas activas -->
        <h3 class="text-center mb-4">Listado de Plazas</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No. Oficio</th>
                        <th>Estatus</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Dependencia</th>
                        <th>Programa</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>821/CUCEI/2024B</td>
                        <td class="text-success">ACTIVA</td>
                        <td>02/09/2024</td>
                        <td>-</td>
                        <td>COMPUTO Y TELECOMUNICACIONES PARA EL APRENDIZAJE CUCEI</td>
                        <td>Soporte Técnico y Mantenimiento de Equipos de Cómputo</td>
                        <td><button class="btn btn-info btn-sm" disabled>Detalle</button></td>
                    </tr>
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </div>

        <!-- Tabla Reportes parciales -->
        <h3 class="text-center mb-4">Reportes parciales</h3>
        <button class="btn-download">+</button>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>No.</th>
                        <th>Fecha</th>
                        <th></th>
                        <th>Periodo Reportado</th>
                        <th>Estatus</th>
                        <th>Reporte</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8">No hay registros por mostrar</td>
                    </tr>
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </div>

        <!-- Tabla Reporte final -->
        <h3 class="text-center mb-4">Reporte final</h3>
        <button class="btn-download">+</button>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Registro</th>
                        <th>Estatus</th>
                        <th>Reporte</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">No hay registros por mostrar</td>
                    </tr>
                    <!-- Agregar más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
