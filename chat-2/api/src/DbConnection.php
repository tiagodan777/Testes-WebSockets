<?php
namespace Api\Websocket;

use PDO;
use PDOException;

class DbConnection {
    private $host = "localhost";
    private $user = "reisupremo";
    private $pass = "Tiago1234";
    private $dbname = "chat-websocket";
    private $port = "8889";
    private $connect;

    public function getConnection() {
        try {
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}