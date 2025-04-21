<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
	
	header('Content-type: application/json');


	$pessoas[] = new Pessoa(); 
	$pessoaDao = new PessoaDAO();

	$pessoas = $pessoaDao->listarPessoas();

	for($i=0; $i<count($pessoas); $i++){
		
		$p[$i]["id"] = $pessoas[$i]->getCodigo(); 
		$p[$i]["nomeCompleto"] = $pessoas[$i]->getNomeCompleto(); 
		$p[$i]["biografia"] = $pessoas[$i]->getBiografia();
		$p[$i]["dataNascimento"] = $pessoas[$i]->getDataNascimento();
		$p[$i]["pathFotoPerfil"] = $pessoas[$i]->getPathFotoPerfil(); 
		$p[$i]["tel_ddd"] = $pessoas[$i]->getTelDdd();
		$p[$i]["tel_numero"] = $pessoas[$i]->getTelNumero();
		$p[$i]["logradouro"] = $pessoas[$i]->getLogradouro(); 
		$p[$i]["numero"] = $pessoas[$i]->getNumero();
		$p[$i]["complemento"] = $pessoas[$i]->getComplemento();
		$p[$i]["bairro"] = $pessoas[$i]->getBairro();
		$p[$i]["estado"] = $pessoas[$i]->getEstado();
		$p[$i]["cidade"] = $pessoas[$i]->getCidade();    
		$p[$i]["pontoReferencia"] = $pessoas[$i]->getPontoReferencia();
		$p[$i]["usuario"] = $pessoas[$i]->getUsuario();
		$p[$i]["email"] = $pessoas[$i]->getEmail();
		$p[$i]["genero"] = $pessoas[$i]->getGenero()->getNomeGenero();   

	}

	
	echo json_encode($p);
	

?>