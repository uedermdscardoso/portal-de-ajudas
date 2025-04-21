    <?php
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php';

        include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/header.php');
        include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/nav-principal.php');
        include($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/slide.php'); 
    ?>
    
    <div class="container" style="padding:2em;">

        <hr />
        
        <div class="row">

            <div class="col-12 col-md-6 offset-md-3 col-sm-12 justify-content-center">
                
                <h4>Precisa de alguma coisa?</h4> <br />

                <div style="text-indent:2em;">

                    <p >
                        É fácil e simples. Somente basta publicar uma ajuda
                        para que seja divulgado que o que necessita e receber 
                        propostas de outras pesssoas. 
                    </p>

                    <p>
                        Independentemente de ajuda, haverá uma pessoa que tenha a disponibilidade de ajudá-lo. 
                    </p>

                    <p>
                        Tipos de ajudas pode ser como alguem que precisa de cadeira de rodas ou de algum voluntário para realização de alguma tarefa. 
                    <p>
                        Para a comunicação entre as partes envolvidas, há
                        um chat em tempo real para que possam trocar
                        mensagens.
                    </p>

                 </div>

            </div>

        </div>

        <hr />

        <div class="row text-center" style="padding-top:2em; padding-bottom:1em;">

            <div class="col-12 col-md-12 col-sm-12">
                <h4>Navegue pelas categorias</h4>
            </div>
        </div>

        <div class="row" style="padding-top:1em; padding-bottom:2em;">

            <div class="col-12 col-md-8 offset-md-3 col-sm-12">
                <?php include('bloco-categoria.php'); ?>
            </div>

        </div>

        <hr/>

        <div class="row text-center" style="padding-top:2em;">

            <div class="col-12 col-md-12 col-sm-12">
                <h4>Navegue pelas Ajudas</h4>
            </div>

        </div>

        <div class="row text-center" style="padding-top:2em; padding-bottom:2em;">

            <?php include('bloco-ajuda.php'); ?>

        </div>

        <hr />

        <div class="row text-center" style="padding-top:2em; padding-bottom:2em;">

            <div class="col-12 col-md-4 col-sm-12" style="margin-bottom:1em;">
                
                <!-- card-->
                <div class="card text-md-center text-sm-center text-xs-center">

                    <div class="card-block" style="padding:1em;">

                        <img src="assets/images/plataforma/pessoas.png" width="100em" height="auto" /> 
                        <h1>
                            <?php
                                $pessoaDao = new PessoaDAO(); 
                                echo $pessoaDao->totalPessoas();
                            ?>
                        </h1><!--Total de Pessoas-->
                        <h5>Pessoas</h5>

                    </div>

                </div>

            </div>

            <div class="col-12 col-md-4 col-sm-12" style="margin-bottom:1em;">

                <!-- card-->
                <div class="card text-md-center text-sm-center text-xs-center">

                    <div class="card-block" style="padding:1em;">
                        <img src="assets/images/plataforma/ajudas.png" width="100em" height="auto" /> 
                        <h1>
                            <?php
                                $ajudaDao = new AjudaDAO(); 
                                echo $ajudaDao->totalAjudas();
                            ?>
                        </h1><!--Total de Ajudas-->
                        <h5>Ajudas</h5>
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-4 col-sm-12">

                <!-- card-->
                <div class="card text-md-center text-sm-center text-xs-center">

                    <div class="card-block" style="padding:1em;">
                        <img src="assets/images/plataforma/propostas.png" width="100em" height="auto" />  
                        <h1>
                            <?php
                                $propostaDao = new PropostaDAO();
                                echo $propostaDao->totalPropostas();
                            ?>
                        </h1><!--Total de Propostas-->
                        <h5>Propostas</h5>
                    </div>

                </div>

            </div>


        </div>

        <hr />

    </div>

    <?php include('footer.php'); ?>

</body>
</html>