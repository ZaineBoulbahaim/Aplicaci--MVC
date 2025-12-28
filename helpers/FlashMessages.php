<?php
class FlashMessages {
    public static function addMessage($message, $type = 'info') {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }
        $_SESSION['flash_messages'][] = ['message' => $message, 'type' => $type];
    }

    public static function display() {
        if (!isset($_SESSION['flash_messages'])) return;

        foreach ($_SESSION['flash_messages'] as $flash) {
            $typeClass = match($flash['type']) {
                'success' => 'alert-success',
                'error' => 'alert-danger',
                'warning' => 'alert-warning',
                default => 'alert-info',
            };
            echo "<div class='alert $typeClass alert-dismissible fade show' role='alert'>
                    {$flash['message']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
        unset($_SESSION['flash_messages']);
    }
}
