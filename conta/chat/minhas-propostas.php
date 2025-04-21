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



    $proposta = $propostaDao->listarPropostasPorCodigoPessoa($usuario['codigo']);

    if($proposta != null){ //Não publicou a proposta
        
        $chatId = $proposta[0]->getChatId();
        //echo $chatId;
        for($i=0; $i<count($proposta); $i++){
?>
            <input type="hidden" id="chatId" value="<?= $chatId ?>" />
            <div style="border:1px solid black;">
                <p><?= $proposta[$i]->getAjuda()->getCodigo().' - Ajuda de '.$proposta[$i]->getAjuda()->getPessoa()->getUsuario() ?></p>
                <p><?= $proposta[$i]->getChatId() ?></p>
                <p><?= $proposta[$i]->getCodigo() ?> - Proposta de <?= $proposta[$i]->getPessoa()->getUsuario() ?></p>
                <p><button id="test<?= $i ?>">Clique aqui</button></p>
            </div>
<?php
            $u = $proposta[$i]->getAjuda()->getPessoa()->getUsuario();
         
            echo "
                <script>
                    $(document).ready(function(){
                        $('#test".$i."').click(function(){
                            $(location).attr('href', '/portal-de-ajudas/conta/chat/chat.php?chatId=".$chatId."&user=".$u."');
                        });
                    });
                </script>
            ";

        }

    } 
?>
<br />