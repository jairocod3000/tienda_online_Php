<?php

namespace Utils;

class Utils
{
    /**
     * Elimina una variable específica de la sesión.
     * 
     * @param string $name Nombre de la variable de sesión a eliminar.
     */
    public static function removeSession($name): void {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Verifica si el usuario actual tiene privilegios de administrador.
     * 
     * @return bool Retorna true si el usuario es administrador, de lo contrario false.
     */
    public static function isUserAdmin(): bool {
        return isset($_SESSION['admin']);
    }

    /**
     * Devuelve la hora actual en formato H:i:s.
     * 
     * @return string Hora actual.
     */
    public static function getCurrentTime(): string {
        return date("H:i:s");
    }

    /**
     * Devuelve la fecha actual en formato Y-m-d.
     * 
     * @return string Fecha actual.
     */
    public static function getCurrentDate(): string {
        return date("Y-m-d");
    }
}
