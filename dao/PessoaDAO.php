<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Pessoa.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/models/Genero.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/ConnectionFactory.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/portal-de-ajudas/dao/GeneroDAO.php';

class PessoaDAO {

    function listarPessoas(){
        $sql = "SELECT id,nomeCompleto,dataNascimento,pathFotoPerfil,genero_id,tel_ddd,tel_numero,logradouro,numero,complemento,bairro,estado,cidade,pontoReferencia,usuario,email,senha,tokenBloqueio FROM pessoa";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $pessoas = null;
        
        foreach ($resultado as $p) {
            $pessoas[] = $this->preenchePessoa($p);
        }
        return $pessoas;
    }

    function preenchePessoa($res){
        $pessoa = new Pessoa(); 
        $pessoa->setCodigo($res->id);
        $pessoa->setNomeCompleto($res->nomeCompleto);
        
        if(!empty($res->biografia)){
            $pessoa->setBiografia($res->biografia);
        }

        $pessoa->setDataNascimento($res->dataNascimento);
        $pessoa->setPathFotoPerfil($res->pathFotoPerfil);

        $pessoa->setTelDdd($res->tel_ddd);
        $pessoa->setTelNumero($res->tel_numero);

        $pessoa->setLogradouro($res->logradouro);
        $pessoa->setNumero($res->numero);
        $pessoa->setComplemento($res->complemento);
        $pessoa->setBairro($res->bairro);
        $pessoa->setEstado($res->estado);
        $pessoa->setCidade($res->cidade);
        
        if(!empty($res->pontoReferencia)){
            $pessoa->setPontoReferencia($res->pontoReferencia);
        }

        $pessoa->setUsuario($res->usuario);
        $pessoa->setEmail($res->email);
        $pessoa->setSenha($res->senha);


        $genero = new Genero();
        $generoDAO = new GeneroDAO();
        $genero = $generoDAO->retornarGeneroPeloCodigo($res->genero_id);
        $pessoa->setGenero($genero);

        if(!empty($res->tokenBloqueio)){
            $pessoa->setTokenBloqueio($res->tokenBloqueio);
        }

        return $pessoa;
    }

	function consultarPessoaPorCodigo($codigo){
		$sql = "SELECT id,nomeCompleto,biografia,dataNascimento,pathFotoPerfil,genero_id,tel_ddd,tel_numero,logradouro,numero,complemento,bairro,estado,cidade,pontoReferencia,usuario,email,senha,tokenBloqueio FROM pessoa WHERE id = :id";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':id',$codigo,PDO::PARAM_INT);
        $st->execute();
        
        $p = $st->fetchAll(PDO::FETCH_OBJ);
        
        $pessoa = null; 

        if (count($p) > 0) {
            $pessoa = new Pessoa(); 
            $pessoa->setCodigo($p[0]->id);
            $pessoa->setNomeCompleto($p[0]->nomeCompleto);
            
            if(!empty($p[0]->biografia)){
                $pessoa->setBiografia($p[0]->biografia);
            }

            $pessoa->setDataNascimento($p[0]->dataNascimento);
            $pessoa->setPathFotoPerfil($p[0]->pathFotoPerfil);

            $pessoa->setTelDdd($p[0]->tel_ddd);
            $pessoa->setTelNumero($p[0]->tel_numero);

            $pessoa->setLogradouro($p[0]->logradouro);
            $pessoa->setNumero($p[0]->numero);
            $pessoa->setComplemento($p[0]->complemento);
            $pessoa->setBairro($p[0]->bairro);
            $pessoa->setEstado($p[0]->estado);
            $pessoa->setCidade($p[0]->cidade);
            
            if(!empty($p[0]->pontoReferencia)){
                $pessoa->setPontoReferencia($p[0]->pontoReferencia);
            }

            $pessoa->setUsuario($p[0]->usuario);
            $pessoa->setEmail($p[0]->email);
            $pessoa->setSenha($p[0]->senha);


            $genero = new Genero();
            $generoDAO = new GeneroDAO();
            $genero = $generoDAO->retornarGeneroPeloCodigo($p[0]->genero_id);
            $pessoa->setGenero($genero);

            if(!empty($p[0]->tokenBloqueio)){
                $pessoa->setTokenBloqueio($p[0]->tokenBloqueio);
            }

            return $pessoa;
        }

        return false;
	}

	function consultarPessoaPeloEmail($email){
		$sql = "SELECT id,nomeCompleto,biografia,dataNascimento,pathFotoPerfil,genero_id,tel_ddd,tel_numero,logradouro,numero,complemento,bairro,estado,cidade,pontoReferencia,usuario,email,senha,tokenBloqueio FROM pessoa WHERE email = :email";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':email',$email,PDO::PARAM_STR);
        $st->execute();        $p = $st->fetchAll(PDO::FETCH_OBJ);
        $pessoa = null;         
		
		if (count($p) > 0) {            
			$pessoa = new Pessoa();            
			$pessoa->setCodigo($p[0]->id);
            $pessoa->setNomeCompleto($p[0]->nomeCompleto);
			
			if(!empty($p[0]->biografia)){
                $pessoa->setBiografia($p[0]->biografia);
			}     
			
			$pessoa->setDataNascimento($p[0]->dataNascimento);
            $pessoa->setPathFotoPerfil($p[0]->pathFotoPerfil);
            $pessoa->setTelDdd($p[0]->tel_ddd);
            $pessoa->setTelNumero($p[0]->tel_numero);
            $pessoa->setLogradouro($p[0]->logradouro);
            $pessoa->setNumero($p[0]->numero);
            $pessoa->setComplemento($p[0]->complemento);
            $pessoa->setBairro($p[0]->bairro);
            $pessoa->setEstado($p[0]->estado);
            $pessoa->setCidade($p[0]->cidade);
			
            if(!empty($p[0]->pontoReferencia)){
                $pessoa->setPontoReferencia($p[0]->pontoReferencia);
			}    
			
			$pessoa->setUsuario($p[0]->usuario);
            $pessoa->setEmail($p[0]->email);
            $pessoa->setSenha($p[0]->senha);
			
			
            $genero = new Genero();
            $generoDAO = new GeneroDAO();
            $genero = $generoDAO->retornarGeneroPeloCodigo($p[0]->genero_id);
            $pessoa->setGenero($genero);

            if(!empty($p[0]->tokenBloqueio)){
                $pessoa->setTokenBloqueio($p[0]->tokenBloqueio);
            }

            return $pessoa;
		}        
		
		return null;
	}	

    function consultarPessoaPeloToken($tokenBloqueio){
        $sql = "SELECT id,nomeCompleto,biografia,dataNascimento,pathFotoPerfil,genero_id,tel_ddd,tel_numero,logradouro,numero,complemento,bairro,estado,cidade,pontoReferencia,usuario,email,senha,tokenBloqueio FROM pessoa WHERE tokenBloqueio = :tokenBloqueio";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':tokenBloqueio',$tokenBloqueio,PDO::PARAM_STR);
        $st->execute();        $p = $st->fetchAll(PDO::FETCH_OBJ);
        $pessoa = null;         
        
        if (count($p) > 0) {            
            $pessoa = new Pessoa();            
            $pessoa->setCodigo($p[0]->id);
            $pessoa->setNomeCompleto($p[0]->nomeCompleto);
            
            if(!empty($p[0]->biografia)){
                $pessoa->setBiografia($p[0]->biografia);
            }     
            
            $pessoa->setDataNascimento($p[0]->dataNascimento);
            $pessoa->setPathFotoPerfil($p[0]->pathFotoPerfil);
            $pessoa->setTelDdd($p[0]->tel_ddd);
            $pessoa->setTelNumero($p[0]->tel_numero);
            $pessoa->setLogradouro($p[0]->logradouro);
            $pessoa->setNumero($p[0]->numero);
            $pessoa->setComplemento($p[0]->complemento);
            $pessoa->setBairro($p[0]->bairro);
            $pessoa->setEstado($p[0]->estado);
            $pessoa->setCidade($p[0]->cidade);
            
            if(!empty($p[0]->pontoReferencia)){
                $pessoa->setPontoReferencia($p[0]->pontoReferencia);
            }    
            
            $pessoa->setUsuario($p[0]->usuario);
            $pessoa->setEmail($p[0]->email);
            $pessoa->setSenha($p[0]->senha);
            
            
            $genero = new Genero();
            $generoDAO = new GeneroDAO();
            $genero = $generoDAO->retornarGeneroPeloCodigo($p[0]->genero_id);
            $pessoa->setGenero($genero);

            if(!empty($p[0]->tokenBloqueio)){
                $pessoa->setTokenBloqueio($p[0]->tokenBloqueio);
            }

            return $pessoa;
        }        
        
        return null;
    }   
	
    function verificarSeUsuarioExiste($usuario){
        $sql = "SELECT COUNT(id) AS 'count' FROM pessoa WHERE usuario = :usuario";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':usuario',$usuario,PDO::PARAM_STR);
        $st->execute();
        
        $p = $st->fetchAll(PDO::FETCH_OBJ);
        
        $pessoa = null; 

        if (count($p) > 0) {
            return $p[0]->count;
        }

        return false;
    }

    function verificarSeEmailExiste($email){
        $sql = "SELECT COUNT(id) AS 'count' FROM pessoa WHERE email = :email";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':email',$email,PDO::PARAM_STR);
        $st->execute();
        
        $p = $st->fetchAll(PDO::FETCH_OBJ);
        
        $pessoa = null; 

        if (count($p) > 0) {
            return $p[0]->count;
        }

        return false;
    }


	function inserirDadosBasicosPessoa(Pessoa $pessoa){
		$sql = "INSERT INTO pessoa(id,nomeCompleto,dataNascimento,pathFotoPerfil,genero_id,tel_ddd,tel_numero,logradouro,numero,complemento,bairro,estado,cidade,pontoReferencia,usuario,email,senha) VALUES(:id,:nomeCompleto, :dataNascimento, :pathFotoPerfil, :genero_id,:tel_ddd, :tel_numero, :logradouro, :numero, :complemento, :bairro, :estado, :cidade, :pontoReferencia, :usuario, :email, :senha)";

        $pessoa->setCodigo($this->totalPessoas()+1);

		$stmt = ConnectionFactory::getInstance()->prepare($sql);
		$ret = $stmt->execute([
                ':id' => $pessoa->getCodigo(),
				':nomeCompleto' => $pessoa->getNomeCompleto(),
				':dataNascimento' => $pessoa->getDataNascimento(),
				':pathFotoPerfil' => $pessoa->getPathFotoPerfil(),
				':genero_id' => $pessoa->getGenero()->getCodigo(),
                ':tel_ddd' => $pessoa->getTelDdd(),
                ':tel_numero' => $pessoa->getTelNumero(),
                ':logradouro' => $pessoa->getLogradouro(),
                ':numero' => $pessoa->getNumero(),
                ':complemento' => $pessoa->getComplemento() == NULL ? NULL : $pessoa->getComplemento(),
                ':bairro' => $pessoa->getBairro(),
                ':estado' => $pessoa->getEstado(),
                ':cidade' => $pessoa->getCidade(),
                ':pontoReferencia' => $pessoa->getPontoReferencia() == NULL ? NULL : $pessoa->getPontoReferencia(),
                ':usuario' => $pessoa->getUsuario(),
                ':email' => $pessoa->getEmail(),
                ':senha' => $pessoa->getSenha()
			]);

            $this->criarSessao($pessoa);

	}

    function atualizarPerfil($pessoa){
        $sql = "UPDATE pessoa SET nomeCompleto = :nomeCompleto, dataNascimento = :dataNascimento, genero_id = :genero_id, email = :email, usuario = :usuario, tel_ddd = :tel_ddd, tel_numero = :tel_numero, biografia = :biografia WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $pessoa->getCodigo(),
                    ':nomeCompleto' => $pessoa->getNomeCompleto(),
                    ':dataNascimento' => $pessoa->getDataNascimento(), 
                    ':genero_id' => $pessoa->getGenero()->getCodigo(),
                    ':email' => $pessoa->getEmail(),
                    ':usuario' => $pessoa->getUsuario(),
                    ':tel_ddd' => $pessoa->getTelDdd(),
                    ':tel_numero' => $pessoa->getTelNumero(),
                    ':biografia' => $pessoa->getBiografia() == null ? null : $pessoa->getBiografia()
                )
            );

        return $ret;

    }

    function atualizarPathFotoPerfil($pessoa){
        $sql = "UPDATE pessoa SET pathFotoPerfil = :pathFotoPerfil WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $pessoa->getCodigo(),
                    ':pathFotoPerfil' => $pessoa->getPathFotoPerfil()
                )
            );

        return $ret;

    }

    function atualizarEndereco($pessoa){
        $sql = "UPDATE pessoa SET logradouro = :logradouro, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado, pontoReferencia = :pontoReferencia WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $pessoa->getCodigo(),
                    ':logradouro' => $pessoa->getLogradouro(), 
                    ':numero' => $pessoa->getNumero(),
                    ':complemento' => $pessoa->getComplemento() == null ? null : $pessoa->getComplemento(),
                    ':bairro' => $pessoa->getBairro(),
                    ':cidade' => $pessoa->getCidade(), 
                    ':estado' => $pessoa->getEstado(),
                    ':pontoReferencia' => $pessoa->getPontoReferencia() == null ? null : $pessoa->getPontoReferencia()
                )
            );

        return $ret;

    }


    function atualizarSenha($pessoa){
        $sql = "UPDATE pessoa SET senha = :senha WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $pessoa->getCodigo(),
                    ':senha' => $pessoa->getSenha()
                )
            );

        return $ret;

    }

    function excluirPessoa($pessoa){
        
        $codigo = $pessoa->getCodigo();
        
        $sql = "DELETE FROM pessoa WHERE id = :id";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->bindParam(':id',$codigo,PDO::PARAM_INT);
        $st->execute();

    }



    function criarSessao($pessoa){

         //Criando a sessão para acessar a página
        session_start();

        $usuario['codigo'] = $pessoa->getCodigo();
        $usuario['usuario'] = $pessoa->getUsuario(); 
        $usuario['email'] = $pessoa->getEmail(); 

        $_SESSION['user'] = $usuario;

    }

    function totalPessoas(){
        $sql = "SELECT COUNT(id) AS 'total' FROM pessoa";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $res[0]->total;
    }

    function validarLogin($email, $senha) {
        $sql = "SELECT id,usuario,email,senha,tokenBloqueio FROM pessoa WHERE email = '".$email."' AND senha = '".$senha."'";
        $st = ConnectionFactory::getInstance()->prepare($sql);
        $st->execute();
        $p = $st->fetchAll(PDO::FETCH_OBJ);
        if (count($p)) 
            return $this->preencherCredenciais($p[0]);
        else
            return null;
    }

    function verificarTokenExiste($tokenBloqueio){
        $sql = "SELECT COUNT(id) AS 'total' FROM pessoa WHERE tokenBloqueio = :tokenBloqueio";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $stmt->bindParam(':tokenBloqueio',$tokenBloqueio,PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $res[0]->total;
    }

    function preencherCredenciais($p){
        $pessoa = new Pessoa();
        $pessoa->setCodigo($p->id);
        $pessoa->setUsuario($p->usuario);
        $pessoa->setEmail($p->email);
        $pessoa->setSenha($p->senha);
        $pessoa->setTokenBloqueio($p->tokenBloqueio);

        return $pessoa;
    }

/******* Bloqueio *******/

    function bloquearPessoa($p) {
        $sql = "UPDATE pessoa SET tokenBloqueio = :tokenBloqueio WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $p->getCodigo(),
                    ':tokenBloqueio' => $p->getTokenBloqueio()
                )
            );

        return $ret;
    }

    function desbloquearPessoa($p) {
        $sql = "UPDATE pessoa SET tokenBloqueio = :tokenBloqueio WHERE id = :id";
        $stmt = ConnectionFactory::getInstance()->prepare($sql);
        $ret = $stmt->execute(
                array(
                    ':id' => $p->getCodigo(),
                    ':tokenBloqueio' => null
                )
            );

        return $ret;
    }

/******* Bloqueio *******/



}