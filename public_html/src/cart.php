<!DOCTYPE html>
<html lang="es">
<head>

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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVICIO SOCIAL UDG</title>
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

        .main-content {
            margin-top: 50px;
            text-align: center;
        }

        .options-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .option {
            background-color: rgba(52, 58, 64, 0.9);
            color: white;
            padding: 15px;
            border-radius: 5px;
            width: 150px;
            text-align: center;
        }

        .option a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .option a:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SERVICIO SOCIAL UDG</h1>
        <a href="../index.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="main-content">
        <div class="options-container">
            <div class="option">
                <a href="/public_html/src/datos_personales.php">Datos Personales </a>
            </div>
            <div class="option">
                <a href="/public_html/src/registro.php">Registro</a>
            </div>
            <div class="option">
                <a href="/public_html/src/orden_pago.php">Orden de pago</a>
            </div>
            <div class="option">
                <a href="/public_html/src/ofertas_disponibles.php">Ofertas disponibles</a>
            </div>
            <div class="option">
                <a href="/public_html/src/listado_plazas.php">Listado de plazas</a>
            </div>
            <div class="option">
                <a href="/public_html/src/acreditacion.php">Acreditación</a>
            </div>
            <!--<div class="option">
                <a href="/public_html/src/cambiar_contrasena.php">Cambiar contraseña</a>
            </div>-->
        </div>
    </div>

</body>
</html>

 <!---------------------------- AQUI COMIENZA LO QUE PASA AL DAR CLIC EN DATOS PERSONALES ------------------------------->            




 <!-------------------------------------------------- AQUI COMIENZA EL CHATBOT ------------------------------->            
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Flotante</title>
    <style>
        /* Botón flotante */
        #chatbot-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        /* Caja de chat */
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
        }

        #chat-header {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 18px;
        }

        #chat-body {
            height: 300px;
            overflow-y: auto;
            padding: 10px;
            background: #f9f9f9;
        }

        #chat-footer {
            padding: 10px;
            display: flex;
            border-top: 1px solid #ccc;
        }

        #chat-input {
            flex: 1;
            padding: 5px;
        }

        #send-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Botón flotante -->
    <button id="chatbot-btn">💬</button>

    <!-- Chatbox -->
    <div id="chatbox">
        <div id="chat-header">SERVIBOT</div>
        <div id="chat-body"></div>
        <div id="chat-footer">
            <input type="text" id="chat-input" placeholder="Escribe un mensaje...">
            <button id="send-btn">Enviar</button>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
<script>
    document.getElementById("chatbot-btn").addEventListener("click", function() {
        let chatbox = document.getElementById("chatbox");
        chatbox.style.display = (chatbox.style.display === "block") ? "none" : "block";
    });

    const socket = io("wss://chatbot-ws-ofa9.onrender.com"); // Conectar al servidor WebSocket en Python

    // ✅ Escuchar respuestas solo una vez al inicio
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
        chatBody.innerHTML += `<div style="text-align:right; background:#007bff; color:white; padding:5px; border-radius:10px; margin:5px 0;">Tú: ${message}</div>`;

        socket.emit("mensaje", { mensaje: message }); // ✅ Enviar mensaje al WebSocket
        input.value = "";
    }

    document.getElementById("send-btn").addEventListener("click", sendMessage);
    
    document.getElementById("chat-input").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            sendMessage();
            event.preventDefault();
        }
    });
</script>
</body>

</body>
</html>		