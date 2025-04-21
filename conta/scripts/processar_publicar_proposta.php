<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';

	session_start();

	$titulo = $_POST['titulo']; 
	$descricao = $_POST['descricao'];
	
	if(isset($_SESSION['user'])){

		$usuario = $_SESSION['user'];

		$proposta[] = new Proposta();
		$propostaDao = new PropostaDAO();

		$proposta = $propostaDao->listarPropostasPorCodigoPessoa($usuario['codigo']);


		if(isset($_POST['codAjuda'])){
			
			$codAjuda = $_POST['codAjuda'];

			$chave = false;
			
			if($proposta != null){
				$tam = count($proposta); 
			} else {
				$tam = 0;
			}

			//Verificar  se há tem uma proposta registrada na ajuda
			if($tam > 0){
				for($i=0; $i<$tam; $i++){
					if($proposta[$i]->getAjuda()->getCodigo() == $codAjuda){
						
						$_SESSION['so_uma_prop'] = true;
						$chave = false;
						
						break;

					} else {
						$chave = true;
					}
				}
			} else {
				$chave = true;
			}

			if($chave == true){

				$proposta = new Proposta();
				$ajuda = new Ajuda();
				$pessoa = new Pessoa();
				$propostaDao = new PropostaDAO();

				$proposta->setTitulo($titulo);
				$proposta->setDescricao($descricao);

				$dataCriacao = date('Y-m-d');
				$proposta->setDataCriacao($dataCriacao);
				
				$ajuda->setCodigo($codAjuda);
				$pessoa->setCodigo($usuario['codigo']);

				$proposta->setPessoa($pessoa);
				$proposta->setAjuda($ajuda);


				$propostaDao->inserirProposta($proposta);
				
			}
			
			header('Location: ' . $_SERVER['HTTP_REFERER']);

		} 

		
	}


?>