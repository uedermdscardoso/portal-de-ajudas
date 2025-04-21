<?php
	ob_start();
	//CONTATO
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/enviarEmail.php');

	$email = $_POST['email'];
	$nome = $_POST['nome'];
	$mensagem = $_POST['mensagem']; 

	$destino = "portaldeajudas@gmail.com";
	$assunto = "Mensagem de ".$nome;

	$msg = "
		<div style='text-align:center;'>
			<div style='color:green; background-color:lightgreen; padding:10px;'>
				<h2>Mensagem de ".$nome." <".$email."></h2>
			</div>
			
			<div style='padding:75px;'>
				<h2>Mensagem: ".$mensagem.". </h2>
			</div>
			
			<div style='color:green; background-color:lightgreen; padding:10px;'>
				<h5>Portal de Ajudas - Desenvolvido por Lauan, Rafael e Ueder.</h5>
			</div>
		</div>
		";

	$titulo = $nome;
	$msgRetorno = "Agradecemos pelo seu contato!";


	enviarEmail($titulo,$email,$destino,$assunto,$msg,$msgRetorno); 
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	ob_end_flush(); 

?>