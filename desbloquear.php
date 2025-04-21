<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php');
    include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php'); 
?>

<script type="text/javascript">

    $(document).ready(function() {
        $('#form_desbloqueio').bootstrapValidator({
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
                    <h5>Desbloquear</h5>    
                </div>

                <div class="card-body">

                <?php
                    if(isset($_SESSION['success_desbloqueio'])){
                ?>
                        <div class="alert alert-success text-center">
                            <?= $_SESSION['success_desbloqueio'] ?>
                        </div>
                <?php
                        unset($_SESSION['success_desbloqueio']);
                        
                    } else if(isset($_SESSION['danger_desbloqueio'])){
                ?>
                        <div class="alert alert-danger text-center">
                            <?= $_SESSION['danger_desbloqueio']; ?>
                        </div>
                <?php
                        unset($_SESSION['danger_desbloqueio']);
                    }
                ?>

                    <form method="POST" id="form_desbloqueio" action="/portal-de-ajudas/script_desbloquear.php">
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="email" placeHolder="e-mail" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


