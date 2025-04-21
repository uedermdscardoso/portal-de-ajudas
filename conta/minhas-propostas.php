
<?php

    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

?>

<div class="row">

<div class="col-md-12 col-sm-12 col-12" style="margin-top:1em;">
    
    <!-- Primeiro Card - Fundo -->
    <div class="card text-md-center text-sm-center text-center" style="padding:1em;">

        <div class="card-title" style="margin-top:1em;">
            <h5>Minhas propostas</h5>
        </div>

        <div class="card-block">
            
            <!-- Traz todas as ajudas que a pessoa tinha enviado suas propostas -->
        <?php

                $propostas[] = new Proposta();
                $propostaDao = new PropostaDAO();

                $propostas = $propostaDao->listarPropostasPorCodigoPessoa($usuario['codigo']);


            if($propostas != null){ //Verifica se há propostas na lista 
        ?>
                <div class="row">
                    <?php
                        for($i=0;$i<count($propostas);$i++){
                    ?>
                                <div class="col-md-6 col-sm-12 col-12 d-inline-block" style="padding:1em;">
                                
                                <!-- Segundo card para cada bloco --> 
                                <div class="card" style="padding:1em; ">
                                
                                    <div class="card-title">
    
                <!-- _____________________________ Modal ________________________________________ -->
                            <!-- Aqui, não precisa verificar as propostas do usuário logado porque todas já são dele. -->
                                        <p>
                                            <!-- ICONES -->
                                            <img class="float-left" src="/portal-de-ajudas/assets/images/icones/star.png" width="25em" height="auto" />
                                            <a href="/portal-de-ajudas/conta/editar/proposta.php?cod=<?= $propostas[$i]->getCodigo() ?>"><button class="btn btn-default" type="button"><img src="/portal-de-ajudas/assets/images/icones/edit.png" width="25em" height="auto" /></button></a>
                                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#excluirProposta<?= $i ?>"><img src="/portal-de-ajudas/assets/images/icones/trash.png" width="25em" height="auto" /></button>

                                            <!-- Modal Excluir a proposta -->     
                                            <div class="modal fade" id="excluirProposta<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"> 
                                                                <img class="float-left" src="/portal-de-ajudas/assets/images/icones/trash.png" width="25em" height="auto" /> 
                                                                <span style="margin-left:1em;"> Alerta - Exclusão da Proposta</span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h6>Você deseja excluir realmente a sua proposta?</h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="/portal-de-ajudas/conta/excluir/proposta.php?cod=<?= $propostas[$i]->getCodigo() ?>" method="POST">
                                                                <input type="submit" class="btn btn-danger" value="Sim" style="width:3.5em;" />
                                                                <input type="submit" class="btn btn-secondary" value="Não" style="width:3.5em;" data-dismiss="modal" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- Fim Modal -->

                                        </p>                  
                                                <!-- Modal Editar a proposta-->     


              <!-- _________________________ Final do Modal _________________________________ -->

                                        <p>
                                            <img src="/portal-de-ajudas/<?= $propostas[$i]->getPessoa()->getPathFotoPerfil() ?>" width="25px" height="auto" style="margin-top:-0.25em;" />
                                            <span><?= $propostas[$i]->getPessoa()->getNomeCompleto() ?></span>
                                        </p>
                                        <!--
                                            <p>Criado em {{ \Carbon\Carbon::parse($propostas[$i]->created_at)->format('d/m/Y H:i:s') }}<p>
                                        -->
                                        <p class="font-weight-bold"><?= $propostas[$i]->getTitulo() ?></p>
                                    </div>
                                    
                                    <div class="card-block">
                                        <p class="text-justify" style="text-indent:2em;"><?= $propostas[$i]->getDescricao() ?></p><br />
                                        <a href="/portal-de-ajudas/conta/ajuda/propostas.php?codAjuda=<?= $propostas[$i]->getAjuda()->getCodigo() ?>"><button class="btn btn-success">Visualizar Ajuda</button></a>                                        
                                    </div>
                                
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
                            Nenhum proposta registrada. 
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