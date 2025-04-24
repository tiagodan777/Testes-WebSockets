<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "websockets";
$port = "8889";

try {
    $conn = new PDO("mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;host=$host;dbname=" . $dbname, $user, $pass);
} catch (PDOException $e) {
    echo "Ocorreu um erro na ligação ao banco de dados: " . $e->getMessage();
}