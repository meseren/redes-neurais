<?php 

    /*
        NOTAS DOS INTEGRANTES: Professor, como pôde acompanhar durante as aulas, estávamos conseguindo gerar os deltas e gradientes certinho, porém depois que vi o pseudo código do Sr, percebi que estava um tanto quanto errado e tive que alterar para a sua lógica rsrsrs. 

        Nosso histórico de desenvolvimento está nos commits do GitHub, caso queira verificar: https://github.com/meseren/redes-neurais


        Integrantes: Melissa, Allan e Leonardo Clemente 
    */
    include 'RedeNeural.php';

    /**Inputs */
    
    print '<pre>Inserção dos pesos manualmente:<br>';
    //H1
    $pesos[0] = [-0.46, -0.07,  0.22];
    //H2
    $pesos[1] = [ 0.10,  0.94,  0.46];
    //01
    $pesos[2] = [ 0.78, -0.22,  0.58];
    //02
    $pesos[3] = [ 0.78, -0.22,  0.58];

    $entradas = [[0,0],[0,1],[1,0],[1,1]];

    $resultados_esperados = [[0,1],[1,0],[1,0],[0,1]];
                
    $MSE = new RedeNeural($pesos);

    $MSE->treinar($entradas,$resultados_esperados,0.3,0.1);

    print_r($MSE->MLP($entradas[0]));
    print_r($MSE->MLP($entradas[1]));
    print_r($MSE->MLP($entradas[2]));
    print_r($MSE->MLP($entradas[3]));

    /*
    Resultado Esperado = 0,0
    [0] => 0.0098746961706474  O1 <- saída que importa
    [1] => 0.99011562275379    O2 <- saída que importa
    [2] => 0.97283841299981    H1
    [3] => 0.01846863631561    H2
    
    Resultado Esperado = 1,0
    [0] => 0.98851079891453    O1 <- saída que importa
    [1] => 0.011500471298918   O2 <- saída que importa
    [2] => 0.026845065044502   H1
    [3] => 8.0102581066593E-6  H2 
    
    Resultados Esperados = 1,0
    [0] => 0.99058560277932    O1 <- saída que importa
    [1] => 0.0094237202552812  O2 <- saída que importa
    [2] => 0.99998296934959    H1
    [3] => 0.97242032319106    H2

    Resultados Esperados = 0,1
    [0] => 0.0090253628665525  O1 <- saída que importa
    [1] => 0.99096560471334    O2 <- saída que importa
    [2] => 0.9783656951525     H1
    [3] => 0.014788149169334   H2
    */

    print '<br>Inserção de pesos randomicamente:<br>';

    for ($i=0; $i<4 ; $i++) { 
        for ($j=0; $j<3 ; $j++) { 
            $pesos[$i][$j] = rand(-5,5);
        }
    }

    $entradas = [[0,0],[0,1],[1,0],[1,1]];

    $resultados_esperados = [[0,1],[1,0],[1,0],[0,1]];
                
    $MSE = new RedeNeural($pesos);

    $MSE->treinar($entradas,$resultados_esperados,0.3,0.1);

    print_r($MSE->MLP($entradas[0]));
    print_r($MSE->MLP($entradas[1]));
    print_r($MSE->MLP($entradas[2]));
    print_r($MSE->MLP($entradas[3]));

    /*
    Resultado Esperado = 0,0
    [0] => 0.0092968141576208  O1 <- saída que importa
    [1] => 0.99061320806223    O2 <- saída que importa
    [2] => 0.999975976489      H1
    [3] => 0.95315892128581    H2  
    
    Resultado Esperado = 1,0
    [0] => 0.99058846453896    O1 <- saída que importa
    [1] => 0.0094999883967769  O2 <- saída que importa
    [2] => 0.97165709153301    H1
    [3] => 0.018000147847865   H2   
    
    Resultados Esperados = 1,0
    [0] => 0.99058524358826    O1 <- saída que importa
    [1] => 0.0095032336608643  O2 <- saída que importa
    [2] => 0.97104363906098    H1
    [3] => 0.017446193750669   H2

    Resultados Esperados = 0,1
    [0] => 0.011516618656009    O1 <- saída que importa
    [1] => 0.98837924168654     O2 <- saída que importa
    [2] => 0.026876833497225    H1 
    [3] => 1.5994240549239E-5   H2   
    */
?>