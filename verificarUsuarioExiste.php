<?php
	/***
		Este script verifica se um usuário já existe no banco. Isto para inserir um novo usuário.
	***/
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

	header('Content-type: application/json');

	$valid = true;

	if(isset($_POST['usuario'])){

		$nomeUsuario = $_POST['usuario'];

		$pessoaDao = new PessoaDAO();
		$result = $pessoaDao->verificarSeUsuarioExiste($nomeUsuario);

		if($result != 0){
			$valid = false;
		}
	}


	echo json_encode(array(
	    'valid' => $valid,
	));


?>