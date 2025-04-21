    <div class="card-title">

    <!-- Início do Modal -->
        <p>
        <?php
            $pessoa = new Pessoa();
            $pessoa = $ajudas[$i]->getPessoa();

            $status = $ajudas[$i]->getStatus()->getNomeStatus();

            if($status == "Aberto"){
        ?>
                <p class="text-success"><?= $status ?></p>
        <?php
            } else if($status == "Realizado"){
        ?>
                <p class="text-info"><?= $status ?></p>
        <?php
            } else { //Fechado
        ?>
                <p class="text-danger"><?= $status ?></p>
        <?php
            }

            if( $pessoa->getCodigo() == $codUsuario ){
            
        ?>
            <!-- Exibe uma estrela quando aparece as ajudas da pessoa que está logada no momento.-->
            <!--
            <img class="float-left" src="/portal-de-ajudas/assets/images/icones/star.png" width="25em" height="auto" />
            -->
            <a href="editar/ajuda.php?cod=<?= $ajudas[$i]->getCodigo() ?>"><button class="btn btn-default" type="button"><img src="/portal-de-ajudas/assets/images/icones/edit.png" width="25em" height="auto" /></button></a>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#excluirAjuda<?= $i ?>"><img src="/portal-de-ajudas/assets/images/icones/trash.png" width="25em" height="auto" /></button>

            <?php
                if($ajudas[$i]->getStatus()->getNomeStatus() == "Aberto"){
            ?>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#marcarRealizadaAjuda<?= $i ?>"><img src="/portal-de-ajudas/assets/images/icones/marcarRealizadaAjuda.png" width="25em" height="auto" /></button>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#fecharAjuda<?= $i ?>"><img src="/portal-de-ajudas/assets/images/icones/fechar.png" width="25em" height="auto" /></button>
            <?php
                } else if($ajudas[$i]->getStatus()->getNomeStatus() != "Realizado") { //Só fechado
            ?>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#reabrirAjuda<?= $i ?>"><img src="/portal-de-ajudas/assets/images/icones/reabrir.png" width="25em" height="auto" /></button>
            <?php
                }
            ?>
        
            <!-- Modal Excluir a proposta -->     
            <div class="modal fade" id="excluirAjuda<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> 
                                <img class="float-left" src="/portal-de-ajudas/assets/images/icones/trash.png" width="25em" height="auto" /> 
                                <span style="margin-left:1em;">Alerta - Exclusão de Ajuda</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h6>Você deseja excluir realmente a sua ajuda?</h6>
                        </div>
                        <div class="modal-footer">
                            <form action="excluir/ajuda.php?codAjuda=<?= $ajudas[$i]->getCodigo() ?>" method="POST">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="submit" class="btn btn-danger" value="Sim" style="width:3.5em;" />
                                <input type="submit" class="btn btn-secondary" value="Não" data-dismiss="modal" style="width:3.5em;" />
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Fim Modal -->

            <!-- Modal Fechar a ajuda -->     
            <div class="modal fade" id="fecharAjuda<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> 
                                <img class="float-left" src="/portal-de-ajudas/assets/images/icones/fechar.png" width="25em" height="auto" /> 
                                <span style="margin-left:1em;"> Alerta - Fechamento de Ajuda</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h6>Você deseja fechar realmente a sua ajuda?</h6>
                        </div>
                        <div class="modal-footer">
                            <form action="/portal-de-ajudas/conta/scripts/fechar-ajuda.php" method="POST">
                                <input type="hidden" name="codAjuda" value="<?= $ajudas[$i]->getCodigo() ?>">

                                <input type="submit" class="btn btn-danger" style="width:5em;" value="Fechar" />
                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancelar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Fim Modal -->

            <!-- Modal Reabrir a ajuda -->     
            <div class="modal fade" id="marcarRealizadaAjuda<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> 
                                <img class="float-left" src="/portal-de-ajudas/assets/images/icones/marcarRealizadaAjuda.png" width="25em" height="auto" /> 
                                <span style="margin-left:1em;"> Alerta - Ajuda Realizada</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h6>Você deseja marcar a ajuda como realizada?</h6>
                        </div>
                        <div class="modal-footer">
                            <form action="/portal-de-ajudas/conta/scripts/marcar-ajuda.php" method="POST">
                                <input type="hidden" name="codAjuda" value="<?= $ajudas[$i]->getCodigo() ?>">
                                
                                <input type="submit" class="btn btn-danger" style="width:5em;" value="Marcar" />
                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancelar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Fim Modal -->

            <!-- Modal Reabrir a ajuda -->     
            <div class="modal fade" id="reabrirAjuda<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> 
                                <img class="float-left" src="/portal-de-ajudas/assets/images/icones/reabrir.png" width="25em" height="auto" /> 
                                <span style="margin-left:1em;"> Alerta - Reabertura da Ajuda</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h6>Você deseja reabrir a sua ajuda?</h6>
                        </div>
                        <div class="modal-footer">
                            <form action="/portal-de-ajudas/conta/scripts/reabrir-ajuda.php" method="POST">
                                <input type="hidden" name="codAjuda" value="<?= $ajudas[$i]->getCodigo() ?>">
                                
                                <input type="submit" class="btn btn-danger" style="width:5em;" value="Reabrir" />
                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancelar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Fim Modal -->
        <?php
            } 
        ?>

    <!-- Fim Modal -->
        <p style="margin-top:15px;">
            <img src="/portal-de-ajudas/<?= $pessoa->getPathFotoPerfil() ?>" width="25px" height="auto" style="margin-top:-0.25em;" />
            <span><?= $ajudas[$i]->getPessoa()->getNomeCompleto() ?></span>
        </p>

        <?php
            $dataCriacao = Ajuda::mudarFormatoParaBR($ajudas[$i]->getDataCriacao());
            $dataTermino = Ajuda::mudarFormatoParaBR($ajudas[$i]->getDataTermino());
        ?>

        <p>
            <span>Criado em: <?= $dataCriacao ?></span><br/>
            <span>Termina em: <?= $dataTermino ?></span>
        </p>
        <p class="font-weight-bold"><?= $ajudas[$i]->getTitulo() ?></p>
    </div>

    <div class="card-block">
        <p class="text-justify text-truncate" style="text-indent:2em;"><?= $ajudas[$i]->getDescricao() ?></p><br />
        
    <?php
        if($ajudas[$i]->getPathAnexo() != null){
    ?>
            <?php $pathAnexo = $ajudas[$i]->getPathAnexo();?>
            <p class="text-center">
                <span>Anexo: </span>
                <a href="/portal-de-ajudas/<?= $pathAnexo ?>" download><?= substr(strrchr($pathAnexo, "/"), 1,strlen($pathAnexo)) ?></a> 
            </p>
    <?php
        }
    ?>

        <!-- Exibe categorias --> 
        <p>
    <?php 
        $categ[] = new Categoria();
        $categ = $ajudas[$i]->getCategoria(); 

        for($j=0; $j<count($categ);$j++){
    ?>
            <a href="/portal-de-ajudas/conta/categoria/ajudas.php?codCategoria=<?= $categ[$j]->getCodigo() ?>"><?= $categ[$j]->getNomeCategoria() ?></a>
    <?php                 
        }                                                
    ?>
        </p>

        
        <a href="/portal-de-ajudas/conta/ajuda/propostas.php?codAjuda=<?= $ajudas[$i]->getCodigo() ?>"><button class="btn btn-success">Visualizar Propostas</button></a>      
    </div>
