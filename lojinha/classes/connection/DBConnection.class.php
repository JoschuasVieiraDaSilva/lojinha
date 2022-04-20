<?php

namespace classes\connection;

class DBConnection {
    private $host;
    private $username;
    private $passwd;
    private $dbname;
    private $connection;

    function __construct($host = 'localhost', $username = 'root', $passwd = '123456', $dbname = 'lojinha') {
        $this->setHost($host);
        $this->setUsername($username);
        $this->setPasswd($passwd);
        $this->setDbname($dbname);
        $this->setConnection(new \mysqli($this->getHost(), $this->getUsername(), $this->getPasswd(), $this->getDbname()));
    }
    
    public function query($query) {
        return $this->getConnection()->query($query);
    }
    
    public function close() {
        $this->getConnection()->close();
    }
    
    public function errno() {
        return $this->getConnection()->errno;
    }
    
    public function getHost() {
        return $this->host;
    }
    
    public function setHost($host) {
        $this->host = $host;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getPasswd() {
        return $this->passwd;
    }
    
    public function setPasswd($passwd) {
        $this->passwd = $passwd;
    }
    
    public function getDbname() {
        return $this->dbname;
    }
    
    public function setDbname($dbname) {
        $this->dbname = $dbname;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function setConnection($connection) {
        $this->connection = $connection;
    }
}

?>