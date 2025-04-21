<?php 
    include('header.php');
    include('nav-principal.php'); 
?>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#form_contato').bootstrapValidator({
                message: 'O valor não é válido.',
                fields: {
                    nome: {
                        validators: {
                            notEmpty: {
                                message: 'O nome é obrigatório'
                            },
                            stringLength: {
                                min: 5,
                                max: 50,
                                message: 'O nome precisa ter caracteres entre 5 e 50'
                            }
                        }
                    },
                    mensagem: {
                        validators: {
                            notEmpty: {
                                message: 'A mensagem é obrigatório'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'e-mail é obrigatório'
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

    <div class="container" style="margin-top:8em;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4 col-sm-12">
                  
                <h5 class="text-center">Contate-nos</h5>

            	<form id="form_contato" action="/portal-de-ajudas/enviarMensagem.php" method="post">
            		<div class="form-group">
            			<label for="nome">Nome: </label>
            			<span style="color:rgb(224,0,0);"> *</span>
            			<input type="text" class="form-control" name="nome" placeholder="Seu nome" />
            		</div>
            		<div class="form-group">
            			<label for="email">E-mail: </label>
            			<span style="color:rgb(224,0,0);"> *</span>
            			<input type="text" class="form-control" name="email" placeholder="Seu e-mail" />
            		</div>
            		<div class="form-group">
            			<label for="mensagem">Mensagem: </label>
            			<span style="color:rgb(224,0,0);"> *</span>
            			<textarea class="form-control" name="mensagem" rows="8" placeholder="Elogios, críticas ou sugestões" style="resize:none;"></textarea>
            		</div>
            		<div class="form-group float-right">
            			<input type="submit" class="btn btn-success" name="Enviar" />
            		</div>
            	</form>
            </div>
        </div>
    </div>