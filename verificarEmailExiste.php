<?php
	/***
		Este script verifica se um email já existe no banco. Inserir o novo email da pessoa.
	***/
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

	header('Content-type: application/json');

	$valid = true;

	if(isset($_POST['email'])){

		$nomeEmail = $_POST['email'];

		$pessoaDao = new PessoaDAO();
		$result = $pessoaDao->verificarSeEmailExiste($nomeEmail);

		if($result != 0){
			$valid = false;
		}
	}


	echo json_encode(array(
	    'valid' => $valid,
	));


?>