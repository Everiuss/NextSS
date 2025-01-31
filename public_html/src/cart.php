<?php

    session_start();
    if (!isset($_SESSION['correo'])) {
        header('Location: login.php');
    }
    include("db_connection.php");
        $idusuario = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM CARRITO INNER JOIN PRODUCTOS ON CARRITO.IdProducto = PRODUCTOS.IdProducto WHERE CARRITO.IdUsuario = '$idusuario'";
        $result = mysqli_query($conn, $sql);
        $total = 0;
        echo "<table>";
        echo "<tr><td>&nbsp; IdProducto &nbsp;</td><td>&nbsp; Nombre &nbsp;</td><td>&nbsp; Cantidad &nbsp;</td><td>&nbsp; Precio &nbsp;</td></tr>";

        while ($car = mysqli_fetch_assoc($result)) {
            //echo "<tr><td>".$car["id_Producto"]."</td><td>".$car["Nombre"]."</td><td>".$car["Descripcion"]."</td><td>".$car["Precio"]."</td></tr>";
            echo "<tr>";
            echo "<td> &nbsp;".$car["IdProducto"]." &nbsp;</td>";
            echo "<td> &nbsp;".$car["Nombre"]." &nbsp;</td>";
            echo "<td> &nbsp;".$car["Cantidad"]." &nbsp;</td>";
            echo "<td> &nbsp;"."$".$car["Costo"]." MXN"." &nbsp;</td>";
            $total += $car["Costo"];
            echo "<td>";
        }
        echo "<tr>";
        echo "<tr>";
        echo "<td></td><td> &nbsp;Total: </td><td>"."&nbsp;$".$total." MXN"."</td>";
        echo "</table>";

        ?>
        <form class="login100-form" method="post" action="delete_cart.php">
        <div class="container-login100-form-btn">
        <input class="login100-form-btn" type="button" value="Comprar">
    <a href="../index.php#Productos" style="margin-left: 10%"><input class="login100-form-btn" type="button" value="Seguir viendo productos"></a>
    <input class="login100-form-btn" type="submit" name="borrar_carrito" value="Borrar carrito"  style="margin-left: 10%">
		</form>    
		</div>

        




        
        <!DOCTYPE html>
        <html lang="es">
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