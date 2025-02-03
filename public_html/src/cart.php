<!DOCTYPE html>
<html lang="es">
<head>
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

        .header {
            background-color: rgba(52, 58, 64, 0.8);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
        }

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
                <a href="orden_pago.php">Orden de pago</a>
            </div>
            <div class="option">
                <a href="Ofertas_disponibles.php">Ofertas disponibles</a>
            </div>
            <div class="option">
                <a href="listado_plazas.php">Listado de plazas</a>
            </div>
            <div class="option">
                <a href="acreditacion.php">Acreditación</a>
            </div>
            <div class="option">
                <a href="Cambiar_contrasena.php">Cambiar contraseña</a>
            </div>
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
        <div id="chat-header">Chatbot</div>
        <div id="chat-body"></div>
        <div id="chat-footer">
            <input type="text" id="chat-input" placeholder="Escribe un mensaje...">
            <button id="send-btn">Enviar</button>
        </div>
    </div>


    <script>
    document.getElementById("chatbot-btn").addEventListener("click", function() {
        let chatbox = document.getElementById("chatbox");
        chatbox.style.display = (chatbox.style.display === "block") ? "none" : "block";
    });

    function sendMessage() {
        let input = document.getElementById("chat-input");
        let message = input.value.trim();
        if (message === "") return;

        let chatBody = document.getElementById("chat-body");
        chatBody.innerHTML += `<div style="text-align:right; background:#007bff; color:white; padding:5px; border-radius:10px; margin:5px 0;">Tú: ${message}</div>`;

        fetch("chatbot.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `message=${encodeURIComponent(message)}`
        })
        .then(response => response.text())
        .then(data => {
            chatBody.innerHTML += `<div style="text-align:left; background:#f1f1f1; padding:5px; border-radius:10px; margin:5px 0;">Bot: ${data}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        });

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
</html>		