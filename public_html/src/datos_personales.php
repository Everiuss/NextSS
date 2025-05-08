<?php
session_start();
include("db_connection.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$IdUsuario = $_SESSION['id_usuario'];
$conn = OpenCon();

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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
        }
        body {
            background: linear-gradient(45deg, #a2c2e7, #86b3d1);
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 95%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080;
            color: white;
            padding: 15px 20px;
            font-family: Arial, sans-serif;
            width: 100%;
            box-sizing: border-box;
        }
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        .logout-button {
            background-color: rgb(52, 170, 185);
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
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
        .action-button:hover {
            background-color: rgb(35, 30, 150);
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Registro de Datos - Servicio Social</h1>
        <a href="cart.php" class="logout-button">Salir al menú</a>
    </div>

    <div class="container">
        <form method="POST" action="registro_datos.php" id="datosForm">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-3">Datos del Alumno</h4>
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
                </div>

                <div class="col-md-6">
                    <h4 class="mb-3">Contacto</h4>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $alumno['correoAlumno'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono"
                            value="<?= $alumno['telefono'] ?? '' ?>" required <?= !empty($alumno) ? 'readonly' : '' ?>>
                    </div>

                    <h4 class="mb-3">Datos del Trabajo</h4>
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
    value="<?= $alumno['trabajoBool'] == 1 ? ($alumno['empresa'] ?? '') : '' ?>"
    <?= $alumno['trabajoBool'] == 1 ? 'readonly' : 'readonly' ?>>

                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary mt-3" id="editarDatos">Editar datos</button>
            <button type="submit" class="btn btn-primary mt-3" id="guardarDatos" style="display:none;">Guardar Datos</button>
        </form>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const editarBtn = document.getElementById("editarDatos");
    const guardarBtn = document.getElementById("guardarDatos");
    const trabajaSelect = document.getElementById("trabaja");
    const empresaInput = document.getElementById("empresa");
    const form = document.getElementById("datosForm");

    // Validación antes de enviar el formulario
    form.addEventListener("submit", function (e) {
        if (trabajaSelect.value === "1" && empresaInput.value.trim() === "") {
            e.preventDefault();
            alert("Debes ingresar el nombre de la empresa si trabajas.");
            empresaInput.focus();
        }
    });

    editarBtn.addEventListener("click", function () {
        empresaInput.removeAttribute("readonly"); 
        document.querySelectorAll("input:not(#codigo):not(#nombre_alumno):not(#curp), select").forEach(campo => {
        campo.removeAttribute("readonly");
        campo.removeAttribute("disabled");
    });

        if (trabajaSelect.value === "0") {
            empresaInput.setAttribute("readonly", "readonly");
            empresaInput.removeAttribute("required");
        } else {
            empresaInput.removeAttribute("readonly");
            empresaInput.setAttribute("required", "required");
        }

        editarBtn.style.display = "none";
        guardarBtn.style.display = "block";

        if (trabajaSelect.value === "1") {
    empresaInput.removeAttribute("readonly");
    empresaInput.setAttribute("required", "required");
} else {
    empresaInput.setAttribute("readonly", "readonly");
    empresaInput.removeAttribute("required");
    empresaInput.value = "";
}

    });

    trabajaSelect.addEventListener("change", function () {
        if (trabajaSelect.value === "1") {
            empresaInput.removeAttribute("readonly");
            empresaInput.setAttribute("required", "required");
        } else {
            empresaInput.setAttribute("readonly", "readonly");
            empresaInput.removeAttribute("required");
            empresaInput.value = "";  // Borramos el valor si no trabaja
        }
    });
});

    </script>
    
</body>
</html>