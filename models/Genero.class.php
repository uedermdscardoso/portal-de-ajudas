<?php 

class Genero {
	
	private $codigo;
	private $nomeGenero;

	function __construct(){

	}

	function setCodigo($codigo){
		$this->codigo = $codigo; 
	}
	function getCodigo(){
		return $this->codigo;
	}

	function setNomeGenero($nomeGenero){
		$this->nomeGenero = $nomeGenero;
	}
	function getNomeGenero(){
		return $this->nomeGenero;
	}

}