<?php 
class RedeNeural{  

    private $pesos_h;
    private $pesos_o;
    private $erros;
    private $erros_2;
    private $H1;
    private $H2;
    private $taxaAprendizado;
    private $delta_h1 = [0,0,0];
    private $delta_h1_anterior;
    private $delta_h2 = [0,0,0];
    private $delta_h2_anterior;
    private $delta_o1 = [0,0,0];
    private $delta_o1_anterior;
    private $delta_o2 = [0,0,0];
    private $delta_o2_anterior;
    private $gradienteEntradas;
    private $gradienteCamadaOculta;
    private $entradas;
    private $erroQuadratico;
    private $erroQuadratico_2;
    private $resultadoEsperado;
    private $resultadoEsperado_2;
    private $resultados;
    private $resultados_2;
    private $e = 2.7183;

    public function __construct($entradas, $resultadoEsperado, $resultadoEsperado_2, $pesos_h, $pesos_o) {
        $this->entradas = $entradas;
        $this->resultadoEsperado = $resultadoEsperado;
        $this->resultadoEsperado_2 = $resultadoEsperado_2;
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
        
            $u_1 = $this->pesos_o[0][0] + $this->H1[$key] * $this->pesos_o[0][1] + $this->H2[$key] * $this->pesos_o[0][2];
            $u_2 = $this->pesos_o[0][0] + $this->H1[$key] * $this->pesos_o[1][1] + $this->H2[$key] * $this->pesos_o[1][2];
            

            $this->resultados[] = 1/(1 +  pow($this->e, -$u_1));
            $this->erros[] = $this->resultadoEsperado[$key] - $this->resultados[$key];
            $this->erroQuadratico += pow($this->erros[$key], 2);

            $this->resultados_2[] = 1/(1 +  pow($this->e, -$u_2));
            $this->erros_2[] = $this->resultadoEsperado_2[$key] - $this->resultados_2[$key];
            $this->erroQuadratico += pow($this->erros_2[$key], 2);
        }
        
        return ($this->erroQuadratico/(count($this->entradas)*2))*100;
    }

    public function atualizaPesos(){
        $mse = $this->getMse();

        $this->calculaGradiente();
        
        $this->pesos_o[0][0] = $this->pesos_o[0][0] + ($this->taxaAprendizado * (-$this->gradienteCamadaOculta['X0'][0][0]));
        $this->pesos_o[0][1] = $this->pesos_o[0][1] + ($this->taxaAprendizado * (-$this->gradienteCamadaOculta['H1'][0][0]));
        $this->pesos_o[0][2] = $this->pesos_o[0][2] + ($this->taxaAprendizado * (-$this->gradienteCamadaOculta['H2'][0][0]));

        $this->delta_h1 = $this->delta_h2 = $this->delta_o1 = array();

        // while($mse > 0.01){
            
        // }
    }

    public function calculaDelta(){
        foreach($this->entradas as $key => $x){

            $derivadaFdeU = ($this->resultados[$key] * (1- $this->resultados[$key]));
            $this->delta_o1[] =  $derivadaFdeU * $this->erros[$key];

            $derivadaFdeU = ($this->resultados_2[$key] * (1- $this->resultados_2[$key]));
            $this->delta_o2[] =  $derivadaFdeU * $this->erros_2[$key];

            $derivadaFdeU = ($this->H1[$key] * (1- $this->H1[$key]));
            $this->delta_h1[] = $derivadaFdeU * $this->pesos_o[1] * $this->delta_o1[$key]; 

            $derivadaFdeU = ($this->H2[$key] * (1- $this->H2[$key]));
            $this->delta_h2[] = $derivadaFdeU * $this->pesos_o[2] * $this->delta_o1[$key]; 
        }

        $this->delta_h1_anterior = $this->delta_h1;
        $this->delta_h2_anterior = $this->delta_h2;
        $this->delta_o1_anterior = $this->delta_o1;
        $this->delta_o2_anterior = $this->delta_o2;
    }

    public function calculaGradiente(){
        $this->calculaDelta();

        foreach($this->entradas as $i => $value){
            foreach($value as $j => $x){
                $this->gradienteEntradas['H1'][$i][$j] = $x * $this->delta_h1[$i];
                $this->gradienteEntradas['H2'][$i][$j] = $x * $this->delta_h2[$i];
            }
            
            $this->gradienteCamadaOculta['X0'][0][] = $this->pesos_o[0][0] * $this->delta_o1[$i];    
            $this->gradienteCamadaOculta['H1'][0][] = $this->pesos_o[0][1] * $this->delta_o1[$i];    
            $this->gradienteCamadaOculta['H2'][0][] = $this->pesos_o[0][2] * $this->delta_o1[$i];    

            $this->gradienteCamadaOculta['X0'][1][] = $this->pesos_o[1][0] * $this->delta_o1[$i];    
            $this->gradienteCamadaOculta['H1'][1][] = $this->pesos_o[1][1] * $this->delta_o1[$i];    
            $this->gradienteCamadaOculta['H2'][1][] = $this->pesos_o[1][2] * $this->delta_o1[$i];  
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