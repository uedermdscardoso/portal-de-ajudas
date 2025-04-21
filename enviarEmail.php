<?php
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php');
	require_once($_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php');

	function enviarEmail($titulo,$email,$destino,$assunto,$msg){

		// É necessário indicar que o formato do e-mail é html
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
		$headers .= 'From: '.$titulo.' <'.$email.'>';

		$enviarEmail = mail($destino, $assunto, $msg, $headers);

		if($enviarEmail){
			return true;
		} else {
			return false;
		}

	}
	
?>

	