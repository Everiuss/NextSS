<?php
session_start();

header("Content-Type: text/plain; charset=UTF-8");

// Pregunta inicial si no hay sesión activa
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 'inicio';
    echo "👋 ¡Hola! ¿En qué puedo ayudarte con el servicio social?
    \n1️⃣ Requisitos\n2️⃣ Registro y procesos\n3️⃣ Reportes y liberación\n4️⃣ Contacto";
    exit;
}

// Obtener mensaje del usuario
$message = trim($_POST['message'] ?? '');

// Árbol de decisiones
switch ($_SESSION['step']) {
    case 'inicio':
        if ($message == '1') {
            $_SESSION['step'] = 'requisitos';
            echo "➡ ¿Eres estudiante de licenciatura o posgrado?\n1️⃣ Licenciatura\n2️⃣ Posgrado";
        } elseif ($message == '2') {
            $_SESSION['step'] = 'registro';
            echo "✅ Para registrarte, visita el portal oficial de la UDG y sigue las instrucciones.";
        } elseif ($message == '3') {
            $_SESSION['step'] = 'reportes';
            echo "📝 Los reportes deben subirse en la plataforma oficial. ¿Necesitas más detalles? (Sí/No)";
        } elseif ($message == '4') {
            $_SESSION['step'] = 'contacto';
            echo "📩 Puedes contactar a la coordinación en: contacto@udg.mx";
        } else {
            echo "❌ Opción no válida. Escribe un número del 1 al 4.";
        }
        break;
    
    case 'requisitos':
        if ($message == '1') {
            echo "📘 Requisitos para licenciatura: Tener 70% de créditos aprobados, registrarte en la plataforma oficial y cumplir 480 horas de servicio.";
        } elseif ($message == '2') {
            echo "🎓 Requisitos para posgrado: Haber cursado al menos 1 año y completar 300 horas de servicio.";
        } else {
            echo "❌ Opción no válida. Escribe 1 o 2.";
        }
        break;
    
    case 'reportes':
        if (strtolower($message) == 'sí') {
            echo "📌 Más detalles sobre reportes: Debes entregarlos en las fechas establecidas y subirlos en PDF al sistema.";
        } else {
            echo "✅ Entendido. Si necesitas más ayuda, dime en qué más te puedo apoyar.";
            $_SESSION['step'] = 'inicio';
        }
        break;
    
    default:
        $_SESSION['step'] = 'inicio';
        echo "❌ Algo salió mal. Volvamos al inicio. ¿En qué puedo ayudarte con el servicio social?";
        break;
}
