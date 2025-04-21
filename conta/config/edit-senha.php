<script type="text/javascript">
    $(document).ready(function() {

        $('#form_editar_senha').bootstrapValidator({
            message: 'O valor não é válido.',
            fields: {
                senhaAtual: {
                    validators: {
                        notEmpty: {
                            message: 'A senha atual é obrigatório'
                        },
                        different: {
                            field: 'novaSenha',
                            message: 'A nova senha não pode ser igual a senha atual'
                        },
                        different: {
                            field: 'confirmarNovaSenha',
                            message: 'A senha precisa ser diferente do usuário'
                        },
                        remote: {
                            type: 'POST',
                            url: 'scripts/verificarSenhaAtual.php',
                            message: 'A senha deve ser igual a senha registrada'
                        }
                    }
                },
                novaSenha: {
                    validators: {
                        notEmpty: {
                            message: 'A nova senha é obrigatório'
                        },
                        identical: {
                            field: 'confirmarNovaSenha',
                            message: 'A nova senha e a confirmação não são iguais'
                        },
                        different: {
                            field: 'senhaAtual',
                            message: 'A nova senha não pode ser igual a senha atual'
                        }
                    }
                },
                confirmarNovaSenha: {
                    validators: {
                        notEmpty: {
                            message: 'A confirmação de senha é obrigatório'
                        },
                        identical: {
                            field: 'novaSenha',
                            message: 'A confirmação e nova senha não são iguais'
                        },
                        different: {
                            field: 'senhaAtual',
                            message: 'A confirmação não pode ser igual a senha atual'
                        }
                    }
                }
            }
        });

    });
</script>

<div class="row">
    <div class="col-12 col-md-12 col-sm-12 text-center" style="padding-top:1em;">
        <h5>Atualização da Senha</h5>
    </div>  
</div>


<div class="row">
    <div class="col-12 col-md-8 offset-md-2 col-sm-12" style="padding-top:1em;">


        <form action="scripts/atualizar_senha.php" id="form_editar_senha" method="POST">
            
            <input type="hidden" name="codPessoa" value="<?= $pessoa->getCodigo() ?>" />

            <div class="form-group">
                <p>
                    <label for="senhaAtual">Senha atual: </label>
                    <span style="color:rgb(220,53,69);">*</span>
                    <input type="password" class="form-control" name="senhaAtual" placeHolder="Senha Atual" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="novaSenha">Nova Senha: </label>
                    <span style="color:rgb(220,53,69);">*</span>
                    <input type="password" class="form-control" name="novaSenha" placeHolder="Nova Senha" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <label for="confirmarNovaSenha">Confirmar Nova Senha: </label>
                    <span style="color:rgb(220,53,69);">*</span>
                    <input type="password" class="form-control" name="confirmarNovaSenha" placeHolder="Confirmar Nova Senha" />
                </p>
            </div>

            <div class="form-group">
                <p>
                    <input type="submit" class="btn btn-danger float-right" value="Atualizar" />
                </p>
            </div>

        </form>
    </div>
</div>

