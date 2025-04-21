<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Status.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/StatusDAO.php';

	date_default_timezone_set('America/Sao_Paulo');
    session_start();


    $usuario = $_SESSION['user'];
	$pathAnexo = null;
	$titulo = $_POST['titulo'];
	$dataTermino = $_POST['dataTermino'];
	$descricao = $_POST['descricao'];
	$categorias = $_POST['categoria'];
	
	$codUsuario = $usuario['codigo'];

	$dataTermino = str_replace('/','-',$dataTermino);
	$dataTermino = date("Y-m-d", strtotime($dataTermino));

	$ajuda = new Ajuda(); 
	$ajudaDao = new AjudaDAO();

	$ajuda->setTitulo($titulo);
	$ajuda->setDataTermino($dataTermino);
	$ajuda->setDescricao($descricao);

	$dataCriacao = date('Y-m-d');
	$ajuda->setDataCriacao($dataCriacao);

	if($pathAnexo != null){
		$pathAnexo = '/portal-de-ajudas/assets/arquivos/user_'.$codUsuario.'/'.$pathAnexo;
		$ajuda->setPathAnexo($pathAnexo);
	}
	
	
	//Inserir Pessoa
	$pessoa[] = new Pessoa();
	$pessoaDao = new PessoaDAO(); 
	$pessoa = $pessoaDao->consultarPessoaPorCodigo($codUsuario);
	$ajuda->setPessoa($pessoa);

	//Inserir Status
	$status = new Status();
	$statusDao = new StatusDAO();
	$status = $statusDao->consultarStatusPeloNome('Aberto');
	$ajuda->setStatus($status);

	//Inserir Categoria
	for($i=0; $i<count($categorias); $i++){
		$categoria[$i] = new Categoria();
		$categDao = new CategoriaDAO();

		$categoria[$i] = $categDao->listarCategoriaPorNome($categorias[$i]);

		$ajuda->setCategoria($categoria);
		
	}

	//Cadastrar Ajuda
	$ajuda = $ajudaDao->inserirAjuda($ajuda);

	header('Location: /portal-de-ajudas/conta/ajudas.php');

