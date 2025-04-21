<?php
	/***
		Este script verifica se um usuário já existe no banco exceto o usuário da pessoa logada.
		Isto para atualizar o nome do usuário.
	***/
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

	header('Content-type: application/json');

	session_start();

	$valid = false;

	if(isset($_SESSION['user']) && isset($_POST['usuario'])){

		$usuario = $_SESSION['user'];
		$nomeUsuarioNovo = $_POST['usuario'];

		$pessoa = new Pessoa();
		$pessoaDao = new PessoaDAO();

		$pessoa = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']);
		$nomeUsuarioRegistrado = $pessoa->getUsuario();

		if($nomeUsuarioNovo != $nomeUsuarioRegistrado){

			$result = $pessoaDao->verificarSeUsuarioExiste($nomeUsuarioNovo);

			if($result == 0){
				$valid = true;
			} 

		} else {
			$valid = true;
		}

	} 

	echo json_encode(array(
	    'valid' => $valid,
	));


?>