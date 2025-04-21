<script type="text/javascript">
    $(document).ready(function() {

        $('#form_editar_endereco').bootstrapValidator({
            message: 'O valor não é válido.',
            fields: {
                logradouro: {
                    validators: {
                        notEmpty: {
                            message: 'O logradouro é obrigatório'
                        }
                    }
                },
               numero: {
                    validators: {
                        notEmpty: {
                            message: 'O número é obrigatório'
                        }
                    }
                },
                complemento: {
                    validators: {
                        stringLength: {
                            min: 3,
                            max: 50,
                            message: 'Entre 3 e 50 caracteres'
                        }
                    }
                },
                bairro: {
                    validators: {
                        notEmpty: {
                            message: 'O bairro é obrigatório'
                        }
                    }
                },
                cidade: {
                    validators: {
                        notEmpty: {
                            message: 'A cidade é obrigatório'
                        }
                    }
                },
                estado: {
                    validators: {
                        notEmpty: {
                            message: 'O estado é obrigatório'
                        }
                    }
                },
                pontoReferencia: {
                    validators: {
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'Entre 3 e 30 caracteres'
                        },
                    }
                }
            }
        });

    });
</script>


<div class="row">
    <div class="col-12 col-md-12 col-sm-12 text-center">
        <h5>Endereço</h5>
    </div>  
</div>

<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-sm-12" style="padding-top:1em;">
    
        <?php
            $codPessoa = $usuario['codigo'];

            $pessoa = new Pessoa(); 
            $pessoaDao = new PessoaDAO(); 

            $pessoa = $pessoaDao->consultarPessoaPorCodigo($codPessoa);
        ?>

        <!-- USA O PessoaController -->
        <form action="scripts/atualizar_endereco.php" id="form_editar_endereco" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="codPessoa" value="<?= $pessoa->getCodigo() ?>" />

        <!-- Atualização de Endereço -->
            <div class="row">
                <div class="col-12 col-md-8 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="logradouro">Logradouro: </label>
                            <span style="color:rgb(220,53,69);">*</span>
                            <input type="text" class="form-control" name="logradouro" value="<?= $pessoa->getLogradouro() ?>" placeHolder="Logradouro" />
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="numero">Número: </label>
                            <span style="color:rgb(220,53,69);">*</span>
                            <input type="text" class="form-control" name="numero" value="<?= $pessoa->getNumero() ?>" placeHolder="Número" />
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-7 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="complemento">Complemento: </label>
                            <input type="text" class="form-control" name="complemento" value="<?= $pessoa->getComplemento() ?>" placeholder="Complemento" />
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="bairro">Bairro: </label>
                            <span style="color:rgb(220,53,69);">*</span>
                            <input type="text" class="form-control" name="bairro"  value="<?= $pessoa->getBairro() ?>" placeHolder="Bairro" />
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-4 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="cidade">Cidade: </label>
                            <span style="color:rgb(220,53,69);">*</span>
                            <input type="text" class="form-control" name="cidade" value="<?= $pessoa->getCidade() ?>" placeHolder="Cidade" />
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-3 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="estado">UF: </label>
                            <span style="color:rgb(220,53,69);">*</span>
                            <?php
                                $uf = array('SP','RJ','BA','PR','AM',
                                            'MG','ES','GO','AC','AL',
                                            'AP','CE','DF','MA','MT',
                                            'MS','RS','SC','RO','RR',
                                            'PA','PI','RN','PB','PE',
                                            'SE','TO'); 
                                //asort($uf);
                            ?>
                            <select class="form-control" name="estado">
                                <?php
                                    for($i=0; $i<count($uf); $i++){
                                        if($uf[$i] == $pessoa->getEstado()){
                                ?> 
                                            <option value="<?= $uf[$i] ?>" selected><?= $uf[$i] ?></option>
                                <?php
                                            continue;
                                        }
                                ?>
                                        <option value="<?= $uf[$i] ?>"><?= $uf[$i] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-sm-12">
                    <div class="form-group">
                        <p>
                            <label for="pontoReferencia">Ponto de Referência: </label>
                            <input type="text" class="form-control" name="pontoReferencia" value="<?= $pessoa->getPontoReferencia() ?>" placeHolder="Ponto de Referência" />
                        </p>
                    </div>
                </div>
            </div>

            <hr />

            <div class="form-group">
                <p>
                    <input type="submit" class="btn btn-danger float-right" value="Atualizar" />
                </p>
            </div>

        </form>

    </div>
</div>
