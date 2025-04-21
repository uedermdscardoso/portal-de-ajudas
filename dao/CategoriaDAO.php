<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php'; //dao

	class CategoriaDAO {

		function retornarCodigoCategoriaPorNome($nomeCategoria){
	        $sql = "SELECT id FROM categoria WHERE nomeCategoria = :nomeCategoria ";
	        
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':nomeCategoria',$nomeCategoria,PDO::PARAM_STR);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $categoria = null; 

	        if (count($obj) > 0) {

	            return $obj[0]->id;

	        }

	        return false;
		}

		function listarCategoriaPorNome($nomeCategoria){
	        $sql = "SELECT id,nomeCategoria FROM categoria WHERE nomeCategoria = :nomeCategoria ";
	        
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':nomeCategoria',$nomeCategoria,PDO::PARAM_STR);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $categoria = null; 

	        if (count($obj) > 0) {

	            $categoria = new Categoria();
	            $categoria->setCodigo($obj[0]->id);
	            $categoria->setNomeCategoria($obj[0]->nomeCategoria);

	            return $categoria;

	        }

	        return false;
		}


		function retornarCategoriaPorCodigoAjuda($codAjuda){
	        $sql = "SELECT c.id AS '
	        id',c.nomeCategoria AS 'nomeCategoria' FROM categoria c INNER JOIN ajuda_categoria ac ON ac.categoria_id = c.id WHERE ac.ajuda_id = :codAjuda ";
	        
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':codAjuda',$codAjuda,PDO::PARAM_INT);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $categoria = null; 

	        if (count($obj) > 0) {

	            $categoria = new Categoria();
	            $categoria->setCodigo($obj[0]->id);
	            $categoria->setNomeCategoria($obj[0]->nomeCategoria);

	            return $categoria;

	        }

	        return false;
		}

		function listarCategorias(){
			$sql = "SELECT id,nomeCategoria FROM categoria";
	        $stmt = ConnectionFactory::getInstance()->prepare($sql);
	        $stmt->execute();
	        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

	        $categorias = null;
	        
	        foreach ($resultado as $c) {
	            $categorias[] = $this->preencheCategoria($c);
	        }
	        return $categorias;
		}
    
	    function preencheCategoria($res) {
	        $categoria = new Categoria();
	        $categoria->setCodigo($res->id);
	        $categoria->setNomeCategoria($res->nomeCategoria);
	        return $categoria;
	    }


	}