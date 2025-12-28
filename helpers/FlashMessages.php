<?php
class FlashMessages {

    // Agregar un mensaje flash a la sesión
    public static function addMessage($message, $type = 'info') {
        // Crear array de mensajes si no existe
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }

        // Añadir mensaje con tipo (success, error, warning, info)
        $_SESSION['flash_messages'][] = ['message' => $message, 'type' => $type];
    }

    // Mostrar todos los mensajes flash y luego eliminarlos
    public static function display() {
        if (!isset($_SESSION['flash_messages'])) return; // salir si no hay mensajes

        foreach ($_SESSION['flash_messages'] as $flash) {
            // Mapear tipo a clase de Bootstrap
            $typeClass = match($flash['type']) {
                'success' => 'alert-success',
                'error' => 'alert-danger',
                'warning' => 'alert-warning',
                default => 'alert-info',
            };

            // Mostrar alerta con botón de cerrar
            echo "<div class='alert $typeClass alert-dismissible fade show' role='alert'>
                    {$flash['message']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }

        // Limpiar mensajes de la sesión para que no se repitan
        unset($_SESSION['flash_messages']);
    }
}
