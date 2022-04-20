<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class Institucional extends conn\Dao {
	private $idInstituicao;
    private $nome;
    private $cpf_cnpj;
    private $tipoPessoa;
    private $endereco;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $telefone;
    private $email;
    private $logo;
	private $resultSet;
    
    public function __construct($idInstituicao, $nome, $cpf_cnpj, $tipoPessoa, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $email, $logo) {
		$this->setIdInstituicao($idInstituicao);
        $this->setNome($nome);
        $this->setCpf_cnpj($cpf_cnpj);
        $this->setTipoPessoa($tipoPessoa);
        $this->setEndereco($endereco);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setUf($uf);
        $this->setCep($cep);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        $this->setLogo($logo);
		$this->setTable('institucional');
		$this->setFields([
			'idInstituicao',
			'nome',
			'cpf_cnpj',
			'tipoPessoa',
			'endereco',
			'bairro',
			'cidade',
			'uf',
			'cep',
			'telefone',
			'email',
			'logo'
		]);
    }

	public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdInstituicao(),
				$this->getNome(),
				$this->getCpf_cnpj(),
				$this->getTipoPessoa(),
				$this->getEndereco(),
				$this->getBairro(),
				$this->getCidade(),
				$this->getUf(),
				$this->getCep(),
				$this->getTelefone(),
				$this->getEmail(),
				$this->getLogo()
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
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdInstituicao()));
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
					$this->getIdInstituicao(),
					$this->getNome(),
					$this->getCpf_cnpj(),
					$this->getTipoPessoa(),
					$this->getEndereco(),
					$this->getBairro(),
					$this->getCidade(),
					$this->getUf(),
					$this->getCep(),
					$this->getTelefone(),
					$this->getEmail(),
					$this->getLogo()
				],
				$this->getFields()[0],
				$this->getIdInstituicao()
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

	public function getIdInstituicao(){
		return $this->idInstituicao;
	}

	public function setIdInstituicao($idInstituicao){
		$this->idInstituicao = $idInstituicao;
		return $this;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getCpf_cnpj(){
		return $this->cpf_cnpj;
	}

	public function setCpf_cnpj($cpf_cnpj){
		$this->cpf_cnpj = $cpf_cnpj;
		return $this;
	}

	public function getTipoPessoa(){
		return $this->tipoPessoa;
	}

	public function setTipoPessoa($tipoPessoa){
		$this->tipoPessoa = $tipoPessoa;
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

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
		return $this;
	}

	public function getLogo(){
		return $this->logo;
	}

	public function setLogo($logo){
		$this->logo = $logo;
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