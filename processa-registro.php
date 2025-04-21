<?php
	ob_start();
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Genero.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/GeneroDAO.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php');

	$nomeCompleto = $_POST['nomeCompleto'];

	$dataNascimento = $_POST['dataNascimento'];
    $dataNascimento = date("Y-m-d", strtotime($dataNascimento));

	if(isset($_POST['genero'])){
		$gen = $_POST['genero']; 
	}

	$telDdd = $_POST['tel_ddd'];
	$telNumero = $_POST['tel_numero'];

	$endereco = array($_POST['logradouro'], 
				 $_POST['numero'],
				 $_POST['complemento'],
				 $_POST['bairro'],
				 $_POST['estado'],
				 $_POST['cidade'],
				 $_POST['pontoReferencia']
				);

	$email = $_POST['email']; 
	$usuario = $_POST['usuario']; 

	$senha = $_POST['senha']; 
	$senha = Pessoa::criptografarSHA256($senha);
	$confirmarSenha = $_POST['confirmarSenha'];


	$confirmarSenha = Pessoa::criptografarSHA256($confirmarSenha);

	if($senha == $confirmarSenha){
		
		//Preenche e insere
		preencher($nomeCompleto,$dataNascimento,$gen,$telDdd,$telNumero,$endereco,$email,$usuario,$senha,$confirmarSenha);

	} //Verificando se a senha é equivalente ao confirmar senha



	function preencher($nomeCompleto,$dataNascimento,$gen,$telDdd,$telNumero,$endereco,$email,$usuario,$senha,$confirmarSenha){

		$pessoa = new Pessoa();
		$pessoa->setNomeCompleto($nomeCompleto);
		$pessoa->setDataNascimento($dataNascimento);
		if($gen == 'Feminino'){
			$pessoa->setPathFotoPerfil('assets/images/fotos_perfil/padrao/woman_profile.png');
		} else {
			$pessoa->setPathFotoPerfil('assets/images/fotos_perfil/padrao/man_profile.png');
		}

		$genero = new Genero();
		$generoDao = new GeneroDAO();
		$genero = $generoDao->consultarGeneroPeloNome($gen);
		$pessoa->setGenero($genero);

		$pessoa->setTelDdd($telDdd);
		$pessoa->setTelNumero($telNumero);
	    
	    $pessoa->setLogradouro($endereco[0]);
	    $pessoa->setNumero($endereco[1]);
	    $pessoa->setComplemento($endereco[2]);
	    $pessoa->setBairro($endereco[3]);
	    $pessoa->setEstado($endereco[4]);
	    $pessoa->setCidade($endereco[5]);
	    $pessoa->setPontoReferencia($endereco[6]);

		$pessoa->setUsuario($usuario);
		$pessoa->setEmail($email);
		if($senha == $confirmarSenha){
			$pessoa->setSenha($senha);
		}

		$pessoaDao = new PessoaDAO();
		$pessoaDao->inserirDadosBasicosPessoa($pessoa);

		header('Location: /portal-de-ajudas/conta/conta.php');

	}
	ob_end_flush(); 
?>