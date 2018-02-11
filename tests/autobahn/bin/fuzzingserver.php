<?php
use Reamp\ConnectionInterface;

require \dirname(\dirname(\dirname(__DIR__))) . '/vendor/autoload.php';

class BinaryEcho implements \Reamp\WebSocket\MessageComponentInterface {
    public function onMessage(ConnectionInterface $from, \Ratchet\RFC6455\Messaging\MessageInterface $msg) {
        $from->send($msg);
    }

    public function onOpen(ConnectionInterface $conn) {
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}

    $port = $argc > 1 ? $argv[1] : 8000;
    $loop = \Amp\Loop::get();
    $sock = \Amp\Socket\listen('0.0.0.0:' . $port);

    $wsServer = new Reamp\WebSocket\WsServer(new BinaryEcho);
    // This is enabled to test https://github.com/ratchetphp/Ratchet/issues/430
    // The time is left at 10 minutes so that it will not try to every ping anything
    // This causes the Ratchet server to crash on test 2.7
    $wsServer->enableKeepAlive($loop, 600);

    $app = new Reamp\Http\HttpServer($wsServer);

    $server = new Reamp\Server\IoServer($app, $sock, $loop);
    $server->run();
