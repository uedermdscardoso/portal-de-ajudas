<?php 

class Status {
	
	private $codigo;
	private $nomeStatus; 

	function __construct(){

	}

	function setCodigo($codigo){
		$this->codigo = $codigo; 
	}
	function getCodigo(){
		return $this->codigo;
	}

	function setNomeStatus($nomeStatus){
		$this->nomeStatus = $nomeStatus;
	}
	function getNomeStatus(){
		return $this->nomeStatus;
	}

}