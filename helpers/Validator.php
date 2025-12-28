<?php
class Validator {
    // Validar texto no vacío
    public static function validateString($value, $min = 1, $max = 255) {
        $value = trim($value);
        return (strlen($value) >= $min && strlen($value) <= $max);
    }

    // Validar número entero positivo
    public static function validateId($value) {
        return filter_var($value, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]) !== false;
    }
}
