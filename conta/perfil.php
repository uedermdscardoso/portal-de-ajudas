<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    //--------------------------------------

    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php';
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'; 
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php';


    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

?>

    <?php 
        $pessoa = new Pessoa();
        $pessoaDao = new PessoaDAO();

        $pessoa = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']); 

    ?>

    <div class="container" style="margin-top:1em; margin-bottom:5em;">

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                <p class="lead" style="font-size:10pt;"> Início > Conta > Perfil</p>
            </div>

        </div> 

        <div class="row">

            <div class="col-12 col-md-8 offset-md-2 col-sm-12" style="margin-top:1em;">
                
                <div class="card text-md-center text-sm-center text-center">

                    <div class="card-block" style="padding:2em; margin-top:2em; ">
                        <img class="img-thumbnail rounded-circle" src="/portal-de-ajudas/<?= $pessoa->getPathFotoPerfil() ?>" width="150px" height="auto" />

                        <h5 style="margin-top:2em; font-size:15pt;">
                            <?= $pessoa->getNomeCompleto() ?>
                        </h5>
                        
                        <hr />

                        <p><?= $pessoa->getEmail() ?></p>
                        <p>
                            <?= $pessoa->getUsuario() ?>,
                            <!--{{ \Carbon\Carbon::parse($pessoa->dataNascimento)->format('d/m/Y') }},-->
                            <?= $pessoa->getGenero()->getNomeGenero() ?>
                        </p>
                        
                        <p>
                            <?= $pessoa->getComplemento() == NULL ? $pessoa->getLogradouro() : $pessoa->getLogradouro().', '.$pessoa->getComplemento() ?>, 
                            <?= $pessoa->getNumero() ?>, 
                            <?= $pessoa->getBairro() ?>, 
                            <?= $pessoa->getCidade() ?> - 
                            <?= $pessoa->getPontoReferencia() == NULL ? $pessoa->getEstado() : $pessoa->getEstado().", ".$pessoa->getPontoReferencia() ?>
                        </p>

                        <!-- Telefone -->
                        <?php
                            echo "(".$pessoa->getTelDdd().") ".$pessoa->getTelNumero();
                        ?> 

                    </div>

                </div>

            </div>
        </div>

        <div class="row">

            <div class="col-12 col-md-8 offset-md-2 col-sm-12" style="margin-top:1em;">
                
                <div class="card text-md-center text-sm-center text-center" style="padding:1em;">

                    <div class="card-title" style="margin-top:2em;">
                        <h5>Biografia</h5>
                    </div>
                    <div class="card-block">
                        
                    <?php
                        if($pessoa->getBiografia() != null){
                    ?>
                            <div class="row text-justify" style="text-indent:4em;">
                                <div class="col-12 col-md-10 offset-md-1 col-sm-12">
                                        <p><?= $pessoa->getBiografia() ?></p>
                                </div>
                            </div>
                    <?php
                        } else {
                    ?>
                            <div class="row">
                                <div class="col-12 col-md-12 col-sm-12">
                                    <div class="alert alert-danger" role="alert">
                                        Nenhuma biografia registrada.
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>

                    </div>

                </div>

            </div>
        </div>

    </div> <!-- container --> 

    <?php include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'; ?>

</body>
</html>