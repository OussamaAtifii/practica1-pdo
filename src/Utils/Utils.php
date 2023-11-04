<?php

namespace App\Utils;

class Utils
{
    // Comprueba si un texto cumple con la longitud mínima requerida.
    public static function textError(string $name, string $value, int $length): bool
    {
        if (strlen($value) < $length) {
            $_SESSION[$name] = "$name debe tener al menos $length caracteres";
            return true;
        }

        return false;
    }

    // Comprueba si un número está dentro del rango especificado.
    public static function numError(string $name, int $value, int $min, int $max): bool
    {
        if ($value < $min || $value > $max) {
            $_SESSION[$name] = "$name debe tener un valor entre $min y $max";
            return true;
        }

        return false;
    }

    // Muestra y elimina los mensajes de error asociados a un nombre específico.
    public static function showErrors(string $errorName): void
    {
        if (isset($_SESSION[$errorName])) {
            echo "<p class='text-xs italic text-red-700 mt-2'>{$_SESSION[$errorName]}</p>";
            unset($_SESSION[$errorName]);
        }
    }
}
