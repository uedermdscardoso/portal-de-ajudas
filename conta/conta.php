<?php

	if(!isset($_SESSION)){
		session_start();
	}

	if(!isset($_SESSION['user'])){
		header('Location: /portal-de-ajudas/login.php');
	} 

	$usuario = $_SESSION['user'];

    //-------------------------------------

    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

    //--------------------------------

    include('../header.php'); 
    include('../nav-principal.php'); 
    include('nav-conta.php');


?>
	    <!-- Aqui, começa o conteúdo -->
    <div class="container" style="margin-top:1em; margin-bottom:7em;">
    
        <div class="row">
            <div class="col-12 col-md-12 col-sm-12 text-left">
                <p class="lead" style="font-size:10pt;">/ conta</p>
            </div>
        </div>

    <?php
        if(isset($_SESSION['data_antig']) && $_SESSION['data_antig'] == true){
    ?>
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                    <div class="alert alert-danger text-center">
                        Atualize a data para que possa reabrir a ajuda.
                    </div>
                </div>
            </div>
    <?php
            unset($_SESSION['data_antig']);
        }
    ?>

        <div class="row justify-content-center">

            <div class="col-12 col-md-2 col-sm-12 text-center border" style="padding:1em; margin-right:0.5em;">

                <p><?php $usuario['usuario'] ?></p>

                <!-- Aqui pega o path da imagem do login seja padrão ou definido pelo usuário de acordo com o usuário da sessão -->
                <?php
                    $pessoa = new Pessoa();
                    $pessoaDao = new PessoaDAO();

                    $pessoa = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']);
                ?>
                <p><?= $pessoa->getNomeCompleto() ?></p>
                <p>
                    <img src="/portal-de-ajudas/<?= $pessoa->getPathFotoPerfil() ?>" width="100px" height="auto" />
                </p>

            </div>

            <div class="col-12 col-md-9 col-sm-12 border" style="padding:1em; margin-right:0.5em;">
                <?php
                    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/minhas-ajudas.php';
                    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/minhas-propostas.php';
                ?>
            </div>

        </div>
    </div>   
    
    <?php 
    	include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'; 
    ?>
 
</body>
</html>



