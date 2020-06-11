<?php 
class RedeNeural{  

    private $pesos;
    private $e = 2.7183;

    public function __construct($pesos) {
        $this->pesos = $pesos;
    }

    public function Y($neuronio, $entrada){
        $u = $this->pesos[$neuronio][0];

        for ($i=0; $i < count($entrada); $i++) { 
            $u += $entrada[$i] * $this->pesos[$neuronio][$i+1];
        }

        return 1/(1 +  pow($this->e, -$u));
    }

    public function MLP($entrada){
        $H1 = $this->Y(0, $entrada);
        $H2 = $this->Y(1, $entrada);
        $O1 = $this->Y(2, [$H1, $H2]);
        $O2 = $this->Y(3, [$H1, $H2]);

        return [$O1,$O2,$H1,$H2];
    }

    public function MSE($padroes, $resultados_esperados){
        $s = 0;

        for ($i=0; $i<count($padroes); $i++) { 
            $Ys = $this->MLP($padroes[$i]);
            $EO1 = pow(($resultados_esperados[$i][0] - $Ys[0]), 2);
            $EO2 = pow(($resultados_esperados[$i][1] - $Ys[1]), 2);
            $s += $EO1 + $EO2;
        }

        return ($s/(count($padroes)*2))*100;
    }

    public function treinar($padroes, $resultados_esperados, $eta, $alpha){
        
        $dp[0] = [[0, 0, 0],[0, 0, 0],[0, 0, 0],[0, 0, 0]];
        $dp[1] = [[0, 0, 0],[0, 0, 0],[0, 0, 0],[0, 0, 0]];
        $dp[2] = [[0, 0, 0],[0, 0, 0],[0, 0, 0],[0, 0, 0]];
        $dp[3] = [[0, 0, 0],[0, 0, 0],[0, 0, 0],[0, 0, 0]];

        $cont = 0;

        while(($this->MSE($padroes, $resultados_esperados)>0.01) && ($cont < 100000)){

            for ($i=0; $i<count($padroes); $i++) { 
                $Ys = $this->MLP($padroes[$i]);

                $D = $this->deltas($Ys, $resultados_esperados[$i]);

                $g = $this->gradientes($Ys, $padroes[$i], $D);

                $do[$i] = $dp[$i];

                $dp[$i] = $this->deslocamento($g, $do[$i], $eta, $alpha);

                $this->atualiza_pesos($dp[$i]);
            }

            $cont++;
        }
    }

    public function deltas($Ys, $resultados_desejados){
        $E1 = $resultados_desejados[0] - $Ys[0];
        $deltaO1 = $E1 * ($Ys[0] * (1 - $Ys[0]));

        $E2 = $resultados_desejados[1] - $Ys[1];
        $deltaO2 = $E2 * ($Ys[1] * (1 - $Ys[1]));

        $deltaH1 =  ($Ys[2] * (1 - $Ys[2] )) * (($this->pesos[2][1] * $deltaO1) + ($this->pesos[3][1] * $deltaO2));
        $deltaH2 =  ($Ys[3] * (1 - $Ys[3] )) * (($this->pesos[2][2] * $deltaO1) + ($this->pesos[3][2] * $deltaO2));

        return [$deltaO1, $deltaO2, $deltaH1, $deltaH2];
    }

    public function gradientes($Ys, $entrada, $D) {

        $gh10 = $D[2];
        $gh11 = $entrada[0]*$D[2];
        $gh12 = $entrada[1]*$D[2];
        
        $gh20 = $D[3];
        $gh21 = $entrada[0]*$D[3];
        $gh22 = $entrada[1]*$D[3];

        $go10 = $D[0];
        $go11 = $Ys[2]*$D[0];
        $go12 = $Ys[3]*$D[0];

        $go20 = $D[1];
        $go21 = $Ys[2]*$D[1];
        $go22 = $Ys[3]*$D[1];

        return [[$gh10, $gh11, $gh12],
                [$gh20, $gh21, $gh22],
                [$go10, $go11, $go12],
                [$go20, $go21, $go22]];
    }

    public function deslocamento($g, $do, $eta, $alpha){
        for ($i=0; $i<count($g); $i++) { 
            for ($j=0; $j<count($g[$i]); $j++) { 
                $deslocamento[$i][$j] = $eta*$g[$i][$j]+$alpha*$do[$i][$j];
            }
        }

        return $deslocamento;
    }

    public function atualiza_pesos($dp){
        for ($i=0; $i<count($dp); $i++) {
            for ($j=0; $j <count($dp[$i]) ; $j++) { 
                $this->pesos[$i][$j] += $dp[$i][$j];
            }
        }
    }
}
?>