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
            background-size: 800% 800%; /* Más grande para que la animación sea más fluida */
            animation: gradientAnimation 2s ease infinite; /* Animación más rápida, 2 segundos */
        }

        /* Animación del fondo */
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
        <!-- BOTÓN SALIR AL INICIO -->
        <a href="index.php" class="logout-button">Salir al inicio</a>
    </div>

    <div class="main-content">
        <div class="options-container">
            <!-- Opción 1 -->
            <div class="option">
                <a href="#">Datos personales</a>
            </div>
            <!-- Opción 2 -->
            <div class="option">
                <a href="#">Registro</a>
            </div>
            <!-- Opción 3 -->
            <div class="option">
                <a href="#">Orden de pago</a>
            </div>
            <!-- Opción 4 -->
            <div class="option">
                <a href="#">Ofertas disponibles</a>
            </div>
            <!-- Opción 5 -->
            <div class="option">
                <a href="#">Listado de plazas</a>
            </div>
            <!-- Opción 6 -->
            <div class="option">
                <a href="#">Acreditación</a>
            </div>
            <!-- Opción 7 -->
            <div class="option">
                <a href="#">Cambiar contraseña</a>
            </div>
        </div>
    </div>

</body>
</html>




            
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
        // Mostrar u ocultar el chat al hacer clic en el botón
        document.getElementById("chatbot-btn").addEventListener("click", function() {
            let chatbox = document.getElementById("chatbox");
            chatbox.style.display = (chatbox.style.display === "block") ? "none" : "block";
        });

        // Enviar mensaje al backend PHP
        document.getElementById("send-btn").addEventListener("click", function() {
            let input = document.getElementById("chat-input");
            let message = input.value.trim();
            if (message === "") return;

            let chatBody = document.getElementById("chat-body");
            chatBody.innerHTML += `<div><strong>Tú:</strong> ${message}</div>`;

            // Enviar al backend
            fetch("chatbot.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `message=${encodeURIComponent(message)}`
            })
            .then(response => response.text())
            .then(data => {
                chatBody.innerHTML += `<div><strong>Bot:</strong> ${data}</div>`;
                chatBody.scrollTop = chatBody.scrollHeight;
            });

            input.value = "";
        });
    </script>

</body>
</html>		