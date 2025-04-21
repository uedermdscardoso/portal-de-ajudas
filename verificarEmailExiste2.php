<?php
	/***
		Este script verifica se um email já existe no banco exceto o email da pessoa logada.
		Isto para atualizar o email da pessoa.
	***/
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

	header('Content-type: application/json');

	session_start();

	$valid = false;

	if(isset($_SESSION['user']) && isset($_POST['email'])){

		$usuario = $_SESSION['user'];
		$nomeEmailNovo = $_POST['email'];

		$pessoa = new Pessoa();
		$pessoaDao = new PessoaDAO();

		$pessoa = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']);
		$nomeEmailRegistrado = $pessoa->getEmail();

		if($nomeEmailNovo != $nomeEmailRegistrado){

			$result = $pessoaDao->verificarSeEmailExiste($nomeEmailNovo);

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