<?php

namespace classes;

include_once 'connection/DBConnection.class.php';
include_once 'connection/Dao.class.php';

use classes\connection as conn;

class NivelUsuario extends conn\Dao {
    private $idNivelUsuario;
    private $nivel;
    private $resultSet;
    
    public function __construct($idNivelUsuario, $nivel) {
        $this->setIdNivelUsuario($idNivelUsuario);
        $this->setNivel($nivel);
        $this->setTable('nivelUsuarios');
        $this->setFields([
            'idNivelUsuario',
            'nivel'
        ]);
    }
    
    public function save() {
        try {
            $connection = $this->newConnection();
            $connection->query($this->insertCmd([
                $this->getIdNivelUsuario(),
                $this->getNivel()
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
            $connection->query($this->deleteCmd($this->getFields()[0], $this->getIdNivelUsuario()));
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
                    $this->getIdNivelUsuario(),
                    $this->getNivel()
                ],
                $this->getFields()[0],
                $this->getIdNivelUsuario()
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

    public function getIdNivelUsuario(){
        return $this->idNivelUsuario;
    }
    
    public function setIdNivelUsuario($idNivelUsuario){
        $this->idNivelUsuario = $idNivelUsuario;
        return $this;
    }
    
	public function getNivel(){
		return $this->nivel;
	}

	public function setNivel($nivel){
		$this->nivel = $nivel;
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