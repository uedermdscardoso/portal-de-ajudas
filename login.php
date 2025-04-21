<?php 
    session_start();

    if(isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/conta/conta.php');
    } 

    if(isset($_SESSION['nome_sessao_count'])){
        $nome_sessao_bloqueio = $_SESSION['nome_sessao_count'];
        if(isset($_SESSION[$nome_sessao_bloqueio]) && isset($_SESSION['count_time'])){
            if($_SESSION['count_time'] < time()){
                unset($_SESSION['count_time']);
                unset($_SESSION[$nome_sessao_bloqueio]);
            }
        }
    }

    include('header.php');
    include('nav-principal.php'); 
?>


    <div class="container" style="margin-top:8em;">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-sm-12">
                <div class="card">

                    <div class="card-header text-center" style="margin-top:0.5em; background-color:white;">
                        <h5>Autenticação do Usuário</h5>
                    </div>


                    <div class="card-body text-center">
                        
                        <br />


                        <?php
                            if(isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == true){
                        ?>
                                <div id="msg_invalido" class="alert alert-danger">Credenciais inválidos!</div>
                        <?php
                                unset($_SESSION['errorLogin']);

                            } 
                            /*else if(isset($_SESSION['nome_sessao_count'])){
                                $nome_sessao_bloqueio = $_SESSION['nome_sessao_count'];

                                if(isset($_SESSION[$nome_sessao_bloqueio])){
                                    $c = $_SESSION[$nome_sessao_bloqueio]['count'];
                        ?>  
                                    <div id="msg_invalido" class="alert alert-danger">
                                        Credenciais inválidos! <?= $c == 1 ? '1 tentativa' : $c.' tentativas' ?> 
                                    </div>
                        <?php
                                }
                            }*/
                            
                            //Aparecer uma mensagem que está bloqueado
                            if(isset($_SESSION['pessoaBloqueada']) && $_SESSION['pessoaBloqueada'] == true){
                        ?>
                                <div id="msg_invalido" class="alert alert-danger">Bloqueado</div>  
                        <?php
                                unset($_SESSION['pessoaBloqueada']);
                            }
                        ?>

                        <form id="form_login" method="POST" action="processa-login.php">
                            <!--@csrf-->

                            <div class="form-group row">
                                
                                <div class="col-md-8 offset-md-2">
                                    <input type="email" name="email" name="email" placeHolder="e-mail" class="form-control" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <input type="password" name="senha" class="form-control" placeHolder="Senha">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="row mb-0" style="margin-right:8px;">
                                    <div class="col-md-8 offset-md-3">
                                        <a class="btn btn-link" href="/portal-de-ajudas/redefinir.php">Esqueceu a sua senha?</a>
                                        <button type="submit" class="btn btn-primary">Entrar</button>
                                    </div>
                                </div>

                                <hr />

                                <div class="row mb-0">
                                    <div class="col-md-12 text-center">
                                        <span>Bloqueado(a)? <a class="btn btn-link" href="/portal-de-ajudas/desbloquear.php" style="margin-top:-5px;">Desbloquear</a><span>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-12 text-center">
                                        <span>Não tem conta? <a class="btn btn-link" href="/portal-de-ajudas/registrar.php" style="margin-top:-5px;">Criar Conta</a><span>
                                    </div>
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
