<!-- Página do Usuário -->
<?php 
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    
    
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php');
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'); 
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/conta/nav-conta.php');
?>
    
    <script type="text/javascript">

        $(document).ready(function() {
            $('#form_editar_ajuda').bootstrapValidator({
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
                    dataTermino: {
                        validators: {
                            notEmpty: {
                                message: 'Data é obrigatório'
                            },
                            date: {
                                format: 'DD/MM/YYYY',
                                message: 'A data não é válida'
                            },
                            callback: {
                                message: 'Escolha uma data futura.',
                                callback: function(value, validator) {
                                    var m = new moment(value, 'DD/MM/YYYY', true);
                                    var hoje = new Date().toDateString();

                                    if (!m.isValid() && !empty(m)) {
                                        return false;
                                    }
                                    return m.isAfter(hoje);
                                }
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
                                max: 1024,
                                message: 'A descrição precisa ter caracteres entre 5 e 1024'
                            }
                        }
                    },
                    'categoria[]': {
                        validators: {
                            notEmpty: {
                                message: 'Categoria é obrigatório'
                            }
                        }
                    }
                }
            });

        });

    </script>


    <div class="container" style="margin-top:1em; margin-bottom:3em;">
        
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                
                <?php $codAjuda = $_GET['cod']; ?>

                <p>Início > Conta > Editar > Ajuda > <?= $codAjuda ?></p>

            </div>

        </div>

        <div class="row">
            
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h3>Atualizar Ajuda</h3>
            </div>
        
        </div>

        <div class="row">

            <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12">

                <hr />

                <?php
                    $ajuda = new Ajuda(); 
                    $ajudaDAO = new AjudaDAO(); 

                    $ajuda = $ajudaDAO->consultarAjudaPorCodigo($codAjuda);

                ?>
                
				<form action="up-ajuda.php?cod=<?= $ajuda->getCodigo() ?>" method="POST" id="form_editar_ajuda" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-7 col-sm-12">
								<label for="titulo">Escolhe um título para sua Ajuda: </label>
                                <span style="color:rgb(224,0,0);"> *</span> <br />
								<input type="text" class="form-control" name="titulo" value="<?= $ajuda->getTitulo() ?>" placeHolder="Título" />
                            </div>

                            <div class="col-12 col-md-5 col-sm-12">
								<label for="dataTermino">Data de Término: </label>
                                <span style="color:rgb(224,0,0);"> *</span> <br />
                                <?php 
                                    $date = date_create($ajuda->getDataTermino());
                                    $dataTermino = date_format($date,"d/m/Y");
                                ?>
								<input type="text" class="form-control" name="dataTermino" value="<?= $dataTermino ?>" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<label for="descricao">Descreva a sua ajuda: </label>
                        <span style="color:rgb(224,0,0);"> *</span> <br />
						<textarea class="form-control" name="descricao" rows="8" placeHolder="Descrição" style="resize:none;"><?= $ajuda->getDescricao() ?></textarea>
                    </div>

                    <div class="form-group">

                        <?php
                            $categoria = new Categoria();
                            $categoriaDAO = new CategoriaDAO(); 
                            $categoria = $categoriaDAO->listarCategorias(); 

                            $nomes = [];
                            for($i=0; $i<count($categoria); $i++){
                                $nomes[$i] = $categoria[$i]->getNomeCategoria();
                            }


                            $categoria = $ajudaDAO->buscarCategoriasPorCodigoAjuda($codAjuda);
                            $values = [];
                            for($i=0; $i<count($categoria); $i++){
                                $values[$i] = $categoria[$i]->getNomeCategoria();
                            }
                        ?>

                        <label for="categoria[]">Informe as categorias: </label>
                        <span style="color:rgb(224,0,0);"> *</span> <br />
                        <select class="form-control js-example-basic-multiple" name="categoria[]" style="width:100%;" multiple="multiple">
                            <?php
                                for($i=0; $i<count($nomes); $i++){
                                    for($j=0; $j<count($values); $j++){
                                        if($values[$j] == $nomes[$i]){
                            ?>
                                             <option value="<?= $nomes[$i] ?>" selected><?= $nomes[$i] ?></option>
                            <?php
                                            break;
                                        }
                                        
                            ?>
                                    <option value="<?= $nomes[$i] ?>"><?= $nomes[$i] ?></option>
                            <?php
                                    }
                                }
                            
                            ?>
                        </select>

                    </div>

                    <div class="form-group">
						<input type="submit" class="btn btn-danger form-control float-right" style="width:10em;" value="Atualizar" />
                    </div>


                </form>

            </div>

        </div>

    </div>

    <?php include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/footer.php'); ?>
