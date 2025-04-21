<!-- Configuração do Usuário -->
<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];


    include('../../header.php'); 
    include('../../nav-principal.php'); 
    include('../nav-conta.php');


?>

    <div class="container" style="margin-top:1em; margin-bottom:5em;">

        <div class="row">

            <div class="col-12 col-md-12 col-sm-12 text-left">
                <p class="lead" style="font-size:10pt;">Início > Conta > Configurações > Dados Pessoais</p>
            </div>

        </div>


        <div class="row">
            
            <div class="col-12 col-md-2 col-sm-12" style="padding-top:2.5em;">
                
                <ul class="nav flex-column text-center">

                    <a href="config/perfil.php">
                        <li class="nav-item border" style="padding:0.5em; margin-bottom:0.5em; cursor:pointer;">
                            <span>Dados Pessoais</span>
                        </li>
                    </a>
                    <a href="endereco.php">
                        <li class="nav-item border" style="padding:0.5em; margin-bottom:0.5em; cursor:pointer;">
                            <span>Endereço</span>
                        </li>
                    </a>
                    <a href="senha.php">
                        <li class="nav-item border" style="padding:0.5em; margin-bottom:0.5em; cursor:pointer;">
                            <span>Senha</span>
                        </li>
                    </a>
                        
                </ul>

            </div>  

            <div class="col-12 col-md-8 col-sm-12 border" id="conteudo-config" style="padding:2.5em;">
               
               <!-- Exibe o formulário para atualização dos dados pessoais -->
                <?php include('edit-perfil.php'); ?>

                <hr />
                <br />

                <div class="row">
                    <div class="col-12 col-md-4 offset-md-4 col-sm-12" style="padding:2.5em;">

                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#excluirConta" style="width:8em;">Excluir Conta</button>

                    </div>
                </div>
            </div>



        </div>

    </div> <!-- Container -->

    <?php 
        include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'; 

        //Modal Excluir Conta
        include('modal-excluir-conta.php');
    ?>


