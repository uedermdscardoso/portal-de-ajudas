<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';
	
	header('Content-type: application/json');


	$categorias[] = new Categoria(); 
	$categoriaDao = new CategoriaDAO();

	$categorias = $categoriaDao->listarCategorias();

	for($i=0; $i<count($categorias); $i++){
		
		$c[$i]["id"] = $categorias[$i]->getCodigo(); 
		$c[$i]["nomeCategoria"] = $categorias[$i]->getNomeCategoria(); 

	}

	echo json_encode($c);
	

?>