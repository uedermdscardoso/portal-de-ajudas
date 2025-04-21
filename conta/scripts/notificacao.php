<?php
  
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: /portal-de-ajudas/login.php');
    } 

    $usuario = $_SESSION['user'];

    
    if(isset($_POST['view'])){
        if($_POST['view'] == 'no'){
          $ajudaDao = new AjudaDAO(); 
          $ajudaDao->atualizarStatusDeNotificacao();
        }
    }

    $ajuda[] = new Ajuda(); 
    $ajudaDao = new AjudaDAO();
    $ajuda = $ajudaDao->listarAjudasParaNotificacao();

    $output = '';

    if(count($ajuda) > 0){
      for($i=0; $i<count($ajuda); $i++){
        if($ajuda[$i]->getStatus()->getNomeStatus() == 'Aberto' && $ajuda[$i]->getPessoa()->getCodigo() != $usuario['codigo']){
          $output .= '
          <li class="text-center">
          <a href="/portal-de-ajudas/conta/ajuda/propostas.php?codAjuda='.$ajuda[$i]->getCodigo().'" class="nav-link">
          <strong>'.$ajuda[$i]->getTitulo().'</strong><br />
          <small><em>Ajuda de '.$ajuda[$i]->getPessoa()->getUsuario().'</em></small>
          </a>
          </li>
          ';
        }
      }
    } else {
    $output .= '
    <li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
    }

  $ajuda[] = new Ajuda();
  $ajudaDao = new AjudaDAO();
  $ajuda = $ajudaDao->buscarAjudasCriacaoRecente($usuario['codigo']);
  
  if($ajuda != null){
    $count = count($ajuda);
  } else {
    $count = 0;
  }


  $data = array(
      'notification' => $output,
      'unseen_notification'  => $count == 0 ? 0 : $count
  );

  echo json_encode($data);

?>