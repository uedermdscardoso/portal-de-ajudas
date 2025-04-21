<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];


    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';

    //início - Código

    if(isset($_GET['cod'])){

        $codAjuda = $_GET['cod']; 

        $ajuda = new Ajuda();
        $ajudaDao = new AjudaDAO();
        
        $dataTermino = str_replace('/','-',$_POST['dataTermino']);
        $dataTermino = date("Y-m-d", strtotime($dataTermino));

        $ajuda = $ajudaDao->consultarAjudaPorCodigo($codAjuda);
        $ajuda->setTitulo($_POST['titulo']);
        $ajuda->setDataTermino($dataTermino);
        $ajuda->setDescricao($_POST['descricao']);

        $c = $_POST['categoria'];
        for($i=0; $i<count($c); $i++){
            $categoria[$i] = new Categoria();
            $categoriaDao = new CategoriaDAO();

            $codCategoria = $categoriaDao->retornarCodigoCategoriaPorNome($_POST['categoria'][$i]);

            $categoria[$i]->setCodigo($codCategoria);
            $categoria[$i]->setNomeCategoria($_POST['categoria'][$i]);
           
        
        }
        $ajuda->setCategoria($categoria);

        $ajudaDao->atualizarAjuda($ajuda);

        header('Location: /portal-de-ajudas/conta/ajuda/propostas.php?codAjuda='.$ajuda->getCodigo());

    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

?>