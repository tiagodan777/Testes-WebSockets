<?php
namespace Api\Websocket;

use PDO;
use PDOException;

class DbConnection {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "chat";
    private $port = "8889";
    private $connect;

    public function getConnection() {
        try {
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->connect;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}