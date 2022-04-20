<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class Usuario extends conn\Dao {
    private $idUsuario;
    private $email;
    private $senha;
    private $idNivelUsuario;
    private $nome;
    private $cpf;
    private $endereco;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $telefone;
    private $foto;
    private $ativo;
	private $resultSet;

    public function __construct($idUsuario, $email, $senha, $idNivelUsuario, $nome, $cpf, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $foto, $ativo) {
        $this->setIdUsuario($idUsuario);
		$this->setEmail($email);
        $this->setSenha($senha);
        $this->setIdNivelUsuario($idNivelUsuario);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setEndereco($endereco);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setUf($uf);
        $this->setCep($cep);
        $this->setTelefone($telefone);
        $this->setFoto($foto);
        $this->setAtivo($ativo);
        $this->setTable('usuarios');
        $this->setFields([
            'idUsuario',
            'email',
            'senha',
            'idNivelUsuario',
            'nome',
            'cpf',
            'endereco',
            'bairro',
            'cidade',
            'uf',
            'cep',
            'telefone',
            'foto',
            'ativo'
        ]);
    }
    
    public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdUsuario(),
				$this->getEmail(),
				$this->getSenha(),
				$this->getIdNivelUsuario(),
				$this->getNome(),
				$this->getCpf(),
				$this->getEndereco(),
				$this->getBairro(),
				$this->getCidade(),
				$this->getUf(),
				$this->getCep(),
				$this->getTelefone(),
				$this->getFoto(),
				$this->getAtivo()
            ]));
            $this->setResultSet($connection->errno());
            $connection->close();
        } catch (\Exception $e) {
            $this->setResultSet($e);
        }
    }
    
    public function delete() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdUsuario()));
            $this->setResultSet($connection->errno());
            $connection->close();
        } catch (\Exception $e) {
            $this->setResultSet($e);
        }
    }
    
    public function update() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->updateCmd(
                [
                    $this->getIdUsuario(),
					$this->getEmail(),
					$this->getSenha(),
					$this->getIdNivelUsuario(),
					$this->getNome(),
					$this->getCpf(),
					$this->getEndereco(),
					$this->getBairro(),
					$this->getCidade(),
					$this->getUf(),
					$this->getCep(),
					$this->getTelefone(),
					$this->getFoto(),
					$this->getAtivo()
                ],
                $this->getFields()[0],
                $this->getIdUsuario()
                ));
            $this->setResultSet($connection->errno());
            $connection->close();
        } catch (\Exception $e) {
            $this->setResultSet($e);
        }
    }
    
    public function list() {
        try {
            $connection = $this->newConnection();
            $result = $connection->query($this->selectCmd());
            if ($connection->errno() == 0) {
                $array = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($array, $row);
                }
                $this->setResultSet($array);
            } else {
                $this->setResultSet($connection->errno());
            }
            $connection->close();
        } catch (\Exception $e) {
            $this->setResultSet($e);
        }
    }
    
    private function newConnection() {
        return new conn\DBConnection();
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }
    
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
        return $this;
    }
    
	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
		return $this;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
		return $this;
	}

	public function getIdNivelUsuario(){
		return $this->idNivelUsuario;
	}

	public function setIdNivelUsuario($idNivelUsuario){
		$this->idNivelUsuario = $idNivelUsuario;
		return $this;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
		return $this;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
		return $this;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
		return $this;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
		return $this;
	}

	public function getUf(){
		return $this->uf;
	}

	public function setUf($uf){
		$this->uf = $uf;
		return $this;
	}

	public function getCep(){
		return $this->cep;
	}

	public function setCep($cep){
		$this->cep = $cep;
		return $this;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
		return $this;
	}

	public function getFoto(){
		return $this->foto;
	}

	public function setFoto($foto){
		$this->foto = $foto;
		return $this;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
		return $this;
	}
	
	public function getResultSet(){
	    return $this->resultSet;
	}
	
	public function setResultSet($resultSet){
	    $this->resultSet = $resultSet;
	    return $this;
	}
}

?>