<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class Pedido extends conn\Dao {
    private $idPedido;
    private $idUsuario;
    private $dtPedido;
    private $dtPagamento;
    private $dtNotaFiscal;
    private $notaFiscal;
    private $dtEnvio;
    private $dtRecebimento;
    private $tipoFrete;
    private $rastreioFrete;
    private $entregaendereco;
    private $entregaNumero;
    private $entregaCompl;
    private $entregaBairro;
    private $entregaCidade;
    private $entregaUF;
    private $entregaCEP;
    private $entregaTelefone;
    private $entregaRefer;
    private $valorTotal;
    private $qtdItems;
    private $dtDevolucao;
    private $motivoDevolucao;
	private $resultSet;

    public function __construct($idPedido, $idUsuario, $dtPedido, $dtPagamento, $dtNotaFiscal, $notaFiscal, $dtEnvio, $dtRecebimento, $tipoFrete, $rastreioFrete, $entregaendereco, $entregaNumero, $entregaCompl, $entregaBairro, $entregaCidade, $entregaUF, $entregaCEP, $entregaTelefone, $entregaRefer, $valorTotal, $qtdItems, $dtDevolucao, $motivoDevolucao) {
		$this->setIdPedido($idPedido);
        $this->setIdUsuario($idUsuario);
        $this->setDtPedido($dtPedido);
        $this->setDtPagamento($dtPagamento);
        $this->setDtNotaFiscal($dtNotaFiscal);
        $this->setNotaFiscal($notaFiscal);
        $this->setDtEnvio($dtEnvio);
        $this->setDtRecebimento($dtRecebimento);
        $this->setTipoFrete($tipoFrete);
        $this->setRastreioFrete($rastreioFrete);
        $this->setEntregaendereco($entregaendereco);
        $this->setEntregaNumero($entregaNumero);
        $this->setEntregaCompl($entregaCompl);
        $this->setEntregaBairro($entregaBairro);
        $this->setEntregaCidade($entregaCidade);
        $this->setEntregaUF($entregaUF);
        $this->setEntregaCEP($entregaCEP);
        $this->setEntregaTelefone($entregaTelefone);
        $this->setEntregaRefer($entregaRefer);
        $this->setValorTotal($valorTotal);
        $this->setQtdItems($qtdItems);
        $this->setDtDevolucao($dtDevolucao);
        $this->setMotivoDevolucao($motivoDevolucao);
        $this->setTable('pedidos');
        $this->setFields([
            'idPedido',
            'idUsuario',
            'dtPedido',
            'dtPagamento',
            'dtNotaFiscal',
            'notaFiscal',
            'dtEnvio',
            'dtRecebimento',
            'tipoFrete',
            'rastreioFrete',
            'entregaendereco',
            'entregaNumero',
            'entregaCompl',
            'entregaBairro',
            'entregaCidade',
            'entregaUF',
            'entregaCEP',
            'entregaTelefone',
            'entregaRefer',
            'valorTotal',
            'qtdItems',
            'dtDevolucao',
            'motivoDevolucao'
        ]);
    }
    
    public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdPedido(),
                $this->getIdUsuario(),
                $this->getDtPedido(),
                $this->getDtPagamento(),
                $this->getDtNotaFiscal(),
                $this->getNotaFiscal(),
                $this->getDtEnvio(),
                $this->getDtRecebimento(),
                $this->getTipoFrete(),
                $this->getRastreioFrete(),
                $this->getEntregaendereco(),
                $this->getEntregaNumero(),
                $this->getEntregaCompl(),
                $this->getEntregaBairro(),
                $this->getEntregaCidade(),
                $this->getEntregaUF(),
                $this->getEntregaCEP(),
                $this->getEntregaTelefone(),
                $this->getEntregaRefer(),
                $this->getValorTotal(),
                $this->getQtdItems(),
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
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdPedido()));
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
                    $this->getIdPedido(),
					$this->getIdUsuario(),
					$this->getDtPedido(),
					$this->getDtPagamento(),
					$this->getDtNotaFiscal(),
					$this->getNotaFiscal(),
					$this->getDtEnvio(),
					$this->getDtRecebimento(),
					$this->getTipoFrete(),
					$this->getRastreioFrete(),
					$this->getEntregaendereco(),
					$this->getEntregaNumero(),
					$this->getEntregaCompl(),
					$this->getEntregaBairro(),
					$this->getEntregaCidade(),
					$this->getEntregaUF(),
					$this->getEntregaCEP(),
					$this->getEntregaTelefone(),
					$this->getEntregaRefer(),
					$this->getValorTotal(),
					$this->getQtdItems(),
					$this->getDtDevolucao(),
					$this->getMotivoDevolucao()
                ],
                $this->getFields()[0],
                $this->getIdPedido()
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
    
    public function getIdPedido(){
        return $this->idPedido;
    }
    
    public function setIdPedido($idPedido){
        $this->idPedido = $idPedido;
        return $this;
    }

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
		return $this;
	}

	public function getDtPedido(){
		return $this->dtPedido;
	}

	public function setDtPedido($dtPedido){
		$this->dtPedido = $dtPedido;
		return $this;
	}

	public function getDtPagamento(){
		return $this->dtPagamento;
	}

	public function setDtPagamento($dtPagamento){
		$this->dtPagamento = $dtPagamento;
		return $this;
	}

	public function getDtNotaFiscal(){
		return $this->dtNotaFiscal;
	}

	public function setDtNotaFiscal($dtNotaFiscal){
		$this->dtNotaFiscal = $dtNotaFiscal;
		return $this;
	}

	public function getNotaFiscal(){
		return $this->notaFiscal;
	}

	public function setNotaFiscal($notaFiscal){
		$this->notaFiscal = $notaFiscal;
		return $this;
	}

	public function getDtEnvio(){
		return $this->dtEnvio;
	}

	public function setDtEnvio($dtEnvio){
		$this->dtEnvio = $dtEnvio;
		return $this;
	}

	public function getDtRecebimento(){
		return $this->dtRecebimento;
	}

	public function setDtRecebimento($dtRecebimento){
		$this->dtRecebimento = $dtRecebimento;
		return $this;
	}

	public function getTipoFrete(){
		return $this->tipoFrete;
	}

	public function setTipoFrete($tipoFrete){
		$this->tipoFrete = $tipoFrete;
		return $this;
	}

	public function getRastreioFrete(){
		return $this->rastreioFrete;
	}

	public function setRastreioFrete($rastreioFrete){
		$this->rastreioFrete = $rastreioFrete;
		return $this;
	}

	public function getEntregaendereco(){
		return $this->entregaendereco;
	}

	public function setEntregaendereco($entregaendereco){
		$this->entregaendereco = $entregaendereco;
		return $this;
	}

	public function getEntregaNumero(){
		return $this->entregaNumero;
	}

	public function setEntregaNumero($entregaNumero){
		$this->entregaNumero = $entregaNumero;
		return $this;
	}

	public function getEntregaCompl(){
		return $this->entregaCompl;
	}

	public function setEntregaCompl($entregaCompl){
		$this->entregaCompl = $entregaCompl;
		return $this;
	}

	public function getEntregaBairro(){
		return $this->entregaBairro;
	}

	public function setEntregaBairro($entregaBairro){
		$this->entregaBairro = $entregaBairro;
		return $this;
	}

	public function getEntregaCidade(){
		return $this->entregaCidade;
	}

	public function setEntregaCidade($entregaCidade){
		$this->entregaCidade = $entregaCidade;
		return $this;
	}

	public function getEntregaUF(){
		return $this->entregaUF;
	}

	public function setEntregaUF($entregaUF){
		$this->entregaUF = $entregaUF;
		return $this;
	}

	public function getEntregaCEP(){
		return $this->entregaCEP;
	}

	public function setEntregaCEP($entregaCEP){
		$this->entregaCEP = $entregaCEP;
		return $this;
	}

	public function getEntregaTelefone(){
		return $this->entregaTelefone;
	}

	public function setEntregaTelefone($entregaTelefone){
		$this->entregaTelefone = $entregaTelefone;
		return $this;
	}

	public function getEntregaRefer(){
		return $this->entregaRefer;
	}

	public function setEntregaRefer($entregaRefer){
		$this->entregaRefer = $entregaRefer;
		return $this;
	}

	public function getValorTotal(){
		return $this->valorTotal;
	}

	public function setValorTotal($valorTotal){
		$this->valorTotal = $valorTotal;
		return $this;
	}

	public function getQtdItems(){
		return $this->qtdItems;
	}

	public function setQtdItems($qtdItems){
		$this->qtdItems = $qtdItems;
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