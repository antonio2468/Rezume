<?php
// Endpoint para generar un mensaje aleatorio
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['generar'])) {
    $mensaje = generarMensajeAleatorio();
    echo json_encode(['mensaje' => $mensaje]);
    exit;
}

// Función para generar un mensaje aleatorio
function generarMensajeAleatorio() {
    $mensajes = [
        'Hola, ¿cómo estás?',
        'Escribe el número 42',
        'Completa: GPT-3 es genial',
        '¿Cuál es la capital de Francia?',
        'El cielo es azul'
    ];
    $mensaje = $mensajes[array_rand($mensajes)];
    return $mensaje;
}
?>
