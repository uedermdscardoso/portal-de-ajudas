<?php
	session_start();
	
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

	header('Content-type: application/json');

	$valid = false;


	if(isset($_SESSION['user']) && isset($_POST['senhaAtual'])){

		$usuario = $_SESSION['user'];
		$senhaAtual = Pessoa::criptografarSHA256($_POST['senhaAtual']);

		$pessoa = new Pessoa(); 
		$pessoaDao = new PessoaDAO();
		$pessoa = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']);

		$senhaRegistrada = $pessoa->getSenha();

		if($senhaAtual == $senhaRegistrada){
			$valid =  true;
		}
	}


	echo json_encode(array(
	    'valid' => $valid,
	));


?>