<?php

class Neuronio{
    private $pesos;
    private $entradas;
    private $e = 2.7183;

    public function __construct(array $entradas, array $pesos) {
        $this->pesos = $pesos;
        $this->entradas = $entradas;
    }

    private function soma(){
		$soma = 0;
		
		for ($i=0; $i<count($this->pesos); $i++)
			$soma += $this->entradas[$i]*$this->pesos[$i];

		return $soma;
    }
    
    private function h(float $u){
        return 1/(1 +  pow($this->e, -$u));
    }

    public function getSaida(){
        return $this->h($this->soma());
    }
}
?>