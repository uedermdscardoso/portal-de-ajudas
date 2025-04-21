<?php

class Pessoa {
	
	private $codigo; 
	private $nomeCompleto;
	private $biografia;
	private $dataNascimento;
	private $pathFotoPerfil;
	private $genero;
	private $telDdd;
	private $telNumero;

	private $usuario; 
	private $email; 
	private $senha;
	
	private $logradouro; 
	private $numero; 
	private $complemento; 
	private $bairro;
	private $estado; 
	private $cidade; 
	private $pontoReferencia; 

	private $tokenBloqueio;

	function __construct(){

	}

	function setCodigo($codigo){
		$this->codigo = $codigo; 
	}
	function getCodigo(){
		return $this->codigo;
	}

	function setNomeCompleto($nomeCompleto){
		$this->nomeCompleto = $nomeCompleto; 
	}
	function getNomeCompleto(){
		return $this->nomeCompleto;
	}

	function setBiografia($biografia){
		$this->biografia = $biografia; 
	}
	function getBiografia(){
		return $this->biografia;
	}

	function setDataNascimento($dataNascimento){
		$this->dataNascimento = $dataNascimento;
	}
	function getDataNascimento(){
		return $this->dataNascimento;
	}

	function setPathFotoPerfil($pathFotoPerfil){
		$this->pathFotoPerfil = $pathFotoPerfil;
	}
	function getPathFotoPerfil(){
		return $this->pathFotoPerfil;
	}

	function setGenero($genero){
		$this->genero = $genero;
	}
	function getGenero(){
		return $this->genero;
	}

	function setTelDdd($telDdd){
		$this->telDdd = $telDdd;
	}
	function getTelDdd(){
		return $this->telDdd;
	}
	
	function setTelNumero($telNumero){
		$this->telNumero = $telNumero;
	}
	function getTelNumero(){
		return $this->telNumero;
	}
	
	
	function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	function getUsuario(){
		return $this->usuario;
	}

	function setEmail($email){
		$this->email = $email;
	}
	function getEmail(){
		return $this->email;
	}

	function setSenha($senha){
		$this->senha = $senha;
	}
	function getSenha(){
		return $this->senha;
	}

	function setLogradouro($logradouro){
		$this->logradouro = $logradouro;
	}
	function getLogradouro(){
		return $this->logradouro;
	}

	function setNumero($numero){
		$this->numero = $numero;
	}
	function getNumero(){
		return $this->numero;
	}

	function setComplemento($complemento){
		$this->complemento = $complemento;
	}
	function getComplemento(){
		return $this->complemento;
	}

	function setBairro($bairro){
		$this->bairro = $bairro;
	}
	function getBairro(){
		return $this->bairro;
	}

	function setEstado($estado){
		$this->estado = $estado;
	}
	function getEstado(){
		return $this->estado;
	}

	function setCidade($cidade){
		$this->cidade = $cidade;
	}
	function getCidade(){
		return $this->cidade;
	}

	function setPontoReferencia($pontoReferencia){
		$this->pontoReferencia = $pontoReferencia;
	}
	function getPontoReferencia(){
		return $this->pontoReferencia;
	}
	
	function setTokenBloqueio($tokenBloqueio){
		$this->tokenBloqueio = $tokenBloqueio;
	}
	function getTokenBloqueio(){
		return $this->tokenBloqueio;
	}

	

	public static function criptografarSHA256($senha){
		return hash('sha256',$senha);
	}

	public static function gerarToken(){
		$numero_de_bytes = 25;

		$result = random_bytes($numero_de_bytes);
		$result = bin2hex($result);

		return $result;
	}
	
}