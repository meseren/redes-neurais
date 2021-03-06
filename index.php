<?php

    include 'Perceptron.php';

     /*************************************************
     * #4 - Testar o Perceptron com uma porta AND e OR*
     **************************************************/
     $perceptron = new Perceptron(0.2, [-0.6, 0.7, 0.2]);

     //porta AND => saída: 0001
     $x = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
     $resultadoEsperado = [0,0,0,1];
     $perceptron->treinar($x, $resultadoEsperado);

     print 'Porta AND: ';
     print $perceptron->resultado($x[0]);
     print $perceptron->resultado($x[1]);
     print $perceptron->resultado($x[2]);
     print $perceptron->resultado($x[3]);
     print '<br>';

     //porta OR => saída: 0111
     $x = [[1,0,0], [0,0,1], [1,1,0], [1,1,1]];
     $resultadoEsperado = [0,1,1,1];
     $perceptron->treinar($x, $resultadoEsperado);

     print 'Porta OR: ';
     print $perceptron->resultado($x[0]);
     print $perceptron->resultado($x[1]);
     print $perceptron->resultado($x[2]);
     print $perceptron->resultado($x[3]);
     print '<br>';
 
    /**********************************************
     * #5 - Implementar o reconhecimento de A e T *
     **********************************************/
    $pesos = array();
    
    for($i=0;$i<25;$i++){
        $pesos[$i] = (rand(0, 50))/10;
    }

    $perceptron = new Perceptron(0.2, $pesos);

     $x = [['1','1','1','1','1','1',
                '1','0','0','0','1',
                '1','1','1','1','1',
                '1','0','0','0','1',
                '1','0','0','0','1'] /*A*/, 
          ['1','1','1','1','1','1',
               '0','0','1','0','0',
               '0','0','1','0','0',
               '0','0','1','0','0',
               '0','0','1','0','0'] /*T/*/];

     $resultadoEsperado = [1, 0];

     $perceptron->treinar($x, $resultadoEsperado);

     print 'Letra A: '.$perceptron->resultado($x[0]);

     print '<br> Variação de algumas posições da letra A:';

     print $perceptron->resultado(['1','0','1','0','0','1',
                                       '1','0','0','0','1',
                                       '1','1','1','1','1',
                                       '1','0','0','0','1',
                                      '1','0','0','0','0']);   //saída: 1    

     print '<br> Letra T: '.$perceptron->resultado($x[1]);

     print '<br> Variação de algumas posições da letra T:';

     print $perceptron->resultado(['1','1','0','1','0','1',
                                        '0','0','1','0','0',
                                        '0','0','1','0','0',
                                        '0','0','1','0','0',
                                        '0','0','0','0','0']);

    /**********************************************
     * #6 - Implementar o reconhecimento de A a Z *
     **********************************************/
    $pesos = array();

    for($i=0;$i<25;$i++){
        $pesos[$i] = (rand(0, 50))/10;
    }

    $perceptron_1 = new Perceptron(0.8, $pesos);
    $perceptron_2 = new Perceptron(0.8, $pesos);
    $perceptron_3 = new Perceptron(0.8, $pesos);
    $perceptron_4 = new Perceptron(0.8, $pesos);
    $perceptron_5 = new Perceptron(0.8, $pesos);

    $x = [
          ['1','1', '1', '1', '1', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '1',
               '1', '0', '0', '0', '1' /*A*/
          ],
          [
           '1','1', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '0' /*B*/
          ],
          [
           '1','0', '1', '1', '1', '1',
               '1', '0', '0', '0', '0',
               '1', '0', '0', '0', '0',
               '1', '0', '0', '0', '0',
               '0', '1', '1', '1', '1' /*C*/
          ],
          [
          '1', '1', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '0' /*D*/
          ],
          [
          '1', '1', '1', '1', '1', '1',
               '1', '0', '0', '0', '0',
               '1', '1', '1', '1', '1',
               '1', '0', '0', '0', '0',
               '1', '1', '1', '1', '1' /*E*/
          ],
          [
          '1', '1', '1', '1', '1', '1',
               '1', '0', '0', '0', '0',
               '1', '1', '1', '1', '1',
               '1', '0', '0', '0', '0',
               '1', '0', '0', '0', '0' /*F*/
          ],
          [
          '1', '0', '1', '1', '1', '0',
               '1', '0', '0', '0', '0',
               '1', '0', '0', '1', '1',
               '1', '0', '0', '0', '1',
               '0', '1', '1', '1', '1' /*G*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1' /*H*/
          ],
          [
          '1', '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0', /*I*/
          ],
          [
          '1', '0', '0', '1', '1', '1',
               '0', '0', '0', '0', '1',
               '0', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '0', '1', '1', '1', '0' /*J*/
          ],
          [
          '1', '1', '0', '0', '1', '0',
               '1', '0', '1', '0', '0',
               '1', '1', '0', '0', '0',
               '1', '0', '1', '0', '0',
               '1', '0', '0', '1', '0' /*K*/
          ],
          [
          '1', '1', '0', '0', '0', '0',
               '1', '0', '0', '0', '0',
               '1', '0', '0', '0', '0',
               '1', '0', '0', '0', '0',
               '1', '1', '1', '1', '1' /*L*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '1', '1', '0', '1', '1',
               '1', '0', '1', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1' /*M*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '1', '1', '0', '0', '1',
               '1', '0', '1', '0', '1',
               '1', '0', '0', '1', '1',
               '1', '0', '0', '0', '1' /*N*/
          ],
          [
          '1', '0', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '0', '1', '1', '1', '0' /*O*/
          ],
          [
          '1', '1', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '0',
               '1', '0', '0', '0', '0',
               '0', '0', '0', '0', '0' /*P*/
          ],
          [
          '1', '0', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '1', '0',
               '0', '1', '1', '0', '1' /*Q*/
          ],
          [
          '1', '1', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '1', '1', '1', '0',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1' /*R*/
          ],
          [
          '1', '0', '1', '1', '1', '1',
               '1', '0', '0', '0', '1',
               '0', '1', '1', '1', '0',
               '0', '0', '0', '0', '1',
               '1', '1', '1', '1', '0' /*S*/
          ],
          [
          '1', '1', '1', '1', '1', '1',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0' /*T*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '0', '1', '1', '1', '0' /*U*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '0', '1', '0', '1', '0',
               '0', '1', '0', '1', '0',
               '0', '0', '1', '0', '0' /*V*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '1', '0', '0', '0', '1',
               '1', '0', '1', '0', '1',
               '1', '1', '0', '1', '1',
               '1', '0', '0', '0', '1' /*W*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '0', '1', '0', '1', '0',
               '0', '0', '1', '0', '0',
               '0', '1', '0', '1', '0',
               '1', '0', '0', '0', '1' /*X*/
          ],
          [
          '1', '1', '0', '0', '0', '1',
               '0', '1', '0', '1', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0',
               '0', '0', '1', '0', '0' /*Y*/
          ],
          [
          '1', '1', '1', '1', '1', '1',
               '0', '0', '0', '1', '0',
               '0', '0', '1', '0', '0',
               '0', '1', '0', '0', '0',
               '1', '1', '1', '1', '1' /*Z*/
          ]
     ];
     
     $resultadoEsperadoPerceptron_1 = ['0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','1','1'];
     $resultadoEsperadoPerceptron_2 = ['0','0','0','0','0','0','0','0','1','1','1','1','1','1','1','1','0','0','0','0','0','0','0','0','1','1'];
     $resultadoEsperadoPerceptron_3 = ['0','0','0','0','1','1','1','1','0','0','0','0','1','1','1','1','0','0','0','0','1','1','1','1','0','0'];
     $resultadoEsperadoPerceptron_4 = ['0','0','1','1','0','0','1','1','0','0','1','1','0','0','1','1','0','0','1','1','0','0','1','1','0','0'];
     $resultadoEsperadoPerceptron_5 = ['0','1','0','1','0','1','0','1','0','1','0','1','0','1','0','1','0','1','0','1','0','1','0','1','0','1'];

    $perceptron_1->treinar($x, $resultadoEsperadoPerceptron_1);
    $perceptron_2->treinar($x, $resultadoEsperadoPerceptron_2);
    $perceptron_3->treinar($x, $resultadoEsperadoPerceptron_3);
    $perceptron_4->treinar($x, $resultadoEsperadoPerceptron_4);
    $perceptron_5->treinar($x, $resultadoEsperadoPerceptron_5);

    print '<br> Letra A:';
    print $perceptron_1->resultado($x[0]);
    print $perceptron_2->resultado($x[0]);
    print $perceptron_3->resultado($x[0]);
    print $perceptron_4->resultado($x[0]);
    print $perceptron_5->resultado($x[0]);

    print '<br> Letra B:';
    print $perceptron_1->resultado($x[1]);
    print $perceptron_2->resultado($x[1]);
    print $perceptron_3->resultado($x[1]);
    print $perceptron_4->resultado($x[1]);
    print $perceptron_5->resultado($x[1]);

    print '<br> Letra C:';
    print $perceptron_1->resultado($x[2]);
    print $perceptron_2->resultado($x[2]);
    print $perceptron_3->resultado($x[2]);
    print $perceptron_4->resultado($x[2]);
    print $perceptron_5->resultado($x[2]);
    print '<br> [...] <br>';
     
    /************
     * #7 - Xor *
     ************/
     $perceptron_1 = new Perceptron(0.2, [-0.6, 0.7, 0.2]);

     $x = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
     $resultadoEsperado = [0,1,1,1];
     $perceptron_1->treinar($x, $resultadoEsperado);

     print 'Perceptron 1: ';
     print $perceptron_1->resultado($x[0]);
     print $perceptron_1->resultado($x[1]);
     print $perceptron_1->resultado($x[2]);
     print $perceptron_1->resultado($x[3]);
     print '<br>';

     $perceptron_2 = new Perceptron(0.2, [-0.6, 0.7, 0.2]);

     $x = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];
     $resultadoEsperado = [1,1,1,0];
     $perceptron_2->treinar($x, $resultadoEsperado);

     print 'Perceptron 2: ';
     print $perceptron_2->resultado($x[0]);
     print $perceptron_2->resultado($x[1]);
     print $perceptron_2->resultado($x[2]);
     print $perceptron_2->resultado($x[3]);
     print '<br>';

     $perceptron_3 = new Perceptron(0.2, [-0.6, 0.7, 0.2]);

     $x = [[1,0,0], [1,0,1], [1,1,0], [1,1,1]];

     $resultadoEsperado = [0,0,0,1];
     $perceptron_3->treinar($x, $resultadoEsperado);

     print 'Perceptron 3: ';
     print $perceptron_3->resultado($x[0]);
     print $perceptron_3->resultado($x[1]);
     print $perceptron_3->resultado($x[2]);
     print $perceptron_3->resultado($x[3]);
     print '<br>';

     //saídas do perceptron 1 e 2 entrando no perceptron 3
     $x = [[1,$perceptron_1->resultado($x[0]),$perceptron_2->resultado($x[0])], 
          [1,$perceptron_1->resultado($x[1]),$perceptron_2->resultado($x[1])], 
          [1,$perceptron_1->resultado($x[2]),$perceptron_2->resultado($x[2])], 
          [1,$perceptron_1->resultado($x[3]),$perceptron_2->resultado($x[3])]];

     print 'XOR: ';
     print $perceptron_3->resultado($x[0]);
     print $perceptron_3->resultado($x[1]);
     print $perceptron_3->resultado($x[2]);
     print $perceptron_3->resultado($x[3]);
     print '<br>';

?>