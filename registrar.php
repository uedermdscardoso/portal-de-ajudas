<?php 
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php');
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'); 
?>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#form_registrar').bootstrapValidator({
                message: 'O valor não é válido.',
                fields: {
                    nomeCompleto: {
                        validators: {
                            notEmpty: {
                                message: 'Nome Completo é obrigatório'
                            },
                            stringLength: {
                                min: 5,
                                max: 50,
                                message: 'O nome precisa ter caracteres entre 5 e 50'
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
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'e-mail é obrigatório'
                            },
                            remote: {
                                type: 'POST',
                                url: 'verificarEmailExiste.php',
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
                                url: 'verificarUsuarioExiste.php',
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
                    },
                    senha: {
                        validators: {
                            notEmpty: {
                                message: 'A senha é obrigatório'
                            },
                            identical: {
                                field: 'confirmarSenha',
                                message: 'A senha e a confirmação não são iguais'
                            },
                            different: {
                                field: 'usuario',
                                message: 'A senha precisa ser diferente do usuário'
                            }
                        }
                    },
                    confirmarSenha: {
                        validators: {
                            notEmpty: {
                                message: 'A confirmação de senha é obrigatório'
                            },
                            identical: {
                                field: 'senha',
                                message: 'A senha e a confirmação não são iguais'
                            },
                            different: {
                                field: 'usuario',
                                message: 'A senha precisa ser diferente do usuário'
                            }
                        }
                    }
                }
            });

        });
    </script>


<div class="container" style="margin-top:5em; padding-bottom:5em;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5 style="margin-top:0.5em;">Criar Conta</h5>
                </div>

                <div class="card-body">

                    <form method="POST" id="form_registrar" action="processa-registro.php">

                        <div class="form-group row">

                            <div class="col-md-4 col-sm-12 col-12 text-md-right">
                                <label for="nomeCompleto">
                                    Nome Completo: 
                                    <span style="color:rgb(224,0,0);"> *</span>
                                </label><br />
                            </div>

                            <div class="col-md-6 col-sm-12 col-12">

                                <input type="text" name="nomeCompleto" class="form-control style" autofocus />
                                
                            </div>

                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-4 col-sm-12 col-12 text-md-right">
                                <label for="dataNascimento">
                                    Data de Nascimento: 
                                    <span style="color:rgb(224,0,0);"> *</span>
                                </label>
                            </div>

                            <div class="col-md-6 col-sm-12 col-12">

                                <input type="text" name="dataNascimento" class="form-control style" />

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-12 col-md-4 col-sm-12 text-md-right">
                                    <label for="genero">
                                        Gênero: 
                                        <span style="color:rgb(224,0,0);"> *</span>
                                    </label>
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genero" id="genero_f" value="Feminino" />
                                        <label class="form-check-label" for="genero_f" style="margin-right:0.5em;">  Feminino </label>

                                        <input class="form-check-input" type="radio" name="genero" id="genero_m" value="Masculino" />
                                        <label class="form-check-label" for="genero_m">  Masculino </label>
                            
                                    </div>  
                                </div>
                            </div>

                            <!--
                                Observação: 
                                Estilo de "invalid-feedback"
                                style="font-size:9.5pt; color:rgb(220,53,69);"
                            -->

                        </div>

                        <hr />

    <!-- Telefone -->
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-2 col-sm-12">

                                <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <p>Telefone: <p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label for="tel_ddd">DDD: </label>
                                            <span style="color:rgb(224,0,0);"> *</span>
                                            <input type="text" class="form-control style" name="tel_ddd" placeHolder="DDD" />
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="tel_numero">Número: </label>
                                            <span style="color:rgb(224,0,0);"> *</span>
                                            <input type="text" class="form-control style" name="tel_numero" placeHolder="Número de Telefone" />
                                        </div>
                                    </div>
                                </div>
                                
                            </div>


                        </div> 

                        <hr />

    <!-- Endereço /////////////// -->
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-2 col-sm-12">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <p>Endereço: <p>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12 col-md-9 col-sm-12">
                                        <div class="form-group">
                                            <p>
                                                <label for="logradouro">Logradouro: </label>
                                                <span style="color:rgb(224,0,0);"> *</span>
                                                <input type="text" class="form-control style" name="logradouro" placeHolder="Logradouro" />
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <p>
                                                <label for="numero">Número: </label>
                                                <span style="color:rgb(224,0,0);"> *</span>
                                                <input type="text" class="form-control style" name="numero" placeHolder="Número" />
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <p>
                                                <label for="complemento">Complemento: </label>
                                                <input type="text" class="form-control style" name="complemento" placeHolder="Complemento" />
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <p>
                                                <label for="bairro">Bairro: </label>
                                                <span style="color:rgb(224,0,0);"> *</span>
                                                <input type="text" class="form-control style" name="bairro" placeHolder="Bairro" />
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <p>
                                                <label for="cidade">Cidade: </label>
                                                <span style="color:rgb(224,0,0);"> *</span>
                                                <input type="text" class="form-control style" name="cidade" placeHolder="Cidade" />
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <p>
                                                <label for="estado">UF: </label>
                                                <span style="color:rgb(224,0,0);"> *</span>
                                                <?php
                                                    $uf = array('SP','RJ','BA','PR','AM',
                                                                'MG','ES','GO','AC','AL',
                                                                'AP','CE','DF','MA','MT',
                                                                'MS','RS','SC','RO','RR',
                                                                'PA','PI','RN','PB','PE','SE','TO'); 
                                                    asort($uf);
                                                    $uf = array_values($uf);
                                                ?>
                                                <select class="form-control style" name="estado">
                                                    <?php
                                                        for($i=0;$i<count($uf); $i++){
                                                    ?>
                                                            <option value="<?= $uf[$i] ?>"><?= $uf[$i]?></option>
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
                                                <input type="text" class="form-control style" name="pontoReferencia" placeHolder="Ponto de Referência" />
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        
                        <hr />

        <!-- email,usuario e senha. Elementos padrões da autenticação -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                e-mail: 
                                <span style="color:rgb(224,0,0);"> *</span>
                            </label>

                            <div class="col-md-6 col-sm-12 col-12">
                                <input type="email" class="form-control style" name="email" /> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- É o nome do usuário-->
                            <label for="usuario" class="col-md-4 col-form-label text-md-right">
                                Usuário: 
                                <span style="color:rgb(224,0,0);"> *</span>
                            </label>

                            <div class="col-md-6 col-sm-12 col-12">
                                <input type="text" class="form-control style" name="usuario" />

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="senha" class="col-md-4 col-form-label text-md-right">
                                Senha: 
                                <span style="color:rgb(224,0,0);"> *</span>
                            </label>

                            <div class="col-md-6">
                                <input type="password" class="form-control style" id="senha" name="senha" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirmarSenha" class="col-md-4 col-form-label text-md-right">
                                Confirmar a senha: 
                                <span style="color:rgb(224,0,0);"> *</span>
                            </label>

                            <div class="col-md-6">
                                <input type="password" class="form-control style" name="confirmarSenha" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value="Registrar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
