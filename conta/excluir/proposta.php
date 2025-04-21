<?php
    ob_start();
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];


    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';


    //início - Código

	if(isset($_GET['cod'])){

		$codProposta = $_GET['cod'];

		$propostaDao = new PropostaDAO();
		$propostaDao->excluirProposta($codProposta);

	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
    ob_end_flush(); 
?>