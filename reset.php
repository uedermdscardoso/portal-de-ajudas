<?php
	ob_start();
	if(!isset($_SESSION)){
		session_start(); 
	}

	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/enviarEmail.php');

	$email = "naoresponde@portaldeajudas.com.br";

	$destino = $_POST['email'];
	$assunto = "Nova Senha enviada";
	
	$pessoa = new Pessoa(); 
	$pessoaDao = new PessoaDAO();
	$pessoa = $pessoaDao->consultarPessoaPeloEmail($destino);
	
	if($pessoa->getTokenBloqueio() == null){

		$novaSenha = random_bytes(5);
		$novaSenha = bin2hex($novaSenha);
			
		if($pessoa != null){
			
			$pessoa->setSenha(Pessoa::criptografarSHA256($novaSenha));
			$pessoaDao->atualizarSenha($pessoa);
			
		}

		$msg = "
			<div style='text-align:center;'>
				<div style='color:green; background-color:lightgreen; padding:10px;'>
					<h2>Portal de Ajudas - Redefinição de senha</h2>
				</div>
				
				<div style='padding:75px;'>
					<h2>A sua nova senha é: ".$novaSenha.". </h2>
				</div>
				
				<div style='color:green; background-color:lightgreen; padding:10px;'>
					<h5>Portal de Ajudas - Desenvolvido por Lauan, Rafael e Ueder.</h5>
				</div>
			</div>
			";
		

		$titulo = "Portal de Ajudas";

		enviarEmail($titulo,$email,$destino,$assunto,$msg); 
		
		$_SESSION['success_reset_senha'] = "Nova senha foi gerada e enviada no seu email.";

	} else { //Não pode resetar a senha quando tiver bloqueado.
		$_SESSION['danger_reset_senha'] = "Desbloqueia a sua conta para que possa redefinir a sua senha.";
	}

	header('Location: /portal-de-ajudas/redefinir.php');
	ob_end_flush();
?>

	