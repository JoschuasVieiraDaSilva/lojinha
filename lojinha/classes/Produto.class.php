<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class Produto extends conn\Dao {
    private $idProduto;
    private $fabricante;
    private $nome;
    private $marca;
    private $modelo;
    private $idCategoria;
    private $descricao;
    private $unidadeMedida;
    private $largura;
    private $altura;
    private $profundidade;
    private $peso;
    private $cor;
	private $resultSet;

    public function __construct($idProduto, $fabricante, $nome, $marca, $modelo, $idCategoria, $descricao, $unidadeMedida, $largura, $altura, $profundidade, $peso, $cor) {
		$this->setIdProduto($idProduto);
        $this->setFabricante($fabricante);
        $this->setNome($nome);
        $this->setMarca($marca);
        $this->setModelo($modelo);
        $this->setIdCategoria($idCategoria);
        $this->setDescricao($descricao);
        $this->setUnidadeMedida($unidadeMedida);
        $this->setLargura($largura);
        $this->setAltura($altura);
        $this->setProfundidade($profundidade);
        $this->setPeso($peso);
        $this->setCor($cor);
        $this->setTable('produtos');
        $this->setFields([
            'idProduto',
            'fabricante',
            'nome',
            'marca',
            'modelo',
            'idCategoria',
            'descricao',
            'unidadeMedida',
            'largura',
            'altura',
            'profundidade',
            'peso',
            'cor'
        ]);
    }

	public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdProduto(),
				$this->getFabricante(),
				$this->getNome(),
				$this->getMarca(),
				$this->getModelo(),
				$this->getIdCategoria(),
				$this->getDescricao(),
				$this->getUnidadeMedida(),
				$this->getLargura(),
				$this->getAltura(),
				$this->getProfundidade(),
				$this->getPeso(),
				$this->getCor()
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
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdProduto()));
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
                    $this->getIdProduto(),
					$this->getFabricante(),
					$this->getNome(),
					$this->getMarca(),
					$this->getModelo(),
					$this->getIdCategoria(),
					$this->getDescricao(),
					$this->getUnidadeMedida(),
					$this->getLargura(),
					$this->getAltura(),
					$this->getProfundidade(),
					$this->getPeso(),
					$this->getCor()
                ],
                $this->getFields()[0],
                $this->getIdProduto()
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
    
    public function getIdProduto(){
        return $this->idProduto;
    }
    
    public function setIdProduto($idProduto){
        $this->idProduto = $idProduto;
        return $this;
    }

	public function getFabricante(){
		return $this->fabricante;
	}

	public function setFabricante($fabricante){
		$this->fabricante = $fabricante;
		return $this;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getMarca(){
		return $this->marca;
	}

	public function setMarca($marca){
		$this->marca = $marca;
		return $this;
	}

	public function getModelo(){
		return $this->modelo;
	}

	public function setModelo($modelo){
		$this->modelo = $modelo;
		return $this;
	}

	public function getIdCategoria(){
		return $this->idCategoria;
	}

	public function setIdCategoria($idCategoria){
		$this->idCategoria = $idCategoria;
		return $this;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
		return $this;
	}

	public function getUnidadeMedida(){
		return $this->unidadeMedida;
	}

	public function setUnidadeMedida($unidadeMedida){
		$this->unidadeMedida = $unidadeMedida;
		return $this;
	}

	public function getLargura(){
		return $this->largura;
	}

	public function setLargura($largura){
		$this->largura = $largura;
		return $this;
	}

	public function getAltura(){
		return $this->altura;
	}

	public function setAltura($altura){
		$this->altura = $altura;
		return $this;
	}

	public function getProfundidade(){
		return $this->profundidade;
	}

	public function setProfundidade($profundidade){
		$this->profundidade = $profundidade;
		return $this;
	}

	public function getPeso(){
		return $this->peso;
	}

	public function setPeso($peso){
		$this->peso = $peso;
		return $this;
	}

	public function getCor(){
		return $this->cor;
	}

	public function setCor($cor){
		$this->cor = $cor;
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