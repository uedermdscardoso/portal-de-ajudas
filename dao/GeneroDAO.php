<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Genero.class.php';

	class GeneroDAO {

		public function __construct(){

		}

		public function retornarGeneroPeloCodigo($codigo){
			$sql = "SELECT id,nomeGenero FROM genero WHERE id = :codigo";
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':codigo',$codigo,PDO::PARAM_INT);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $genero = null;

	        if (count($obj) > 0) {
	            $genero = new Genero();
	            $genero->setCodigo($obj[0]->id);
	            $genero->setNomeGenero($obj[0]->nomeGenero);

	            return $genero;

	        }

	        return false;
		}

		public function consultarGeneroPeloNome($nomeGenero){
			$sql = "SELECT id,nomeGenero FROM genero WHERE nomeGenero = :nomeGenero";
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':nomeGenero',$nomeGenero,PDO::PARAM_STR);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $genero = null;

	        if (count($obj) > 0) {
	            $genero = new Genero();
	            $genero->setCodigo($obj[0]->id);
	            $genero->setNomeGenero($obj[0]->nomeGenero);

	            return $genero;

	        }

	        return false;
		}

	}