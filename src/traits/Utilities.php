<?php

namespace traits;

trait Utilities
{
    public function getErrorMessages($type)
    {
        $message = "";  

        switch ($type) {
            case 'general':
                $message = "Lo sentimos, la transacción no esta disponible.";
                break;

            case 'pin':
                $message = "No se ha podido enviar el código, por favor inténtalo más tarde.";
                break;

            case 'invalidPin':
                $message = "Ups! ingresaste un código incorrecto.";
                break;
         
            case 'conexion':
                $message = "No hemos podido identificar tu número de servicio, por favor desconecta tu red wi-fi y activa tu conexión de datos móviles, luego vuelve a ingresar.";
                break;
                
            default:
                $message = "Lo sentimos, la transacción no esta disponible.";
                break;
        }

        return $message;
    }

}
