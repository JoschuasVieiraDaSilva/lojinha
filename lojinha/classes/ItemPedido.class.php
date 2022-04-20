<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class ItemPedido extends conn\Dao {
	private $idItemPedido;
    private $ordem;
    private $idPedido;
    private $idEstoque;
    private $qtdItem;
    private $dtDevolucao;
    private $motivoDevolucao;
	private $resultSet;

    public function __construct($idItemPedido, $ordem, $idPedido, $idEstoque, $qtdItem, $dtDevolucao, $motivoDevolucao) {
		$this->setIdItemPedido($idItemPedido);
        $this->setOrdem($ordem);
        $this->setIdPedido($idPedido);
        $this->setIdEstoque($idEstoque);
        $this->setQtdItem($qtdItem);
        $this->setDtDevolucao($dtDevolucao);
        $this->setMotivoDevolucao($motivoDevolucao);
        $this->setTable('itemsPedido');
        $this->setFields([
            'idItemPedido',
            'ordem',
            'idPedido',
            'idEstoque',
            'qtdItem',
            'dtDevolucao',
            'motivoDevolucao'
        ]);
    }

	public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdItemPedido(),
				$this->getOrdem(),
				$this->getIdPedido(),
				$this->getIdEstoque(),
				$this->getQtdItem(),
				$this->getDtDevolucao(),
				$this->getMotivoDevolucao()
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
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdItemPedido()));
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
					$this->getIdItemPedido(),
					$this->getOrdem(),
					$this->getIdPedido(),
					$this->getIdEstoque(),
					$this->getQtdItem(),
					$this->getDtDevolucao(),
					$this->getMotivoDevolucao()
				],
				$this->getFields()[0],
				$this->getIdItemPedido()
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

	public function getIdItemPedido(){
		return $this->idItemPedido;
	}

	public function setIdItemPedido($idItemPedido){
		$this->idItemPedido = $idItemPedido;
		return $this;
	}

	public function getOrdem(){
		return $this->ordem;
	}

	public function setOrdem($ordem){
		$this->ordem = $ordem;
		return $this;
	}

	public function getIdPedido(){
		return $this->idPedido;
	}

	public function setIdPedido($idPedido){
		$this->idPedido = $idPedido;
		return $this;
	}

	public function getIdEstoque(){
		return $this->idEstoque;
	}

	public function setIdEstoque($idEstoque){
		$this->idEstoque = $idEstoque;
		return $this;
	}

	public function getQtdItem(){
		return $this->qtdItem;
	}

	public function setQtdItem($qtdItem){
		$this->qtdItem = $qtdItem;
		return $this;
	}

	public function getDtDevolucao(){
		return $this->dtDevolucao;
	}

	public function setDtDevolucao($dtDevolucao){
		$this->dtDevolucao = $dtDevolucao;
		return $this;
	}

	public function getMotivoDevolucao(){
		return $this->motivoDevolucao;
	}

	public function setMotivoDevolucao($motivoDevolucao){
		$this->motivoDevolucao = $motivoDevolucao;
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