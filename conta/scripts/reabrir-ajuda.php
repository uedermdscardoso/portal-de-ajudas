<?php
	//Reabrir Ajuda
	ob_start();
	session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Status.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/StatusDAO.php';

	$status = new Status();
	$statusDao = new StatusDAO();
	$status = $statusDao->consultarStatusPeloNome("Aberto");

	if(isset($_POST['codAjuda'])){
		
		$codAjuda = $_POST['codAjuda'];

		$ajuda = new Ajuda(); 
		$ajudaDao = new AjudaDAO();
		$ajuda = $ajudaDao->consultarAjudaPorCodigo($codAjuda);
		$ajuda->setStatus($status);

		//Verificar a dataTermino e a data atual
		$dataAtual = date('Y-m-d');

		if($dataAtual < $ajuda->getDataTermino()){
			$ajudaDao->atualizarStatusAjuda($ajuda);
		} else {
			$_SESSION['data_antig'] = true;
		}


	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	ob_end_flush(); 
?>