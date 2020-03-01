<?php

    include 'Perceptron.php';

    $perceptron = new Perceptron(0.2, [-0.6, 0.7, 0.2]);

    $x = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
    $resultadoEsperado = [0,0,0,1];
    $perceptron->treinar($x, $resultadoEsperado);
?>