<?php

class Helper{

    //Si obtenemos división exacta  no es primo
    //Si el cociente es menor que el divisor es primo
    public function validaPrimo($num){
        if ($num <= 1){
            return false;
        }
        for ($i = 2; $i < $num; $i++){
            if ($num % $i == 0){
                return false;
            }
            return true;
        }
    }
    
    //5 N^2 + 4 o 5N^2 – 4
    public function validarFibonacci($num){
        $resp = (int)(sqrt($num));
        return ($resp * $resp == $num);
    }
    
    public function isFibonacci($num){
        return $this->validarFibonacci(5 * $num * $num + 4) || $this->validarFibonacci(5 * $num * $num - 4);
    }

    public function invertirBinario($num){
        $numBinario = decbin($num);
        echo "Binario : $numBinario\n";

        $formatted_value = sprintf("%08d", $numBinario);
        echo "Binario con 8 bits : $formatted_value\n";

        $invert = strrev($formatted_value);
        echo "Binario Invertido : $invert\n";
        $newDecimal = bindec($invert);
        echo "Nuevo numero: $newDecimal\n";
    }
}



