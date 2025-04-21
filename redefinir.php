<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php');
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'); 
?>

<script type="text/javascript">

    $(document).ready(function() {
        $('#form_reset').bootstrapValidator({
            message: 'O valor não é válido.',
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'e-mail é obrigatório'
                        },
                        remote: {
                            type: 'POST',
                            url: '/portal-de-ajudas/verificarEmailNaoExiste.php',
                            message: 'O email informado não existe.'
                        },
                        emailAddress: {
                            message: 'O e-mail não é válido'
                        }
                    }
                }
            }
        });

    });

</script> 

<div class="container" style="margin-top:10em;"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="margin-top:0.5em; background-color:white;">
                    <h5>Redefinição de Senha</h5>    
                </div>

                <div class="card-body">

                <?php
                    if(isset($_SESSION['success_reset_senha'])){
                ?>
                        <div class="alert alert-success text-center">
                            <?= $_SESSION['success_reset_senha'] ?>
                        </div>
                <?php
                        unset($_SESSION['success_reset_senha']);
                        
                    } else if(isset($_SESSION['danger_reset_senha'])){
                ?>
                        <div class="alert alert-danger text-center">
                            <?= $_SESSION['danger_reset_senha'] ?>
                        </div>
                <?php
                        unset($_SESSION['danger_reset_senha']);
                    }
                ?>

                    <form method="POST" id="form_reset" action="/portal-de-ajudas/reset.php">
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="email" placeHolder="e-mail" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Senha
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


