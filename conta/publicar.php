<?php 
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];
    
    //-------------------------------------

	require_once('../models/Categoria.class.php');
	require_once('../dao/CategoriaDAO.php');

    include('../header.php');
    include('../nav-principal.php'); 
    include('nav-conta.php');
?>

    <script type="text/javascript">

        $(document).ready(function() {
            $('#form_publicar').bootstrapValidator({
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
                <p> Início > conta > publicar</p>
            </div>

        </div>

        <div class="row">
            
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h3>Registrar Ajuda</h3>
            </div>
        
        </div>

        <div class="row">

            <div class="col-md-6 offset-md-3 col-sm-12 col-xs-12">

                <hr />

                <form method="POST" id="form_publicar"  action="scripts/processar_publicar_ajuda.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-7 col-sm-12">
                                <p>
                                	<label for="titulo">
                                        Escolhe um título para sua Ajuda
                                        <span style="color:rgb(224,0,0);"> *</span>
                                    </label><br />
                                	<input type="text" name="titulo" class="form-control" placeHolder="Título" />
                                </p>
                            </div>

                            <div class="col-12 col-md-5 col-sm-12">
                                 <p>
                                    <label for="dataTermino">Data de Término: </label>
                                    <span style="color:rgb(224,0,0);"> *</span> <br />
                                    <input type="text" class="form-control" name="dataTermino" />
                                 </p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                         <p>
                        	<label for="descricao">
                                <label for="descricao">Descreva a sua ajuda </label>
                                <span style="color:rgb(224,0,0);"> *</span>
                            </label><br />
                        	<textarea class="form-control" name="descricao" rows="8" placeholder="Descrição" style="resize:none;"></textarea>
                         </p>
                    </div>

                    <div class="form-group">

                        <p>
                            <?php
                            	$categoria = new Categoria();
                            	$categoriaDao = new CategoriaDAO();

                            	$categoria = $categoriaDao->listarCategorias();

                            ?>

                            <label for="categoria[]">
                                Informe a(s) categoria(s): 
                                <span style="color:rgb(224,0,0);"> *</span>
                            </label><br />
                            <select name="categoria[]" class="form-control js-example-basic-multiple" style="width:100%;" multiple>
                            	<?php
                            		for($i=0;$i<count($categoria); $i++){
                            			$nomeCategoria = $categoria[$i]->getNomeCategoria();
                            	?>
                            			<option value="<?= $nomeCategoria ?>"><?= $nomeCategoria ?></option>
                            	<?php 
                            		}
                            	?>
                            </select>
                         </p>
                    

                    </div>

                    <div class="form-group">
                    	<input type="submit" class="btn btn-success form-control float-right" value="Publicar Ajuda" style="width:10em;" />
                    </div>

                </form>

            </div>

        </div>

    </div>

    <?php include('../footer.php'); ?>

 </body>
 </html>