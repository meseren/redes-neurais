<?php 

    include 'Neuronio.php';

    $e = 2.7183;

    $entradas = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
    $resultadoEsperado = [0,1,1,0];

    $O1 = array();
    $erroQuadratico = 0;

    foreach($entradas as $key => $x){
        $neuronio = new Neuronio($x, [-0.16,-0.87,0.15]);
        $H1 =  $neuronio->getSaida();

        $neuronio = new Neuronio($x, [0.90,0.14,0.05]);
        $H2 =  $neuronio->getSaida();
    
        $u = 0.20 + $H1 * -0.25 + $H2 * 0.15;
    
        $O1[] = 1/(1 +  pow($e, -$u));
        $erroQuadratico += pow(($resultadoEsperado[$key] - $O1[$key]), 2);
    }

    print (($erroQuadratico/4)*100).'%';
   
?>