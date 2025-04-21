<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    //--------------------------------------

    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';


    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php';
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'; 
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php';

?>
    <div class="container">

        <div class="row">

            <div class="col-12 col-md-12 col-sm-12 text-center" style="margin-top:2em;">

                <h6>Aqui, coloca os campos correspondentes para filtrar as ajudas.</h6>

            </div>

        </div>

        <div class="row" style="margin-bottom:4em;">
        <?php

            $count = 0;
            $usuario = $_SESSION['user'];
            $codUsuario = $usuario['codigo'];

            $ajudas = new Ajuda();
            $ajudaDao = new AjudaDAO();

            $ajudas = $ajudaDao->listarAjudasDoRecenteAoMaisAntigo();

            if($ajudas != null){
                for($i=0; $i<count($ajudas); $i++){

                    //Só aparece as ajudas que estão abertas
                    if($ajudas[$i]->getStatus()->getNomeStatus() == "Aberto"){
                        $count = 1; 
        ?>                
                        <div class="col-12 col-md-4 col-sm-12" style="margin-top:1em;">

                            <div class="card text-md-center text-sm-center text-center d-inline-block" style="padding:1em; width:100%; height:100%;">

                                <?php include($_SERVER["DOCUMENT_ROOT"]."/portal-de-ajudas/conta/quadro-ajuda.php"); ?>

                            </div>

                        </div>

        <?php
                    }
                }

                if($count == 0){ //Se não tiver nenhuma ajuda aberta
        ?>
                    <div class="col-12 col-md-12 col-sm-12" style="margin-top:75px;">

                        <div class="alert alert-danger text-center">Não há ajudas abertas.</div>

                    </div>      
        <?php
                }
                
            } else {
        ?>
                <div class="col-12 col-md-12 col-sm-12" style="margin-top:75px;">

                    <div class="alert alert-danger text-center">Não há ajudas registradas.</div>

                </div>
        <?php
            }
        ?>

        </div>

    </div>

    <?php include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'; ?>

</body>
</html>