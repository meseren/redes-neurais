<?php

class Perceptron {
    
    private $pesos;
    private $fatorAprendizado;

    public function __construct($fatorAprendizado  = '', $pesos = '') {
        $this->pesos = $pesos;
        $this->fatorAprendizado = $fatorAprendizado;
    }

    public function soma(array $x) {
        $soma = 0;
		
		for ($i=0; $i<count($this->pesos); $i++) { 
            $soma += $x[$i]*$this->pesos[$i];
        }

		return $soma;
    }

    public function resultado(array $x) {
        if($this->soma($x) >= 0)
			return 1;

		return 0;
    }

    public function atualizaPeso($w, $erro, $entrada){
         return $w + ($this->fatorAprendizado * $erro * $entrada);
    }

    public function treinar(array $entradas, array $resultadoEsperado) {
        $erro = 0;
        for($i=0;$i<count($entradas);$i++){
            do {
                for($j=0;$j<count($this->pesos);$j++) {
                    $erro = $resultadoEsperado[$i] - $this->resultado($entradas[$i]);
                    $this->pesos[$j] = $this->atualizaPeso($this->pesos[$j], $erro, 1);
                }
            }while($erro != 0);
            // print_r($this->pesos);
            // print $this->resultado($entradas[$i]);
        }
    }

}

?>