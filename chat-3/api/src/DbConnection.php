<?php
namespace Api\Websocket;

use PDO;
use PDOException;

class DbConnection {
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $dbname = "websockets";
    private $port = "8889";
    private $connect;

    public function getConnection() {
        try {
            $this->connect = new PDO('mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=websockets;charset=utf8','root', 'root');
            return $this->connect;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null; // Adicione isso aqui
        }
    }
}