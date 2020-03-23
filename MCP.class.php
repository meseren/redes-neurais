<?php

class MCP{
	private $w;
	private $limiar;

	public function __construct($w, $limiar){
		$this->limiar = $limiar;

		for($i=0;$i<count($w);$i++)
			$this->w[$i] = $w[$i];
	}

	public function Y($x){
		if($this->soma($x) >= $this->limiar)
			return 1;

		return 0;
	}

	private function soma($x){
		$soma = 0;
		
		for ($i=0; $i<count($this->w); $i++)
			$soma += $x[$i]*$this->w[$i];

		return $soma;
	}
}

?>