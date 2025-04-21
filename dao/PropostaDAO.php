<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/AjudaDAO.php';

class PropostaDAO {

    //Buscar propostas a partir do código de uma pessoa
    function listarPropostasPorCodigoPessoa($codPessoa){

        $sql = "SELECT p.id,p.titulo,p.descricao,p.dataCriacao,p.pessoa_id,p.ajuda_id FROM proposta p 
    INNER JOIN pessoa pe ON pe.id = p.pessoa_id
    WHERE pe.id = :codigo;";

        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':codigo',$codPessoa,PDO::PARAM_INT);
        $st->execute();
        
        $resultado = $st->fetchAll(PDO::FETCH_OBJ);

        $propostas = null;
        
        if(count($resultado) > 0){
            foreach ($resultado as $p) {
                $propostas[] = $this->preencheProposta($p);
            }
            return $propostas;
        }  

        return null;
    }

    //Buscar propostas a partir do código de uma ajuda
    function consultarPropostasPorCodigoAjuda($codAjuda){

        $sql = "SELECT p.id,p.titulo,p.descricao,p.dataCriacao,p.pessoa_id,p.ajuda_id FROM proposta p 
    INNER JOIN pessoa pe ON pe.id = p.pessoa_id
    INNER JOIN ajuda a ON a.id = p.ajuda_id
    WHERE a.id = :codigo;";

        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':codigo',$codAjuda,PDO::PARAM_INT);
        $st->execute();
        
        $resultado = $st->fetchAll(PDO::FETCH_OBJ);

        $propostas = null;
        
        if(count($resultado) > 0){
            foreach ($resultado as $p) {
                $propostas[] = $this->preencheProposta($p);
            }
            return $propostas;
        }  

        return null;
    }

	function listarPropostas(){
		$sql = "SELECT id,titulo,descricao,dataCriacao,pessoa_id,ajuda_id FROM proposta";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

        $propostas = null;
        
        foreach ($resultado as $p) {
            $propostas[] = $this->preencheProposta($p);
        }
        return $propostas;
	}

    function consultarPropostaPorCodigo($codigo){
        $sql = "SELECT id,titulo,descricao,dataCriacao,pessoa_id,ajuda_id FROM proposta WHERE id = :id";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':id',$codigo,PDO::PARAM_INT);
        $st->execute();
        
        $p = $st->fetchAll(PDO::FETCH_OBJ);
        
        $proposta = null; 
        $pessoa = null;
        $ajuda = null;

        if (count($p) > 0) {
            $proposta = new Proposta(); 
            $proposta->setCodigo($p[0]->id);
            $proposta->setTitulo($p[0]->titulo);
            $proposta->setDescricao($p[0]->descricao);
            $proposta->setDataCriacao($p[0]->dataCriacao);

            $pessoa = new Pessoa();
            $pessoaDao = new PessoaDAO(); 
            $pessoa = $pessoaDao->consultarPessoaPorCodigo($p[0]->pessoa_id);
            $proposta->setPessoa($pessoa);

            $ajuda = new Ajuda(); 
            $ajudaDao = new AjudaDAO();
            $ajuda = $ajudaDao->consultarAjudaPorCodigo($p[0]->ajuda_id);
            $proposta->setAjuda($ajuda);

            return $proposta;
        }

        return false;
    }


    function inserirProposta($proposta){
        $sql = "INSERT INTO proposta(titulo,descricao,dataCriacao,pessoa_id,ajuda_id) VALUES(:titulo, :descricao, :dataCriacao, :pessoa_id, :ajuda_id)";

        $stmt = ConnectionFactory::getInstance()->prepare($sql);

        $ret = $stmt->execute([
                ':titulo' => $proposta->getTitulo(),
                ':descricao' => $proposta->getDescricao(),
                ':dataCriacao' => $proposta->getDataCriacao(),
                ':pessoa_id' => $proposta->getPessoa()->getCodigo(),
                ':ajuda_id' => $proposta->getAjuda()->getCodigo()
            ]);

    }

    function atualizarProposta($proposta){
        $sql = "UPDATE proposta SET titulo = :titulo, descricao = :descricao WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $proposta->getCodigo(),
                    ':titulo' => $proposta->getTitulo(),
                    ':descricao' => $proposta->getDescricao()
                )
            );
        return $ret;
    }

    function excluirProposta($codProposta){
        
        $sql = "DELETE FROM proposta WHERE id = :id";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':id',$codProposta,PDO::PARAM_INT);
        $st->execute();

    }

    function preencheProposta($res) {
        $proposta = new Proposta();
        $proposta->setCodigo($res->id);
        $proposta->setTitulo($res->titulo);
        $proposta->setDescricao($res->descricao);
        $proposta->setDataCriacao($res->dataCriacao);

        $pessoa = new Pessoa(); 
        $pessoaDao = new PessoaDAO();
        $pessoa = $pessoaDao->consultarPessoaPorCodigo($res->pessoa_id);
        $proposta->setPessoa($pessoa);

        $ajuda = new Ajuda();
        $ajudaDao = new AjudaDAO();
        $ajuda = $ajudaDao->consultarAjudaPorCodigo($res->ajuda_id);
 		$proposta->setAjuda($ajuda);


   		return $proposta;

	}



	function totalPropostas(){
        $sql = "SELECT COUNT(id) AS 'total' FROM proposta";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $res[0]->total;
    }

}