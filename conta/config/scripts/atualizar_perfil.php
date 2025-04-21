<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Genero.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/GeneroDAO.php';


    //Atualizar Perfil
    
    $codPessoa = $_POST['codPessoa'];
	$nomeCompleto = $_POST['nomeCompleto'];
	$dataNascimento = $_POST['dataNascimento'];
	$gen = $_POST['genero']; 
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	$biografia = $_POST['biografia'];
	$tel_ddd = $_POST['tel_ddd'];
	$tel_numero = $_POST['tel_numero'];

	$pessoa = new Pessoa(); 
	$pessoaDao = new PessoaDAO();
	$pessoa->setCodigo($codPessoa);
	$pessoa->setNomeCompleto($nomeCompleto);

	if($_FILES['pathFotoPerfil']['name'] != false){
		$name = pathinfo($_FILES['pathFotoPerfil']['name']);

		$src = "assets/images/fotos_perfil";
		
		$caminho = $_SERVER["DOCUMENT_ROOT"]."/portal-de-ajudas/".$src;
		$name_img = "pessoa_".$codPessoa;
		$caminho = $caminho."/".$name_img;
		$src = $src."/".$name_img;

		if(!is_dir($caminho)){
			mkdir($caminho,0777,true);
		} 

		$src = $src."/".$name_img.'.'.$name['extension'];
		$uploaddir = $caminho;
		$uploadfile = $uploaddir."/".$name_img.'.'.$name['extension'];

		//Para pegar url da foto antiga e a excluir para gravar outro foto
		$pes = new Pessoa(); 
		$pes = $pessoaDao->consultarPessoaPorCodigo($pessoa->getCodigo());
		$urlAntigo = $_SERVER["DOCUMENT_ROOT"]."/portal-de-ajudas/".$pes->getPathFotoPerfil();
		if(file_exists($urlAntigo)){
			//echo "já existe: ".$urlAntigo;
			unlink($urlAntigo);
		} 

		move_uploaded_file($_FILES['pathFotoPerfil']['tmp_name'], $uploadfile);

		$pessoa->setPathFotoPerfil($src);
	} 

	$dataNascimento = str_replace('/','-',$dataNascimento);
	$dataNascimento = date("Y-m-d", strtotime($dataNascimento));
	$pessoa->setDataNascimento($dataNascimento);
	
	$genero = new Genero();
	$generoDao = new GeneroDAO(); 
	$genero = $generoDao->consultarGeneroPeloNome($gen);
	$pessoa->setGenero($genero);

	$pessoa->setEmail($email);
	$pessoa->setUsuario($usuario);
	$pessoa->setTelDdd($tel_ddd);
	$pessoa->setTelNumero($tel_numero);
	if($biografia != null){
		$pessoa->setBiografia($biografia);
	}

	
	$pessoaDao->atualizarPerfil($pessoa);
	if($_FILES['pathFotoPerfil']['name'] != false){
		$pessoaDao->atualizarPathFotoPerfil($pessoa);
	}
	

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	