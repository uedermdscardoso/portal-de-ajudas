   <?php 
        if (!isset($_SESSION)){
            session_start();
        }

        if(isset($_SESSION['user'])){
            $usuario = $_SESSION['user'];

        } else {
            $usuario = null;
        }

        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';

    ?>

    <style type="text/css">
        .no-arrow::after { 
            display:none; 
        }
    </style>

    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">

            <!--
                brand é logomarca
            -->  
            <a href="/portal-de-ajudas/" class="navbar-brand" id="alinharLogotipo" style="color:black; margin-right:2em;">
                <img src="/portal-de-ajudas/assets/images/volunteer_icon.png" style="width:30px; height:auto;" class="d-inline-block align-top">  Portal de Ajudas
            </a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-sanduiche" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-sanduiche">
                        
                            
                <ul class="nav navbar-nav mr-auto">

                    <li class="nav-item alinharMenus">
                        <a href="/portal-de-ajudas/objetivos.php" class="nav-link" style="color:black;">Objetivos</a>
                    </li>
                    
                    <li class="nav-item alinharMenus">
                        <a href="/portal-de-ajudas/como-funciona.php" class="nav-link" style="color:black;">Como funciona</a>
                    </li>

                    <li class="nav-item alinharMenus">
                        <a href="/portal-de-ajudas/contato.php" class="nav-link" style="color:black;">Contato</a>
                    </li>
                    
                </ul>

                <ul class="nav navbar-nav">
                <?php if($usuario != null ){ ?>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" style="margin-top:0.5em;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            
                            <?php
                                $pessoa = new Pessoa();
                                $pessoaDao = new PessoaDAO();

                                $pessoa = $pessoaDao->consultarPessoaPorCodigo($usuario['codigo']);
                            ?>
                            <img src="/portal-de-ajudas/<?= $pessoa->getPathFotoPerfil() ?>" width="20px" height="auto" />
            
                            <?= $usuario['usuario']; ?> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a href="/portal-de-ajudas/conta/conta.php" class="dropdown-item" style="color:black;">
                                <img src="/portal-de-ajudas/assets/images/icones/icone_conta.png" width="20em" height="auto" style="margin-right:1em;" />
                                Conta
                            </a>     
                            <div class="dropdown-divider"></div>
                            
                            <a href="/portal-de-ajudas/conta/perfil.php" class="dropdown-item" style="color:black;">
                                <img src="/portal-de-ajudas/assets/images/icones/icone_perfil.png" width="20em" height="auto" style="margin-right:1em;" />
                                Perfil
                            </a>
                            <div class="dropdown-divider"></div>
                            
                            <a href="/portal-de-ajudas/conta/config/config.php" class="dropdown-item" style="color:black;">
                                <img src="/portal-de-ajudas/assets/images/icones/icone_config.png" width="20em" height="auto" style="margin-right:1em;" />
                                Configurações
                            </a>
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="/portal-de-ajudas/sair.php">
                                <img src="/portal-de-ajudas/assets/images/icones/icone_sair.png" width="20em" height="auto" style="margin-right:1em;" />
                                Sair
                            </a>
                        </div>
                    </li>



                <?php } else { ?>

                    <li class="nav-item" style="margin-top:0.5em;">
                        <a href="/portal-de-ajudas/login.php" class="nav-link" style="color:black;">Entrar</a>
                    </li>
                    <li class="nav-item" style="margin-top:0.5em;">
                        <a href="/portal-de-ajudas/registrar.php" class="nav-link" style="color:black;">Registra-se</a>
                    </li>

                <?php } ?>

                    <li class="nav-item" style="margin-top:0.1em;">
                        <a href="/portal-de-ajudas/conta/publicar.php" class="nav-link"><button class="btn btn-success">Publique uma Ajuda</button></a>
                    </li>

                </ul>



                
            </div>
        </div>
    </nav>

