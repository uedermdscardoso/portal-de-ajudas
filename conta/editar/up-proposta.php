<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];


    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';


	//início - Código

	if(isset($_GET['cod'])){

		$codProposta = $_GET['cod'];

		$proposta = new Proposta();
		$propostaDao = new PropostaDAO();

		$proposta = $propostaDao->consultarPropostaPorCodigo($codProposta);
		$proposta->setTitulo($_POST['titulo']);
		$proposta->setDescricao($_POST['descricao']);

		$propostaDao->atualizarProposta($proposta);

		header('Location: /portal-de-ajudas/conta/ajuda/propostas.php?codAjuda='.$proposta->getAjuda()->getCodigo());
	} else {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}


?>