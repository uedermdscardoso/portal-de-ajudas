<?php
    $ajuda = new Ajuda();
    $ajudaDao = new AjudaDAO();

    $ajuda = $ajudaDao->listarAjudasDoRecenteAoMaisAntigo();

    for($i=0;$i<count($ajuda);$i++){

?>
        <div class="col-12 col-md-4 col-sm-12" style="margin-bottom:1em;">

            <div class="card text-center" style="padding:1em;">

                <p>
                    <img src="/portal-de-ajudas/<?= $ajuda[$i]->getPessoa()->getPathFotoPerfil() ?>" width="25px" height="auto" style="margin-top:-0.25em;" />
                    <span><?= $ajuda[$i]->getPessoa()->getNomeCompleto() ?></span>
                </p>

                <?php
                    $dataCriacao = Ajuda::mudarFormatoParaBR($ajuda[$i]->getDataCriacao());
                    $dataTermino = Ajuda::mudarFormatoParaBR($ajuda[$i]->getDataTermino());
                ?>

                <p>
                    <span>Criado em: <?= $dataCriacao ?></span><br/>
                    <span>Termina em: <?= $dataTermino ?></span>
                </p>

                <div class="card-title font-weight-bold">
                    <?= $ajuda[$i]->getTitulo() ?>
                </div>

                <div class="card-block" style="padding:1em;">
                    <p class="card-text text-justify text-truncate">
                        <?= $ajuda[$i]->getDescricao() ?>
                    </p>
                    <br />
                    
                    <!--
                    <?php
                        $link = "/portal-de-ajudas/conta/categoria/".$categoria[$i]->id."/ajudas"; 
                    ?>
                    -->

                <!-- Exibe categorias --> 
                    <p>
                    <?php 
                        $categ[] = new Categoria();
                        $categ = $ajuda[$i]->getCategoria(); 

                        for($j=0; $j<count($categ);$j++){
                    ?>
                            <a href="/portal-de-ajudas/conta/categoria/ajudas.php?codCategoria=<?= $categ[$j]->getCodigo() ?>"><?= $categ[$j]->getNomeCategoria() ?></a>
                    <?php                 
                        }                                                
                    ?>
                    </p>


                    <?php
                        //Aqui, exibe a ajuda de um determinado código que foi escolhido no home
                        $link = "/portal-de-ajudas/conta/ajuda/propostas.php?codAjuda=".$ajuda[$i]->getCodigo()."";

                    ?>

                    <a href="<?= $link ?>" style="color:white; text-decoration:none;"><button class="btn btn-success">Enviar Proposta</button></a>

                </div>

            </div>
        </div>

<?php
    }
?>