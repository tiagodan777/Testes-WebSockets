<?php
namespace Api\Websocket;

use Exception;
use Psr\Http\Message\UriFactoryInterface;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use SplObjectStorage;

class SistemaChat implements MessageComponentInterface {
    protected $cliente;

    public function __construct()
    {   
        $this->cliente = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->cliente->attach($conn);

        echo "Nova conexão: {$conn->resourceId}. \n\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->cliente as $cliente) {
            if ($from !== $cliente) {
                $cliente->send($msg);
            }
        }

        $this->salvarMensagemNoBancoDeDados($msg);

        // echo "Utilizador {$from->resourceId} enviou uma mensagem. \n\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->cliente->detach($conn);

        echo "O utilizador {$conn->resourceId} desconectou-se. \n\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        $conn->close();

        echo "Ocorreu um erro: {$e->getMessage()}. \n\n";
    }

    private function salvarMensagemNoBancoDeDados($mensagem) {
        $dbConnection = new DbConnection();
        $conn = $dbConnection->getConnection();

        if ($conn === null) {
        error_log("Falha na conexão com o banco de dados.");
        return;
        }

        $sql = "INSERT INTO mensagens (mensagem) VALUES (:mensagem);";

        $addMensagem = $conn->prepare($sql);

        $mensagemArray = json_decode($mensagem, true);

        $addMensagem->bindParam(':mensagem', $mensagemArray['mensagem']);

        $addMensagem->execute();
    }
}