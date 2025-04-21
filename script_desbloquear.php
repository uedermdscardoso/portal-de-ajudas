<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start(); 
	}

	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/enviarEmail.php');

	if(isset($_GET['token'])){ //Aqui, desbloqueia. Seta nulo no token

		$token = $_GET['token']; 

		$p = new Pessoa(); 
		$pDao = new PessoaDAO();
		$p = $pDao->consultarPessoaPeloToken($token);
		
		if($p != null){
			$pDao->desbloquearPessoa($p);

			header('Location: /portal-de-ajudas/desbloqueado.php');
		}

	} else {

		if(isset($_POST['email'])){

			$email = $_POST['email'];

			$p = new Pessoa(); 
			$pDao = new PessoaDAO();
			$p = $pDao->consultarPessoaPeloEmail($email);

			if($p != null){

				if($p->getTokenBloqueio() != null){

					//Enviar um link com token no email para desbloquear
					$token = $p->getTokenBloqueio();

					$emailPortal = "naoresponde@portaldeajudas.com.br";
					$destino = $email;
					$assunto = "Desbloqueio da Conta";
					$titulo = "Portal de Ajudas";
					$msg = "
						<div style='text-align:center;'>
							<div style='color:green; background-color:lightgreen; padding:10px;'>
								<h2>Portal de Ajudas - Link de Desbloqueio</h2>
							</div>
							
							<div style='padding:75px;'>
								<h2><a href='/portal-de-ajudas/script_desbloquear.php?token=".$token."'>Desbloquear</a></h2>
							</div>
							
							<div style='color:green; background-color:lightgreen; padding:10px;'>
								<h5>Portal de Ajudas - Desenvolvido por Lauan, Rafael e Ueder.</h5>
							</div>
						</div>
						";

					enviarEmail($titulo,$emailPortal,$destino,$assunto,$msg);

					$_SESSION['success_desbloqueio'] = "O link de desbloqueio foi enviado no seu email.";

				} else {
					$_SESSION['danger_desbloqueio'] = "A sua conta não está bloqueado.";
				}

				header('Location: /portal-de-ajudas/desbloquear.php');

			}
		}

	}
	ob_end_flush();

?>