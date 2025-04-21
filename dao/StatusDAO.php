<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Status.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php';

	class StatusDAO {

	    function consultarStatusPeloCodigo($codStatus){
	        $sql = "SELECT id,nomeStatus FROM status WHERE id = :id";
	        
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':id',$codStatus,PDO::PARAM_INT);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $status = null; 

	        if (count($obj) > 0) {
	            
                $status = new Status();
                $status->setCodigo($obj[0]->id);
                $status->setNomeStatus($obj[0]->nomeStatus);

	            return $status;

	        }

	        return false;
	    }

	    function consultarStatusPeloNome($nomeStatus){
	        $sql = "SELECT id,nomeStatus FROM status WHERE nomeStatus = :nomeStatus";
	        
	        $st = ConnectionFactory::getInstance()->prepare($sql);
	        $st->bindParam(':nomeStatus',$nomeStatus,PDO::PARAM_STR);
	        $st->execute();
	        
	        $obj = $st->fetchAll(PDO::FETCH_OBJ);
	        
	        $status = null; 

	        if (count($obj) > 0) {
	            
                $status = new Status();
                $status->setCodigo($obj[0]->id);
                $status->setNomeStatus($obj[0]->nomeStatus);

	            return $status;

	        }

	        return false;
	    }
		
	}