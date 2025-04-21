<?php 

class Categoria {
	
	private $codigo;
	private $nomeCategoria;

	function __construct(){

	}

	function setCodigo($codigo){
		$this->codigo = $codigo; 
	}
	function getCodigo(){
		return $this->codigo;
	}

	function setNomeCategoria($nomeCategoria){
		$this->nomeCategoria = $nomeCategoria;
	}
	function getNomeCategoria(){
		return $this->nomeCategoria;
	}

}