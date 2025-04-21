<?php
    ob_start();
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
   	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';


    $codPessoa = $_POST['codPessoa'];


    $pessoa = new Pessoa(); 
    $pessoaDao = new PessoaDAO(); 
    $pessoa = $pessoaDao->consultarPessoaPorCodigo($codPessoa);

    //Excluir Proposta

    $proposta[] = new Proposta();
    $propostaDao = new PropostaDAO();
    $proposta = $propostaDao->listarPropostasPorCodigoPessoa($pessoa->getCodigo());
    for($i=0; $i<count($proposta); $i++){
    	$propostaDao->excluirProposta($proposta[$i]->getCodigo());
    }

    //Excluir Ajuda
    
    $ajuda[] = new Ajuda(); 
    $ajudaDao = new AjudaDAO();
    $ajuda = $ajudaDao->listarAjudasPorCodigoPessoa($pessoa->getCodigo());
    for($i=0; $i<count($ajuda); $i++){
    	$ajudaDao->excluirAjuda($ajuda[$i]->getCodigo());
    } 
    

    $srcPadrao = "assets/images/fotos_perfil/padrao/man_profile.png";

    if($pessoa->getPathFotoPerfil() != $srcPadrao){
        //echo "diferente";

        $dir = $_SERVER["DOCUMENT_ROOT"]."/portal-de-ajudas/assets/images/fotos_perfil/pessoa_".$pessoa->getCodigo()."/";
        $src = $_SERVER["DOCUMENT_ROOT"]."/portal-de-ajudas/".$pessoa->getPathFotoPerfil();

        if(file_exists($src)){
            unlink($src);
        }
        
        if(is_dir($dir)){
            rmdir($dir);
        }

        //echo "dir: ".$dir."<br />";
        //echo "src: ".$src;

    } 

    //Excluir pessoa
    $pessoaDao->excluirPessoa($pessoa);

    session_destroy();

    header('Location: /portal-de-ajudas/');
    ob_end_flush(); 
?>