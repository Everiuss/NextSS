<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVICIO SOCIAL UDG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #e3f2fd, #bbdefb);
            text-align: center;
            margin: 0;
            padding: 0;
            animation: backgroundAnimation 5s infinite alternate;
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
            animation: slideDown 1s ease-in-out;
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            justify-items: center;
            animation: fadeIn 2s ease-in-out;
            max-width: 960px;
            margin: 0 auto;
        }
        .button {
            background-color: #1976d2;
            color: white;
            padding: 20px;
            width: 200px;
            height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #1565c0;
            transform: scale(1.05);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
        .button:active {
            transform: scale(0.95);
        }
        .icon {
            font-size: 30px;
            margin-bottom: 10px;
        }
        .exit {
            display: block;
            margin: 20px auto 40px;
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
            background-color: #ff9800;
            color: white;
            padding: 15px 20px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s, background 0.3s;
        }
        .chatbot:hover {
            background-color: #e68900;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="header">SERVICIO SOCIAL UDG</div>
    <div class="container">
        <a href="/public_html/src/datos_personales.php" class="button"><i class="fas fa-user icon"></i>Datos Personales</a>
        <a href="/public_html/src/registro.php" class="button"><i class="fas fa-edit icon"></i>Registro</a>
        <a href="/public_html/src/orden_pago.php" class="button"><i class="fas fa-file-invoice-dollar icon"></i>Orden de Pago</a>
        <a href="/public_html/src/ofertas_disponibles.php" class="button"><i class="fas fa-briefcase icon"></i>Ofertas Disponibles</a>
        <a href="/public_html/src/listado_plazas.php" class="button"><i class="fas fa-list icon"></i>Listado de Plazas</a>
        <a href="/public_html/src/acreditacion.php" class="button"><i class="fas fa-check-circle icon"></i>Acreditación</a>
    </div>
    <a href="../index.php" class="exit">Salir al inicio</a>
    <div class="chatbot" onclick="toggleChatbox()">💬 Chatbot</div>

    <div id="chatbox" style="display:none; position:fixed; bottom:80px; right:20px; width:300px; background:white; border-radius:10px; box-shadow:2px 2px 10px rgba(0,0,0,0.3); border:1px solid #ccc;">
        <div style="background:#ff9800; color:white; padding:10px; text-align:center; font-size:18px; border-top-left-radius:10px; border-top-right-radius:10px;">SERVIBOT</div>
        <div id="chat-body" style="height:300px; overflow-y:auto; padding:10px; background:#f9f9f9;"></div>
        <div style="padding:10px; display:flex; border-top:1px solid #ccc;">
            <input type="text" id="chat-input" style="flex:1; padding:5px;">
            <button onclick="sendMessage()" style="background:#ff9800; color:white; border:none; padding:5px 10px; cursor:pointer;">Enviar</button>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
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
            chatBody.innerHTML += `<div style="text-align:right; background:#ff9800; color:white; padding:5px; border-radius:10px; margin:5px 0;">Tú: ${message}</div>`;

            socket.emit("mensaje", { mensaje: message });
            input.value = "";
        }

        document.getElementById("chat-input").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                sendMessage();
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
