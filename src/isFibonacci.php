<?php

include 'helper/Algoritmos.php';

$helper = new Helper();

echo "Ingresa un numero :\n";
fscanf(STDIN, '%d\n', $dato);
if($helper->isFibonacci($dato)){
    echo "$dato es un numero Fibonacci\n";
}
else{
    echo "$dato no es un numero Fibonacci\n" ;
}

