<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

    $codPessoa = $_POST['codPessoa'];
	$logradouro = $_POST['logradouro']; 
	$numero = $_POST['numero']; 
	$complemento = $_POST['complemento']; 
	$bairro = $_POST['bairro']; 
	$cidade = $_POST['cidade']; 
	$uf = $_POST['estado'];
	$pontoReferencia = $_POST['pontoReferencia'];

	
	$pessoa = new Pessoa();
	$pessoaDao = new PessoaDAO();
	$pessoa->setCodigo($codPessoa);
	$pessoa->setLogradouro($logradouro);
	$pessoa->setNumero($numero);
	$pessoa->setComplemento($complemento);
	$pessoa->setBairro($bairro);
	$pessoa->setCidade($cidade);
	$pessoa->setEstado($uf);

	if($pontoReferencia != null){
		$pessoa->setPontoReferencia($pontoReferencia);
	}

	$pessoaDao->atualizarEndereco($pessoa);

	header('Location: ' . $_SERVER['HTTP_REFERER']);