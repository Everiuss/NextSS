<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SERVICIO SOCIAL UDG</title>
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(120deg, #e3f2fd, #bbdefb);
      animation: backgroundAnimation 5s infinite alternate;
      margin: 0;
      padding-bottom: 100px;
    }
    @keyframes backgroundAnimation {
      0% { background: linear-gradient(120deg, #e3f2fd, #bbdefb); }
      50% { background: linear-gradient(120deg, #bbdefb, #e3f2fd); }
      100% { background: linear-gradient(120deg, #e3f2fd, #bbdefb); }
    }
    .header {
      background-color: #0d47a1;
      color: white;
      padding: 20px;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
    }
    .button {
      background-color: #1976d2;
      color: white;
      padding: 20px;
      width: 100%;
      height: 100%;
      border-radius: 15px;
      font-size: 16px;
      font-weight: bold;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      text-decoration: none;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
    }
    .button:hover {
      background-color: #1565c0;
      transform: scale(1.05);
    }
    .icon {
      font-size: 30px;
      margin-bottom: 10px;
    }
    .exit {
      display: block;
      margin: 30px auto;
      background-color: red;
      padding: 12px 25px;
      border-radius: 10px;
      color: white;
      font-weight: bold;
      text-decoration: none;
      transition: background 0.3s, transform 0.2s;
      width: fit-content;
    }
    .exit:hover {
      background-color: darkred;
      transform: scale(1.05);
    }
    .chatbot {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: rgb(49, 214, 226);
      color: white;
      padding: 15px 20px;
      border-radius: 50px;
      font-size: 18px;
      font-weight: bold;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: transform 0.3s;
    }
    .chatbot:hover {
      transform: scale(1.1);
    }
    #chatbox {
      display: none;
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 300px;
      background: white;
      border-radius: 10px;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
      border: 1px solid #ccc;
      z-index: 9999;
    }
    .card-custom {
      background-color: white;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="header">SERVICIO SOCIAL UDG</div>

  <div class="container my-4">
    <div class="row g-3">
      <div class="col-6 col-md-4">
        <a href="/public_html/src/datos_personales.php" class="button">
          <i class="fas fa-user icon"></i>Datos Personales
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a href="/public_html/src/registro.php" class="button">
          <i class="fas fa-edit icon"></i>Registro
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a href="/public_html/src/orden_pago.php" class="button">
          <i class="fas fa-file-invoice-dollar icon"></i>Orden de Pago
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a href="/public_html/src/ofertas_disponibles.php" class="button">
          <i class="fas fa-briefcase icon"></i>Ofertas Disponibles
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a href="/public_html/src/listado_plazas.php" class="button">
          <i class="fas fa-list icon"></i>Listado de Plazas
        </a>
      </div>
      <div class="col-6 col-md-4">
        <a href="/public_html/src/acreditacion.php" class="button">
          <i class="fas fa-check-circle icon"></i>Acreditación
        </a>
      </div>
    </div>

    <a href="../index.php" class="exit">Salir al inicio</a>

    <!-- Chatbot -->
    <div class="chatbot" onclick="toggleChatbox()">💬 Chatbot</div>
    <div id="chatbox">
      <div style="background:rgb(49, 214, 226); color:white; padding:10px; text-align:center; border-radius:10px 10px 0 0;">SERVIBOT</div>
      <div id="chat-body" style="height:300px; overflow-y:auto; padding:10px; background:#f9f9f9;"></div>
      <div style="padding:10px; display:flex; border-top:1px solid #ccc;">
        <input type="text" id="chat-input" class="form-control me-2">
        <button onclick="sendMessage()" class="btn btn-info text-white">Enviar</button>
      </div>
    </div>
  </div>

  <!-- Dashboard -->
  <div class="header mt-5">DASHBOARD - SERVICIO SOCIAL</div>
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-4 card-custom">
        <h5>Plazas más solicitadas</h5>
        <canvas id="barChart"></canvas>
      </div>
      <div class="col-md-4 card-custom">
        <h5>Total de alumnos registrados</h5>
        <div style="font-size: 40px; font-weight: bold; color: #0d47a1;">254</div>
      </div>
      <div class="col-md-4 card-custom">
        <h5>Disponibilidad de cupos</h5>
        <canvas id="availabilityChart"></canvas>
      </div>
      <div class="col-md-4 card-custom">
        <h5>Estudiantes por dependencia</h5>
        <canvas id="pieChart"></canvas>
      </div>
      <div class="col-md-4 card-custom">
        <h5>Indicador de horas completadas</h5>
        <canvas id="hoursGauge"></canvas>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    function toggleChatbox() {
      const chatbox = document.getElementById("chatbox");
      chatbox.style.display = (chatbox.style.display === "block") ? "none" : "block";
    }

    const socket = io("wss://chatbot-ws-ofa9.onrender.com");

    socket.on("respuesta", function(data) {
      let chatBody = document.getElementById("chat-body");
      chatBody.innerHTML += `<div style="text-align:left; background:#f1f1f1; padding:5px; border-radius:10px; margin:5px 0;">Bot: ${data.respuesta}</div>`;
      chatBody.scrollTop = chatBody.scrollHeight;
    });

    function sendMessage() {
      let input = document.getElementById("chat-input");
      let message = input.value.trim();
      if (message === "") return;

      let chatBody = document.getElementById("chat-body");
      chatBody.innerHTML += `<div style="text-align:right; background:rgb(49, 214, 226); color:white; padding:5px; border-radius:10px; margin:5px 0;">Tú: ${message}</div>`;

      socket.emit("mensaje", { mensaje: message });
      input.value = "";
    }

    document.getElementById("chat-input").addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        sendMessage();
        event.preventDefault();
      }
    });

    // Chart.js visualizations
    new Chart(document.getElementById("barChart"), {
      type: 'bar',
      data: {
        labels: ["IMSS", "Cruz Roja", "Biblioteca UDG", "Secretaría Salud", "DIF"],
        datasets: [{
          label: 'Solicitudes',
          data: [120, 95, 75, 60, 50],
          backgroundColor: '#1976d2'
        }]
      },
      options: { responsive: true }
    });

    new Chart(document.getElementById("availabilityChart"), {
      type: 'bar',
      data: {
        labels: ["IMSS", "Cruz Roja", "DIF", "Secretaría Salud", "Biblioteca UDG"],
        datasets: [
          { label: 'Cupos disponibles', data: [10, 5, 15, 8, 6], backgroundColor: "#1976d2" },
          { label: 'Cupos ocupados', data: [30, 25, 20, 18, 14], backgroundColor: "#f44336" }
        ]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        scales: { x: { stacked: true }, y: { stacked: true } }
      }
    });

    new Chart(document.getElementById("pieChart"), {
      type: 'pie',
      data: {
        labels: ["IMSS", "Cruz Roja", "Secretaría Salud", "DIF"],
        datasets: [{
          data: [40, 30, 20, 10],
          backgroundColor: ["#2196f3", "#4caf50", "#ffeb3b", "#f44336"]
        }]
      },
      options: { responsive: true }
    });

    const completedHours = 320;
    const requiredHours = 480;
    const percentage = Math.round((completedHours / requiredHours) * 100);

    new Chart(document.getElementById("hoursGauge"), {
      type: 'doughnut',
      data: {
        labels: ["Completadas", "Restantes"],
        datasets: [{
          data: [completedHours, requiredHours - completedHours],
          backgroundColor: ["#42a5f5", "#e0e0e0"],
          borderWidth: 0
        }]
      },
      options: {
        cutout: "75%",
        plugins: {
          tooltip: { enabled: true },
          legend: { display: false }
        }
      },
      plugins: [{
        id: 'centerText',
        beforeDraw(chart) {
          const { width, height, ctx } = chart;
          ctx.restore();
          ctx.font = `${(height / 140).toFixed(2)}em Arial`;
          ctx.textBaseline = 'middle';
          ctx.fillStyle = '#0d47a1';
          const text = `${completedHours} / ${requiredHours} hrs`;
          const textX = Math.round((width - ctx.measureText(text).width) / 2);
          const textY = height / 2;
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }]
    });
  </script>

</body>
</html>
