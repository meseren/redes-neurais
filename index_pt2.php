<?php 

    include 'Neuronio.php';
    include 'RedeNeural.php';

    /**Inputs */

    /* Exemplo 1 */
    $entradas = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
    $resultadoEsperado = [0,1,1,0];
    $pesos_h = [[-0.46,-0.7,0.22],[0.10,0.94,0.46]];
    $pesos_o = [0.78,-0.22,0.58];
    
    /* Exemplo 2
    $entradas = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
    $resultadoEsperado = [0,1,1,0];
    $pesos_h = [[-0.16,-0.87,0.15],[0.90,0.14,0.05]];
    $pesos_o = [0.20,-0.25,0.15];*/

    /*Exemplo 3*/
    // $entradas = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
    // $resultadoEsperado = [0,1,1,0];
    // $pesos_h = [[1.81,-5.61,-5.90],[5.27,-3.70,-3.72]];
    // $pesos_o = [-2.48,-7.01,5.92];

    $MSE = new RedeNeural($entradas, $resultadoEsperado, $pesos_h, $pesos_o);

    $resultMse = $MSE->atualizaPesos();

    // print 'Mean Squared Error (MSE): '.$resultMse.'% <br>';

    // print 'Erro quadrático: '.$MSE->getErroQuadratico().'<br>';

    // $resultados = $MSE->getResultados();
    // print 'Resultados: ';
    // print_r($resultados);
    
?>