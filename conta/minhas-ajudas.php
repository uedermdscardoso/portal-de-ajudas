    
<?php

    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

    //Pegando todas as categorias
    $categorias = new Categoria();
    $categoriaDao = new CategoriaDAO();

    $categorias = $categoriaDao->listarCategorias();

    $categ_todas = [];
    for($i=0; $i<count($categorias); $i++){
        $nomeCategoria = $categorias[$i]->getNomeCategoria();
        $categ_todas[$nomeCategoria] = $nomeCategoria;
    }

?>

    <!-- EXIBE AS AJUDAS que uma pessoa publicou-->
    <div class="row">

        <div class="col-12 col-md-12 col-sm-12" style="margin-top:1em;">
            
            <div class="card text-md-center text-sm-center text-center" style="padding:1em;">

                <div class="card-title" style="margin-top:2em;">
                    <h5>Minhas ajudas</h5>
                </div>
                
                <div class="card-block">
                    
                <?php
                        $usuario = $_SESSION['user'];
                        $codUsuario = $usuario['codigo'];

                        $ajudas[] = new Ajuda();
                        $ajudaDao = new AjudaDAO();

                        $ajudas = $ajudaDao->listarAjudasPorCodigoPessoa($codUsuario);
                    
                    if($ajudas != null){
                ?>
                        <div class="row">
                        <?php
                            for($i=0;$i<count($ajudas);$i++){ 
                        ?>                                        
                                <div class="col-md-6 col-sm-12 col-12 d-inline-block" style="margin-top:1em;">
                                    
                                    <div class="card" style="padding:1em; ">
                                        <?php include($_SERVER["DOCUMENT_ROOT"]."/portal-de-ajudas/conta/quadro-ajuda.php"); ?>
                                    </div>

                                </div>

                        <?php
                            }
                        ?>
                        </div>

                <?php
                    } else {
                ?>
                        <div class="row">
                            <div class="col-12 col-md-12 col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    Não há ajudas publicadas.
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

