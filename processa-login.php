<?php
	ob_start();
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/enviarEmail.php');

	$email = $_POST['email']; 
	$senha = Pessoa::criptografarSHA256($_POST['senha']); 

	$pessoa = new Pessoa();
	$pessoaDao = new PessoaDAO();
	$pessoa = $pessoaDao->validarLogin($email,$senha);

	session_start();


	if($pessoa != null && $pessoa->getTokenBloqueio() == null){

		$u['codigo'] = $pessoa->getCodigo();
		$u['usuario'] = $pessoa->getUsuario();
		$u['email'] = $pessoa->getEmail();
		$u['senha'] = $pessoa->getSenha();

		$_SESSION['user'] = $u;

		header('Location: conta/conta.php');

	} else {

		$p = new Pessoa(); 
		$p = $pessoaDao->consultarPessoaPeloEmail($email);
		
		if($p != null && $p->getTokenBloqueio() == null){ //Email existe e não tem token (não está bloqueado)

			$cod = $p->getCodigo();

			if(!isset($_SESSION['count_login_'.$cod])){				
				
				$e['count'] = 1;
				$_SESSION['count_login_'.$cod] = $e;
				$_SESSION['count_time'] = time() + 60;
				
				$_SESSION['errorLogin'] = true; //Exibir também quando está tentando.
			} else {

				//Até 3 tentativas de erro
				if($_SESSION['count_login_'.$cod]['count'] < 2){ 
					$_SESSION['count_login_'.$cod]['count']++;

					if($_SESSION['count_login_'.$cod]['count'] != 1){
						$_SESSION['errorLogin'] = true; //Exibir também quando está tentando.
					}
				} else {
					//Bloqueia o usuário
					
					$tokenBloqueio = $p->gerarToken();
					$aux = $pessoaDao->verificarTokenExiste($tokenBloqueio);

					if($aux == 0){ //Se não existe o token
						$tokenBloqueio = $p->gerarToken();
					} else {
						while($aux != 0){ //Enquanto existe token
							$tokenBloqueio = $p->gerarToken();
							$aux = $pessoaDao->verificarTokenExiste($tokenBloqueio);
						}
					}
					$p->setTokenBloqueio($tokenBloqueio);
					$pessoaDao->bloquearPessoa($p);

					$aux = enviarEmailLinkDesbloqueio($p->getTokenBloqueio(),$p->getEmail());

					//echo $aux;

					//Destrói as sessões que não serão mais usadas					
					unset($_SESSION["count_login_".$cod]);
					unset($_SESSION["nome_sessao_count".$cod]);

					$_SESSION['pessoaBloqueada'] = true;
				}

			}

			if(isset($_SESSION['count_login_'.$cod])){
				$_SESSION['nome_sessao_count'] = 'count_login_'.$cod;
			}


		} else if($p == null){ //Quando for inserir alguma email que não existe
			
			$_SESSION['errorLogin'] = true;

		} else if($p->getTokenBloqueio() != null){ //Quando tiver um token. Ou seja, está bloqueado
			
			$_SESSION['pessoaBloqueada'] = true;

		} else { //Email não existente

			$_SESSION['errorLogin'] = true;
			
		}
			
		header('Location: /portal-de-ajudas/login.php');

	}


	function enviarEmailLinkDesbloqueio($token,$email){

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

		return enviarEmail($titulo,$emailPortal,$destino,$assunto,$msg);

	}
	ob_end_flush(); 