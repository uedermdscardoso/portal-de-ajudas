<?php
	//Fechar Ajuda
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
	$status = $statusDao->consultarStatusPeloNome("Fechado");

	if(isset($_POST['codAjuda'])){
		
		$codAjuda = $_POST['codAjuda'];

		$ajuda = new Ajuda(); 
		$ajudaDao = new AjudaDAO();
		$ajuda = $ajudaDao->consultarAjudaPorCodigo($codAjuda);
		$ajuda->setStatus($status);
		$ajudaDao->atualizarStatusAjuda($ajuda);

	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	ob_end_flush(); 
?>