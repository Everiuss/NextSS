<?php
session_start();
include("db_connection.php");

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

// Obtener datos del alumno
$sql = "SELECT * FROM alumno WHERE IdUsuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IdUsuario);
$stmt->execute();
$result = $stmt->get_result();
$alumno = $result->fetch_assoc() ?: [];

$stmt->close();
CloseCon($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Datos</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
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
        .action-button {
            display: block;
            width: 100%;
            margin-top: 10px;
            background-color: rgb(42, 40, 167);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
        }
        .action-button:hover {
            background-color: rgb(35, 30, 150);
        }
        .logout-button {
            position: absolute;
            right: 20px;
            top: 15px;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
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
            <h4 class="mb-3">Datos del Alumno</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="codigo">Código:</label>
                        <input type="text" class="form-control" id="codigo" name="codigo"
                               value="<?= $alumno['codigoAlumno'] ?? '' ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre_alumno">Nombre completo:</label>
                        <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno"
                               value="<?= $alumno['nombreAlumno'] ?? '' ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="curp">CURP:</label>
                        <input type="text" class="form-control" id="curp" name="curp"
                               value="<?= $alumno['curp'] ?? '' ?>" required readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="domicilio">Domicilio:</label>
                        <input type="text" class="form-control" id="domicilio" name="domicilio"
                               value="<?= $alumno['domicilio'] ?? '' ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                               value="<?= $alumno['fechaNac'] ?? '' ?>" required readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="colonia">Colonia:</label>
                        <input type="text" class="form-control" id="colonia" name="colonia"
                               value="<?= $alumno['colonia'] ?? '' ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal">Código Postal:</label>
                        <input type="text" class="form-control" id="codigo_postal" name="codigo_postal"
                               value="<?= $alumno['codigoPostal'] ?? '' ?>" required readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                        <label for="pais">País:</label>
                        <input type="text" class="form-control" id="pais" name="pais"
                               value="<?= $alumno['pais'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado"
                               value="<?= $alumno['estado'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad"
                               value="<?= $alumno['ciudad'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                    </div>

                <div class="col-md-12">
                    <h4 class="mt-3">Contacto</h4>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?= $alumno['correoAlumno'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono"
                               value="<?= $alumno['telefono'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                    </div>
                </div>

                <!-- Datos del trabajo -->
                <div class="col-md-12">
                    <h4 class="mt-3">Datos del Trabajo</h4>
                    <div class="form-group">
                        <label for="trabaja">¿Trabaja?</label>
                        <select class="form-control" id="trabaja" name="trabaja" required <?= !empty($alumno) ? 'disabled' : '' ?>>
                            <?php if (!empty($alumno)): ?>
                                <option value="1" <?= $alumno['trabajoBool'] == 1 ? 'selected' : '' ?>>Sí</option>
                                <option value="0" <?= $alumno['trabajoBool'] == 0 ? 'selected' : '' ?>>No</option>
                            <?php else: ?>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="empresa">Empresa:</label>
                        <input type="text" class="form-control" id="empresa" name="empresa"
                        value="<?= isset($alumno['trabajoBool']) && $alumno['trabajoBool'] == 0 ? '' : ($alumno['empresa'] ?? '') ?>"
                        <?= isset($alumno['trabajoBool']) && $alumno['trabajoBool'] == 0 ? 'readonly' : '' ?>>
                    </div>
                </div>
            </div>

            <button type="button" class="action-button" id="editarDatos">Editar datos</button>
            <button type="submit" class="btn btn-primary mt-3" id="guardarDatos" style="display:none;">Guardar Datos</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editarBtn = document.getElementById("editarDatos");
            const guardarBtn = document.getElementById("guardarDatos");
            const campos = document.querySelectorAll("input[readonly], select[disabled]");

            editarBtn.addEventListener("click", function () {
                campos.forEach(campo => {
                    campo.removeAttribute("readonly");
                    campo.removeAttribute("disabled");
                });

                editarBtn.style.display = "none";
                guardarBtn.style.display = "block";
            });
        });
    </script>
</body>
</html>
