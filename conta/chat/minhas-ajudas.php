<?php

    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';


    $proposta[] = new Proposta();
    $propostaDao = new PropostaDAO();



    $ajuda = new Ajuda(); 
    $ajudaDao = new AjudaDAO();
    $ajuda = $ajudaDao->listarAjudasPorCodigoPessoa($usuario['codigo']);

    if($ajuda != 0){
        $proposta = $propostaDao->consultarPropostasPorCodigoAjuda($ajuda[0]->getCodigo());
        
        for($i=0; $i<count($proposta); $i++){

?>
        <div style="border:1px solid black;">
            <p>
                <?= $ajuda[0]->getCodigo().' - Ajuda de '.$ajuda[0]->getPessoa()->getUsuario() ?>
            </p>
            <p>
                <?php
                    $chatId = $proposta[$i]->getChatId();
                    echo $chatId; 
                ?>
            </p>
            <p> 
                <span><?= $proposta[$i]->getCodigo() ?></span> -
                <span><?= $proposta[$i]->getTitulo() ?></span> 
                <?php
                    $u = $proposta[$i]->getPessoa()->getUsuario();
                ?>
            </p>
            <p><button id="teste<?= $i ?>">Clique aqui</button></p>

        </div>
<?php
            echo "
                <script>
                    $(document).ready(function(){
                        $('#teste".$i."').click(function(){
                            $(location).attr('href', '/portal-de-ajudas/conta/chat/chat.php?chatId=".$chatId."&user=".$u."');
                        });
                    });
                </script>
            ";

            }
        }
    $chatId = 0;
    $u = 0;
    
?>