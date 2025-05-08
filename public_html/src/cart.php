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

    .dot-typing {
      display: inline-block;
      width: 1em;
      text-align: left;
    }

    .dot-typing::after {
      content: '...';
      animation: typingDots 1s steps(3, end) infinite;
    }

    @keyframes typingDots {
      0%   { content: ''; }
      33%  { content: '.'; }
      66%  { content: '..'; }
      100% { content: '...'; }
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
      <h5>Carreras con plazas más solicitadas</h5>
      <canvas id="barChart"></canvas>
    </div>

    <div class="col-md-4 card-custom">
      <h5>Disponibilidad de cupos</h5>
      <canvas id="availabilityChart"></canvas>
    </div>
  </div> <!-- Cerramos la primera fila -->

  <div class="row justify-content-center"> <!-- Nueva fila -->
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
      const chatBody = document.getElementById("chat-body");

      if (chatbox.style.display === "block") {
        chatbox.style.display = "none";
      } else {
        chatbox.style.display = "block";

        // Mensaje de bienvenida solo una vez
        if (!chatOpened) {
          chatBody.innerHTML += `<div style="text-align:left; background:#f1f1f1; padding:5px; border-radius:10px; margin:5px 0;">Bot: ¡Hola! Soy Servibot. ¿En qué puedo ayudarte hoy?</div>`;
          chatBody.scrollTop = chatBody.scrollHeight;
          chatOpened = true;
        }
      }
    }

    let chatOpened = false; // bandera para saber si ya se abrió
    const socket = io("wss://chatbot-ws-ofa9.onrender.com");

    socket.on("respuesta", function(data) {
      const chatBody = document.getElementById("chat-body");

      // Crear burbuja de "escribiendo..."
      const typingIndicator = document.createElement("div");
      typingIndicator.id = "typing-indicator";
      typingIndicator.style.cssText = "text-align:left; background:#f1f1f1; padding:5px; border-radius:10px; margin:5px 0;";
      typingIndicator.innerHTML = 'Bot: <span class="dot-typing"></span>';
      chatBody.appendChild(typingIndicator);
      chatBody.scrollTop = chatBody.scrollHeight;

      // Esperar un poco antes de comenzar a escribir (opcional)
      setTimeout(() => {
        // Reemplazar burbuja de "escribiendo..." con texto real
        typingIndicator.innerHTML = "Bot: ";
        let i = 0;
        const texto = data.respuesta;

        const escribir = () => {
          if (i < texto.length) {
            typingIndicator.innerHTML += texto.charAt(i);
            i++;
            chatBody.scrollTop = chatBody.scrollHeight;
            setTimeout(escribir, 30); // velocidad de escritura
          }
        };

        escribir();
      }, 800); // tiempo que permanece el indicador antes de empezar (en ms)
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
    function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

new Chart(document.getElementById("barChart"), {
  type: 'bar',
  data: {
    labels: ["INNI", "INCO", "INRO", "INBI", "INEA"],
    datasets: [{
      label: 'Solicitudes',
      data: [
        getRandomInt(50, 150),
        getRandomInt(50, 150),
        getRandomInt(50, 150),
        getRandomInt(50, 150),
        getRandomInt(50, 150)
      ],
      backgroundColor: [
        '#1976d2', // Azul
        '#4caf50', // Verde
        '#ff9800', // Naranja
        '#f44336', // Rojo
        '#9c27b0'  // Morado
      ]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false
      }
    }
  }
});



function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

const empresas = [
  "INTEL", "IBM", "ORACLE", "MICROSOFT", "GOOGLE", "TATA", "LUXOFT", 
  "HP", "KUKA", "ABB MEXICO", "YASKAWA", "BOSTON", "PHILIPS", "MERCEDES", "BMW"
];

const cuposDisponibles = empresas.map(() => getRandomInt(5, 20));
const cuposOcupados = empresas.map(() => getRandomInt(10, 40));

new Chart(document.getElementById("availabilityChart"), { 
  type: 'bar',
  data: {
    labels: empresas,
    datasets: [
      { label: 'Cupos disponibles', data: cuposDisponibles, backgroundColor: "#1976d2" },
      { label: 'Cupos ocupados', data: cuposOcupados, backgroundColor: "#f44336" }
    ]
  },
  options: {
    indexAxis: 'y',
    responsive: true,
    scales: {
      x: { stacked: true },
      y: { stacked: true }
    }
  }
});


function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Tonos de azul y colores oscuros definidos manualmente
const darkBlueColors = [
  // Azules
  "#1f77b4", // azul clásico
  "#3498db", // azul brillante
  "#5dade2", // azul claro

  // Verdes
  "#2ca02c", // verde brillante
  "#27ae60", // verde esmeralda
  "#82e0aa", // verde claro

  // Amarillos
  "#f1c40f", // amarillo dorado
  "#f9e79f", // amarillo claro
  "#ffdd57", // amarillo mostaza

  // Naranjas
  "#e67e22", // naranja medio
  "#ff7f0e", // naranja vibrante
  "#f5b041", // naranja claro

  // Rojos
  "#d62728", // rojo intenso
  "#e74c3c", // rojo brillante
  "#f1948a"  // rojo claro/salmón
];

const empresasPie = [
  "INTEL", "IBM", "ORACLE", "MICROSOFT", "GOOGLE", "TATA", "LUXOFT", 
  "HP", "KUKA", "ABB MEXICO", "YASKAWA", "BOSTON", "PHILIPS", "MERCEDES", "BMW"
];

const dataPie = empresasPie.map(() => getRandomInt(5, 30));

new Chart(document.getElementById("pieChart"), {
  type: 'pie',
  data: {
    labels: empresasPie,
    datasets: [{
      data: dataPie,
      backgroundColor: darkBlueColors
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
