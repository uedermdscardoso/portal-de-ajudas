<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

	$codPessoa = $_POST['codPessoa'];
	$novaSenha = Pessoa::criptografarSHA256($_POST['novaSenha']);


	$pessoa = new Pessoa(); 
	$pessoaDao = new PessoaDAO();
	$pessoa->setCodigo($codPessoa);
	$pessoa->setSenha($novaSenha);

	$pessoa = $pessoaDao->atualizarSenha($pessoa);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
