<?php
    //EXIBE AS PROPOSTAS DE UMA DETERMINADA AJUDA 
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    //--------------------------------------

    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php';
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'; 
    include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php';


    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

    $codAjuda = $_GET['codAjuda'];

?>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#form_proposta').bootstrapValidator({
                message: 'O valor não é válido.',
                fields: {
                    titulo: {
                        validators: {
                            notEmpty: {
                                message: 'Título é obrigatório'
                            },
                            stringLength: {
                                min: 5,
                                max: 30,
                                message: 'O nome precisa ter caracteres entre 5 e 30'
                            }
                        }
                    },
                    descricao: {
                        validators: {
                            notEmpty: {
                                message: 'Descrição é obrigatório'
                            },
                            stringLength: {
                                min: 5,
                                max: 255,
                                message: 'A descrição precisa ter caracteres entre 5 e 255'
                            }
                        }
                    }
                }
            });

        });

    </script>

    <div class="container">

        <div class="row">

        <?php

            $ajuda = new Ajuda(); 
            $ajudaDao = new AjudaDAO();
            $ajuda = $ajudaDao->consultarAjudaPorCodigo($codAjuda);

            if($ajuda != null && $ajuda->getPessoa()->getCodigo() == $usuario['codigo']){

        ?>

            <div class="col-12 col-md-6 offset-md-3 col-sm-12" style="margin-top:2em;">
                <div class="card" style="padding:2em;">
                    <div class="card-title"></div>
                    <div class="card-block text-center">
                    
                        <p>
                            <img src="/portal-de-ajudas/<?= $ajuda->getPessoa()->getPathFotoPerfil() ?>" width="25em" height="auto" style="margin-top:-0.25em;" />
                            <?= $ajuda->getPessoa()->getNomeCompleto() ?>
                        </p>
                        <?php
                            $dataCriacao = Ajuda::mudarFormatoParaBR($ajuda->getDataCriacao());
                            $dataTermino = Ajuda::mudarFormatoParaBR($ajuda->getDataTermino());
                        ?>

                        <p>
                            <span>Criado em: <?= $dataCriacao ?></span><br/>
                            <span>Termina em: <?= $dataTermino ?></span>
                        </p>
                        <p class="font-weight-bold"><?= $ajuda->getTitulo() ?></p>
                        <p class="text-justify" style="text-indent:2em;"><?= $ajuda->getDescricao() ?></p><br />

                        <?php
                            if($ajuda->getPathAnexo() != null){
                        ?>
                                <?php $pathAnexo = $ajuda->getPathAnexo();?>
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
                            $categ = $ajuda->getCategoria(); 

                            for($j=0; $j<count($categ);$j++){
                        ?>
                                <a href="/portal-de-ajudas/conta/categoria/ajudas.php?codCategoria=<?= $categ[$j]->getCodigo() ?>"><?= $categ[$j]->getNomeCategoria() ?></a>
                        <?php                 
                            }                                                
                        ?>
                        </p>

                    </div>
                </div>
            </div>

    <?php 
        } else if($ajuda == null) { 
    ?>
            <div class="col-12 col-md-12 col-sm-12" style="margin-top:100px;">
                <div class="alert alert-danger text-center">
                    Ajuda não encontrada
                </div>
            </div>
    <?php
        } else {
    ?>

            <div class="col-12 col-md-5 offset-md-1 col-sm-12" style="margin-top:2em;">
                <div class="card" style="padding:2em;">
                    <div class="card-title"></div>
                    <div class="card-block text-center">
                    
                        <p>
                            <img src="/portal-de-ajudas/<?= $ajuda->getPessoa()->getPathFotoPerfil() ?>" width="25em" height="auto" style="margin-top:-0.25em;" />
                            <?= $ajuda->getPessoa()->getNomeCompleto() ?>
                        </p>
                        <?php
                            $dataCriacao = Ajuda::mudarFormatoParaBR($ajuda->getDataCriacao());
                            $dataTermino = Ajuda::mudarFormatoParaBR($ajuda->getDataTermino());
                        ?>

                        <p>
                            <span>Criado em: <?= $dataCriacao ?></span><br/>
                            <span>Termina em: <?= $dataTermino ?></span>
                        </p>
                        <p class="font-weight-bold"><?= $ajuda->getTitulo() ?></p>
                        <p class="text-justify" style="text-indent:2em;"><?= $ajuda->getDescricao() ?></p><br />

                        <?php
                            if($ajuda->getPathAnexo() != null){
                        ?>
                                <?php $pathAnexo = $ajuda->getPathAnexo();?>
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
                            $categ = $ajuda->getCategoria(); 

                            for($j=0; $j<count($categ);$j++){
                        ?>
                                <a href="/portal-de-ajudas/conta/categoria/ajudas.php?codCategoria=<?= $categ[$j]->getCodigo() ?>"><?= $categ[$j]->getNomeCategoria() ?></a>
                        <?php                 
                            }                                                
                        ?>
                        </p>
                        
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 offset-md-1 col-sm-12" style="margin-top:2em;">

                <div class="alert alert-danger" id="msg-unico" style="display:none;"></div>

                <?php

                    if(isset($_SESSION['so_uma_prop'])){
                        echo "<script>
                                    $(document).ready(function(){
                                        $('#msg-unico').text('Não pode enviar mais que uma proposta.');
                                        $('#msg-unico').css('display','block');
                                    });
                              </script>";

                        unset($_SESSION['so_uma_prop']);
                    } 

                ?>

                <h6>Escreva a sua proposta</h6>

                <div id="msg_success" class="alert alert-success" style="display:none;"></div>
                <div id="msg_invalido" class="alert alert-danger" style="display:none;"></div>

                <form id="form_proposta" action="../scripts/processar_publicar_proposta.php" method="POST">

                    <input type="hidden" name="codAjuda" value="<?= $codAjuda ?>" />

                    <div class="form-group">
                        <label for="titulo">
                            Título: 
                            <span style="color:rgb(224,0,0);"> *</span>
                        </label>
                        <input type="text" name="titulo" class="form-control" placeHolder="Título" />
                    </div>
                    
                    <div class="form-group">
                    	<label for="descricao">
                            Descrição: 
                            <span style="color:rgb(224,0,0);"> *</span>
                        </label>
                    	<textarea name="descricao" class="form-control" rows="5" placeHolder="Descrição" style="resize:none;"></textarea>
                    </div>

                    <div class="form-group float-right">
                    	<input type="submit" class="btn btn-success" value="Enviar Proposta" />
                    </div>

                </form>

            </div>

    <?php
        }
    ?>

        </div>

        <hr />

    <!-- EXIBE PROPOSTAS -->

        <div class="row" style="margin-bottom:4em;">
        <?php

            $usuario = $_SESSION['user'];
            $codUsuario = $usuario['codigo'];

            $proposta = new Proposta();
            $ajudaDao = new AjudaDAO();
            $proposta = $ajudaDao->buscarPropostasPorCodigoAjuda($codAjuda);

            if($proposta != null){
                for($i=0; $i<count($proposta); $i++){
        ?>        
                    <div class="col-12 col-md-4 col-sm-12" style="margin-top:1em;">

                        <div class="card text-md-center text-sm-center text-center d-inline-block" style="padding:1em; width:100%; height:100%;">

                            <div class="card-title">

                                <!-- Exibe uma estrela quando aparece as ajudas da pessoa que está logada no momento.-->
                                <p>
                                <?php
                                    if( $proposta[$i]->getPessoa()->getCodigo() == $codUsuario ){
                                ?>
                                        <img class="float-left" src="/portal-de-ajudas/assets/images/icones/star.png" width="25em" height="auto" />
                                        <a href="/portal-de-ajudas/conta/editar/proposta.php?cod=<?= $proposta[$i]->getCodigo() ?>"><button class="btn btn-default" type="button"><img src="/portal-de-ajudas/assets/images/icones/edit.png" width="25em" height="auto" /></button></a>
                                        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#excluirProposta"><img src="/portal-de-ajudas/assets/images/icones/trash.png" width="25em" height="auto" /></button>
                                        
                                        <!-- Modal Excluir a proposta -->     
                                        <div class="modal fade" id="excluirProposta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"> 
                                                            <img class="float-left" src="/portal-de-ajudas/assets/images/icones/trash.png" width="25em" height="auto" /> 
                                                            <span style="margin-left:1em;" > Alerta - Exclusão da Proposta</span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h6>Você deseja excluir realmente a sua proposta?</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                    	<form action="/portal-de-ajudas/conta/excluir/proposta.php?cod=<?= $proposta[$i]->getCodigo() ?>" method="POST">

                                                    		<input type="submit" class="btn btn-danger" value="Sim" style="width:3.5em;" />
                                                    		<input type="submit" class="btn btn-secondary" value="Não" data-dismiss="modal" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- Fim Modal -->
                                <?php
                                	}
                                ?>
                                </p>                  
                                        <!-- Modal Editar a proposta-->     


                <!-- _________________________ Final do Modal _________________________________ -->

                                <p>
                                    <img src="/portal-de-ajudas/<?= $proposta[$i]->getPessoa()->getPathFotoPerfil() ?>" width="25px" height="auto" style="margin-top:-0.25em;" />
                                    <span><?= $proposta[$i]->getPessoa()->getNomeCompleto() ?></span>
                                </p>
                                
                                <?php
                                    $dataPropCriacao = Ajuda::mudarFormatoParaBR($proposta[$i]->getDataCriacao());
                                ?>
                                <p>
                                    <span>Criado em: <?= $dataPropCriacao ?></span><br/>
                                </p>

                                <p class="font-weight-bold"><?= $proposta[$i]->getTitulo() ?></p>
                                <p class="text-justify" style="text-indent:2em;"><?= $proposta[$i]->getDescricao() ?></p>
                                
                            </div>

                            
                            
                        </div>

                    </div>

        <?php
                }
        	} else {
        ?>
                <div class="col-12 col-md-12 col-sm-12" style="margin-top:1em;">
                    <div class="alert alert-danger text-center">
                        Não existem propostas
                    </div>
                </div>
        <?php
            }
        ?> <!-- FIM - For-->

        </div>

    </div>

    <?php include $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'; ?>

</body>
</html>