<!DOCTYPE html>
<html lang="pt">
<head>
    <meta name="description" content="Portal de Ajudas"/>
    <meta name="author" content="Portal de Ajudas"/>
    <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no" /> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <title>Portal de Ajudas</title> 

    <!-- Scripts -->
    <script src="/portal-de-ajudas/assets/js/jquery-3.1.0.js"></script>
    <script src="/portal-de-ajudas/assets/js/tether.js"></script>
    <script src="/portal-de-ajudas/assets/js/modernizr.js"></script>
    <script src="/portal-de-ajudas/assets/bootstrap/js/bootstrap.min.js"></script>

    <!--  Style  --> 
    <link rel="stylesheet" href="/portal-de-ajudas/assets/bootstrap/css/bootstrap.css" />   

    <link rel="stylesheet" href="/portal-de-ajudas/assets/css/style.css" />   

    <!-- ******* SLIDE --> 
    <script src="/portal-de-ajudas/assets/js/slides/immersive-slider/jquery.immersive-slider.js"></script>
    <link rel="stylesheet" href="/portal-de-ajudas/assets/css/slides/immersive-slider/immersive-slider.css"/>
    <link rel="stylesheet" href="/portal-de-ajudas/assets/css/slides/immersive-slider/style-slider.css" />
    
    <!-- SELECT 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

    <!-- Validação - BootstrapValidator -->
    <link rel="stylesheet" href="/portal-de-ajudas/assets/plugins/bootstrap-validator/css/bootstrapValidator.css"/>
    <link rel="stylesheet" href="/portal-de-ajudas/assets/css/style-validation.css"/>
    <script src="//oss.maxcdn.com/momentjs/2.8.2/moment.min.js"></script>
    <script type="text/javascript" src="/portal-de-ajudas/assets/plugins/bootstrap-validator/js/bootstrapValidator.js"></script>
    <!-- FIM -->

	<!-- Notificação -->
	<link rel="stylesheet" href="/portal-de-ajudas/assets/plugins/jnoty/jnoty.css" />   
	<script src="/portal-de-ajudas/assets/plugins/jnoty/jnoty.js"></script>
	
</head>

<body>

	<script type="text/javascript">
	
		function exibirNotificacao(title,complemento,conteudo,link,link2){
			
			$.jnoty(conteudo+"  "+'<a href="'+link+'">Ver Ajuda</a>', {
				life: 10000,
				header: title+' <a href="'+link2+'">'+complemento+'</a>',
				sticky: false,
				icon: 'fa fa-check-circle',
				position: 'bottom-right',

			});
			
		}
			
	</script>
	

	<?php
		if(!isset($_SESSION)){
			session_start(); 
		}

		if(isset($_SESSION['user'])){
			
			$usuario = $_SESSION['user'];
			
			require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
			require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';
		
			$codPessoa = $usuario['codigo'];
			$ajuda[] = new Ajuda();
			$ajudaDao = new AjudaDAO();
			$ajuda = $ajudaDao->buscarAjudasCriacaoRecente($codPessoa);
		  

			if($ajuda != null){
			  for($i=0; $i<count($ajuda); $i++){
				if($ajuda[$i]->getStatus()->getNomeStatus() == 'Aberto' && $ajuda[$i]->getPessoa()->getCodigo() != $usuario['codigo']){

				$usuario = $ajuda[$i]->getPessoa()->getUsuario();
				 echo '
					<script type="text/javascript">
						exibirNotificacao("Ajuda de ","'.$usuario.'","'.$usuario.' precisa de ajuda!'.'","/portal-de-ajudas/conta/ajuda/propostas.php?codAjuda='.$ajuda[$i]->getCodigo().'","/portal-de-ajudas/conta/pessoa.php?cod='.$ajuda[$i]->getPessoa()->getCodigo().'"); 
					</script>
				  ';
				}
				
			  }
			  $ajudaDao->atualizarStatusDeNotificacao($codPessoa);
			} 
			
		}

	?>


	

