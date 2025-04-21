<!-- Exibe as propostas -->
<?php 
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];


    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php');
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'); 
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php');
?>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#editar_proposta').bootstrapValidator({
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
                
                $pessoa_logado = new Pessoa();
                $pessoaDao = new PessoaDAO(); 

                $pessoa_logado = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']);

                $ajuda = new Ajuda(); 
                $ajudaDao = new AjudaDAO();
                $proposta = new Proposta(); 
                $propostaDao = new PropostaDAO();

                $proposta = $propostaDao->consultarPropostaPorCodigo($_GET['cod']);
                $ajuda = $ajudaDao->consultarAjudaPorCodigo($proposta->getAjuda()->getCodigo());
                $pessoa = $pessoaDao->consultarPessoaPorCodigo($ajuda->getPessoa()->getCodigo());

                //Se a pessoa que publicou ajuda é diferente da pessoa que está logada
                if($pessoa->getCodigo() == $pessoa_logado->getCodigo()){
            ?>

                <div class="col-12 col-md-6 offset-md-3 col-sm-12" style="margin-top:2em;">
                    <div class="card" style="padding:2em;">
                        <div class="card-title"></div>
                        <div class="card-block text-center">
                            <p>
                                <img src="<?= '/portal-de-ajudas/'.$pessoa->getPathFotoPerfil() ?>" width="25em" height="auto" style="margin-top:-0.25em;" />
                                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#infoPessoa"><?= $pessoa->getNomeCompleto() ?></button>
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
            } else {
        ?>

                <div class="col-12 col-md-5 offset-md-1 col-sm-12" style="margin-top:2em;">
                    <div class="card" style="padding:2em;">
                        <div class="card-title"></div>
                        <div class="card-block text-center">
                            <p>
                                <img src="/portal-de-ajudas/<?= $pessoa->getPathFotoPerfil() ?>" width="25em" height="auto" style="margin-top:-0.25em;" />
                                <button class="btn btn-link" type="button" data-toggle="modal" data-target="#infoPessoa"><?= $pessoa->getNomeCompleto() ?></button>
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
                            <p class="text-justify" style="text-indent:2em;"><?= $ajuda->getDescricao() ?></p>
                            
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

                    <h6>Atualize a sua proposta</h6>

                    <form action="up-proposta.php?cod=<?= $proposta->getCodigo() ?>" id="editar_proposta" method="POST">

                        <div class="form-group">
                            <label for="titulo">Título: </label>
                            <span style="color:rgb(224,0,0);"> *</span>
                            <input type="text" class="form-control" name="titulo" value="<?= $proposta->getTitulo() ?>" placeHolder="Título" />
                        </div>
                        
                        <div class="form-group">
                            <label for="descricao">Descricao: </label>
                            <span style="color:rgb(224,0,0);"> *</span>
                            <textarea class="form-control" rows="5" name="descricao" placeHolder="Descrição" style="resize:none;"><?= $proposta->getDescricao() ?></textarea>
                        </div>

                        <div class="form-group float-right">
                            <input type="submit" class="btn btn-danger form-control" value="Atualizar" />
                        </div>

                    </form>

                </div>          
        <?php
            }
        ?>

            <!-- Modal #infoPessoa -->
            <?php
                $telefone = "(".$pessoa->getTelDdd().") ".$pessoa->getTelNumero();
            ?>

            <div class="modal fade" id="infoPessoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <span style="margin-left:1em;">Informação</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <p>Nome Completo: <?= $pessoa->getNomeCompleto() ?></p>  
                            <p>Gênero: <?= $pessoa->getGenero()->getNomeGenero() ?></p>
                            <p>Data de Nascimento: <?= $pessoa->getDataNascimento() ?> </p>
                            <hr />
                            <p> Telefone:    
                                <span><?= $telefone ?></span>
                            </p>


                            <hr />

                            <p>Endereço: </p>
                            <p>
                                <?= $pessoa->getLogradouro() ?>, <?= $pessoa->getComplemento() ?>, <?= $pessoa->getNumero() ?>, <?= $pessoa->getBairro() ?>, <?= $pessoa->getCidade() ?> - <?= $pessoa->getEstado() ?><?= $pessoa->getPontoReferencia() != null ? ', '.$pessoa->getPontoReferencia() : '' ?>
                            </p>


                            <hr />
                            <p>Biografia</p>
                        <?php
                            if($pessoa->getBiografia() != null){
                        ?>
                                <p><?= $pessoa->getBiografia() ?></p>
                        <?php
                            } else { 
                        ?>
                                <div class="alert alert-danger">Biografia não preenchida.</div>
                        <?php
                            }
                        ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Fim - Modal -->

        </div>

        <hr />

    </div>

    <?php include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'); ?>

