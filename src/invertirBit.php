<?php

include 'helper/Algoritmos.php';

$helper = new Helper();
echo "Ingresa un numero :\n";
fscanf(STDIN, '%d\n', $dato);

$helper->invertirBinario($dato);
