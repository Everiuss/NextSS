<?php
session_start();

header("Content-Type: text/plain; charset=UTF-8");

// Justificación del chatbot basado en árboles de decisión
// 
// Este chatbot se desarrolla como parte del Módulo 2 de Sistemas Inteligentes, cumpliendo con el criterio 2.1.9 Árboles de decisión.
// Los árboles de decisión permiten modelar el flujo de conversación del chatbot mediante una estructura jerárquica de decisiones,
// lo que facilita la navegación y personalización de respuestas según las necesidades del usuario.
// 
// Modelo matemático:
// El árbol de decisiones se representa como un grafo dirigido donde cada nodo interno representa una pregunta
// y cada hoja representa una respuesta final. Se modela mediante una función de transición que asigna cada entrada
// a una siguiente pregunta o respuesta final.
// 
// Formalmente, un árbol de decisión se define como un grafo dirigido acíclico (DAG):
// - Un conjunto de nodos N = {n1, n2, ..., nk}, donde cada nodo representa un estado del chatbot.
// - Un conjunto de transiciones T = {(ni, nj) | ni lleva a nj según la respuesta del usuario}.
// - Una función de decisión D(ni, respuesta) → nj que asigna la siguiente transición en base a la respuesta.
// 
// Justificación de la elección del algoritmo:
// Se eligió un árbol de decisiones en lugar de redes neuronales o aprendizaje automático debido a:
// 1. Simplicidad y claridad: Un árbol de decisiones es interpretable, permitiendo definir preguntas y respuestas de manera estructurada.
// 2. Bajo consumo de recursos: No requiere entrenamiento ni grandes volúmenes de datos.
// 3. Determinismo: El chatbot siempre responde con base en reglas predefinidas, asegurando coherencia en la interacción con el usuario.
// 4. Facilidad de implementación: Integrar un árbol de decisiones en PHP con sesiones es más eficiente para este caso de uso específico.

// Pregunta inicial si no hay sesión activa
if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 'inicio';
    echo "👋 ¡Hola! ¿En qué puedo ayudarte con el servicio social?\n1️⃣ Requisitos\n2️⃣ Registro y procesos\n3️⃣ Reportes y liberación\n4️⃣ Contacto";
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
