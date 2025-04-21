<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Ajuda.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Categoria.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Status.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Proposta.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PessoaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/PropostaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/CategoriaDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/StatusDAO.php';

class AjudaDAO {

    //Buscar ajudas a partir do código de um usuário
    function listarAjudasPorCodigoPessoa($codPessoa){

        $sql = "SELECT a.id,a.titulo,a.pathAnexo,a.descricao,a.dataCriacao,a.dataTermino,a.pessoa_id,a.status_id FROM ajuda a 
    INNER JOIN pessoa p ON p.id = a.pessoa_id
    WHERE p.id = :codigo;";

        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':codigo',$codPessoa,PDO::PARAM_INT);
        $st->execute();
        
        $resultado = $st->fetchAll(PDO::FETCH_OBJ);

        $ajudas = null;
        
        if(count($resultado) > 0){
            foreach ($resultado as $a) {
                $ajudas[] = $this->preencheAjuda($a);
            }
            return $ajudas;
        }  

        return null;
    }

	function listarAjudas(){
		$sql = "SELECT id,titulo,pathAnexo,descricao,dataCriacao,dataTermino,pessoa_id,status_id FROM ajuda";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

        $ajudas = null;
        
        foreach ($resultado as $a) {
            $ajudas[] = $this->preencheAjuda($a);
        }
        return $ajudas;
	}

    function listarAjudasDoRecenteAoMaisAntigo(){
        $sql = "SELECT id,titulo,pathAnexo,descricao,dataCriacao,dataTermino,pessoa_id,status_id FROM ajuda ORDER BY id DESC";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

        $ajudas = null;
        
        foreach ($resultado as $a) {
            $ajudas[] = $this->preencheAjuda($a);
        }
        return $ajudas;
    }

    function preencheAjuda($res) {
        $ajuda = new Ajuda();
        $ajuda->setCodigo($res->id);
        $ajuda->setTitulo($res->titulo);
        $ajuda->setPathAnexo($res->pathAnexo);
        $ajuda->setDescricao($res->descricao);
        $ajuda->setDataCriacao($res->dataCriacao);
        $ajuda->setDataTermino($res->dataTermino);

        $pessoa = new Pessoa(); 
        $pessoaDao = new PessoaDAO();
        $pessoa = $pessoaDao->consultarPessoaPorCodigo($res->pessoa_id);
        $ajuda->setPessoa($pessoa);

        $status = new Status();
        $statusDao = new StatusDAO();
        $status = $statusDao->consultarStatusPeloCodigo($res->status_id);
        $ajuda->setStatus($status);

        $categoria = $this->buscarCategoriasPorCodigoAjuda($ajuda->getCodigo());
        $ajuda->setCategoria($categoria);

        return $ajuda;
    }


    function buscarCategoriasPorCodigoAjuda($codAjuda){
        $sql = "SELECT c.id,c.nomeCategoria FROM categoria c INNER JOIN ajuda_categoria ac ON ac.categoria_id = c.id INNER JOIN ajuda a ON a.id = ac.ajuda_id WHERE a.id = :codigo ";
        
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':codigo',$codAjuda,PDO::PARAM_INT);
        $st->execute();
        
        $obj = $st->fetchAll(PDO::FETCH_OBJ);
        
        $categoria = null; 

        if (count($obj) > 0) {
            
            for($i=0; $i<count($obj); $i++){
                $categoria[$i] = new Categoria();
                $categoria[$i]->setCodigo($obj[$i]->id);
                $categoria[$i]->setNomeCategoria($obj[$i]->nomeCategoria);
            }

            return $categoria;

        }

        return false;
    }



    function consultarAjudaPorCodigo($codigo){
        $sql = "SELECT id,titulo,descricao,pathAnexo,dataCriacao,dataTermino,pessoa_id,status_id FROM ajuda WHERE id = :id";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':id',$codigo,PDO::PARAM_INT);
        $st->execute();
        
        $p = $st->fetchAll(PDO::FETCH_OBJ);
        
        $ajuda = null; 
        $pessoa = null;
        $status = null;

        if (count($p) > 0) {
            $ajuda = new Ajuda(); 
            $ajuda->setCodigo($p[0]->id);
            $ajuda->setTitulo($p[0]->titulo);
            $ajuda->setDescricao($p[0]->descricao);
            $ajuda->setPathAnexo($p[0]->pathAnexo);
            $ajuda->setDataCriacao($p[0]->dataCriacao);
            $ajuda->setDataTermino($p[0]->dataTermino);

            $pessoa = new Pessoa();
            $pessoaDao = new PessoaDAO(); 
            $pessoa = $pessoaDao->consultarPessoaPorCodigo($p[0]->pessoa_id);
            $ajuda->setPessoa($pessoa);

            $status = new Status();
            $status->setCodigo($p[0]->status_id);
            $ajuda->setStatus($status);

            $categoria = $this->buscarCategoriasPorCodigoAjuda($ajuda->getCodigo());
            $ajuda->setCategoria($categoria);

            return $ajuda;
        }

        return false;
    }

    //Buscas as propostas de uma determinada ajuda
    function buscarPropostasPorCodigoAjuda($codAjuda){
        $sql = "SELECT p.id,p.titulo,p.descricao,p.pessoa_id,p.ajuda_id FROM proposta p 
    INNER JOIN ajuda a ON a.id = p.ajuda_id
    WHERE a.id = :codigo;";
        
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':codigo',$codAjuda,PDO::PARAM_INT);
        $st->execute();
        
        $obj = $st->fetchAll(PDO::FETCH_OBJ);
        
        $proposta = null; 
        $pessoa = null;
        $ajuda = null;

        if (count($obj) > 0) {
            
            for($i=0; $i<count($obj); $i++){
                $proposta[$i] = new Proposta();
                $proposta[$i]->setCodigo($obj[$i]->id);
                $proposta[$i]->setTitulo($obj[$i]->titulo);
                $proposta[$i]->setDescricao($obj[$i]->descricao);

                $pessoa = new Pessoa();
                $pessoaDao = new PessoaDAO(); 
                $pessoa = $pessoaDao->consultarPessoaPorCodigo($obj[$i]->pessoa_id);
                $proposta[$i]->setPessoa($pessoa);

                $ajuda = new Ajuda();
                $ajuda = $this->consultarAjudaPorCodigo($obj[$i]->ajuda_id);
                $proposta[$i]->setAjuda($ajuda);


            }

            return $proposta;

        }

        return false;
    }



    function totalAjudas(){
        $sql = "SELECT COUNT(id) AS 'total' FROM ajuda";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $res[0]->total;
    }

    //Operações de Cadastro
    function inserirAjuda($ajuda){
        $sql = "INSERT INTO ajuda(id,titulo,descricao,pathAnexo,dataCriacao,dataTermino,pessoa_id,status_id) VALUES(:id,:titulo, :descricao, :pathAnexo, :dataCriacao, :dataTermino, :pessoa_id, :status_id)";

        $stmt = ConnectionFactory::getInstance()->prepare($sql);

        $ajuda->setCodigo($this->totalAjudas()+1); 
        
        $ret = $stmt->execute([
                ':id' => $ajuda->getCodigo(),
                ':titulo' => $ajuda->getTitulo(),
                ':descricao' => $ajuda->getDescricao(),
                ':pathAnexo' => $ajuda->getPathAnexo(),
                ':dataCriacao' => $ajuda->getDataCriacao(),
                ':dataTermino' => $ajuda->getDataTermino(),
                ':pessoa_id' => $ajuda->getPessoa()->getCodigo(),
                ':status_id' => $ajuda->getStatus()->getCodigo()
            ]);

        $this->vincularCategoriaAjuda($ajuda);

    }

    function vincularCategoriaAjuda($ajuda){
        $sql = "INSERT INTO ajuda_categoria(ajuda_id,categoria_id) VALUES(:ajuda_id, :categoria_id)";

        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $tam = count($ajuda->getCategoria());

        for($i=0; $i<$tam; $i++){
            $ret = $stmt->execute([
                    ':ajuda_id' => $ajuda->getCodigo(),
                    ':categoria_id' => $ajuda->getCategoria()[$i]->getCodigo()
                ]);
        }

    }

    function atualizarStatusAjuda($ajuda){
        $sql = "UPDATE ajuda SET status_id = :status_id WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $ajuda->getCodigo(),
                    ':status_id' => $ajuda->getStatus()->getCodigo()
                )
            );

        //Acertar categorias
        $this->atualizarCategoriasAjuda($ajuda);

        return $ret;

    }

    function atualizarAjuda($ajuda){
        $sql = "UPDATE ajuda SET titulo = :titulo, dataTermino = :dataTermino, descricao = :descricao WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $ajuda->getCodigo(),
                    ':titulo' => $ajuda->getTitulo(),
                    ':dataTermino' => $ajuda->getDataTermino(),
                    ':descricao' => $ajuda->getDescricao()
                )
            );

        //Acertar categorias
        $this->atualizarCategoriasAjuda($ajuda);

        return $ret;

    }

    function atualizarCategoriasAjuda($ajuda){
        //Remover as categorias que foram retiradas
        $this->removerCategoriasDaAjuda($ajuda);
        $this->vincularCategoriaAjuda($ajuda);
    }

    function removerCategoriasDaAjuda($ajuda){
        $sql = "DELETE FROM ajuda_categoria WHERE (ajuda_id = :ajuda_id) and (categoria_id = :categoria_id)";

        $codAjuda = $ajuda->getCodigo();

        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':ajuda_id',$codAjuda,PDO::PARAM_INT);
        
        //Categorias registradas
        $categ_novo[] = new Categoria();
        $categ_reg[] = new Categoria();
        $categoriaDao = new CategoriaDAO();

        $categ_reg = $categoriaDao->listarCategorias();
        $categ_novo = $ajuda->getCategoria();

        for($i=0; $i<count($categ_reg); $i++){

            $codCategoria = $categ_reg[$i]->getCodigo();

            $st->bindParam(':categoria_id',$codCategoria,PDO::PARAM_INT);
            $st->execute();

        }
    }

    function excluirAjuda($codAjuda){
        
        $sql = "DELETE FROM ajuda WHERE id = :id";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':id',$codAjuda,PDO::PARAM_INT);
        $st->execute();

    }









    function atualizarStatusDeNotificacao($codPessoa){
        $sql = "UPDATE ajuda SET notificacao_status = :notificacao_status WHERE notificacao_status = 0 and pessoa_id != :codPessoa";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->bindParam(':codPessoa',$codPessoa,PDO::PARAM_INT);
        $ret = $stmt->execute(
                array(
					':codPessoa' => $codPessoa,
                    ':notificacao_status' => 1
                )
            );
        
        return $ret;

    }

    function listarAjudasParaNotificacao(){
        $sql = "SELECT id,titulo,pathAnexo,descricao,dataCriacao,dataTermino,pessoa_id,status_id FROM ajuda ORDER BY id DESC LIMIT 5";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

        $ajudas = null;
        
        foreach ($resultado as $a) {
            $ajudas[] = $this->preencheAjuda($a);
        }
        return $ajudas;
    }

    function buscarAjudasCriacaoRecente($codPessoa){
        $sql = "SELECT a.id,a.titulo,a.pathAnexo,a.descricao,a.dataCriacao,a.dataTermino,a.pessoa_id,a.status_id FROM ajuda a 
    INNER JOIN pessoa p ON p.id = a.pessoa_id
    WHERE a.notificacao_status = 0 and a.pessoa_id != :codPessoa;";

        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':codPessoa',$codPessoa,PDO::PARAM_INT);
        $st->execute();
        
        $resultado = $st->fetchAll(PDO::FETCH_OBJ);

        $ajudas = null;
        
        if(count($resultado) > 0){
            foreach ($resultado as $a) {
                $ajudas[] = $this->preencheAjuda($a);
            }
            return $ajudas;
        }  

        return null;
    }


}