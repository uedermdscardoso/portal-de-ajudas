<!-- Página do do Chat -->

<?php

    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 


    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php';
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'; 
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php';

?>

    <input type="hidden" id="chatId" value="<?= isset($_GET['chatId']) ? $_GET['chatId'] : ''  ?>" />
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
            <div class="col-12 col-md-4 offset-md-2 col-sm-12" style="border:1px solid black;">
               <div class="row">
                    <div class="col-12 col-md-3 col-sm-12">
                        <input type="button" class="btn btn-success" href="#" onclick="carregar('minhas-ajudas.php')" value="Minhas Ajudas" />
                    </div>
               </div>
               <div class="row">
                    <div class="col-12 col-md-4 col-sm-12">
                        <input type="button" class="btn btn-success" onclick="carregar('minhas-propostas.php')" value="Minhas Propostas" />
                    </div>
               </div>
               <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div id="sidebar_chat"></div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                $('#sidebar_chat').load('minhas-ajudas.php');

                function carregar(pagina){
                    $('#sidebar_chat').load(pagina);
                }
            
            </script>

            <div class="col-12 col-md-4 col-sm-12" style="border:1px solid black;">
                <div class="title">
                    <h3><?= isset($_GET['user']) ? $_GET['user'] : 'Indisponível' ?></h3>
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
