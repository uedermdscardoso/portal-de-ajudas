<script type="text/javascript">
    $(document).ready(function() {

        $('#form_editar_dados_pessoais').bootstrapValidator({
            message: 'O valor não é válido.',
            fields: {
                pathFotoPerfil: {
                    validators: {
                        file: {
                              extension: 'jpg,png',
                              type: 'image/jpeg,image/png',
                              maxSize: 1*1024*1024,   // 1 MB
                              message: 'Permite somente extensão jpeg ou png e tamanho de 1 MB.'
                        },
                    }
                },
                nomeCompleto: {
                    validators: {
                        notEmpty: {
                            message: 'Nome Completo é obrigatório'
                        },
                        stringLength: {
                            min: 5,
                            max: 50,
                            message: 'O nome precisa caracteres entre 5 e 25'
                        }
                    }
                },
                biografia: {
                    validators: {
                        stringLength: {
                            max: 2024,
                            message: 'A biografia pode ser preenchida em até 2024 caracteres'
                        }
                    }
                },
                dataNascimento: {
                    validators: {
                        notEmpty: {
                            message: 'A data de nascimento é obrigatório'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            message: 'A data de nascimento não é válida'
                        },
                        callback: {
                            message: 'Escolha uma data entre 01/01/1910 e 30/12/1999.',
                            callback: function(value, validator) {
                                var m = new moment(value, 'DD/MM/YYYY', true);

                                if (!m.isValid()) {
                                    return false;
                                }
                                return m.isAfter('01/01/1910') && m.isBefore('12/30/1999');
                            }
                        }
                    }
                },
                genero: {
                    validators: {
                        notEmpty: {
                            message: 'O gênero é obrigatório'
                        }
                    }
                },
                tel_ddd: {
                    validators: {
                        notEmpty: {
                            message: 'DDD é obrigatório'
                        },
                        stringLength: {
                            min: 2,
                            message: 'Exige 2 números'
                        }
                    }
                },
                tel_numero: {
                    validators: {
                        notEmpty: {
                            message: 'O número de telefone é obrigatório'
                        },
                        stringLength: {
                            min: 8,
                            max: 9,
                            message: 'O telefone precisa ter 8 ou 9 números'
                        },
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'e-mail é obrigatório'
                        },
                        remote: {
                            type: 'POST',
                            url: '/portal-de-ajudas/verificarEmailExiste2.php',
                            message: 'O email já existe.'
                        },
                        emailAddress: {
                            message: 'O e-mail não é válido'
                        }
                    }
                },
                usuario: {
                    validators: {
                        notEmpty: {
                            message: 'O usuário é obrigatório'
                        },
                        remote: {
                            type: 'POST',
                            url: '/portal-de-ajudas/verificarUsuarioExiste2.php',
                            message: 'O usuário já existe.'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'O usuário precisa ter 6 caracteres no mínimo e 20 no máximo'
                        },
                        different: {
                            field: 'senha,confirmarSenha',
                            message: 'O usuário e senha não podem ser iguais'
                        }
                    }
                }
            }
        });

    });
</script>


<div class="row">
    <div class="col-12 col-md-12 col-sm-12 text-center">
        <h5>Dados Pessoais</h5>
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
        <form action="scripts/atualizar_perfil.php" id="form_editar_dados_pessoais" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="codPessoa" value="<?= $pessoa->getCodigo() ?>" />

            <div class="form-group">
                <p>
                    <label for="pathFotoPerfil">Foto do Perfil: </label>
                    <input type="file" class="form-control" name="pathFotoPerfil" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="nomeCompleto">Nome Completo: </label>  
                    <span style="color:rgb(220,53,69);">*</span>    
                    <input type="text" class="form-control" name="nomeCompleto" value="<?= $pessoa->getNomeCompleto() ?>" placeholder="Nome Completo" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="dataNascimento">Data de Nascimento: </label>
                    <span style="color:rgb(220,53,69);">*</span>
                    <?php 
                        $dataNascimento = date_create($pessoa->getDataNascimento());
                        $dataNascimento = date_format($dataNascimento,"d/m/Y"); 
                    ?>
                    <input type="text" class="form-control" name="dataNascimento" value="<?= $dataNascimento ?>" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <div class="form-check form-check-inline">
                        
                        <?php 
                            $nomeGenero = $pessoa->getGenero()->getNomeGenero();
                        ?>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="genero_f" value="Feminino" <?= $nomeGenero == 'Feminino' ? 'checked' : '' ?> />
                            <label class="form-check-label" for="genero_f" style="margin-right:0.5em;">  Feminino </label>

                            <input class="form-check-input" type="radio" name="genero" id="genero_m" value="Masculino" <?= $nomeGenero == 'Masculino' ? 'checked' : '' ?> />
                            <label class="form-check-label" for="genero_m">  Masculino </label>
                
                        </div>  
            
                    </div> 
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="email">e-mail: </label>
                    <span style="color:rgb(220,53,69);">*</span>
                    <input type="text" class="form-control" name="email" value="<?= $pessoa->getEmail() ?>" placeHolder="e-mail" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="usuario">Usuário: </label>
                    <span style="color:rgb(220,53,69);">*</span>
                    <input type="text" class="form-control" name="usuario" value="<?= $pessoa->getUsuario() ?>" placeHolder="Usuário" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="biografia">Biografia: </label>
                    <textarea class="form-control" name="biografia" rows="8" placeHolder="Biografia" style="resize:none;"><?= $pessoa->getBiografia() ?></textarea>
                </p>
            </div>

      
        <!-- Atualização de Telefone --> 

            <div class="row">
                <div class="col-12 col-md-4 col-sm-12">
                    <p>Telefone: </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="tel_ddd">DDD: </label>
                        <span style="color:rgb(220,53,69);">*</span>
                        <input type="text" class="form-control" name="tel_ddd" value="<?= $pessoa->getTelDdd() ?>" placeholder="DDD" />
                    </div>
                </div>

                <div class="col-12 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="tel_numero">Número</label>
                        <span style="color:rgb(220,53,69);">*</span>
                        <input type="text" class="form-control" name="tel_numero" value="<?= $pessoa->getTelNumero() ?>" placeholder="Telefone" />
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
