<?php 

class Proposta {
	
	private $codigo;
	private $titulo; 
	private $descricao;
	private $dataCriacao;
	private $pessoa;
	private $ajuda;

	function __construct(){

	}

	function setCodigo($codigo){
		$this->codigo = $codigo; 
	}
	function getCodigo(){
		return $this->codigo;
	}

	function setTitulo($titulo){
		$this->titulo = $titulo; 
	}
	function getTitulo(){
		return $this->titulo;
	}

	function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	function getDescricao(){
		return $this->descricao;
	}

	function setDataCriacao($dataCriacao){
		$this->dataCriacao = $dataCriacao;
	}
	function getDataCriacao(){
		return $this->dataCriacao;
	}

	function setPessoa(Pessoa $pessoa){
		$this->pessoa = $pessoa;
	}
	function getPessoa(){
		return $this->pessoa;
	}

	function setAjuda(Ajuda $ajuda){
		$this->ajuda = $ajuda;
	}
	function getAjuda(){
		return $this->ajuda;
	}

}