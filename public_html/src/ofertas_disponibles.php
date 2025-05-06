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


// Obtener oferta de plazas activas
$sqlOfertas = "SELECT centro, carrera, dependencia, programa, turno, hora_desde, hora_hasta, lugares, lugares_restantes FROM ofertas";
$stmt = $conn->prepare($sqlOfertas);
$stmt->execute();  
$result = $stmt->get_result();

$ofertas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ofertas[] = $row;
    }
}

$stmt->close();
CloseCon($conn);
?>

<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ofertas Disponibles</title>
    <style>
        /* Estilos generales */
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
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #004080;
        color: white;
        padding: 15px 20px;
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

    .logout-button:hover {
        background-color: #0056b3;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .info-box {
        background: #f0f7ff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #004080;
        color: white;
    }

    tr:nth-child(even) td {
        background-color: #e6f2ff;
    }

    tr:hover td {
        background-color: rgb(188, 254, 242);
    }

    .btn-container {
        text-align: center;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        margin: 10px;
        font-size: 16px;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: rgb(188, 254, 242);
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.6);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 90%;
        max-width: 1000px;
        max-height: 80%;
        overflow-y: auto;
        animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
        from { transform: translateY(100px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Quitamos el fondo azul al hacer clic */
    .modal-content tr {
        background-color: white !important;
    }

    /* Resaltar fila seleccionada */
    .modal-content tr.selected {
        background-color: #b6f7ce !important;
    }

    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header h1 {
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .logout-button {
            width: 100%;
            text-align: center;
            font-size: 0.95rem;
        }

        .container {
            margin: 20px;
            padding: 20px;
        }

        .info-box table,
        .modal-content table {
            font-size: 0.9rem;
        }

        .btn {
            width: 100%;
            margin: 10px 0;
            font-size: 1rem;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .modal-content {
            width: 95%;
            max-height: 90%;
            padding: 15px;
        }

        /* Hacer que las tablas se desplacen horizontalmente */
        .modal-content table,
        .info-box table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }

    .tarjeta-oferta {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .tarjeta-oferta:hover {
        background-color: #e6f2ff;
    }

    .tarjeta-oferta.selected {
        background-color: #b6f7ce;
    }

    .modal-footer {
        position: sticky;
        bottom: 0;
        background-color: transparent;
        padding: 15px 10px;
        text-align: right;
        box-shadow: 0 -4px 6px rgba(0,0,0,0.1);
        z-index: 10;
        box-shadow: none !important; /* Elimina sombra */
        border-top: none !important; /* Elimina borde superior */
    }

</style>


</head>
<body>
    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="cart.php" class="logout-button">Salir al menú</a>
    </div>

```
<div class="container">
    <h2 style="text-align:center;">Ofertas de prestación de servicio social</h2>

    <div class="info-box">
        <strong>Agenda del alumno:</strong>
        <table>
            <tr><td>Inicia:</td><td id="fechaInicio"></td></tr>
            <tr><td>Termina:</td><td id="fechaFin"></td></tr>
        </table>
        <br>
        <strong>Oferta seleccionada:</strong>
        <table>
            <tr><td>Centro:</td><td id="centro"></td></tr>
            <tr><td>Carrera:</td><td id="carrera"></td></tr>
            <tr><td>Dependencia:</td><td id="dependencia"></td></tr>
            <tr><td>Nombre del programa:</td><td id="nombrePrograma"></td></tr>
            <tr><td>Turno:</td><td id="turno"></td></tr>
            <tr><td>Desde:</td><td id="desde"></td></tr>
            <tr><td>Hasta:</td><td id="hasta"></td></tr>
            <tr><td>Fecha y Hora de registro:</td><td id="fechaRegistro"></td></tr>
        </table>
    </div>

    <div class="btn-container">
        <button class="btn btn-primary" onclick="abrirModal()">Actualizar listado</button>
        <button class="btn btn-success" onclick="registrar()">Registrar</button>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modalOfertas">
    <div class="modal-content">
        <h3>Ofertas Asignadas</h3>
        <div id="tarjetasOfertas">
            <?php foreach ($ofertas as $oferta): ?>
                <div class="tarjeta-oferta" onclick="seleccionarOfertaTarjeta(this)">
                    <p><strong>Centro:</strong> <?= htmlspecialchars($oferta['centro']) ?></p>
                    <p><strong>Carrera:</strong> <?= htmlspecialchars($oferta['carrera']) ?></p>
                    <p><strong>Dependencia:</strong> <?= htmlspecialchars($oferta['dependencia']) ?></p>
                    <p><strong>Programa:</strong> <?= htmlspecialchars($oferta['programa']) ?></p>
                    <p><strong>Turno:</strong> <?= htmlspecialchars($oferta['turno']) ?></p>
                    <p><strong>Desde:</strong> <?= htmlspecialchars($oferta['hora_desde']) ?></p>
                    <p><strong>Hasta:</strong> <?= htmlspecialchars($oferta['hora_hasta']) ?></p>
                    <p><strong>Lugares:</strong> <?= htmlspecialchars($oferta['lugares']) ?></p>
                    <p><strong>Lugares restantes:</strong> <?= htmlspecialchars($oferta['lugares_restantes']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary" onclick="asignarmeOferta()">Asignarme oferta</button>
            <button class="btn btn-primary" onclick="asignarmeOferta()">Salir</button>
        </div>

    </div>
</div>

<script>
    function abrirModal() {
        document.getElementById("modalOfertas").style.display = "flex";
    }

    function asignarmeOferta() {
        document.getElementById("modalOfertas").style.display = "none";
    }

    function seleccionarOfertaTarjeta(div) {
        document.querySelectorAll(".tarjeta-oferta").forEach(card => {
            card.classList.remove("selected");
        });

        div.classList.add("selected");

        const datos = div.querySelectorAll("p");
        document.getElementById("centro").textContent = datos[0].textContent.replace("Centro: ", "");
        document.getElementById("carrera").textContent = datos[1].textContent.replace("Carrera: ", "");
        document.getElementById("dependencia").textContent = datos[2].textContent.replace("Dependencia: ", "");
        document.getElementById("nombrePrograma").textContent = datos[3].textContent.replace("Programa: ", "");
        document.getElementById("turno").textContent = datos[4].textContent.replace("Turno: ", "");
        document.getElementById("desde").textContent = datos[5].textContent.replace("Desde: ", "");
        document.getElementById("hasta").textContent = datos[6].textContent.replace("Hasta: ", "");
        document.getElementById("fechaRegistro").textContent = new Date().toLocaleString();
    }

    function registrar() {
        const dependencia = document.getElementById("dependencia").textContent;
        const programa = document.getElementById("nombrePrograma").textContent;
        const fechaInicio = document.getElementById("fechaInicio").textContent || new Date().toISOString().split('T')[0];

        if (!dependencia || !programa) {
            alert("Por favor, selecciona una oferta antes de registrar.");
            return;
        }

        const formData = new FormData();
        formData.append('dependencia', dependencia);
        formData.append('programa', programa);
        formData.append('fecha_inicio', fechaInicio);

        fetch('registrar_plaza.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Opcional: redirigir o actualizar la página
            } else {
                alert(data.error || 'Ocurrió un error al registrar la plaza.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al conectar con el servidor.');
        });
    }


</script>
```

</body>
</html>
