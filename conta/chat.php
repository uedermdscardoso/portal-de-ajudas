<!-- Página do do Chat -->

<?php

    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php';
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'; 
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php';

?>

    <input type="hidden" id="codUsuario" value="<?= $usuario['codigo'] ?>" />
    

    <!--
    <div class="container">
        <div class="row">

            <div class="chat col-10 col-md-6 col-sm-12">
                <div class="title">
                    <h3><?= $usuario['usuario'] ?></h3>
                </div>
                <div id="body-msgs"></div>
                <div class="text-box col-md-12 col-sm-12">
                    <input type="text" id="text" value=""/>
                </div>
            </div>

        </div>
    </div>
    -->
    <br />
    <br />

    <div class="container">
        <div class="row">
            <div class="col-2 col-md-4 col-sm-2" style="border:1px solid black;">
                
                <?php 
                    $proposta[] = new Proposta();
                    $propostaDao = new PropostaDAO();

                    $proposta = $propostaDao->listarPropostasPorCodigoPessoa($usuario['codigo']);
                    
                    if($proposta != null){ //Não publicou a proposta
                        
                        $chatId = $proposta[0]->getChatId();
                        echo $chatId;
                ?>
                        <input type="hidden" id="chatId" value="<?= $chatId ?>" />
                <?php

                    } else {

                        $ajuda = new Ajuda(); 
                        $ajudaDao = new AjudaDAO();
                        $ajuda = $ajudaDao->listarAjudasPorCodigoPessoa($usuario['codigo']);

                        if($ajuda != 0){
                            $proposta = $propostaDao->consultarPropostasPorCodigoAjuda($ajuda[0]->getCodigo());
                ?>
                            <input type="hidden" id="chatId" value="<?= $proposta[0]->getChatId() ?>" />
                            <div style="border:1px solid black;">
                                <span><?= $proposta[0]->getCodigo() ?></span> -
                                <span><?= $proposta[0]->getTitulo() ?></span> 
                            </div>
                <?php
                        }
                    }
                    
                ?>

                <br />

            </div>
            <div class="col-8 col-md-6 col-sm-8" style="border:1px solid black;">
                <div class="title">
                    <h3><?= $usuario['usuario'] ?></h3>
                </div>
                <div id="body-msgs"></div>
                <div class="text-box col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="text" value=""/>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="/portal-de-ajudas/assets/plugins/chat/firebase.js"></script>
