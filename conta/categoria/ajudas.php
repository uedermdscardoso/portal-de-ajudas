<?php
	//Exibir as ajudas de uma determinada categoria
	session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

	//$_GET['codCateg'];


?>