<?php 

class Ajuda {
	
	private $codigo;
	private $titulo; 
	private $descricao;
	private $pathAnexo;
	private $dataCriacao; 
	private $dataTermino;
	private $categoria; 
	private $status;
	private $pessoa;

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

	function setPathAnexo($pathAnexo){
		$this->pathAnexo = $pathAnexo;
	}
	function getPathAnexo(){
		return $this->pathAnexo;
	}

	function setDataCriacao($dataCriacao){
		$this->dataCriacao = $dataCriacao;
	}
	function getDataCriacao(){
		return $this->dataCriacao;
	}

	function setDataTermino($dataTermino){
		$this->dataTermino = $dataTermino;
	}
	function getDataTermino(){
		return $this->dataTermino;
	}

	function setCategoria($categoria){
		$this->categoria = $categoria;
	}
	function getCategoria(){
		return $this->categoria;
	}

	function setStatus($status){
		$this->status = $status;
	}
	function getStatus(){
		return $this->status;
	}

	function setPessoa($pessoa){
		$this->pessoa = $pessoa;
	}
	function getPessoa(){
		return $this->pessoa;
	}
	

    static function mudarFormatoParaBR($data){
        $data = str_replace('/','-',$data);
        $data = date("d/m/Y", strtotime($data));
        return $data;
    }


}