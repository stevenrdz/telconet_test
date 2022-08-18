<?php

include 'helper/Algoritmos.php';

$helper = new Helper();

echo "Ingresa un numero :\n";
fscanf(STDIN, '%d\n', $dato);

if($helper->validaPrimo($dato)){
  echo "El número $dato es Primo\n";
}else{
  echo "El número $dato no es Primo\n" ;
}
