<?php 
class RedeNeural{  

    private $pesos_h;
    private $erros;
    private $H1;
    private $H2;
    private $taxaAprendizado;
    private $delta_h1;
    private $delta_h2;
    private $delta_o1;
    private $gradienteEntradas;
    private $gradienteCamadaOculta;
    private $entradas;
    private $erroQuadratico;
    private $resultadoEsperado;
    private $resultados;
    private $e = 2.7183;

    public function __construct($entradas, $resultadoEsperado, $pesos_h, $pesos_o) {
        $this->entradas = $entradas;
        $this->resultadoEsperado = $resultadoEsperado;
        $this->pesos_h = $pesos_h;
        $this->pesos_o = $pesos_o;
        $this->taxaAprendizado = 0.2;
    }
    
    public function getMse(){
        //Para todas as entradas, é calculado um erro
        foreach($this->entradas as $key => $x){
            $neuronio = new Neuronio($x, $this->pesos_h[0]);
            $this->H1[] =  $neuronio->getSaida();
    
            $neuronio = new Neuronio($x, $this->pesos_h[1]);
            $this->H2[] =  $neuronio->getSaida();
        
            $u = $this->pesos_o[0] + $this->H1[$key] * $this->pesos_o[1] + $this->H2[$key] * $this->pesos_o[2];

            $this->resultados[] = 1/(1 +  pow($this->e, -$u));
            $this->erros[] = $this->resultadoEsperado[$key] - $this->resultados[$key];
            $this->erroQuadratico += pow($this->erros[$key], 2);
        }

        return ($this->erroQuadratico/count($this->entradas))*100;
    }

    public function atualizaPesos(){
        $mse = $this->getMse();

        $this->calculaGradiente();
        
        $this->pesos_o[0] = $this->pesos_o[0] + ($this->taxaAprendizado * (-$this->gradienteCamadaOculta['X0'][0]));
        $this->pesos_o[1] = $this->pesos_o[1] + ($this->taxaAprendizado * (-$this->gradienteCamadaOculta['H1'][0]));
        $this->pesos_o[2] = $this->pesos_o[2] + ($this->taxaAprendizado * (-$this->gradienteCamadaOculta['H2'][0]));

        // while($mse > 0.01){
            
        // }
    }

    public function calculaDelta(){
        foreach($this->entradas as $key => $x){

            $derivadaFdeU = ($this->resultados[$key] * (1- $this->resultados[$key]));
            $this->delta_o1[] =  $derivadaFdeU * $this->erros[$key];
            
            $derivadaFdeU = ($this->H1[$key] * (1- $this->H1[$key]));
            $this->delta_h1[] = $derivadaFdeU * $this->pesos_o[1] * $this->delta_o1[$key]; 

            $derivadaFdeU = ($this->H2[$key] * (1- $this->H2[$key]));
            $this->delta_h2[] = $derivadaFdeU * $this->pesos_o[2] * $this->delta_o1[$key]; 
        }
    }

    public function calculaGradiente(){
        $this->calculaDelta();

        foreach($this->entradas as $i => $value){
            foreach($value as $j => $x){
                $this->gradienteEntradas['H1'][$i][$j] = $x * $this->delta_h1[$i];
                $this->gradienteEntradas['H2'][$i][$j] = $x * $this->delta_h2[$i];
            }
            
            $this->gradienteCamadaOculta['X0'][] = $this->pesos_o[0] * $this->delta_o1[$i];    
            $this->gradienteCamadaOculta['H1'][] = $this->pesos_o[1] * $this->delta_o1[$i];    
            $this->gradienteCamadaOculta['H2'][] = $this->pesos_o[2] * $this->delta_o1[$i];    
        }
    }

    public function getResultados(){
        return $this->resultados;
    }

    public function getErroQuadratico(){
        return $this->erroQuadratico;
    }
}
?>