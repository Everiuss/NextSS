<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Datos</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #a2c2e7, #86b3d1);
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
            position: relative;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
        }
        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(38, 143, 255, 0.5);
        }
        .form-table {
            width: 100%;
            border-spacing: 15px;
        }
        .form-table td {
            vertical-align: top;
        }
        .form-group {
            margin-bottom: 15px;
        }
        
        /* Nuevo estilo para el botón "Volver al Perfil" */
        .logout-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            position: absolute;
            right: 20px;
            top: 20px;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Registro de Datos - Servicio Social</h1>
        <a href="cart.php" class="logout-button">Volver al Perfil</a>
    </div>
    <div class="container">
        <form method="POST" action="registro_datos.php">
            <table class="form-table">
                <tr>
                    <td>
                        <h4>Datos del Alumno</h4>
                        <div class="form-group">
                            <label for="codigo">Código:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre_alumno">Nombre completo:</label>
                            <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" required>
                        </div>
                        <div class="form-group">
                            <label for="curp">CURP:</label>
                            <input type="text" class="form-control" id="curp" name="curp" required>
                        </div>
                        <div class="form-group">
                            <label for="domicilio">Domicilio:</label>
                            <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="colonia">Colonia:</label>
                            <input type="text" class="form-control" id="colonia" name="colonia" required>
                        </div>
                        <div class="form-group">
                            <label for="codigo_postal">Código Postal:</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                        </div>
                        <div class="form-group">
                            <label for="pais">País:</label>
                            <input type="text" class="form-control" id="pais" name="pais" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <h4>Datos del Trabajo</h4>
                        <div class="form-group">
                            <label for="trabaja">¿Trabaja?</label>
                            <select class="form-control" id="trabaja" name="trabaja" required>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="empresa">Empresa:</label>
                            <input type="text" class="form-control" id="empresa" name="empresa">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar Datos</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>