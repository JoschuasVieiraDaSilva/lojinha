<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class Estoque extends conn\Dao {
    private $idEstoque;
    private $idProduto;
    private $dtEntrada;
    private $quantidade;
    private $dtFabricacao;
    private $dtVencimento;
    private $nfCompra;
    private $precoCompra;
    private $icmsCompra;
    private $precoVenda;
    private $qtdVendida;
    private $qtdOcorrencia;
    private $ocorrencia;
	private $resultSet;

    public function __construct($idEstoque, $idProduto, $dtEntrada, $quantidade, $dtFabricacao, $dtVencimento, $nfCompra, $precoCompra, $icmsCompra, $precoVenda, $qtdVendida, $qtdOcorrencia, $ocorrencia) {
        $this->setIdEstoque($idEstoque);
        $this->setIdProduto($idProduto);
        $this->setDtEntrada($dtEntrada);
        $this->setQuantidade($quantidade);
        $this->setDtFabricacao($dtFabricacao);
        $this->setDtVencimento($dtVencimento);
        $this->setNfCompra($nfCompra);
        $this->setPrecoCompra($precoCompra);
        $this->setIcmsCompra($icmsCompra);
        $this->setPrecoVenda($precoVenda);
        $this->setQtdVendida($qtdVendida);
        $this->setQtdOcorrencia($qtdOcorrencia);
        $this->setOcorrencia($ocorrencia);
        $this->setTable('estoque');
        $this->setFields([
			'idEstoque',
			'idProduto',
			'dtEntrada',
			'quantidade',
			'dtFabricacao',
			'dtVencimento',
			'nfCompra',
			'precoCompra',
			'icmsCompra',
			'precoVenda',
			'qtdVendida',
			'qtdOcorrencia',
			'ocorrencia'
		]);
    }
    
    public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdEstoque(),
                $this->getIdProduto(),
                $this->getDtEntrada(),
                $this->getQuantidade(),
                $this->getDtFabricacao(),
                $this->getDtVencimento(),
                $this->getNfCompra(),
                $this->getPrecoCompra(),
                $this->getIcmsCompra(),
                $this->getPrecoVenda(),
                $this->getQtdVendida(),
                $this->getQtdOcorrencia(),
                $this->getOcorrencia()
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
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdEstoque()));
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
					$this->getIdEstoque(),
					$this->getIdProduto(),
					$this->getDtEntrada(),
					$this->getQuantidade(),
					$this->getDtFabricacao(),
					$this->getDtVencimento(),
					$this->getNfCompra(),
					$this->getPrecoCompra(),
					$this->getIcmsCompra(),
					$this->getPrecoVenda(),
					$this->getQtdVendida(),
					$this->getQtdOcorrencia(),
					$this->getOcorrencia(),
				],
				$this->getFields()[0],
				$this->getIdEstoque()
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

	public function getIdEstoque(){
		return $this->idEstoque;
	}

	public function setIdEstoque($idEstoque){
		$this->idEstoque = $idEstoque;
		return $this;
	}

	public function getIdProduto(){
		return $this->idProduto;
	}

	public function setIdProduto($idProduto){
		$this->idProduto = $idProduto;
		return $this;
	}

	public function getDtEntrada(){
		return $this->dtEntrada;
	}

	public function setDtEntrada($dtEntrada){
		$this->dtEntrada = $dtEntrada;
		return $this;
	}

	public function getQuantidade(){
		return $this->quantidade;
	}

	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
		return $this;
	}

	public function getDtFabricacao(){
		return $this->dtFabricacao;
	}

	public function setDtFabricacao($dtFabricacao){
		$this->dtFabricacao = $dtFabricacao;
		return $this;
	}

	public function getDtVencimento(){
		return $this->dtVencimento;
	}

	public function setDtVencimento($dtVencimento){
		$this->dtVencimento = $dtVencimento;
		return $this;
	}

	public function getNfCompra(){
		return $this->nfCompra;
	}

	public function setNfCompra($nfCompra){
		$this->nfCompra = $nfCompra;
		return $this;
	}

	public function getPrecoCompra(){
		return $this->precoCompra;
	}

	public function setPrecoCompra($precoCompra){
		$this->precoCompra = $precoCompra;
		return $this;
	}

	public function getIcmsCompra(){
		return $this->icmsCompra;
	}

	public function setIcmsCompra($icmsCompra){
		$this->icmsCompra = $icmsCompra;
		return $this;
	}

	public function getPrecoVenda(){
		return $this->precoVenda;
	}

	public function setPrecoVenda($precoVenda){
		$this->precoVenda = $precoVenda;
		return $this;
	}

	public function getQtdVendida(){
		return $this->qtdVendida;
	}

	public function setQtdVendida($qtdVendida){
		$this->qtdVendida = $qtdVendida;
		return $this;
	}

	public function getQtdOcorrencia(){
		return $this->qtdOcorrencia;
	}

	public function setQtdOcorrencia($qtdOcorrencia){
		$this->qtdOcorrencia = $qtdOcorrencia;
		return $this;
	}

	public function getOcorrencia(){
		return $this->ocorrencia;
	}

	public function setOcorrencia($ocorrencia){
		$this->ocorrencia = $ocorrencia;
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