<?php 
class MSE{  

    private $pesos_h;
    private $entradas;
    private $erroQuadratico;
    private $resultadoEsperado;
    private $resultados= array();
    private $e = 2.7183;

    public function __construct($entradas, $resultadoEsperado, $pesos_h, $pesos_o) {
        $this->entradas = $entradas;
        $this->resultadoEsperado = $resultadoEsperado;
        $this->pesos_h = $pesos_h;
        $this->pesos_o = $pesos_o;
    }
    
    public function getMse(){
        //Para todas as entradas, é calculado um erro
        foreach($this->entradas as $key => $x){
            $neuronio = new Neuronio($x, $this->pesos_h[0]);
            $H1 =  $neuronio->getSaida();
    
            $neuronio = new Neuronio($x, $this->pesos_h[1]);
            $H2 =  $neuronio->getSaida();
        
            $u = $this->pesos_o[0] + $H1 * $this->pesos_o[1] + $H2 * $this->pesos_o[2];

            $this->resultados[] = 1/(1 +  pow($this->e, -$u));
    
            $this->erroQuadratico += pow(($this->resultadoEsperado[$key] - ($this->resultados[$key])), 2);
        }

        return ($this->erroQuadratico/count($this->entradas))*100;
    }

    public function getResultados(){
        return $this->resultados;
    }

    public function getErroQuadratico(){
        return $this->erroQuadratico;
    }
}
?>